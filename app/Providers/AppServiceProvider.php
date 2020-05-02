<?php

namespace App\Providers;

use Dotenv\Parser;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pharDbPath = config('database.connections.sqlite.database');
        $home = getenv('HOME') ?? getenv('HOMEDRIVE') . getenv('HOMEPATH') ?? false;
        if (!$home) {
            throw new FileNotFoundException('Could not find current users home dir');
        }
        $appHiddenConfigPath = $home . '/.' . strtolower(config('app.name'));
        $localDbPath = $appHiddenConfigPath . '/' . basename(($pharDbPath));

        if (!file_exists($appHiddenConfigPath)) {
            mkdir($appHiddenConfigPath);
            copy($pharDbPath, $localDbPath);
        }

        config(['database.connections.sqlite.database' => $localDbPath]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
