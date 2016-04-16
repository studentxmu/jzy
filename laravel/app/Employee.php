<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	//
    public static $departs = array(
        0 => '司机',
        1 => '总办',
        2 => '财务',
        3 => '车队调度',
        4 => '办公室',
        5 => '后勤',
    );

    public function hasManyWorkdays()
    {
        return $this->hasMany('App\Workday', 'employee_id', 'id');
    }

    public function workdays()
    {
        return $this->hasMany('App\Workday');
    }

    public function liushui()
    {
        $thisyear = date('Y');
        $begindate = "$thisyear-01-01";
        $enddate = "$thisyear-12-31";
        $workdays = Workday::whereRaw('employee_id = ? and begintime between ? and ?', array($this->id, $begindate, $enddate))->orderBy('begintime')->get();
        return $workdays;
    }

    public function kaoqin()
    {
        $thisyear = date('Y');
        $months = $kaoqin = $tmpkaoqin = array();
        for ($i = 1; $i < 13; $i++) {
            $m = sprintf("%02d", intval($i));
            $y = str_pad(intval($thisyear), 4, "0", STR_PAD_RIGHT);
            $firstday = date('Y-m-01', strtotime("$y-$m-01"));  
            $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));  
            $months[$i]['begin'] = $firstday;
            $months[$i]['end'] = $lastday;
            $tmpkaoqin[$i] = array();
            $kaoqin[$i] = 0;
        }
        $workdays = $this->liushui();
        foreach ($workdays as $workday) {
            $tmpmonth = $workday->begintime;
            $Date_List_a1 = explode("-" , $tmpmonth);
            $tmpkaoqin[intval($Date_List_a1[1])][] = $workday;
        }
        foreach ($months as $key => $value) {
            $tmpWorkdays = $tmpkaoqin[$key]; 
            $begin = $end = array();
            $i = $j = 0;
            if (empty($tmpWorkdays)) {
                $thisyear = date('Y');
                $begindate1 = "$thisyear-01-01";
                $enddate1 = $value['begin'];
                $lastworkdays = Workday::whereRaw('employee_id = ? and begintime between ? and ?', array($this->id, $begindate1, $enddate1))->orderBy('begintime', 'desc')->take(1)->get();
                if (!empty($lastworkdays[0]) && $lastworkdays[0]->type == 1) {
                    $kaoqin[$key] = $this->getDay($value['begin'], $value['end']);
                }
            }
            foreach ($tmpWorkdays as $workday) {
                if ($workday->type == 1) {
                    $begin[$i] = $workday->begintime;
                } else {
                    $end[$j++] = $workday->begintime;
                    $i++;
                }
            }
            if (!empty($begin) || !empty($end)) {
                $count = ($i > $j) ? $i : $j;
            }
            if (empty($begin)) {
                $count = $j-1;
            }
            if (empty($end)) {
                $count = $i-1;
            }
            for ($a = 0; $a <= $count; $a++) {
                if (!isset($begin[$a])) {
                    $tmpbegin = $value['begin'];
                } else {
                    $tmpbegin = $begin[$a];
                }
                if (!isset($end[$a])) {
                    $tmpend = $value['end'];
                } else {
                    $tmpend = $end[$a];
                }
                $daycount = $this->getDay($tmpbegin, $tmpend);
                $kaoqin[$key] += $daycount;
            }
        }
        return $kaoqin;
    }

    public function getDay($begintime, $endtime)
    {
        $Date_List_a1 = explode("-" , $begintime);
        $Date_List_a2 = explode("-" , $endtime);
        $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);
        $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);
        $days = round(($d2 - $d1)/3600/24) + 1;
        return $days;
    }
}
