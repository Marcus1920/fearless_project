<?php

namespace App\Providers;

use App\Services\CaseTypeService;
use Illuminate\Support\ServiceProvider;

class CaseTypeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CaseTypeService::class,function(){

                return new CaseTypeService();
        });
    }
}
