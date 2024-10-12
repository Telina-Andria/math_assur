<?php

namespace App\Models;

use App\Models\Contrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sinistre extends Model
{
    use HasFactory;

    protected $fillable = [
        "numero_sinistre",
        "montant_indemnise",
        "by_utilisateur_id",
        "by_contrat_id",
        "description",
        "status"
    ];

    public function contrat(): BelongsTo
    {
        return $this->belongsTo(
            Contrat::class,
            "by_contrat_id"
        );
    }

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            "by_utilisateur_id"
        );
    }
}
