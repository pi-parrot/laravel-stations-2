<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateStartAndEndTimes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = request('start_time_date');
        $startTime = request('start_time_time');
        $endDate = request('end_time_date');
        $endTime = request('end_time_time');

        // いずれもrequiredなので、いずれかが未設定の場合はreturn
        if (!($startDate && $startTime && $endDate && $endTime)) {
            return;
        }

        switch ($attribute) {
            case 'start_time_date':
                $startDate = $value;
                break;
            case 'start_time_time':
                $startTime = $value;
                break;
            case 'end_time_date':
                $endDate = $value;
                break;
            case 'end_time_time':
                $endTime = $value;
                break;
        }

        $startDateTime = $startDate . ' ' . $startTime;
        $endDateTime = $endDate . ' ' . $endTime;
        $timeDiff = strtotime($endDateTime) - strtotime($startDateTime);

        if ($timeDiff < 0) {
            $fail('開始時間は終了時間より前でなければなりません。');
            return;
        }

        // 5分未満と書いてあるが、以下ではないか？
        if (($timeDiff / 60) <= 5) {
            $fail('上映時間が短すぎます。');
            return;
        }
    }
}
