<?php
namespace App\Services;
use App\Repositories\LiveRepository;
use Carbon\Carbon;

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
        $results = $this->live_repository->loadLive();
        $datastorage = [];
        foreach($results as $result){
            $datastorage[] = [
                "id" => $result['id'],
                "item_code" => $result['item_code'],
                "created_at" => Carbon::parse($result['created_at'])->toDateString()
            ];
        }

        return $datastorage;
    }
}