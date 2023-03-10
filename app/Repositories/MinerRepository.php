<?php
namespace App\Repositories;
use App\Models\Miner;

class MinerRepository{
    public $miner_model;
    public function __construct(Miner $miner_model)
    {
        $this->miner_model = $miner_model;
    }
    public function storeMiner($data){
        return $this->miner_model->create($data);
    }
    public function loadMiner(){
        return $this->miner_model->orderBy('id')->lazy()->all();
    }
    public function updateMiner($id, $data){
        return $this->miner_model->findOrFail($id)->update($data);
    }

    public function loadSingleMiner($username){
        return $this->miner_model->where('miner_username', $username)->get();
    }
}