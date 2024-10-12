<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueContrat extends Model
{
    use HasFactory;

    protected $fillable = [
        "by_contrat_id",
        "details",
        "utilisateur_responsable",
    ];

    public function contrat(): BelongsTo
    {
        return $this->belongsTo(
            Contrat::class,
            "by_contrat_id"
        );
    }
}
