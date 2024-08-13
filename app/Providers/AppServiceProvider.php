<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

use App\Models\Pengaju;

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
        view()->composer(['pengaju.status', 'pengaju.result'], function($view){
            $view->with('pengajus', Pengaju::all());
        });

        view()->composer('pengaju.dashboard', function($view){
             // Mengambil 3 data terbaru
             $latestPengajus = Pengaju::latest()->limit(3)->get();

             // Mengirim data ke view
             $view->with('latestPengajus', $latestPengajus);
        });

        View::composer(['pengaju.detailp','pengaju.details'], function($view) {
            // Ambil ID dari parameter rute
            $id = Route::current()->parameter('id');
    
            // Cari data pengaju berdasarkan ID
            $pengaju = Pengaju::find($id);
    
            // Kirimkan data pengaju ke view
            $view->with('pengaju', $pengaju);
        });

        Carbon::setLocale('id');
        
        View::composer(
            ['pengaju.dashboard', 'superadmin.dashboard', 'accountant.dashboard', 'bendahara.dashboard', 'approval.status'],
            function ($view) {
            $view->with([
                'currentDate' => Carbon::now()->isoFormat('dddd, D MMMM YYYY'),
                // Tambahkan data lain yang ingin dibagikan ke semua dashboard
            ]);
        });
    }
}
