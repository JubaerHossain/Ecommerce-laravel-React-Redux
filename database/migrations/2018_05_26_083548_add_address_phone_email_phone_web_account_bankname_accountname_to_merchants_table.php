<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressPhoneEmailPhoneWebAccountBanknameAccountnameToMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('address')->nullable()->after('name');
            $table->string('area')->nullable()->after('address');
            $table->string('email')->nullable()->after('area');
            $table->string('phone')->nullable()->after('email');
            $table->string('web')->nullable()->after('email');
            $table->string('account')->nullable()->after('web');
            $table->string('bankname')->nullable()->after('account');
            $table->string('accountname')->nullable()->after('bankname');
            $table->boolean('offline')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('web');
            $table->dropColumn('account');
            $table->dropColumn('bankname');
            $table->dropColumn('accountname');
        });
    }
}
