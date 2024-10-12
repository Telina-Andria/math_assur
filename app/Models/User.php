<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Client;
use App\Models\Contrat;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_utilisateur',
        'mot_de_passe',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mot_de_passe',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'mot_de_passe' => 'hashed',
    ];

    public function client(): HasMany
    {
        return $this->hasMany(Client::class, "by_utilisateur_id");
    }

    public function contrat(): HasMany
    {
        return $this->hasMany(Contrat::class, "by_utilisateur_id");
    }

    public function sinistre(): HasMany
    {
        return $this->hasMany(Sinistre::class, "by_utilisateur_id");
    }
}
