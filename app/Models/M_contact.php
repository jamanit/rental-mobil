<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;

class M_contact extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_contacts';

    protected $guarded = [];

    public $timestamps = true;
}
