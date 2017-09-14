<?php

namespace App\Helpers;

use Carbon\Carbon;

final class DateHelper
{
    /**
     * @const string
     */
    const DATE_HUMAN = '\'F d, Y \a\t g:i A T\'';

    /**
     * @param string $timeStamp
     * @return string
     */
    public static function getRelativeTime($timeStamp): string
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp($timeStamp);
        return Carbon::now()->diffForHumans(Carbon::createFromTimestamp($dateTime->getTimestamp()), true) . ' ago';
    }
}
