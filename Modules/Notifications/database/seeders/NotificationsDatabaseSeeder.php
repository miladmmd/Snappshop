<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call(ProviderSeeder::class);
         $this->call(OperatorsSeeder::class);
         $this->call(ProviderOperatorSeeder::class);
         $this->call(ServiceSeeder::class);
         $this->call(TemplateSeeder::class);
    }
}
