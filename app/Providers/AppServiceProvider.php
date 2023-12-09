<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(App\States\FriendshipState::class);
            // $this->app->singleton(function(){
            //     return new UserService();
            // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Livewire::component('search-interest', SearchInterest::class);
    }
}
