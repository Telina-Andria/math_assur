<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contrat;
use App\Models\Sinistre;
use Illuminate\Auth\Access\Response;

class SinistrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sinistre $sinistre): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, ?Sinistre $sinistre = null): bool
    {
        // Nous n'avons pas accès directement au Contrat ici, donc nous devons le récupérer via la requete
        $contrat = request()->route('contrat');

        return $user->id == $contrat->by_utilisateur_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sinistre $sinistre): bool
    {
        return $user->id == $sinistre->contrat->by_utilisateur_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sinistre $sinistre): bool
    {
        return $user->id == $sinistre->contrat->by_utilisateur_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sinistre $sinistre): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sinistre $sinistre): bool
    {
        return false;
    }
}
