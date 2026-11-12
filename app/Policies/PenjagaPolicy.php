<?php

namespace App\Policies;

use App\Models\Penjaga;
use App\Models\User;

class PenjagaPolicy
{
    // Boleh menambah data?
    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'pengelola');
    }

    // Boleh mengubah data INI?
    public function update(User $user, Penjaga $penjaga): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->hasRole('pengelola')
            && $penjaga->area === 'Lantai 1 dan 2';
    }

    // Boleh menghapus data INI?
    public function delete(User $user, Penjaga $penjaga): bool
    {
        return $user->hasRole('admin');
    }
}