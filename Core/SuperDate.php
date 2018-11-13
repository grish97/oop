<?php

namespace Core;

Class SuperDate 
{
    public $year;
    public $month;
    public $day;
    public $hourse;
    public $minute;
    public $second;

    public function __construct($date = null) {
        if(!$date) {
            $date = date("Y-m-d H:m:s");
        }

        $this->parseFromString($date);
    }

    public function parseFromString($string) {
        $dayMinute = explode(" ", $string);
        if(count($dayMinute) < 2) {
            $dayMinute[] = "00:00:00";
        }

        $ymd = explode("-", $dayMinute[0]);
        $his = explode(":", $dayMinute[1]);

        $this->year = $ymd[0];
        $this->month = $this->validateMonth($ymd[1]);
        $this->day = $this->validateDay($ymd[2]);

        $this->hourse = $this->validateHourse($his[0]);
        $this->minute = $this->validateMinute($his[1]);
        $this->second = $this->validateSecond($his[2]);
    }

    public function getMaxDaysForMonth() {
        if(in_array($this->month, [1,3,5,7,8,10,12])) {
            return 31;
        }else if(in_array($this->month, [4,6,9,11])) {
            return 30;
        }else {
            if($this->isLeapYear()) {
                return 29;
            }else {
                return 28;
            }
        }
    }

    public function add($number, $what) {
        switch ($what) {
            case "second" :
                $this->second += $number;
                if($this->second > 59) {
                    $this->second -= 60;
                    $this->add(1, "minute");
                }
                break;
            case "minute" : 
                $this->minute += $number;
                if($this->minute > 59) {
                    $this->minute -= 60;
                    $this->add(1, "hourse");
                }
                break;
            case "hourse" : 
                $this->hourse += $number;
                if($this->hourse > 23) {
                    $this->hourse -= 24;
                    $this->add(1, "day");
                }
                break;
            case "day" : 
                $this->day += $number;
                if($this->day > $this->getMaxDaysForMonth()) {
                    $this->day -= $this->getMaxDaysForMonth();
                    $this->add(1, "month");
                }
                break;
            case "month" : 
                $this->month += $number;
                if($this->month > 11) {
                    $this->month -= 12;
                    $this->add(1, "year");
                }
                break;
            case "year" :
                $this->year += $number;
            default : 
            break;
        }
        
    }

    public function sub($number, $what) {
        switch ($what) {
            case "second" :
                $this->second -= $number;
                if($this->second < 0) {
                    $this->second += 60;
                    $this->sub(1, "minute");
                }
                break;
            case "minute" :
                $this->minute -= $number;
                if($this->minute < 0) {
                    $this->minute += 60;
                    $this->sub(1, "hourse");
                }
                break;
            case "hourse" :
                $this->hourse -= $number;
                if($this->hourse < 0) {
                    $this->hourse += 24;
                    $this->sub(1, "day");

                }
                break;
            case "day" :
                $this->day -= $number;
                if($this->day < 0) {
                    $this->sub(1, "month"); ///////
                    $this->day += $this->getMaxDaysForMonth();
                }
                break;
            case "month" :
                $this->month -= $number;
                if($this->month < 0) { 
                    $this->month += 12;
                    $this->sub(1, "year");  
                }
                break;
            case "year" :
                $this->year -= $number;
                break;
            default :
                break;
        }
    }

    public function __call($method_name, $arg) {
        if(preg_match("/^validate(Second|Minute|Hourse|Day|Month|Year)$/", $method_name, $matches)) {
            $what = strtolower($matches[1]);
            $max = $this->getMaxFor($what);
            return $this->validate($arg[0], $max, $what);
        }else {
            echo $method_name . " Not Found ";
        }
    }


    public function getMaxFor($what) {
        switch ($what) {
            case "second" :
            case "minute" :
                return 60;
            case "hourse" :
                return 24;
            case "day" :
                return $this->getMaxDaysForMonth();
            case "month" :
                return 12;
        }
    }

    

    public function isLeapYear() {
        return $this->year%4 === 0;
    }

    public function validate($value, $max, $name) {
        if($value > $max || $value < 0) {
            echo "Invalid Value for " . $name; 
            exit;
        }

        return (int)$value;
    }
}