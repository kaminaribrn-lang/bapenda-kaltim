<?php
namespace App\Policies;
use App\Models\Pengaduan;
use App\Models\User;
class PengaduanPolicy {
    public function viewAny(User $user) { return true; }
    public function view(User $user, Pengaduan $model) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Pengaduan $model) { return true; }
    public function delete(User $user, Pengaduan $model) { return true; }
    public function restore(User $user, Pengaduan $model) { return true; }
    public function forceDelete(User $user, Pengaduan $model) { return true; }
}