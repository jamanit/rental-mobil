<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;
use Illuminate\Support\Facades\Storage;

class M_pembayaran extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_pembayarans';

    protected $guarded = [];

    public $timestamps = true;

    public function mobil()
    {
        return $this->belongsTo(M_mobil::class, 'id_mobil', 'id');
    }

    public function penyewaan()
    {
        return $this->hasOne(M_penyewaan::class, 'id_penyewaan', 'id');
    }
}
