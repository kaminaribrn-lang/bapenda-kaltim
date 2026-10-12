<?php
namespace App\Policies;
use App\Models\PostCategory;
use App\Models\User;
class PostCategoryPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, PostCategory $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}