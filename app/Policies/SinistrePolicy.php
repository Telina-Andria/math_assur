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
        return $user->role <= 1;
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

        if ($user->role == 0) {
            return true;
        } elseif ($user->role == 1) {
            return $contrat->utilisateur->role >= 1;
        } elseif ($user->role == 2) {
            return $user->id == $contrat->by_utilisateur_id;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sinistre $sinistre): bool
    {
        if ($user->role == 0) {
            // Le rôle 0 peut mettre à jour tous les sinistres
            return $sinistre->status == 'en cours';
        } elseif ($user->role == 1) {
            // Le rôle 1 peut mettre à jour les sinistres des rôles 1 et 2
            return ($sinistre->contrat->utilisateur->role >= 1 && $sinistre->status == 'en cours');
        } elseif ($user->role == 2) {
            // Le rôle 2 ne peut mettre à jour que ses propres contrats
            return $sinistre->responsable_id == $user->id && $sinistre->status == 'en cours';
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sinistre $sinistre): bool
    {
        if ($user->role == 0) {
            // Le rôle 0 peut supprimer tous les sinistres
            return true;
        } elseif ($user->role == 1) {
            // Le rôle 1 peut supprimer les sinistres des rôles 1 et 2
            return $sinistre->contrat->utilisateur->role >= 1;
        } elseif ($user->role == 2) {
            // Le rôle 2 ne peut supprimer que ses propres contrats
            return $sinistre->responsable_id == $user->id;
        }
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

    //valider sinistre
    public function valider(User $user, Sinistre $sinistre)
    {
        return $user->role <= 1 && $sinistre->status == 'en cours';
    }

    //refuser sinistre
    public function refuser(User $user, Sinistre $sinistre)
    {
        return $user->role <= 1 && $sinistre->status == 'en cours';
    }
}
