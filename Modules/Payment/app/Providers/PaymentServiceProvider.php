<?php

namespace Modules\Payment\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Payment\Interfaces\Repositories\AccountRepositoryInterface;
use Modules\Payment\Interfaces\Repositories\BankRepositoryInterfaces;
use Modules\Payment\Interfaces\Repositories\CreditCardRepositoryInterfaces;
use Modules\Payment\Interfaces\Repositories\FeeRepositoryInterfaces;
use Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces;
use Modules\Payment\Interfaces\Services\PaymentServiceInterface;
use Modules\Payment\Interfaces\Services\TransactionServiceInterface;
use Modules\Payment\Interfaces\UseModules\NotificationModuleInterface;
use Modules\Payment\Interfaces\UseModules\UserModuleInterface;
use Modules\Payment\Repositories\AccountRepository;
use Modules\Payment\Repositories\BankRepository;
use Modules\Payment\Repositories\CreditCardRepository;
use Modules\Payment\Repositories\FeeRepository;
use Modules\Payment\Repositories\TransactionRepository;
use Modules\Payment\Services\NotificationModule;
use Modules\Payment\Services\PaymentService;
use Modules\Payment\Services\TransactionService;
use Modules\Payment\Services\UserModule;

class PaymentServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Payment';

    protected string $moduleNameLower = 'payment';

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
        $this->app->bind(abstract:AccountRepositoryInterface::class,concrete: AccountRepository::class );
        $this->app->bind(abstract:BankRepositoryInterfaces::class,concrete: BankRepository::class );
        $this->app->bind(abstract:CreditCardRepositoryInterfaces::class,concrete: CreditCardRepository::class );
        $this->app->bind(abstract:FeeRepositoryInterfaces::class,concrete: FeeRepository::class );
        $this->app->bind(abstract:TransactionRepositoryInterfaces::class,concrete: TransactionRepository::class );
        $this->app->bind(abstract: UserModuleInterface::class, concrete: UserModule::class);
        $this->app->bind(abstract: NotificationModuleInterface::class,concrete: NotificationModule::class);
        $this->app->bind(abstract: PaymentServiceInterface::class, concrete: PaymentService::class);
        $this->app->bind(abstract: TransactionServiceInterface::class, concrete: TransactionService::class);

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
