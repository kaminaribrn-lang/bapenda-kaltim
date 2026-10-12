<?php
namespace App\Policies;
use App\Models\PpidItem;
use App\Models\User;
class PpidItemPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, PpidItem $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, PpidItem $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, PpidItem $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, PpidItem $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, PpidItem $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}