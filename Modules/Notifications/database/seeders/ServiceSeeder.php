<?php

namespace Modules\Notifications\Database\Seeders;

use App\Helpers\HashHelper;
use Illuminate\Database\Seeder;
use Modules\Notifications\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->insert(
            $this->getServices()
        );
    }

    public function getServices()
    {
        return [
            [
                'name' => 'user',
                'hash_api_key' => HashHelper::hashBase64(env('USER_SERVICE_API_KEY'))
            ],
            [
                'name' => 'payment',
                'hash_api_key' => HashHelper::hashBase64(env('PAYMENT_SERVICE_API_KEY'))
            ],

        ];
    }
}
