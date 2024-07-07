<?php

namespace Modules\Notifications\Enums;

enum KavenegarVerifiedStatusEnum: int
{
    case QUEUED = 1; // در صف ارسال قرار دارد
    case SCHEDULED = 2; // زمان بندی شده (ارسال در تاریخ معین)
    case SENT_TO_CARRIER = 4; // ارسال شده به مخابرات
    case SENT_TO_CARRIER_DUPLICATE = 5; // ارسال شده به مخابرات (همانند وضعیت 4)
    case FAILED = 6; // خطا در ارسال پیام که توسط سر شماره پیش می آید و به معنی عدم رسیدن پیامک می‌باشد (Failed)
    case DELIVERED = 10; // رسیده به گیرنده (Delivered)
    case UNDELIVERED = 11; // نرسیده به گیرنده ، این وضعیت به دلایلی از جمله خاموش یا خارج از دسترس بودن گیرنده اتفاق می افتد (Undelivered)
    case CANCELLED_BY_USER = 13; // ارسال پیام از سمت کاربر لغو شده یا در ارسال آن مشکلی پیش آمده که هزینه آن به حساب برگشت داده می‌شود
    case BLOCKED = 14; // بلاک شده است، عدم تمایل گیرنده به دریافت پیامک از خطوط تبلیغاتی که هزینه آن به حساب برگشت داده می‌شود
    case INVALID_ID = 100; // شناسه پیامک نامعتبر است ( به این معنی که شناسه پیام در پایگاه داده کاوه نگار ثبت نشده است یا متعلق به شما نمی‌باشد)

    public static function getWillRetryVerifyStatus(): array
    {
        return [
            self::QUEUED->value,
            self::SCHEDULED->value,
            self::SENT_TO_CARRIER_DUPLICATE->value,
            self::SENT_TO_CARRIER->value,
        ];
    }

    public static function getWillRetrySendSms(): array
    {
        return [
            self::FAILED->value,
            self::UNDELIVERED->value,
            self::INVALID_ID->value
        ];
    }

}
