<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GeneralObserver
{
    // Saat data dibuat (Create) - Opsional jika ingin tetap dipakai
    public function created(Model $model)
    {
        ActivityLog::create([
            'user_name' => Auth::user()->name ?? 'System',
            'action' => 'CREATE_'.class_basename($model),
        ]);
    }

    // Saat data diubah (Update Akun / Edit Profil)
    public function updated(Model $model)
    {
        // Pengecekan agar log tidak spam jika tidak ada yang berubah signifikan
        if ($model->wasChanged()) {
            ActivityLog::create([
                'user_name' => Auth::user()->name ?? 'System',
                'action' => 'UPDATE_'.class_basename($model),
            ]);
        }
    }

    // Saat data dihapus (Hapus Akun)
    public function deleted(Model $model)
    {
        // Kita ambil nama dari model yang akan dihapus, karena Auth user mungkin sudah logout/hilang
        $name = $model->name ?? (Auth::user()->name ?? 'System');

        ActivityLog::create([
            'user_name' => $name,
            'action' => 'DELETE_'.class_basename($model),
        ]);
    }
}
