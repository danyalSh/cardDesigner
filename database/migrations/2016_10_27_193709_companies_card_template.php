<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompaniesCardTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_card_template', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->longText('card_json');
            $table->integer('card_side')->comment('1 = card front, 2 = card back');
            $table->longText('template_html');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
