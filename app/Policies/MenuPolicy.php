<?php
namespace App\Policies;
use App\Models\Menu;
use App\Models\User;
class MenuPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, Menu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}