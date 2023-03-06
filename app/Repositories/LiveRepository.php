<?php
namespace App\Repositories;
use App\Models\Live;

class LiveRepository{
    public $live_model;
    public function __construct(Live $live_model)
    {
        $this->live_model = $live_model;
    }
    public function storeLive($data){
        return $this->live_model->create($data);
    }
    public function loadLive(){
        return $this->live_model->all();
    }
}