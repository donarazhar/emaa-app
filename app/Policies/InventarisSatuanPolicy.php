<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InventarisSatuan;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventarisSatuanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_inventaris::satuan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('view_inventaris::satuan');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_inventaris::satuan');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('update_inventaris::satuan');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('delete_inventaris::satuan');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_inventaris::satuan');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('force_delete_inventaris::satuan');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_inventaris::satuan');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('restore_inventaris::satuan');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_inventaris::satuan');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, InventarisSatuan $inventarisSatuan): bool
    {
        return $user->can('replicate_inventaris::satuan');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_inventaris::satuan');
    }
}
