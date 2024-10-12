<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
// use App\Models\HistoriqueContrat;
use App\Models\Sinistre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_contrat',
        'type_contrat',
        'date_souscription',
        'montant_assure',
        'duree_contrat',
        'date_fin',
        'by_utilisateur_id',
        'by_client_id'
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            "by_utilisateur_id"
        );
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(
            Client::class,
            "by_client_id"
        );
    }

    public function historiqueContrat(): HasMany
    {
        return $this->hasMany(
            HistoriqueContrat::class,
            "by_contrat_id",
        );
    }

    public function sinistre(): HasMany
    {
        return $this->hasMany(
            Sinistre::class,
            "by_contrat_id",
        );
    }
}
