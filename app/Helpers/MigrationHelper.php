<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class MigrationHelper
{
    /**
     * Delete all files in the specified directory on the public disk.
     *
     * @param string $directory
     * @return void
     */
    public static function removeFiles(string $directory): void
    {
        $files = Storage::disk('public')->files($directory);

        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }
    }
}
