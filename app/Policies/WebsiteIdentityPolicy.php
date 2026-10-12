<?php
namespace App\Policies;
use App\Models\WebsiteIdentity;
use App\Models\User;
class WebsiteIdentityPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, WebsiteIdentity $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, WebsiteIdentity $model) { return true; }
    public function delete(User $user, WebsiteIdentity $model) { return true; }
    public function restore(User $user, WebsiteIdentity $model) { return true; }
    public function forceDelete(User $user, WebsiteIdentity $model) { return true; }
}