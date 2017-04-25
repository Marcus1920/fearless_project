<?php

namespace App\Providers;

use App\Services\CaseResponderService;
use Illuminate\Support\ServiceProvider;

class CaseResponderServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(CaseResponderService::class,function(){

            return new CaseResponderService();

        });
    }
}
