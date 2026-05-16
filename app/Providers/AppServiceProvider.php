<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\Job::observe(\App\Observers\JobObserver::class);
        \App\Models\BlogPost::observe(\App\Observers\BlogPostObserver::class);
        \App\Models\Document::observe(\App\Observers\DocumentObserver::class);

        // Event - Listener mappings
        Event::listen(
            \App\Events\DocumentUploaded::class,
            \App\Listeners\AwardPointsForDocumentUpload::class,
        );
        Event::listen(
            \App\Events\DocumentVerified::class,
            \App\Listeners\AwardPointsForDocumentVerification::class,
        );
    }
}
