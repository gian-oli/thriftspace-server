<?php
namespace App\Repositories;
use App\Models\ItemDetail;

class ItemDetaiLRepository{
    public $item_detail_model;
    public function __construct(ItemDetail $item_detail_model)
    {
        $this->item_detail_model = $item_detail_model;
    }
    public function storeItemDetail($data){
        return $this->item_detail_model->create($data);
    }
    public function loadItemDetail(){
        return $this->item_detail_model->with('live','process')->orderBy('id')->get();
    }
    public function loadSalesToday(){
        return $this->item_detail_model->with('process')->get();
    }
    public function updateItemDetail($id, $data){
        return $this->item_detail_model->findOrFail($id)->update($data);
    }
    public function loadSalesByDateRange($data){
        return $this->item_detail_model
        ->with('process')
        ->whereBetween('created_at', ["{$data['date_from']} 00:00:00", "{$data['date_to']} 24:00:00"])
        ->get();
    }
    public function thisLiveTopMiners($live_id){
        return $this->item_detail_model->with('live')->where('live_id', $live_id)->get();
    }
}