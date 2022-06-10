<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleXcontrollerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_xcontroller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('xcontroller_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->boolean('is_can_modify')->default(0);
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
        Schema::dropIfExists('role_xcontroller');
    }
}
