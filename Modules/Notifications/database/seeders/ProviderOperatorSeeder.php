<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notifications\Models\Operator;
use Modules\Notifications\Models\Provider;
use Modules\Notifications\Models\ProviderOperator;

class ProviderOperatorSeeder extends Seeder
{
    protected array $payLoads = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Provider::all()->map(function (Provider $provider) {
            Operator::all()->map(function (Operator $operator) use ($provider) {
                if ($provider->getAttribute('name') == 'kavenegar') {
                    $priority = 1;
                } elseif ($provider->getAttribute('name') == 'ghasedaksms') {
                    $priority = 2;
                }
                $this->payLoads[] = [
                    'provider_id' => $provider->getAttribute('id'),
                    'operator_id' => $operator->getAttribute('id'),
                    'priority' => $priority
                ];
            });
        });

        ProviderOperator::query()->insert($this->payLoads);
    }


}
