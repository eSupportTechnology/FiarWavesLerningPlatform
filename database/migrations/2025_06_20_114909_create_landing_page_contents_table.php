<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageContentsTable extends Migration
{
    public function up()
    {
        Schema::create('landing_page_contents', function (Blueprint $table) {
            $table->id();

            $table->string('email')->nullable();
            $table->string('number_1')->nullable();
            $table->string('number_2')->nullable();

            $table->string('red_title')->nullable();
            $table->string('main_title')->nullable();
            $table->text('title_description')->nullable();

            $table->string('middle_title')->nullable();
            $table->text('middle_title_description')->nullable();

            $table->text('footer_description')->nullable();

            $table->string('about_title')->nullable();
            $table->text('about_title_description')->nullable();

            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->text('location_link')->nullable();

            $table->text('vision')->nullable();
            $table->text('mission')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('landing_page_contents');
    }
}
