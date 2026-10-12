<?php
namespace App\Policies;
use App\Models\WbsAbout;
use App\Models\User;
class WbsAboutPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, WbsAbout $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, WbsAbout $model) { return true; }
    public function delete(User $user, WbsAbout $model) { return true; }
    public function restore(User $user, WbsAbout $model) { return true; }
    public function forceDelete(User $user, WbsAbout $model) { return true; }
}