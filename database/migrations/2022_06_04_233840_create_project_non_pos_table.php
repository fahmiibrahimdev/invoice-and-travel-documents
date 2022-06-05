<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_non_pos', function (Blueprint $table) {
            $table->id();
            $table->text('description')->default('0');
            $table->text('qty')->default(1);
            $table->text('po')->default('SN');
            $table->text('amount')->default(0);
            $table->text('total')->default(0);
            $table->text('department')->default('-');
            $table->text('status')->default('Belum PO');
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
        Schema::dropIfExists('project_non_pos');
    }
};
