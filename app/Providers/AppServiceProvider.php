<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // publish from datatables.net in node_modules into public
        $this->publishes([
            base_path('node_modules/bootstrap-icons/font/bootstrap-icons.css') => public_path('datatables/bootstrap-icons/font/bootstrap-icons.css'),
            base_path('node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css') => public_path('datatables/datatables.net-bs5/css/dataTables.bootstrap5.min.css'),
            base_path('node_modules/datatables.net-select-bs5/css/select.bootstrap5.css') => public_path('datatables/datatables.net-select-bs5/css/select.bootstrap5.css'),
            base_path('node_modules/datatables.net/js/jquery.dataTables.js') => public_path('datatables/datatables.net/js/jquery.dataTables.js'),
            base_path('node_modules/datatables.net/types/types.d.ts') => public_path('datatables/datatables.net/types/types.d.ts'),
        ], 'datatables');
    }
}
