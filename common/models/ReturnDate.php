<?php

namespace common\models;

use DateTime;
use yii\helpers\ArrayHelper;
use DatePeriod;
use DateInterval;

class ReturnDate
{

    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;
    const SUNDAY    = 7;

    /**
     * @param DateTime   $startDate       Date to start calculations from
     * @param DateTime[] $holidays        Array of holidays, holidays are not conisdered as business days.
     * @param int[]      $nonBusinessDays Array of days of the week which are not business days.
     */
    public function __construct(DateTime $startDate) {

        $holidays = SettingsHolidays::find()->asArray()->where('start_date > NOW()')->all();
        $holidays = ArrayHelper::map($holidays, 'start_date', 'duration');

        $skipDays = array();

        $nonBusinessDays = array(7);

        foreach ($holidays as $holiday => $holidayDuration) {
            $holidayStart = new DateTime($holiday);
            $holidayEnd = new DateTime($holiday);

            while ($holidayDuration > 0) {
                $holidayEnd = $holidayEnd->modify('+1 day');
                $holidayDuration--;
            }

            $days = new DatePeriod(
                $holidayStart,
                new DateInterval('P1D'),
                $holidayEnd
            );

            foreach ($days as $day) {
                $skipDays[] = $day;
            }
        }

        $this->date = $startDate;
        $this->holidays = $skipDays;
        $this->nonBusinessDays = $nonBusinessDays;
    }

    public function addBusinessDays($howManyDays) {
        $i = 0;
        while ($i < $howManyDays) {
            $this->date->modify("+1 day");
            if ($this->isBusinessDay($this->date)) {
                $i++;
            }
        }
    }

    public function getDate() {
        return $this->date;
    }

    private function isBusinessDay(DateTime $date) {
        if (in_array((int)$date->format('N'), $this->nonBusinessDays)) {
            return false; //Date is a nonBusinessDay.
        }
        foreach ($this->holidays as $days) {
                if ($date->format('Y-m-d') == $days->format('Y-m-d')) {
                    return false; //Date is a holiday.
                }
        }
        return true; //Date is a business day.
    }
}