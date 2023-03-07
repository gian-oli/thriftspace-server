<?php

namespace App\Http\Controllers;

use App\Models\ItemDetail;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\ItemDetailRequest;
use App\Http\Requests\DateRangeRequest;
use App\Http\Requests\MinerRequest;
use App\Services\ItemDetailService;
use App\Services\MinerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemDetailController extends Controller
{
    use ResponseTrait;
    public $item_detail_service;
    public $miner_service;
    public function __construct(ItemDetailService $item_detail_service, MinerService $miner_service){
        $this->item_detail_service = $item_detail_service;
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
           $result['data'] = $this->item_detail_service->loadItemDetail();
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
    public function store(ItemDetailRequest $item_detail_request, MinerRequest $miner_request)
    {
        $result = $this->successResponse("Registered Successfully.");
        $res = $this->miner_service->loadSingleMiner($item_detail_request["miner_username"]);
        try{
            $data = [
                "live_id" => $item_detail_request["live_id"],
                "process_id" => 1,
                "miner_username" => $item_detail_request["miner_username"],
                "price" => $item_detail_request['price'],
                "size" => $item_detail_request['size'],
                "item_codes" => $item_detail_request['item_codes']
            ];
            $this->item_detail_service->storeItemDetail($data);
            if(count($res) === 0 ){
                $data_miner = [
                    "miner_username" => $miner_request['miner_username']
                ];
                $this->miner_service->storeMiner($data_miner);
            }
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemDetail  $itemDetail
     * @return \Illuminate\Http\Response
     */
    public function update(ItemDetailRequest $item_detail_request, $id)
    {
        $result = $this->successResponse("Updated Successfully.");
        try{
            $data = [
                "live_id" => $item_detail_request["live_id"],
                "process_id" => $item_detail_request["process_id"],
                "miner_username" => $item_detail_request["miner_username"],
                "price" => $item_detail_request['price'],
                "size" => $item_detail_request['size'],
                "item_codes" => $item_detail_request['item_codes']
            ];
            $this->item_detail_service->updateItemDetail($id, $data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    public function loadSalesToday(){
        $result = $this->successResponse("Load Successfully."); 
        try{
           $result['data'] = $this->item_detail_service->loadSalesToday();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    
    public function loadSalesMonthly($date){
        $result = $this->successResponse("Load Successfully."); 
        try{
           $result['data'] = $this->item_detail_service->loadSalesMonthly($date);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    // public function loadSalesByDateRange($date_from, $date_to){
    //     $result = $this->successResponse("Load Successfully."); 
    //     try{
    //        $result['data'] = $this->item_detail_service->loadSalesByDateRange($date_from, $date_to);
    //     } catch (\Exception $e) {
    //         $result = $this->errorResponse($e);
    //     }
    //     return $result;
    // }
    public function loadSalesByDateRange(DateRangeRequest $date_range_request){
        $result = $this->successResponse("Load Successfully."); 
        try{
            $data = [
                "date_from" => $date_range_request['date_from'],
                "date_to" => $date_range_request['date_to']
            ];
           $result['data'] = $this->item_detail_service->loadSalesByDateRange($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    public function topMiners() {
        $result = $this->successResponse("Load Successfully."); 
        try{
           $result['data'] = $this->item_detail_service->topMiners();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    
    public function thisLiveTopMiners($live_id){
        $result = $this->successResponse("Load Successfully."); 
        try{
           $result['data'] = $this->item_detail_service->thisLiveTopMiners($live_id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;

    }
}
