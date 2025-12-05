<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\AuthActivity;
use App\Observers\GeneralObserver;

// Import Semua Model Anda di sini
use App\Models\User;
use App\Models\Artikel;
use App\Models\BalasanTanyaJawab;
use App\Models\DeteksiDini;
use App\Models\HasilDeteksi;
use App\Models\Infografis;
use App\Models\InterpretasiSkor;
use App\Models\JawabanUser;
use App\Models\KategoriDeteksi;
use App\Models\Konsultasi;
use App\Models\Pertanyaan;
use App\Models\PilihanJawaban;
use App\Models\PsikologProfile;
use App\Models\TanyaJawab;
use App\Models\Video;

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
       // 1. Daftar Model yang ingin diawasi CCTV (Observer)
        $modelsToObserve = [
            User::class,
            Artikel::class,
            BalasanTanyaJawab::class,
            DeteksiDini::class,
            HasilDeteksi::class,
            Infografis::class,
            InterpretasiSkor::class,
            JawabanUser::class,
            KategoriDeteksi::class,
            Konsultasi::class,
            Pertanyaan::class,
            PilihanJawaban::class,
            PsikologProfile::class,
            TanyaJawab::class,
            Video::class,
        ];

        // 2. Loop daftar tersebut dan pasang Observer ke masing-masing model
        foreach ($modelsToObserve as $model) {
            $model::observe(GeneralObserver::class);
        }

        // 3. Aktifkan Subscriber untuk Login/Logout
        Event::subscribe(AuthActivity::class);
    }
}
