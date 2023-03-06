<?php

namespace App\Http\Controllers;

use App\Models\Live;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\LiveRequest;
use App\Services\LiveService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LiveController extends Controller
{
    use ResponseTrait;
    public $live_service;
    public function __construct(LiveService $live_service){
        $this->live_service = $live_service;
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
           $result['data'] = $this->live_service->loadLive();
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
    public function store(LiveRequest $live_request)
    {
        $result = $this->successResponse("Registered Successfully.");
        try{
            $data = [
                "item_code" => $live_request["item_code"],
            ];
            $result['data'] = $this->live_service->storeLive($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Live  $live
     * @return \Illuminate\Http\Response
     */
    public function update(LiveRequest $live_request, $id)
    {
        $result = $this->successResponse("Updated Successfully.");
        try{
            $data = [
                "item_code" => $live_request["item_code"],
            ];
            $result['data'] = $this->live_service->updateLive($id, $data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Live  $live
     * @return \Illuminate\Http\Response
     */
    public function destroy(Live $live)
    {
        //
    }
}
