<?php

namespace App\Policies;

use App\Models\Contrat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContratPolicy
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
    public function view(User $user, Contrat $contrat): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contrat $contrat): bool
    {
        if ($user->role == 0) {
            // Le rôle 0 peut mettre à jour tous les contrats
            return true;
        } elseif ($user->role == 1) {
            // Le rôle 1 peut mettre à jour les contrats des rôles 1 et 2
            return $contrat->utilisateur->role >= 1;
        } elseif ($user->role == 2) {
            // Le rôle 2 ne peut mettre à jour que ses propres contrats
            return $contrat->by_utilisateur_id == $user->id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contrat $contrat): bool
    {
        if ($user->role == 0) {
            // Le rôle 0 peut supprimer tous les contrats
            return true;
        } elseif ($user->role == 1) {
            // Le rôle 1 peut supprimer les contrats des rôles 1 et 2
            return $contrat->utilisateur->role >= 1;
        } elseif ($user->role == 2) {
            // Le rôle 2 ne peut supprimer que ses propres contrats
            return $contrat->by_utilisateur_id == $user->id;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Contrat $contrat): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Contrat $contrat): bool
    {
        return false;
    }
}
