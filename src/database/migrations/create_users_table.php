<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('password');
            $table->enum('status', [0, 1])->default(0)->comment('0 = Inactive. 1 = Active');
            $table->unsignedBigInteger('role_id')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        DB::table('users')->insert(
            array(
                [
                    'username' => 'developer',
                    'email' => 'developer@mail.com',
                    'password' => Hash::make('password'),
                    'status' => '1',
                    'role_id' => 1
                ]
            )
        );
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