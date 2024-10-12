<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'date_naissance',
        'type_client',
        'by_utilisateur_id',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            "by_utilisateur_id"
        );
    }

    public function contrat(): HasMany
    {
        return $this->hasMany(
            Contrat::class,
            "by_client_id"
        );
    }
}
