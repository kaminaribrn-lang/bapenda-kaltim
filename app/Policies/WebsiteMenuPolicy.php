<?php
namespace App\Policies;
use App\Models\WebsiteMenu;
use App\Models\User;
class WebsiteMenuPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, WebsiteMenu $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}