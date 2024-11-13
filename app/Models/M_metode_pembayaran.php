<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;

class M_metode_pembayaran extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_metode_pembayarans';

    protected $guarded = [];

    public $timestamps = true;
}
