<?php

namespace App\Http\Controllers;

use App\Companies;
use App\CompanyContacts;
use App\Contacts;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __construct()
    {
        $this->companies = new Companies();
        $this->companyContact = new CompanyContacts();
        $this->user = new User();
        $this->contacts = new Contacts();
    }

    public function index()
    {
        $isAdmin = Auth::user()->hasRole('super_admin');
        $domain = '';
        if (!$isAdmin || count($isAdmin) < 0) {
            $companiesObj = $this->companies->getCompanies(Auth::user()->id);
            if ($companiesObj && count($companiesObj) > 0) {
                $domain = $companiesObj[0]['domain'];
            }
        }

        return view('createUser',[
            'companies' => $this->companies->getCompanies(),
            'domain' => $domain
        ]);
    }

    public function createUser(Request $request)
    {

        try {
            $email = $request['email'];
            $company = $request['company_id'];
            $name = $request['name'];
//            if (!Input::hasFile('card_front')) {
//                return redirect()->back()->with('error', 'Card front image required...!');
//            }
//            if (!Input::hasFile('card_back')) {
//                return redirect()->back()->with('error', 'Card back image required...!');
//            }
            if (!$email) {
                return redirect()->back()->with('error', 'Email is required...!');
            }
            $isAdmin = Auth::user()->hasRole('super_admin');
            if ($isAdmin) {
                if (!$company) {
                    return redirect()->back()->with('error', 'Company is required...!');
                }
            }

            if (!$name) {
                return redirect()->back()->with('error', 'Name is required...!');
            }

//            $dt = Carbon::parse(Carbon::Now());
//            $timeStamp = $dt->timestamp;
//            $destinationPath = public_path() . '/users';
//
//            $extension = Input::file('card_front')->getClientOriginalExtension();
//            $fileOriginalName = Input::file('card_front')->getClientOriginalName();
//            $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
//            $fileNameFront = $timeStamp . '__front' . '__' . $fileOriginalName . '.' . $extension;
//            Input::file('card_front')->move($destinationPath, $fileNameFront);
//
//            $extension = Input::file('card_back')->getClientOriginalExtension();
//            $fileOriginalName = Input::file('card_back')->getClientOriginalName();
//            $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
//            $fileNameBack = $timeStamp . '__back' . '__' . $fileOriginalName . '.' . $extension;
//            Input::file('card_back')->move($destinationPath, $fileNameBack);
	        $fileNameFront = '';
	        $fileNameBack='';
            $userObj = $this->user->createUser($request);
            $contactObj = $this->contacts->createContact($request, $fileNameFront, $fileNameBack);
            $abc = $this->companyContact->createCompanyContact($request, $userObj->id, $contactObj->id);
	          self::createOpenFireAccount($userObj->id);
            if (!$abc) {
                $this->contacts->where('email', '=', $request['email'])->delete();
                $this->user->where('email', '=', $request['email'])->delete();
                return redirect('/404');
            }
            $roleObj = $this->user->assignRole($userObj, 3);
            return redirect()->back()->with('message', 'User Created...!');
        } catch (\Exception $e) {
            dd($e);
        }
    }
	
		public function createOpenFireAccount($id = false)
		{
			try {
				if (!$id) {
					return false;
				}
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_PORT => "9090",
					CURLOPT_URL => "http://69.64.88.48:9090/plugins/userService/userservice?secret=PuPfh9eC&type=add&username=" . $id . "&password=" . $id,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
						"cache-control: no-cache",
						"postman-token: 9aee50c3-7fdb-820b-c802-d1d1ffde6d35"
					),
				));
				
				$response = curl_exec($curl);
				$err = curl_error($curl);
				
				curl_close($curl);
			} catch (\Exception $e){}
		
		}

    public function usersListing() {
        if (Auth::user()->hasRole('super_admin')) {
            $users = $this->contacts->getAllContacts();
            return view('usersListing', [
                'users' => $users
            ]);
        } else {
            $companyObj = $this->companies->where('user_id', '=', Auth::user()->id)->first();
            $companyContacts = ($this->companyContact->getCompanyContacts($companyObj->id));

            return view('contactsListing', [
                'users' => $companyContacts
            ]);
        }
    }

}
