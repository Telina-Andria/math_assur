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
            $table->foreignIdFor(User::class, "responsable_id")->constrained('users');
            $table->foreignIdFor(User::class, "validateur_id")->nullable()->constrained('users');
            $table->foreignIdFor(Contrat::class, "by_contrat_id")->constrained('contrats');
            $table->text('description');
            $table->enum('status', ['en cours', 'valider', 'refuser']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('sinistres', ["numero_sinistre", "montant_indemnise", "responsable_id", "validateur_id", "by_contrat_id", "description", "status"]);
    }
};
