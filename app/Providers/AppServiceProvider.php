<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $configRepository = $this->app->make(Repository::class);
        if ($configRepository->get('app.force_https', false)) {
            URL::forceScheme('https');
        }

        if ($this->app->environment('local')) {
            Model::shouldBeStrict();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::$wrap = '';
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
