<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;
use Illuminate\Support\Facades\Storage;

class M_mobil extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_mobils';

    protected $guarded = [];

    public $timestamps = true;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($mobil) {
            if ($mobil) {
                if ($mobil->foto_1 && Storage::disk('public')->exists($mobil->foto_1)) {
                    Storage::disk('public')->delete($mobil->foto_1);
                }
                if ($mobil->foto_2 && Storage::disk('public')->exists($mobil->foto_2)) {
                    Storage::disk('public')->delete($mobil->foto_2);
                }
                if ($mobil->foto_3 && Storage::disk('public')->exists($mobil->foto_3)) {
                    Storage::disk('public')->delete($mobil->foto_3);
                }
                if ($mobil->foto_4 && Storage::disk('public')->exists($mobil->foto_4)) {
                    Storage::disk('public')->delete($mobil->foto_4);
                }
            }
        });
    }

    public function penyewaan()
    {
        return $this->hasMany(M_penyewaan::class, 'id_mobil', 'id');
    }
}
