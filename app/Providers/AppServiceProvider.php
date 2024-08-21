<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Pengaju;
use App\Models\Status;

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
        view()->composer(['pengaju.status', 'pengaju.result', 'pengaju.dashboard'], function($view){
            $userId = Auth::id();
            $pengajus = Pengaju::where('user_id', $userId)->get();
            $view->with('pengajus', $pengajus);

            $latestPengajus = Pengaju::where('user_id', $userId)
                                ->latest()
                                ->limit(3)
                                ->get();

             // Mengirim data ke view
             $view->with('latestPengajus', $latestPengajus);
        });

        view()->composer(['approval.status'], function($view){
            $view->with('pengajus', Pengaju::all());
        });

        View::composer(['pengaju.detailp','pengaju.details','approval.detailstat'], function($view) {
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

        View::composer('approval.status', function ($view) {
            // Ambil status 'pending' dari database
            $statusPending = Status::where('status', 'pending')->first()->id;

            // Bagikan variabel ini ke view 'approval.status'
            $view->with('statusPending', $statusPending);
        });
    }
}
