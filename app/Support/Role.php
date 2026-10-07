<?php

namespace App\Support;

class Role
{
    /**
     * Determine if a given jabatan is an admin role.
     */
    public static function isAdmin(string $jabatan): bool
    {
        $adminJabatan = config('haruna.admin_jabatan', []);
        $adminPrefix = config('haruna.admin_prefix', '');
        // Direct admin jabatan
        if (in_array($jabatan, $adminJabatan, true)) {
            return true;
        }
        // Prefix check for Ketua Divisi
        if ($adminPrefix && str_starts_with($jabatan, $adminPrefix)) {
            return true;
        }
        return false;
    }
}
?>
