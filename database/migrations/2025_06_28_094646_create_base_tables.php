<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 127);
            $table->string('last_name', 127);
            $table->boolean('is_minor')->default(false);
            $table->date('joined_at');
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id');
            $table->string('first_name', 127)->nullable();
            $table->string('last_name', 127)->nullable();
            $table->string('phone_number', 13);
            $table->string('email', 255);
            $table->foreign('member_id')->references('id')->on('members');
            $table->timestamps();
        });

        Schema::create('material_states', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id');
            $table->smallInteger('version')->default(1);
            $table->enum('state', ['Neuf', 'Bon', 'Correcte', 'Usé', 'Abimé']);
            $table->foreign('material_id')->references('id')->on('materials');
            $table->timestamps();
        });

        Schema::create('material_types', function (Blueprint $table) {
            $table->id();
            $table->string('label', 255);
            $table->timestamps();
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_type_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('material_type_id')->references('id')->on('material_types');
        });

        Schema::create('material_member', function (Blueprint $table) {
            $table->bigInteger('material_id');
            $table->bigInteger('member_id');
            $table->timestamp('borrowed_at');
            $table->timestamp('returned_at');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('material_states');
        Schema::dropIfExists('material_types');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('material_member');
    }
};
