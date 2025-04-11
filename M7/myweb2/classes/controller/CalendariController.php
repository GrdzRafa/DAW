<?php

class CalendariController extends Controller {
    private $currentDate;
    
    public function __construct() {
        $this->currentDate = new DateTime();
    }
    
    public function show($params) {
        if (isset($params['date'])) {
            $this->currentDate = new DateTime($params['date']);
        }
        
        if (isset($params['prevYear'])) {
            $this->currentDate->modify('-1 year');
        } elseif (isset($params['prevMonth'])) {
            $this->currentDate->modify('-1 month');
        } elseif (isset($params['nextMonth'])) {
            $this->currentDate->modify('+1 month');
        } elseif (isset($params['nextYear'])) {
            $this->currentDate->modify('+1 year');
        }
        $vCalendari = new CalendariView();
        $vCalendari->show($this->currentDate); // Pasar fecha actual a vista
    }
    
    public function form($params) {
        if (isset($params['date'])) {
            $this->currentDate = new DateTime($params['date']);
        }
        
        if (isset($params['prevYear'])) {
           
            $this->currentDate->modify('-1 year');
        } elseif (isset($params['prevMonth'])) {
            $this->currentDate->modify('-1 month');
        } elseif (isset($params['nextMonth'])) {
            $this->currentDate->modify('+1 month');
        } elseif (isset($params['nextYear'])) {
            $this->currentDate->modify('+1 year');
        }
        
        $vCalendari = new CalendariView();
        $vCalendari->show($this->currentDate);
    }
    
    
}