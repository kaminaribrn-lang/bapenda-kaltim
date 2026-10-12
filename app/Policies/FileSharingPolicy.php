<?php
namespace App\Policies;
use App\Models\FileSharing;
use App\Models\User;
class FileSharingPolicy {
    public function viewAny(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function view(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function create(User $user) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function update(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function delete(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function restore(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
    public function forceDelete(User $user, FileSharing $model) { return $user->isSuperAdmin() || $user->isAdmin(); }
}