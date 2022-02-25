<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_first_name')->nullable();
            $table->string('user_last_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email');
            $table->string('user_password');
            $table->string('salt_password')->nullable();
            $table->string('user_mobile_number')->nullable();
            $table->string('user_phone_number')->nullable();
            $table->multiLineString('user_profile_image')->nullable();
            $table->text('user_address')->nullable();
            $table->text('user_country')->nullable();
            $table->text('user_state')->nullable();
            $table->integer('user_zip_code')->nullable();
            $table->boolean('user_verified')->default(0);
            $table->boolean('user_approved')->default(0);
            $table->enum('user_role', ['super_admin','super','admin','manager','vendor','host','agent','customer','user','guest'])->default('user');
            $table->dateTime('user_created_at')->nullable()->useCurrent();
            $table->dateTime('user_updated_at')->nullable()->useCurrentOnUpdate();
            $table->string('user_updated_by')->nullable();
//            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Super',
            'user_last_name'=>'Admin',
            'user_name'=>'SuperAdmin',
            'user_email'=>'super-admin@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'super_admin',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Ad',
            'user_last_name'=>'Min',
            'user_name'=>'AdMin',
            'user_email'=>'admin@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'admin',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Man',
            'user_last_name'=>'Ager',
            'user_name'=>'ManAger',
            'user_email'=>'manager@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'manager',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Ven',
            'user_last_name'=>'Dor',
            'user_name'=>'VenDor',
            'user_email'=>'vendor@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'vendor',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Ho',
            'user_last_name'=>'St',
            'user_name'=>'HoSt',
            'user_email'=>'host@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'host',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Age',
            'user_last_name'=>'Nt',
            'user_name'=>'AgeNt',
            'user_email'=>'agent@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'agent',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Cust',
            'user_last_name'=>'Omer',
            'user_name'=>'CustOmer',
            'user_email'=>'customer@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'customer',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Us',
            'user_last_name'=>'Er',
            'user_name'=>'UsEr',
            'user_email'=>'user@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'user',
        ]);
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'user_first_name'=>'Gue',
            'user_last_name'=>'St',
            'user_name'=>'GueSt',
            'user_email'=>'guest@email.com',
            'user_password'=>'password1234',
            'user_verified'=>1,
            'user_approved'=>1,
            'user_role'=>'guest',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
