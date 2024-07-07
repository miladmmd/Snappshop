<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notifications\Enums\OperatorStatusEnum;
use Modules\Notifications\Models\Operator;

class OperatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Operator::query()->insert($this->getOperators());
    }

    public function getOperators()
    {
        return [
            [
                "name" => "همراه اول",
                "code" => "MCI",
                "regex" => "^98(910|911|912|913|914|915|916|917|918|919|990|991|992|993)",
                "status" => OperatorStatusEnum::ACTIVE
            ],
            [
                "name" => "ایرانسل",
                "code" => "IR",
                "regex" => "^98(901|902|903|904|930|933|935|936|937|938|939|941)",
                "status" => OperatorStatusEnum::ACTIVE
            ],
            [
                "name" => "رایتل",
                "regex" => "^98(920|921|922)",
                "code" => "RYT" ,
                "status" => OperatorStatusEnum::ACTIVE
            ],
            [
                "name" => "تالیا",
                "code" => "TLY",
                "regex" => "^98(932)",
                "status" => OperatorStatusEnum::ACTIVE
            ]
        ];

    }
}
