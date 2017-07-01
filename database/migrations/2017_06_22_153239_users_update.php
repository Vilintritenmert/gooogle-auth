<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->dropColumn('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('picture');
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('picture');
            $table->dropColumn('title');
            $table->dropColumn('location');
            $table->dropColumn('parent_id')->nullable();
            $table->dropColumn('company_id');
        });
    }
}
