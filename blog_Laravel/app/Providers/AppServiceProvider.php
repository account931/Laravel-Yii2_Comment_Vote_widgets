<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Laravel\Dusk\DuskServiceProvider; //mine

//For Observe register
use App\models\Elastic_search\Elastic_Posts;
use App\Observers\Elastic\ElasticSearchObserver;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //register my Observer
		//Elastic_Posts::observe(ElasticSearchObserver::class); // here
		Schema::defaultStringLength(191);
    }



    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //mine to register Dusk testing
		/*
		if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
		*/
		
		
		//bind Elastic search. CAUSED form token error ????????????
		/*
		$this->app->bind(
            \App\ElasticRepository\ArticlesRepositoryInterface::class,
            \App\ElasticRepository\EloquentRepository::class
        ); */
		
    }
}
