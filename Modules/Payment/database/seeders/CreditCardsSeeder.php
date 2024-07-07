<?php

namespace Modules\Payment\Database\Seeders;

use Exception;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Enums\CreditCardStatusEnum;
use Modules\Payment\Helpers\PaymentHelper;
use Modules\Payment\Models\Account;
use Modules\Payment\Models\Bank;

class CreditCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::all()->map(function (Account $account){
            $faker = Faker::create();

            $this->generateCreditCard(
                countCardNumbers: $faker->numberBetween(1,4),
                accountId: $account->getAttribute('id')
            );
        });
    }

    protected function generateCreditCard($countCardNumbers,$accountId)
    {
        $bins = Bank::query()->select('bin')->get()->pluck('bin')->toArray();
        if (empty($bins)) {
            throw new Exception("No BIN numbers found in the database.");
        }
        $cardNumbers = [];
        for ($i = 0; $i < $countCardNumbers; $i++) {
            $cardNumber = $this->generateValidCardNumber($bins);
            while (in_array($cardNumber, $cardNumbers) || DB::table('credit_cards')->where('number', $cardNumber)->exists()) {
                $cardNumber = $this->generateValidCardNumber($bins);
            }
            $cardNumbers[] = $cardNumber;
        }
        // Insert generated card numbers into the credit_cards table
        foreach ($cardNumbers as $number) {
            DB::table('credit_cards')->insert([
                'number' => $number,
                'account_id' => $accountId,
                'status' => CreditCardStatusEnum::ACTIVE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }

    protected function generateValidCardNumber($bins) {
        while (true) {
            // Randomly select a BIN
            $bin = $bins[array_rand($bins)];

            // Ensure the BIN is 6 digits
            if (strlen($bin) !== 6) {
                continue;
            }

            // Generate the remaining 9 digits randomly
            $cardNumber = $bin;
            for ($i = 0; $i < 9; $i++) {
                $cardNumber .= rand(0, 9);
            }

            // Calculate the Luhn check digit
            $cardTotal = 0;
            $digits = str_split($cardNumber);

            for ($i = 0; $i < 15; $i++) {
                $c = intval($digits[$i]);

                if ($i % 2 === 0) {
                    $cardTotal += ($c * 2 > 9) ? ($c * 2 - 9) : ($c * 2);
                } else {
                    $cardTotal += $c;
                }
            }

            // Find the check digit that makes the total a multiple of 10
            $checkDigit = (10 - ($cardTotal % 10)) % 10;
            $cardNumber .= $checkDigit;
            // Validate the card number
            if (PaymentHelper::validateCreditCardNumber($cardNumber)) {
                return $cardNumber;
            }
        }
    }
}
