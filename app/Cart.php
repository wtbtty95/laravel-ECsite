<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{

	use SoftDeletes;
	protected $fillable = ['user_id', 'item_id', 'quantity'];
	protected $dates = ['deleted_at'];

	public function item()
	{
		//リレーション。従テーブル（cartsテーブル）から主テーブル（itemテーブル）を取得する
		return $this->belongsTo('App\Item', 'item_id');
	}


	public function insert($item_id, $add_qty)
	{
		$item = (new Item)->findOrFail($item_id);
		$qty = $item->inventory;
		//在庫なしバリデーション
		if ($qty == 0) {
			return false;
		}
		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['quantity' => 0]);
		DB::beginTransaction();
		try {
			$cart->increment('quantity', $add_qty);
			$item->decrement('inventory', $add_qty);
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollback();
			return false;
		}
	}

	public function remove($cart_id)
	{
		$cart = $this->findOrFail($cart_id);
		if ($cart->user_id == Auth::id()) {
			DB::beginTransaction();
			try {
				$item_id = $cart->item_id;
				$qty = $cart->quantity;
				$cart->delete();
				$item = (new Item)->findOrFail($item_id);
				$item->increment('inventory', $qty);
				DB::commit();
				return true;
			} catch (Exception $e) {
				DB::rollback();
			}
		}
		return false;
	}

	public function subtotal()
	{
		$result = $this->item->price * $this->quantity;
		return $result;
	}

}
