<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCreatedAtFromTimeToTimestamepOnVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_verifications', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
        Schema::table('phone_verifications', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_verifications', function (Blueprint $table) {
            Schema::table('phone_verifications', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
            Schema::table('phone_verifications', function (Blueprint $table) {
                $table->time('created_at')->nullable();
            });
        });
    }
}
