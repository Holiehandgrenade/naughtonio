<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocalTimeToWeatherTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // i have manually updated the utc stored "time" in the database.
        // first i will add the column
        Schema::table('weather_texts', function (Blueprint $table) {
            $table->time('local_time')->default('00:00');
        });

        // and then i will update each records local time based on their manually fixed global time
        \App\Models\WeatherText\WeatherText::all()->each(function ($w) {
            // weather text has a getTimeAttribute that converts it to local
            $w->local_time = $w->time;
            $w->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather_texts', function (Blueprint $table) {
            $table->dropColumn('local_time');
        });
    }
}
