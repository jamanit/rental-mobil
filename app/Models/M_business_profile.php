<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneratesUuid;
use Illuminate\Support\Facades\Storage;

class M_business_profile extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'tb_business_profiles';

    protected $guarded = [];

    public $timestamps = true;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $business_profiles = is_array($model) ? $model : [$model];

            foreach ($business_profiles as $business_profile) {
                if ($business_profile->logo && Storage::disk('public')->exists($business_profile->logo)) {
                    Storage::disk('public')->delete($business_profile->logo);
                }
            }
        });
    }
}
