<?php

/*
 *  Copyright © All Rights Reserved by Vizrex (Private) Limited 
 *  Usage or redistribution of this code is strictly prohibited
 *  without written consent of Vizrex (Private) Limited.
 *  Queries are welcomed at copyright@vizrex.com
 */

/**
 * Description of LaravelCleanerProvider
 *
 * @author Zeshan
 */

namespace Vizrex\LaravelCleaner;

use Vizrex\Laraviz\BaseServiceProvider;

class LaravelCleanerProvider extends BaseServiceProvider
{
    public function register(){}
    
    public function boot()
    {
        // Commands
        $this->commands(['Vizrex\LaravelCleaner\Console\Commands\Cleanup']);
        $this->commands(['Vizrex\LaravelCleaner\Console\Commands\ClearSession']);
        $this->commands(['Vizrex\LaravelCleaner\Console\Commands\ClearLog']);
        
        // Translations
        $this->loadTranslationsFrom(__DIR__."/../resources/lang", self::getNamespace());
        
    }
}
