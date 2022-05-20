<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('line_1', 255)->nullable();
            $table->string('line_2', 255)->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('other_address_details', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        DB::table('user_addresses')->insert(
            array(
                [
                    'user_id' => 1
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
        Schema::dropIfExists('user_profiles');
    }
}