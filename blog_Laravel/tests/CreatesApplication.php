<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
	
	/**
     * The base URL to use while testing the application. Added by mr
     *
     * @var string
     */
    //protected $baseUrl = 'http://localhost/laravel+Yii2_comment_widget/blog_Laravel/';
	
	
	
	
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
