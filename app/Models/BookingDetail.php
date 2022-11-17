<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'booking_details';

    protected $dates = [
        'booking_date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'booking_no',
        'booking_date_time',
        'service_id',
        'service_provider_id',
        'client_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function getBookingDateTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setBookingDateTimeAttribute($value)
    {
        $this->attributes['booking_date_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}