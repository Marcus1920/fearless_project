<?php

namespace App\Providers\v1;
use App\Services\v1;
use App\Services\v1\CaseService;
use Illuminate\Support\ServiceProvider;


class CasesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CaseService::class,function($app){

            return new CaseService($app->make('App\Services\CaseResponderService'),
                                   $app->make('App\Services\CaseOwnerService')
               );
        });

    }
}
