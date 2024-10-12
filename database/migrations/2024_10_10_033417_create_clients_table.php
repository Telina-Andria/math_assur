<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->date('date_naissance');
            $table->enum('type_client', ["individuel", "groupe"]);
            $table->foreignIdFor(User::class, "by_utilisateur_id")->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('clients', ["nom", "prenom", "adresse", "date_naissance", "type_client", "by_utilisateur_id"]);
    }
};
