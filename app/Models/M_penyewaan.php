<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneratesUuid;

class M_penyewaan extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_penyewaans';

    protected $guarded = [];

    public $timestamps = true;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($penyewaan) {
            if ($penyewaan->pembayaran) {
                if ($penyewaan->pembayaran->bukti_pembayaran && Storage::disk('public')->exists($penyewaan->pembayaran->bukti_pembayaran)) {
                    Storage::disk('public')->delete($penyewaan->pembayaran->bukti_pembayaran);
                }
            }
        });
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pelanggan', 'id');
    }

    public function pembayaran()
    {
        return $this->hasOne(M_pembayaran::class, 'id_penyewaan', 'id');
    }

    public function mobil()
    {
        return $this->belongsTo(M_mobil::class, 'id_mobil', 'id');
    }
}
