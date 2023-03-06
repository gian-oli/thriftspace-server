<?php
namespace App\Services;
use App\Repositories\MinerRepository;

class MinerService{
    public $miner_repository;
    public function __construct(MinerRepository $miner_repository)
    {
        $this->miner_repository = $miner_repository;
    }
    public function storeMiner($data){
        return $this->miner_repository->storeMiner($data);
    }
    public function loadMiner(){
        return $this->miner_repository->loadMiner();
    }
    public function updateMiner($id, $data){
        return $this->miner_repository->updateMiner($id, $data);
    }

    public function loadSingleMiner($username){
        return $this->miner_repository->loadSingleMiner($username);
    }
}