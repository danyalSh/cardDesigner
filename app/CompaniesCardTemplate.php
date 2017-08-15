<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompaniesCardTemplate extends Model
{
    protected $table = 'companies_card_template';

		protected $fillable = [
			'company_id',
			'card_side',
			'card_json',
			'template_html'
		];

	public function createCompanyCard($id, $json, $side, $cardhtml)
	{
		$isExist = $this->where('company_id', '=', $id)->where('card_side' , '=', $side)->first();

		if (count($isExist) > 0) {
			return $this->where('company_id', '=', $id)->where('card_side' , '=', $side)->update([
				'card_json' => $json,
				'card_side' => $side,
				'template_html' => $cardhtml
			]);
		} else {
			return $this->create([
				'company_id' => $id,
				'card_json' => $json,
				'card_side' => $side,
				'template_html' => $cardhtml
			]);
		}
	}

	public function getTemplate($id)
	{
		return $this->where('company_id', '=', $id)->get();
	}
}
