<?php

namespace App\Models\Calendar\Accesors;

trait AccessCalendarDate
{
    /**
     * Translate month from date
     * @param string $date
     * @return string
     */
    public function TranslateMonthFromDate($date)
    {
        $month = date('m', strtotime($date));
        return $this->TranslateMonth($month);
    }
    public function TranslateMonthShort($month)
    {
        return substr($this->TranslateMonth($month), 0, 3);
    }
    public function TranslateMonth($month)
    {
        $months = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
        return $months[$month];
    }

    /**
     * Translate day from date
     * @param string $date
     * @return string
     */
    public function TranslateDayFromDate($date)
    {
        $day = date('l', strtotime($date));
        return $this->TranslateDayName($day);
    }
    public function TranslateDayName($day)
    {
        $days = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];
        return $days[$day] ?? $day;
    }
}