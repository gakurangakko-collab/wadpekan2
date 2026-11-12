<?php

namespace App\Policies;

use App\Models\PenghuniKost;
use App\Models\User;

class PenghuniKostPolicy
{
    public function update(User $user, PenghuniKost $penghuni): bool
    {
        if ($user->hasRole('pemilik')) {
            return true;
        }

        return $user->hasRole('pengelola') && $penghuni->status !== 'Lunas';
    }

    public function delete(User $user, PenghuniKost $penghuni): bool
    {
        return $user->hasRole('pemilik');
    }

    public function updateHarga(User $user, PenghuniKost $penghuni): bool
    {
        return $user->hasRole('pemilik');
    }
}
