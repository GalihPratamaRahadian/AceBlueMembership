<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class initFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initFolder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perintah Membuat Default';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPaths = [
            public_path('storage/photo'),
         
        ];

        foreach ($folderPaths as $folderPath) {
            self::makeDirectoryStorage($folderPath);
        }
    }

    public static function makeDirectoryStorage(string $path)
    {
        $result = [];

        if (!\File::exists($path)) {
            $result = \File::makeDirectory($path);
        }

        return $result;
    }
}
