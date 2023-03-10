<?php
namespace App\Services;
use App\Repositories\ProcessRepository;

class ProcessService{
    public $process_repository;
    public function __construct(ProcessRepository $process_repository)
    {
        $this->process_repository = $process_repository;
    }
    public function loadProcess(){
        return $this->process_repository->loadProcess();
    }
}