<?php
namespace App\Services;
use App\Repositories\LiveRepository;

class LiveService{
    public $live_repository;
    public function __construct(LiveRepository $live_repository)
    {
        $this->live_repository = $live_repository;
    }
    public function storeLive($data){
        return $this->live_repository->storeLive($data);
    }
    public function loadLive(){
        return $this->live_repository->loadLive();
    }
}