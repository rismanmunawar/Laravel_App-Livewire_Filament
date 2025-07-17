<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class monitoring_zndsu extends Model
{
    use HasFactory;

    protected $table = 'monitoring_zndsus';
    protected $fillable = [
        'user_id',
        'plant',
        'name_dist',
        'master_it_id',
        'master_dist_id',
        'uploaded_at',
        'has_error',
        // Tambah semua kolom day_01 s/d day_31
        'day_01',
        'day_02',
        'day_03',
        'day_04',
        'day_05',
        'day_06',
        'day_07',
        'day_08',
        'day_09',
        'day_10',
        'day_11',
        'day_12',
        'day_13',
        'day_14',
        'day_15',
        'day_16',
        'day_17',
        'day_18',
        'day_19',
        'day_20',
        'day_21',
        'day_22',
        'day_23',
        'day_24',
        'day_25',
        'day_26',
        'day_27',
        'day_28',
        'day_29',
        'day_30',
        'day_31',
    ];


    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Master IT
    // di MonitoringZndsu model
    // public function masterDist()
    // {
    //     return $this->belongsTo(MasterDataDist::class, 'master_dist_id'); // <- pastikan ini
    // }

    // public function masterIt()
    // {
    //     return $this->belongsTo(\App\Models\MasterDataIt::class);
    // }
}
