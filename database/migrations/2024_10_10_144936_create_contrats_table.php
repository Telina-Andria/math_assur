<?php

use App\Models\User;
use App\Models\Client;
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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string("numero_contrat");
            $table->enum('type_contrat', ['vie', 'non vie']);
            $table->decimal('montant_assure', 15, 2);
            $table->integer('duree_contrat');
            $table->date('date_fin');
            $table->foreignIdfor(User::class, 'by_utilisateur_id')->constrained("users");
            $table->foreignIdfor(Client::class, 'by_client_id')->constrained('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropcolumns('contrats', [
            "numero_contrat",
            "type_contrat",
            "montant_assure",
            "duree_contrat",
            "date_fin",
            "by_utilisateur_id",
            "by_client_id"
        ]);
    }
};
