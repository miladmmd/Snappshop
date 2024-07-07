<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Payment\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getBanks() as $bank) {
            Bank::query()->firstOrCreate($bank);
        }
    }

    public function getBanks()
    {
        return [
            [
                "code" => "BMJ",
                "title" => "اداره معاملات ریالی بانک مرکزی",
                "bin" => "636795"
            ],
            [
                "code" => "BIM",
                "title" => "بانک صنعت و معدن",
                "bin" => "627961"
            ],
            [
                "code" => "BML",
                "title" => "بانک ملت",
                "bin" => "610433"
            ],
            [
                "code" => "BRK",
                "title" => "بانک رفاه کارگران",
                "bin" => "589463"
            ],
            [
                "code" => "BMK",
                "title" => "بانک مسکن",
                "bin" => "628023"
            ],
            [
                "code" => "BSP",
                "title" => "بانک سپه",
                "bin" => "589210"
            ],
            [
                "code" => "BKH",
                "title" => "بانک کشاورزی",
                "bin" => "603770"
            ],
            [
                "code" => "BMI",
                "title" => "بانک ملی ایران",
                "bin" => "603799"
            ],
            [
                "code" => "BTE",
                "title" => "بانک تجارت",
                "bin" => "627353"
            ],
            [
                "code" => "BTE",
                "title" => "بانک تجارت",
                "bin" => "585983"
            ],
            [
                "code" => "BSI",
                "title" => "بانک صادرات ایران",
                "bin" => "603769"
            ],
            [
                "code" => "EBDI",
                "title" => "بانک توسعه صادرات ایران",
                "bin" => "627648"
            ],
            [
                "code" => "PB",
                "title" => "پست بانک",
                "bin" => "627760"
            ],
            [
                "code" => "TTB",
                "title" => "بانک توسعه تعاون",
                "bin" => "502908"
            ],
            [
                "code" => "TDBI",
                "title" => "موسسه اعتباری توسعه",
                "bin" => "628157"
            ],
            [
                "code" => "KRB",
                "title" => "بانک کارآفرین",
                "bin" => "627488"
            ],
            [
                "code" => "BP",
                "title" => "بانک پارسیان",
                "bin" => "622106"
            ],
            [
                "code" => "ENB",
                "title" => "بانک اقتصاد نوین",
                "bin" => "627412"
            ],
            [
                "code" => "SB",
                "title" => "بانک سامان",
                "bin" => "621986"
            ],
            [
                "code" => "BPG",
                "title" => "بانک پاسارگاد",
                "bin" => "502229"
            ],
            [
                "code" => "SBB",
                "title" => "بانک سرمایه",
                "bin" => "639607"
            ],
            [
                "code" => "SNA",
                "title" => "بانک سینا",
                "bin" => "639346"
            ],
            [
                "code" => "GHMB",
                "title" => "بانک قرضالحسنه مهر ایران",
                "bin" => "606373"
            ],
            [
                "code" => "SHB",
                "title" => "بانک شهر",
                "bin" => "504706"
            ],
            [
                "code" => "AYB",
                "title" => "بانک آینده",
                "bin" => "636214"
            ],
            [
                "code" => "ANSB",
                "title" => "بانک انصار",
                "bin" => "627381"
            ],
            [
                "code" => "TGB",
                "title" => "بانک گردشگری",
                "bin" => "505416"
            ],
            [
                "code" => "HB",
                "title" => "بانک حکمت ایرانیان",
                "bin" => "636949"
            ],
            [
                "code" => "DB",
                "title" => "بانک دی",
                "bin" => "502938"
            ],
            [
                "code" => "IZB",
                "title" => "بانک ایران زمین",
                "bin" => "505785"
            ],
            [
                "code" => "GHMRB",
                "title" => "بانک قرض الحسنه رسالت",
                "bin" => "504172"
            ],
            [
                "code" => "MBE",
                "title" => "بانک خاورمیانه",
                "bin" => "505809"
            ],
            [
                "code" => "MBE",
                "title" => "بانک خاورمیانه",
                "bin" => "585947"
            ],
            [
                "code" => "GHB",
                "title" => "بانک قوامین",
                "bin" => "639599"
            ],
            [
                "code" => "KOSAR",
                "title" => "موسسه مالی و اعتباری کوثر",
                "bin" => "505801"
            ],
            [
                "code" => "ASEB",
                "title" => "موسسه مالی واعتباری عسگریه",
                "bin" => "606256"
            ],
            [
                "code" => "IVB",
                "title" => "بانک ایران ونزوئلا",
                "bin" => "581874"
            ],
            [
                "code" => "NOOR",
                "title" => "موسسه نور",
                "bin" => "507677"
            ]
        ];
    }
}
