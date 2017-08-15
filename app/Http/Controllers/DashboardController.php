<?php

namespace App\Http\Controllers;

use App\CardDesign;
use App\Companies;
use App\CompaniesCardTemplate;
use App\CompanyContacts;
use App\Contacts;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->companies = new Companies();
        $this->companiesContacts = new CompanyContacts();
        $this->contacts = new Contacts();
        $this->designCards = new CardDesign();
        $this->cardTemplate  = new CompaniesCardTemplate();
    }
    public function dashboardIndex() {
        return view('home');
    }

    public function designCards(Request $request)
    {
        $companies = array();
        $this->card  = new CardDesign();
        if (Auth::user()->hasRole('super_admin')) {
            $companies = $this->companies->getCompanies();
        }
        return view('cardDesign.index',[
            'companies' => $companies,
            'design' => $this->card->where('uploader_id', '=', Auth::user()->id)->get()
        ]);
    }

    public function getCompanyUsers(Request $request)
    {
        $users = array();
        $users = $this->companiesContacts->getCompanyContacts($request['id']);
        return collect([
            'users' => $users
        ]);
    }

    public function saveImage(Request $request)
    {
        $data = Input::all();
        $png_url = "perfil-".time().".png";
        $path = public_path() . "/assets/images/" . $png_url;
        $img = $data['imgBase64'];
        $img = substr($img, strpos($img, ",")+1);
        $data = base64_decode($img);
        $success = file_put_contents($path, $data);
        if ((int)$request['cardSide'] == 1) {
            $this->contacts->where('id', '=', $request['contactId'])->update([
                'card_front' => $png_url
            ]);
        } else {
            $this->contacts->where('id', '=', $request['contactId'])->update([
                'card_back' => $png_url
            ]);
        }

        return collect([
            'status' => 'success'
        ]);
    }

    public function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }

    public function saveBackgroundImage(Request $request)
    {
        if (Input::hasFile('uploadImage')) {
            $dt = Carbon::parse(Carbon::Now());
            $timeStamp = $dt->timestamp;
            $destinationPath = public_path() . '/assets/images';
            $extension = Input::file('uploadImage')->getClientOriginalExtension();
            $fileOriginalName = preg_replace('/[^A-Za-z0-9\-]/', '', Input::file('uploadImage')->getClientOriginalName());
            $fileOriginalName = str_replace('.' . $extension, "", $fileOriginalName);
            $fileName = $timeStamp . '__' . $fileOriginalName . '.' . $extension;
            $resp = Input::file('uploadImage')->move($destinationPath, $fileName);
            $this->designCards->create([
               'uploader_id' => Auth::user()->id,
                'card' => $fileName
            ]);
            return redirect('/dashboard/design-card');
        } else {
            return redirect('/dashboard/design-card');
        }
    }
}
