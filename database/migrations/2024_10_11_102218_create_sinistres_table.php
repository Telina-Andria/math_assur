<?php

use App\Models\User;
use App\Models\Contrat;
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
        Schema::create('sinistres', function (Blueprint $table) {
            $table->id();
            $table->string('numero_sinistre');
            $table->decimal('montant_indemnise', 15, 2);
            $table->foreignIdFor(User::class, "by_utilisateur_id")->constrained('users');
            $table->foreignIdFor(Contrat::class, "by_contrat_id")->constrained('contrats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinistres');
    }
};
