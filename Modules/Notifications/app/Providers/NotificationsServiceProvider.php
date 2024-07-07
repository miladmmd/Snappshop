<?php

namespace Modules\Notifications\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Notifications\Interfaces\Repositories\NotificationRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\OperatorRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ProviderOperatorRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ProviderRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\ServiceRepositoryInterfaces;
use Modules\Notifications\Interfaces\Repositories\SmsInfoRepositoryInterface;
use Modules\Notifications\Interfaces\Repositories\TemplateRepositoryInterfaces;
use Modules\Notifications\Interfaces\Services\NotificationServiceInterface;
use Modules\Notifications\Interfaces\Services\SendSmsServiceInterface;
use Modules\Notifications\Interfaces\Services\SmsInfoServiceInterface;
use Modules\Notifications\Repositories\NotificationRepository;
use Modules\Notifications\Repositories\OperatorRepository;
use Modules\Notifications\Repositories\ProviderOperatorRepository;
use Modules\Notifications\Repositories\ProviderRepository;
use Modules\Notifications\Repositories\ServiceRepository;
use Modules\Notifications\Repositories\SmsInfoRepository;
use Modules\Notifications\Repositories\TemplateRepository;
use Modules\Notifications\Services\NotificationService;
use Modules\Notifications\Services\CreateNotificationService;
use Modules\Notifications\Services\SmsInfoService;

class NotificationsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Notifications';

    protected string $moduleNameLower = 'notifications';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(abstract: NotificationRepositoryInterfaces::class, concrete: NotificationRepository::class);
        $this->app->bind(abstract: OperatorRepositoryInterfaces::class, concrete: OperatorRepository::class);
        $this->app->bind(abstract: ProviderRepositoryInterfaces::class, concrete: ProviderRepository::class);
        $this->app->bind(abstract: ProviderOperatorRepositoryInterfaces::class, concrete: ProviderOperatorRepository::class);
        $this->app->bind(abstract: ServiceRepositoryInterfaces::class, concrete: ServiceRepository::class);
        $this->app->bind(abstract: TemplateRepositoryInterfaces::class, concrete: TemplateRepository::class);
        $this->app->bind(abstract: NotificationServiceInterface::class, concrete: NotificationService::class);
        $this->app->bind(abstract: SendSmsServiceInterface::class, concrete: CreateNotificationService::class);
        $this->app->bind(abstract: SmsInfoRepositoryInterface::class,concrete: SmsInfoRepository::class);
        $this->app->bind(abstract: SmsInfoServiceInterface::class,concrete: SmsInfoService::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.ltrim(config('modules.paths.generator.component-class.path'), config('modules.paths.app_folder', '')));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<string>
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
