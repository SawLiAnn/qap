<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderSchedule extends Model
{
    use MultiTenantModelTrait;
    use HasFactory;

    public $table = 'service_provider_schedules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'created_at',
        'service_provider_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
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