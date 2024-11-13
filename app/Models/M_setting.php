<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;

class M_setting extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_settings';

    protected $guarded = [];

    public $timestamps = true;
}
