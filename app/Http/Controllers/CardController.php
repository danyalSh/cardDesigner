<?php

namespace App\Http\Controllers;

use App\CompaniesCardTemplate;
use App\CompanyContacts;
use App\Http\Requests;
use App\Services\CommonService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{

	public function __construct()
	{
		$this->companyCard = new CompaniesCardTemplate();
		$this->companiesContacts = new CompanyContacts();
		$this->user = new User();
	}

	public function frontCard()
	{
//		return self::backCard();
		$template = ($this->user->getCompanyFrontCard());
		$data = $template['data'] ? $template['data'] : '';
		$htmlPreview = $template['htmlPreview'] ? $template['htmlPreview'] : '';
		return collect([
			'status' => 'success',
			'card' => $data,
			'htmlPreview' => $htmlPreview
		]);
	}
	public function backCard()
	{
		$template = ($this->user->getCompanyBackCard());
		$data = $template['data'] ? $template['data'] : '';
//		$data = $template['htmlPreview'] ? $template['htmlPreview'] : '';
		$htmlPreview = $template['htmlPreview'] ? $template['htmlPreview'] : '';
//		return \Response::json(view('cardDesign.editCard', compact('data'))->render());
////		return Response::j
//son(array('body' => View::make('product',array('product'=>$product))->render()));

//		return view('cardDesign.editCard', [
//			'data' => json_decode($template['data'])
//		]);
		return collect([
			'status' => 'success',
			'card' => $data,
			'htmlPreview' => $htmlPreview
		]);
	}

	public function processCard(Request $request)
	{
//		dd($request['image']);
//		$request->add(['uploadImage' => $request['image']]);
//		$request->request->add(['uploadImage', $request['image']]);
//		dd($request->all());
//			echo ($_REQUEST['se_company']);
//
//			dd($request->all());
//		dd($request->all());
			$this->service = new CommonService();
//		dd($request['image']);
			$this->service->uploadFileNew($request);
			$cardTemplateHTML = json_encode(self::getCardJson($request));
			$cardSide = ($_REQUEST['se_card_side']);
			$cardCompany = ($_REQUEST['se_company']);
			$cardhtml = (isset($_REQUEST['se_card_html']) ? $_REQUEST['se_card_html']  : '');
			dd($this->companyCard->createCompanyCard($cardCompany, $cardTemplateHTML, $cardSide, $cardhtml));
	}

	public function getContacts(Request $request)
	{
		$contact = $this->companiesContacts->getCompanyContacts($request['id']);
		$companyTemplate  = $this->companyCard->getTemplate($request['id']);
		foreach ($companyTemplate as $key1 => $val1) {
				foreach ($contact as $key => $val) {
					if ((int)$val1->card_side == 1) {
						$bc = (json_decode($val1->card_json));
						if (isset($bc->heading->text))
						$bc->heading->text = $val->contacts->designation;
						if (isset($bc->title1->text))
						$bc->title1->text = $val->contacts->first_name ;
						if (isset($bc->title2->text))
						$bc->title2->text = $val->contacts->lasst_name ;
						if (isset($bc->phone->text))
						$bc->phone->text = $val->contacts->phone ;
						if (isset($bc->mobile->text))
						$bc->mobile->text = $val->contacts->mobile ;
						if (isset($bc->fax->text))
						$bc->fax->text = $val->contacts->fax ;

						$val->contacts->card_front = $bc;
						$val->contacts->card_front->card_template = $val1->template_html;
					} else if ((int)$val1->card_side == 2) {
						$bc = (json_decode($val1->card_json));
						if (isset($bc->heading->text))
						$bc->heading->text = $val->contacts->designation;
						if (isset($bc->title1->text))
						$bc->title1->text = $val->contacts->first_name ;
						if (isset($bc->title2->text))
						$bc->title2->text = $val->contacts->lasst_name ;
						if (isset($bc->phone->text))
						$bc->phone->text = $val->contacts->phone ;
						if (isset($bc->mobile->text))
						$bc->mobile->text = $val->contacts->mobile ;
						if (isset($bc->fax->text))
						$bc->fax->text = $val->contacts->fax ;


						$val->contacts->card_back = $bc;
						$val->contacts->card_back->card_template = $val1->template_html;
					}
			}
		}


//		dd(json_encode($contact));
		return collect([
			'stats' => 'success',
			'data' => $contact
		]);
	}

	public function getCardJson($request)
	{
//		dd($_REQUEST);
		$_REQUEST = $request->all();
		$final_array = array();
		$heading = (!empty($_REQUEST['heading'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['heading'])) : array();
//		dd($heading);
		if(count($heading) > 0){
			$heading[1] = str_replace('position:absolute;cursor:all-scroll;','',$heading[1]);
			$heading_1 = explode(';', $heading[1]);
			$heading_left = preg_replace("/[^0-9,.]/", "", $heading_1[0]);
			$heading_top = preg_replace("/[^0-9,.]/", "", $heading_1[1]);
			$class_h = explode('editable-click', $heading[2]);
//			dd($class_h);
			$heading[2] = (!empty($class_h[0])) ? trim($class_h[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $heading['0'];
			$fontArray['left'] = $heading_left;
			$fontArray['top'] = $heading_top;
//			dd('111');
			if(count($heading[2]) > 0){
				$fontStyle = explode(' ', $heading[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['heading'] = $fontArray;
		}


		$title1 = (!empty($_REQUEST['title1'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['title1'])) : array();
		if(count($title1) > 0){
			$title1[1] = str_replace('position:absolute;cursor:all-scroll;','',$title1[1]);
			$title_1 = explode(';', $title1[1]);
			$title_left = preg_replace("/[^0-9,.]/", "", $title_1[0]);
			$title_top = preg_replace("/[^0-9,.]/", "", $title_1[1]);
			$class_title1 = explode('editable-click', $title1[2]);
			$title1[2] = (!empty($class_title1[0])) ? trim($class_title1[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $title1[0];
			$fontArray['left'] = $title_left;
			$fontArray['top'] = $title_top;
			if(count($title1['2']) > 0){
				$fontStyle = explode(' ', $title1['2']);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['title1'] = $fontArray;
		}

		$title2 = (!empty($_REQUEST['title2'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['title2'])) : array();
		if(count($title2) > 0){
			$title2[1] = str_replace('position:absolute;cursor:all-scroll;','',$title2[1]);
			$title_2 = explode(';', $title2[1]);
			$title2_left = preg_replace("/[^0-9,.]/", "", $title_2[0]);
			$title2_top = preg_replace("/[^0-9,.]/", "", $title_2[1]);
			$class_title2 = explode('editable-click', $title2[2]);
			$title2[2] = (!empty($class_title2[0])) ? trim($class_title2[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $title2[0];
			$fontArray['left'] = $title2_left;
			$fontArray['top'] = $title2_top;
			if(count($title2[2]) > 0){
				$fontStyle = explode(' ', $title2[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['title2'] = $fontArray;
		}

		$phone = (!empty($_REQUEST['phone'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['phone'])) : array();
		if(count($phone) > 0){
			$phone[1] = str_replace('position:absolute;cursor:all-scroll;','',$phone[1]);
			$phone_2 = explode(';', $phone[1]);
			$phone_left = preg_replace("/[^0-9,.]/", "", $phone_2[0]);
			$phone_top = preg_replace("/[^0-9,.]/", "", $phone_2[1]);
			$class_ph = explode('editable-click', $phone[2]);
			$phone[2] = (!empty($class_ph[0])) ? trim($class_ph[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $phone[0];
			$fontArray['left'] = $phone_left;
			$fontArray['top'] = $phone_top;
			if(count($phone[2]) > 0){
				$fontStyle = explode(' ', $phone[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['phone'] = $fontArray;
		}

//		$mobile = (!empty($_REQUEST['mobile'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['mobile'])) : array();
//		if(count($mobile) > 0){
//			$mobile[1] = str_replace('position:absolute;cursor:all-scroll;','',$mobile[1]);
//			$mobile_2 = explode(';', $mobile[1]);
//			$mobile_left = preg_replace("/[^0-9,.]/", "", $mobile_2[0]);
//			$mobile_top = preg_replace("/[^0-9,.]/", "", $mobile_2[1]);
//			$class_mob = explode('editable-click', $mobile[2]);
//			$mobile[2] = (!empty($class_mob[0])) ? trim($class_mob[0]) : '';
//			$fontArray = array();
//			$fontArray['text'] = $mobile[0];
//			$fontArray['left'] = $mobile_left;
//			$fontArray['top'] = $mobile_top;
//			if(count($mobile[2]) > 0){
//				$fontStyle = explode(' ', $mobile[2]);
//				for($i=0; $i<count($fontStyle); $i++){
//					if(trim($fontStyle[$i]) == "bold"){
//						$fontArray['fontweight'] = trim($fontStyle[$i]);
//					}
//					if(trim($fontStyle[$i]) == "italic"){
//						$fontArray['fontstyle'] = trim($fontStyle[$i]);
//					}
//					if(trim($fontStyle[$i]) == "underline"){
//						$fontArray['textdecoration'] = trim($fontStyle[$i]);
//					}
//					if(strpos($fontStyle[$i], 'font-') !== false){
//						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
//					}
//					if(strpos($fontStyle[$i], 'ff-') !== false){
//						if(trim($fontStyle[$i]) == "ff-sans-serif"){
//							$fontArray['fontfamily'] = 'sans-serif';
//						}
//						if(trim($fontStyle[$i]) == "ff-source-sans"){
//							$fontArray['fontfamily'] = 'Source Sans Pro';
//						}
//						if(trim($fontStyle[$i]) == "ff-monospace"){
//							$fontArray['fontfamily'] = 'monospace';
//						}
//						if(trim($fontStyle[$i]) == "ff-serif"){
//							$fontArray['fontfamily'] = 'serif';
//						}
//						if(trim($fontStyle[$i]) == "ff-Arial"){
//							$fontArray['fontfamily'] = 'Arial';
//						}
//						if(trim($fontStyle[$i]) == "ff-comic-sans"){
//							$fontArray['fontfamily'] = 'Comic Sans MS';
//						}
//						if(trim($fontStyle[$i]) == "ff-Georgia"){
//							$fontArray['fontfamily'] = 'Georgia';
//						}
//
//					}
//				}
//			}
//			$final_array['mobile'] = $fontArray;
//		}

		$fax = (!empty($_REQUEST['fax'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['fax'])) : array();
		if(count($fax) > 0){
			$fax[1] = str_replace('position:absolute;cursor:all-scroll;','',$fax[1]);
			$fax_2 = explode(';', $fax[1]);
			$fax_left = preg_replace("/[^0-9,.]/", "", $fax_2[0]);
			$fax_top = preg_replace("/[^0-9,.]/", "", $fax_2[1]);
			$class_fax = explode('editable-click', $fax[2]);
			$fax[2] = (!empty($class_fax[0])) ? trim($class_fax[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $fax[0];
			$fontArray['left'] = $fax_left;
			$fontArray['top'] = $fax_top;
			if(count($fax[2]) > 0){
				$fontStyle = explode(' ', $fax[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['fax'] = $fontArray;
		}

		$company = (!empty($_REQUEST['company'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['company'])) : array();
		if(count($company) > 0){
			$company[1] = str_replace('position:absolute;cursor:all-scroll;','',$company[1]);
			$company_2 = explode(';', $company[1]);
			$company_left = preg_replace("/[^0-9,.]/", "", $company_2[0]);
			$company_top = preg_replace("/[^0-9,.]/", "", $company_2[1]);
			$class_comp = explode('editable-click', $company[2]);
			$company[2] = (!empty($class_comp[0])) ? trim($class_comp[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $company[0];
			$fontArray['left'] = $company_left;
			$fontArray['top'] = $company_top;
			if(count($company[2]) > 0){
				$fontStyle = explode(' ', $company[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['company'] = $fontArray;
		}

		$address1 = (!empty($_REQUEST['address1'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['address1'])) : array();
		if(count($address1) > 0){
			$address1[1] = str_replace('position:absolute;cursor:all-scroll;','',$address1[1]);
			$address1_2 = explode(';', $address1[1]);
			$address1_left = preg_replace("/[^0-9,.]/", "", $address1_2[0]);
			$address1_top = preg_replace("/[^0-9,.]/", "", $address1_2[1]);
			$class_ad1 = explode('editable-click', $address1[2]);
			$address1[2] = (!empty($class_ad1[0])) ? trim($class_ad1[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $address1[0];
			$fontArray['left'] = $address1_left;
			$fontArray['top'] = $address1_top;
			if(count($address1[2]) > 0){
				$fontStyle = explode(' ', $address1[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['address1'] = $fontArray;
		}

		
//		$address2 = (!empty($_REQUEST['address2'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['address2'])) : array();
//		if(count($address2) > 0){
//			$address2[1] = str_replace('position:absolute;cursor:all-scroll;','',$address2[1]);
//			$address2_2 = explode(';', $address2[1]);
//			$address2_left = preg_replace("/[^0-9,.]/", "", $address2_2[0]);
//			$address2_top = preg_replace("/[^0-9,.]/", "", $address2_2[1]);
//			$class_ad2 = explode('editable-click', $address2['2']);
//			$address2[2] = (!empty($class_ad2[0])) ? trim($class_ad2[0]) : '';
//			$fontArray = array();
//			$fontArray['text'] = $address2[0];
//			$fontArray['left'] = $address2_left;
//			$fontArray['top'] = $address2_top;
//			if(count($address2[2]) > 0){
//				$fontStyle = explode(' ', $address2[2]);
//				for($i=0; $i<count($fontStyle); $i++){
//					if(trim($fontStyle[$i]) == "bold"){
//						$fontArray['fontweight'] = trim($fontStyle[$i]);
//					}
//					if(trim($fontStyle[$i]) == "italic"){
//						$fontArray['fontstyle'] = trim($fontStyle[$i]);
//					}
//					if(trim($fontStyle[$i]) == "underline"){
//						$fontArray['textdecoration'] = trim($fontStyle[$i]);
//					}
//					if(strpos($fontStyle[$i], 'font-') !== false){
//						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
//					}
//					if(strpos($fontStyle[$i], 'ff-') !== false){
//						if(trim($fontStyle[$i]) == "ff-sans-serif"){
//							$fontArray['fontfamily'] = 'sans-serif';
//						}
//						if(trim($fontStyle[$i]) == "ff-source-sans"){
//							$fontArray['fontfamily'] = 'Source Sans Pro';
//						}
//						if(trim($fontStyle[$i]) == "ff-monospace"){
//							$fontArray['fontfamily'] = 'monospace';
//						}
//						if(trim($fontStyle[$i]) == "ff-serif"){
//							$fontArray['fontfamily'] = 'serif';
//						}
//						if(trim($fontStyle[$i]) == "ff-Arial"){
//							$fontArray['fontfamily'] = 'Arial';
//						}
//						if(trim($fontStyle[$i]) == "ff-comic-sans"){
//							$fontArray['fontfamily'] = 'Comic Sans MS';
//						}
//						if(trim($fontStyle[$i]) == "ff-Georgia"){
//							$fontArray['fontfamily'] = 'Georgia';
//						}
//
//					}
//				}
//			}
//			$final_array['address2'] = $fontArray;
//		}

		$city = (!empty($_REQUEST['city'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['city'])) : array();
		if(count($city) > 0){
			$city[1] = str_replace('position:absolute;cursor:all-scroll;','',$city[1]);
			$city_2 = explode(';', $city[1]);
			$city_left = preg_replace("/[^0-9,.]/", "", $city_2[0]);
			$city_top = preg_replace("/[^0-9,.]/", "", $city_2[1]);
			$class_city = explode('editable-click', $city[2]);
			$city[2] = (!empty($class_city[0])) ? trim($class_city[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $city[0];
			$fontArray['left'] = $city_left;
			$fontArray['top'] = $city_top;
			if(count($city[2]) > 0){
				$fontStyle = explode(' ', $city[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['city'] = $fontArray;
		}

		$webaddress = (!empty($_REQUEST['webaddress'])) ? explode('|', str_replace('<span class="cross hide">X</span>', '', $_REQUEST['webaddress'])) : array();
		if(count($webaddress) > 0){
			$webaddress[1] = str_replace('position:absolute;cursor:all-scroll;','',$webaddress[1]);
			$webaddress_2 = explode(';', $webaddress[1]);
			$webaddress_left = preg_replace("/[^0-9,.]/", "", $webaddress_2[0]);
			$webaddress_top = preg_replace("/[^0-9,.]/", "", $webaddress_2[1]);
			$class_web = explode('editable-click', $webaddress[2]);
			$webaddress[2] = (!empty($class_web[0])) ? trim($class_web[0]) : '';
			$fontArray = array();
			$fontArray['text'] = $webaddress[0];
			$fontArray['left'] = $webaddress_left;
			$fontArray['top'] = $webaddress_top;
			if(count($webaddress[2]) > 0){
				$fontStyle = explode(' ', $webaddress[2]);
				for($i=0; $i<count($fontStyle); $i++){
					if(trim($fontStyle[$i]) == "bold"){
						$fontArray['fontweight'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "italic"){
						$fontArray['fontstyle'] = trim($fontStyle[$i]);
					}
					if(trim($fontStyle[$i]) == "underline"){
						$fontArray['textdecoration'] = trim($fontStyle[$i]);
					}
					if(strpos($fontStyle[$i], 'font-') !== false){
						$fontArray['fontsize'] = substr($fontStyle[$i], 5, 2);
					}
					if(strpos($fontStyle[$i], 'ff-') !== false){
						if(trim($fontStyle[$i]) == "ff-sans-serif"){
							$fontArray['fontfamily'] = 'sans-serif';
						}
						if(trim($fontStyle[$i]) == "ff-source-sans"){
							$fontArray['fontfamily'] = 'Source Sans Pro';
						}
						if(trim($fontStyle[$i]) == "ff-monospace"){
							$fontArray['fontfamily'] = 'monospace';
						}
						if(trim($fontStyle[$i]) == "ff-serif"){
							$fontArray['fontfamily'] = 'serif';
						}
						if(trim($fontStyle[$i]) == "ff-Arial"){
							$fontArray['fontfamily'] = 'Arial';
						}
						if(trim($fontStyle[$i]) == "ff-comic-sans"){
							$fontArray['fontfamily'] = 'Comic Sans MS';
						}
						if(trim($fontStyle[$i]) == "ff-Georgia"){
							$fontArray['fontfamily'] = 'Georgia';
						}

					}
				}
			}
			$final_array['webaddress'] = $fontArray;
		}

		if ($request['isEdit'] && (int)$request['isEdit'] == 1) {
			$fontArray = array();
			$fontArray['text'] = $request['logo_image'];
			$fontArray['left'] = $request['logo_left'];
			$fontArray['top'] = $request['logo_top'];
			$fontArray['width'] = $request['logo_width'];
			$fontArray['height'] = $request['logo_height'];
			$final_array['logo'] = $fontArray;
		} else {
			$image = (!empty($_REQUEST['logo'])) ? explode('|', str_replace('position:absolute;cursor:all-scroll;', '', $_REQUEST['logo'])) : array();
//			dd($image);
//		dd(Input::file('image')->getClientOriginalName());
			if (count($image) > 0) {
				$image_2 = explode(';', $image['1']);
//				dd($image_2);
				$image_left = preg_replace("/[^0-9,.]/", "", $image_2[0]);
				$image_top = preg_replace("/[^0-9,.]/", "", $image_2[1]);
				$fontArray = array();
				$fontArray['text'] = Input::file('image')->getClientOriginalName();
				$fontArray['left'] = $image_left;
				$fontArray['top'] = $image_top;
				$fontArray['width'] = isset($image_2[4]) && $image_2[4] != '' ? preg_replace("/[^0-9,.]/", "", $image_2[4]) : 155;
				$fontArray['height'] = isset($image_2[5]) && $image_2[5] != '' ? preg_replace("/[^0-9,.]/", "", $image_2[5]) : 155;
				$final_array['logo'] = $fontArray;
			}
		}

		$background = (!empty($_REQUEST['background'])) ? explode('|', $_REQUEST['background']) : array();
//		dd($background);
		if(count($background) > 0){
			$bg_color = $background[0];
			$bg_image = $background[1];
			$bg_repeat = $background[2];
			$fontArray = array();
			$fontArray['backgroundcolor'] = $bg_color;
			$fontArray['backgroundimage'] = $bg_image;
			$fontArray['backgroundrepeat'] = $bg_repeat;
			$final_array['background'] = $fontArray;
		}
//		dd($final_array);
		return $final_array;
//		dd(json_encode($final_array));
//		exit;
	}
}
