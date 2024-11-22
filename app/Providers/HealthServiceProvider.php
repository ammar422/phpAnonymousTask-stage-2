<?php

namespace App\Providers;

use Spatie\Health\Facades\Health;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

class HealthServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            
            DatabaseCheck::new(),
            
            EnvironmentCheck::new(),
            
            OptimizedAppCheck::new(),
        ]);
    }
}
