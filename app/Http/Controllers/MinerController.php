<?php

namespace App\Http\Controllers;

use App\Models\Miner;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\MinerRequest;
use App\Services\MinerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MinerController extends Controller
{
    use ResponseTrait;
    public $miner_service;
    public function __construct(MinerService $miner_service){
        $this->miner_service = $miner_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->successResponse("Load Successfully."); 
        try{
           $result['data'] = $this->miner_service->loadMiner();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MinerRequest $miner_request)
    {
        $result = $this->successResponse("Registered Successfully.");
        try{
            $data = [
                "miner_username" => $miner_request["miner_username"],
            ];
            $this->miner_service->storeMiner($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Miner  $miner
     * @return \Illuminate\Http\Response
     */
    public function update(MinerRequest $miner_request, $id)
    {
        $result = $this->successResponse("Updated Successfully.");
        try{
            $data = [
                "miner_username" => $miner_request["miner_username"],
                "miner_real_name" => $miner_request["miner_real_name"],
                "miner_address" => $miner_request["miner_address"],
            ];
            $result['data'] = $this->miner_service->updateMiner($id, $data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Miner  $miner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Miner $miner)
    {
        //
    }
}
