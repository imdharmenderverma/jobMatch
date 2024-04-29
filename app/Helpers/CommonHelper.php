<?php

namespace App\Helpers;
use Carbon\Carbon;
class CommonHelper
{
    public static function dateFormate($date, $format)
    {
        return Carbon::parse($date)->format($format);
    }

    public static function jobWorkType()
    {
        return [
            ['id' => 1, 'name' => 'Full Time', 'color' => 'danger'],
            ['id' => 2, 'name' => 'Part Time', 'color' => 'success'],
            ['id' => 3, 'name' => 'Casual', 'color' => 'success'],
            ['id' => 4, 'name' => 'Apprentice', 'color' => 'success'],
            ['id' => 5, 'name' => 'Assisted', 'color' => 'success'],
            ['id' => 6, 'name' => 'Intern', 'color' => 'success'],
        ];
    }

    public static function jobWorkTypeText($id, $text = true)
    {
        $status = '';
        foreach (self::jobWorkType() as $value) {
            if ($value['id'] == $id) {
                if ($text) {
                    $status = $value['name'];
                }else{
                    $status = '<label class="badge badge-'.$value['color'].'">'.$value['name'].'</label>';
                }
            }
        }
        return $status;
    }
}
