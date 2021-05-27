<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DownloadFile;
use App\Util\DownloadExcelFile;

class DownloadServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DownloadFile::class, function () {
            return new DownloadExcelFile();
        });
    }
}
