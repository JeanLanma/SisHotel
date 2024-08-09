<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calendar\Accesors\AccessCalendarDate;

class Calendar extends Model
{
    use HasFactory,
        AccessCalendarDate;

    protected $table = 'calendar';
    protected $fillable = ['day', 'month', 'year'];
    protected $appends = [
        'date_string',
        'month_name',
        'day_name',
    ];

    protected function DateString(): Attribute
    {
        return Attribute::make( 
            get: fn (mixed $value, array $attributes) => date('d-m-Y' , strtotime($attributes['day'] . '-' . $attributes['month'] . '-' . $attributes['year'])),
        );
    }
    // Month name in spanish
    protected function MonthName(): Attribute
    {
        return Attribute::make( 
            get: fn (mixed $value, array $attributes) =>$this->TranslateMonthShort($attributes['month']),
        );
    }
    // Day name in spanish
    protected function DayName(): Attribute
    {
        return Attribute::make( 
            get: fn (mixed $value, array $attributes) => $this->TranslateDayFromDate($attributes['day'] . '-' . $attributes['month'] . '-' . $attributes['year']),
        );
    }

    public function getPeriod($from_date, $to_date)
    {
        $dates = [];
        $from_date = strtotime($from_date);
        $to_date = strtotime($to_date);
        for ($i = $from_date; $i <= $to_date; $i = strtotime('+1 day', $i)) {
            $dates[] = [
                'day' => date('d', $i),
                'month' => date('m', $i),
                'year' => date('Y', $i),
            ];
        }
        return $dates;
    }
}
