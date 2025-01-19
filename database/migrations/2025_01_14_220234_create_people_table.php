<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id(); // id (PRIMARY KEY)
            $table->foreignId('created_by')->constrained('users'); // ID utilisateur créateur (avec clé étrangère)
            $table->string('first_name', 255); // Prénom
            $table->string('last_name', 255); // Nom de famille
            $table->string('birth_name', 255)->nullable(); // Nom de naissance
            $table->string('middle_names', 255)->nullable(); // Prénoms intermédiaires
            $table->date('date_of_birth')->nullable(); // Date de naissance
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
