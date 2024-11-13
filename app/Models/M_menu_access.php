<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\GeneratesUuid;

class M_menu_access extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_menu_accesses';

    protected $guarded = [];

    public $timestamps = true;

    public static function level($uuid)
    {
        return DB::table('tb_roles')->select('id', 'uuid', 'role_name')->where('uuid', $uuid)->first();
    }

    public static function menus()
    {
        $query = DB::select('WITH tb_menu_firsts AS ( SELECT id AS first_menu_id, first_menu_name FROM tb_menu_firsts ),
                                tb_menu_seconds AS ( SELECT id AS second_menu_id, second_menu_name, first_menu_id FROM tb_menu_seconds ) SELECT
                                A.first_menu_id,
                                A.first_menu_name,
                                B.second_menu_id,
                                B.second_menu_name 
                                FROM
                                    tb_menu_firsts AS A
                                    LEFT JOIN tb_menu_seconds AS B ON A.first_menu_id = B.first_menu_id 
                                ORDER BY
                                    A.first_menu_name,
                                    B.second_menu_name ASC');
        return $query;
    }

    public function role()
    {
        return $this->belongsTo(M_role::class, 'role_id', 'id');
    }

    public function menu_first()
    {
        return $this->belongsTo(M_menu_first::class, 'first_menu_id', 'id');
    }

    public function menu_second()
    {
        return $this->belongsTo(M_menu_second::class, 'second_menu_id', 'id');
    }
}
