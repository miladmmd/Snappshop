<?php

namespace Modules\Payment\Helpers;

use Modules\Payment\Dtos\StoreTransactionDto;
use Modules\Payment\Interfaces\Repositories\TransactionRepositoryInterfaces;
use Modules\Payment\Models\Bank;

class PaymentHelper
{
    public static function validateCreditCardNumber($card)
    {
        $bins = Bank::query()->select('bin')->pluck('bin');

        if (!isset($card) || $card === null || strlen($card) !== 16) {
            return false;
        }

        $bin = substr($card, 0, 6);

        $isValidBin = false;
        foreach ($bins as $binEntry) {
            if ($bin === $binEntry) {
                $isValidBin = true;
                break;
            }
        }

        if (!$isValidBin) {
            return false;
        }

        $cardTotal = 0;
        $digits = str_split($card);

        for ($i = 0; $i < 16; $i++) {
            $c = intval($digits[$i]);

            if ($i % 2 === 0) {
                $cardTotal += ($c * 2 > 9) ? ($c * 2 - 9) : ($c * 2);
            } else {
                $cardTotal += $c;
            }
        }

        return ($cardTotal % 10 === 0);
    }
}
