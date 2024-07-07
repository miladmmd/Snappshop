<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notifications\Enums\ProviderStatusEnum;
use Modules\Notifications\Models\Provider;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provider::query()->insert($this->getProviders());
    }

    public function getProviders()
    {
        return [
            [
                'name' => 'kavenegar',
                'status' => ProviderStatusEnum::ACTIVE,
                'blacklist' => false
            ],
            [
                'name' => 'ghasedaksms',
                'status' => ProviderStatusEnum::ACTIVE,
                'blacklist' => false
            ]
        ];
    }
}
