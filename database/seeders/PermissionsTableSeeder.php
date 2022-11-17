<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'service_create',
            ],
            [
                'id'    => 23,
                'title' => 'service_edit',
            ],
            [
                'id'    => 24,
                'title' => 'service_show',
            ],
            [
                'id'    => 25,
                'title' => 'service_delete',
            ],
            [
                'id'    => 26,
                'title' => 'service_access',
            ],
            [
                'id'    => 27,
                'title' => 'service_provider_create',
            ],
            [
                'id'    => 28,
                'title' => 'service_provider_edit',
            ],
            [
                'id'    => 29,
                'title' => 'service_provider_show',
            ],
            [
                'id'    => 30,
                'title' => 'service_provider_delete',
            ],
            [
                'id'    => 31,
                'title' => 'service_provider_access',
            ],
            [
                'id'    => 32,
                'title' => 'booking_detail_create',
            ],
            [
                'id'    => 33,
                'title' => 'booking_detail_edit',
            ],
            [
                'id'    => 34,
                'title' => 'booking_detail_show',
            ],
            [
                'id'    => 35,
                'title' => 'booking_detail_delete',
            ],
            [
                'id'    => 36,
                'title' => 'booking_detail_access',
            ],
            [
                'id'    => 37,
                'title' => 'client_create',
            ],
            [
                'id'    => 38,
                'title' => 'client_edit',
            ],
            [
                'id'    => 39,
                'title' => 'client_show',
            ],
            [
                'id'    => 40,
                'title' => 'client_delete',
            ],
            [
                'id'    => 41,
                'title' => 'client_access',
            ],
            [
                'id'    => 42,
                'title' => 'payment_transaction_create',
            ],
            [
                'id'    => 43,
                'title' => 'payment_transaction_edit',
            ],
            [
                'id'    => 44,
                'title' => 'payment_transaction_show',
            ],
            [
                'id'    => 45,
                'title' => 'payment_transaction_delete',
            ],
            [
                'id'    => 46,
                'title' => 'payment_transaction_access',
            ],
            [
                'id'    => 47,
                'title' => 'manage_access',
            ],
            [
                'id'    => 48,
                'title' => 'report_access',
            ],
            [
                'id'    => 49,
                'title' => 'service_schedule_create',
            ],
            [
                'id'    => 50,
                'title' => 'service_schedule_edit',
            ],
            [
                'id'    => 51,
                'title' => 'service_schedule_show',
            ],
            [
                'id'    => 52,
                'title' => 'service_schedule_delete',
            ],
            [
                'id'    => 53,
                'title' => 'service_schedule_access',
            ],
            [
                'id'    => 54,
                'title' => 'service_provider_schedule_create',
            ],
            [
                'id'    => 55,
                'title' => 'service_provider_schedule_edit',
            ],
            [
                'id'    => 56,
                'title' => 'service_provider_schedule_show',
            ],
            [
                'id'    => 57,
                'title' => 'service_provider_schedule_delete',
            ],
            [
                'id'    => 58,
                'title' => 'service_provider_schedule_access',
            ],
            [
                'id'    => 59,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}