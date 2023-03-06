<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Process;

class DatabaseSeeder extends Seeder
{

    public $process_model;
    public function __construct(Process $process_model){
        $this->process_model = $process_model;
    }

    public $process = [
        [
            "process_name" => "for checkout"
        ],
        [
            "process_name" => "checked out"
        ],
        [
            "process_name" => "cancelled"
        ],
        [
            "process_name" => "returned"
        ],
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->process as $process){
            $this->process_model->create($process);
        }
    }
}
