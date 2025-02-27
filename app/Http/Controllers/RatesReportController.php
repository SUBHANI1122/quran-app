<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class RatesReportController extends Controller
{
    public function index(){
        $currencies = Currency::all();
        return view('content.laravel-example.reports.rate-reports',['currencies' => $currencies]);
    }
    private function getDatesBetween($startDate, $endDate) {
        $dates = [];
    
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
    
        $end->modify('+1 day');
    
        $interval = new DateInterval('P1D');
    
        $datePeriod = new DatePeriod($start, $interval, $end);
    
        foreach ($datePeriod as $date) {
            $dates[] = $date->format('Y-m-d');
        }
    
        return $dates;
    }
    public function getRateReport(Request $request){
        $dates = $this->getDatesBetween($request->from, $request->to);
        $currencies = Currency::all();
        $newArray = [];
        foreach($dates as $date){
            foreach($currencies as $currency){
                    $newArray[$date][$currency->currency] = $currency->rate_manager?->history()->whereDate('created_at', $date)->orderby('id','desc')->first()->rate ?? '-';
            }
        }
        return view('content.laravel-example.reports.rate-reports',['currencies' => $currencies, 'newArray' => $newArray, 'from' => $request->from, 'to' => $request->to]);
    }
}
