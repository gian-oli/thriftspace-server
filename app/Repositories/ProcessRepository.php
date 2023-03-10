<?php
namespace App\Repositories;
use App\Models\Process;

class ProcessRepository{
    public $process_model;
    public function __construct(Process $process_model)
    {
        $this->process_model = $process_model;
    }
    public function loadProcess(){
        return $this->process_model->orderBy('id')->get();
    }
}