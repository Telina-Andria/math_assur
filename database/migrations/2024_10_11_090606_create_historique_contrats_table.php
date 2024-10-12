<?php

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
        Schema::create('historique_contrats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contrat::class, "by_contrat_id")->contrained('contrats')->onDelete('cascade');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('historique_contrats', ["by_client_id", "details"]);
    }
};
