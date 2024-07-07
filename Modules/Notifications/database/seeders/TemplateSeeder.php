<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notifications\Models\Service;
use Modules\Notifications\Models\Template;

class TemplateSeeder extends Seeder
{
    protected array $payloads = [];
    public function run(): void
    {
        Service::query()->whereIn('name',
       array_keys(config('templates'))
       )->get()->each(function (Service $service){
           $serviceId = $service->getAttribute('id');
           $serviceName = $service->getAttribute('name');
           $templates = config('templates.'.$serviceName);
           foreach ($templates as $topic)
           $this->payloads[] = [
               'service_id' => $serviceId,
                'topic' => $topic
           ];
       });

       Template::query()->insert($this->payloads);
    }
}
