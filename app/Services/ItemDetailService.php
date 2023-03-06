<?php
namespace App\Services;

use App\Repositories\ItemDetailRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;

class ItemDetailService{
    public $item_detail_repository;
    public function __construct(ItemDetailRepository $item_detail_repository)
    {
        $this->item_detail_repository = $item_detail_repository;
    }

    public function storeItemDetail($data){
        return $this->item_detail_repository->storeItemDetail($data);
    }

    public function loadItemDetail(){
        return $this->item_detail_repository->loadItemDetail();
    }

    public function updateItemDetail($id, $data){
        return $this->item_detail_repository->updateItemDetail($id, $data);
    }

    public function loadSalesToday(){
        $sales = $this->item_detail_repository->loadItemDetail();
        $current_date = Carbon::now()->toDateString();

        


        $miners = [];
        $daily = [];
        $datastorage = [];
        $total_price = 0;
        foreach($sales as $sale){
            if($current_date === Carbon::parse($sale['created_at'])->toDateString()){
                $total_price += $sale['price'];
                // $daily[] = [
                //     "miner_username" => $sale['miner_username'],
                //     "price" => $sale['price']
                // ];
                $miners[] = $sale['miner_username'];
            }
        }

        if(!empty($miners)){
            $miners = array_values(array_unique($miners));
            foreach($miners as $miner){
                $price = 0;
                foreach($sales as $sale){
                    if($miner === $sale['miner_username']){
                        $price += $sale['price'];
                    }
                }
                $daily[] = [
                    "miner_username" => $miner,
                    "price" => $price
                ];
            }
        }

        $datastorage = [
            "daily_record" => $daily,
            "total_sales_per_day" => $total_price,
        ];
        
        return $datastorage;
    }

    public function loadSalesMonthly($date){
        $real_date = strtotime($date);
        $month = date('Y-m', $real_date);
        $end = date(Carbon::parse($month)->endOfMonth()->toDateString());
        $date_from = "{$month}-01";
        $date_to = $end;
        $date_range = [
            "date_from" => $date_from,
            "date_to" => $date_to
        ];
        $monthly_records = $this->item_detail_repository->loadSalesByDateRange($date_range);
        $total_price = 0;

        $daily = [];
        foreach($monthly_records as $monthly_record){
            $daily[] = Carbon::parse($monthly_record['created_at'])->toDateString();
        }

        $temp = [];
        if(!empty($daily)){
            $daily = array_values(array_unique($daily));
            foreach($daily as $res){
                $price = 0;
                foreach($monthly_records as $monthly_record){
                    if($res === Carbon::parse($monthly_record['created_at'])->toDateString()){
                        $price += $monthly_record['price'];
                    }
                }
                
                $temp[] = [
                    "price" => $price,
                    "created_at" => $res,
                ];
            }
            $total_price = 0; 
            foreach($temp as $data){
                $total_price += $data['price'];
            }
        }


        $datastorage = [
            "monthly_record" => $temp,
            "total_sales_per_month" => $total_price,
        ];
        return $datastorage;
    }

    public function loadSalesByDateRange($data){
        return $this->item_detail_repository->loadSalesByDateRange($data);
    }

    public function topMiners(){
        $result = $this->item_detail_repository->loadItemDetail();
        $miners = [];
        foreach($result as $data){
            $miners[] = $data["miner_username"];
        }
        $datastorage = [];
        if(!empty($miners)){
            $miners = array_values(array_unique($miners));
            foreach($miners as $miner){
                $price = 0;
                foreach($result as $res){
                    if($miner === $res['miner_username']) {
                       $price += $res['price'];
                    }
                }
                $datastorage[] = [
                    "miner_username" => $miner,
                    "price" => $price
                ];
            }
        }
        
        return $datastorage;
    }

    public function thisLiveTopMiners($live_id){
        $results = $this->item_detail_repository->thisLiveTopMiners($live_id);
        
        $miners = [];
        foreach($results as $result){
            $miners[] = $result['miner_username'];
        }

        $datastorage = [];
        if(!empty($miners)){
            $miners = array_values(array_unique($miners));
            foreach($miners as $miner){
                $price = 0;
                $quantity = 0;
                foreach($results as $result){
                    if($miner === $result['miner_username']){
                    $price += $result['price'];
                    $quantity += 1;
                    }
                }
                $datastorage[] = [
                    "miner_username" => $miner,
                    "price" => $price,
                    "quantity" => $quantity
                ];
            }
        }

        return $datastorage;
    }


}