<?php

namespace Callmeaf\Geography;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CallmeafGeographyServiceProvider extends ServiceProvider
{
    private const CONFIGS_DIR = __DIR__ . '/../config';
    private const CONFIGS_CONTINENT_KEY = 'callmeaf-continent';
    private const CONFIGS_CONTINENT_GROUP = 'callmeaf-continent-config';
    private const CONFIGS_COUNTRY_KEY = 'callmeaf-country';
    private const CONFIGS_COUNTRY_GROUP = 'callmeaf-country-config';
    private const CONFIGS_PROVINCE_KEY = 'callmeaf-province';
    private const CONFIGS_PROVINCE_GROUP = 'callmeaf-province-config';
    private const ROUTES_DIR = __DIR__ . '/../routes';
    private const DATABASE_DIR = __DIR__ . '/../database';
    private const DATABASE_GROUPS = 'callmeaf-country-migrations';
    private const RESOURCES_DIR = __DIR__ . '/../resources';
    private const VIEWS_NAMESPACE = 'callmeaf-geography';
    private const VIEWS_GROUP = 'callmeaf-geography-views';
    private const LANG_DIR = __DIR__ . '/../lang';
    private const LANG_NAMESPACE = 'callmeaf-geography';
    private const LANG_GROUP = 'callmeaf-geography-lang';
    public function boot()
    {
        $this->registerConfig();
        $this->registerRoute();
        $this->registerMigration();
        $this->registerEvents();
        $this->registerViews();
        $this->registerLang();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-continent.php',self::CONFIGS_CONTINENT_KEY);
        $this->publishes([
            self::CONFIGS_DIR . '/callmeaf-continent.php' => config_path('callmeaf-continent.php'),
        ],self::CONFIGS_CONTINENT_GROUP);

        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-country.php',self::CONFIGS_COUNTRY_KEY);
        $this->publishes([
            self::CONFIGS_DIR . '/callmeaf-country.php' => config_path('callmeaf-country.php'),
        ],self::CONFIGS_COUNTRY_GROUP);

        $this->mergeConfigFrom(self::CONFIGS_DIR . '/callmeaf-province.php',self::CONFIGS_PROVINCE_KEY);
        $this->publishes([
            self::CONFIGS_PROVINCE_KEY . '/callmeaf-province.php' => config_path('callmeaf-province.php'),
        ],self::CONFIGS_PROVINCE_GROUP);

    }

    private function registerRoute(): void
    {
        $this->loadRoutesFrom(self::ROUTES_DIR . '/v1/api.php');
    }

    private function registerMigration(): void
    {
        $this->loadMigrationsFrom(self::DATABASE_DIR . '/migrations');
        $this->publishes([
            self::DATABASE_DIR . '/migrations' => database_path('migrations'),
        ],self::DATABASE_GROUPS);
    }

    private function registerEvents(): void
    {
        foreach (config('callmeaf-country.events') as $event => $listeners) {
            Event::listen($event,function($event) use ($listeners) {
                foreach($listeners as $listener) {
                    app($listener)->handle($event);
                }
            });
        }
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(self::RESOURCES_DIR . '/views',self::VIEWS_NAMESPACE);
        $this->publishes([
            self::RESOURCES_DIR . '/views' => resource_path('views/vendor/callmeaf-geography'),
        ],self::VIEWS_GROUP);

    }

    private function registerLang(): void
    {
        $langPathFromVendor = lang_path('vendor/callmeaf/geography');
        if(is_dir($langPathFromVendor)) {
            $this->loadTranslationsFrom($langPathFromVendor,self::LANG_NAMESPACE);
        } else {
            $this->loadTranslationsFrom(self::LANG_DIR,self::LANG_NAMESPACE);
        }
        $this->publishes([
            self::LANG_DIR => $langPathFromVendor,
        ],self::LANG_GROUP);
    }
}
