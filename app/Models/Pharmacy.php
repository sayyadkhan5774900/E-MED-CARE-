<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'pharmacies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'phone',
        'address',
        'opening_time',
        'closing_time',
        'longitude',
        'latitude',
        'owner_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pharmacyMedicines()
    {
        return $this->hasMany(Medicine::class, 'pharmacy_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
