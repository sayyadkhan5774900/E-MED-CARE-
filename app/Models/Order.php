<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'pending'   => 'Pending',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pharmacy_id',
        'customer_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
