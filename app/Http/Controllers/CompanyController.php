<?php

namespace App\Http\Controllers;

use App\Companies;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->companies = new Companies();
    }

    public function index() {
        return view('createCompany');
    }

    public function companiesListing() {
        $companies = $this->companies->getCompanies();
        return view('companiesListing',[
           'companies' =>  $companies
        ]);
    }

    public function createCompany(Request $request) {
        try {

            $domain = $request['domain'];
            $name= $request['name'];
            $email = $request['email'];
            if (!$domain) {
                    return redirect()->back()->with('error', 'Domain is required...!');
            }
            if (!$name) {
                return redirect()->back()->with('error', 'Name is required...!');
            }
            if (!$email) {
                return redirect()->back()->with('error', 'Email is required...!');
            }

            if (Input::hasFile('uploadImage')) {
                $dt = Carbon::parse(Carbon::Now());
                $timeStamp = $dt->timestamp;
                $destinationPath = public_path() . '/assets/images';
                $extension = Input::file('uploadImage')->getClientOriginalExtension();
                $fileOriginalName = Input::file('uploadImage')->getClientOriginalName();
                $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
                $fileName = $timeStamp . '__' . $fileOriginalName . '.' . $extension;
                Input::file('uploadImage')->move($destinationPath, $fileName);
                $userObj = $this->user->createUser($request);
                $companyObj = $this->companies->createCompany($request, $fileName, $userObj->id);
                $roleObj = $this->user->assignRole($userObj, 2);
                return redirect()->back()->with('message', 'Company Created...!');
            } else {
                return redirect()->back()->with('error', 'Company logo is required...!');
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
