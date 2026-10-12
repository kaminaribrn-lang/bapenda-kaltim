<?php
namespace App\Policies;
use App\Models\PpidAbout;
use App\Models\User;
class PpidAboutPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, PpidAbout $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}