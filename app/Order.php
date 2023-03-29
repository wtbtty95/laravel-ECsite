<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
	protected $guarded = ['id'];

	public function payment($request)
	{
		$address_id = $request->input('select_address');
		$address = new Address;
		$result = $address->where('id', $address_id)->first();
		if ($result) {
			if ($result['user_id'] == Auth::id()) {
				return $result;
			} else {
				$request->session()->flash('message', '不正なアクセスです');
				return false;
			}
		}
		$request->session()->flash('message', '存在しないidです');
		return false;
	}

	public function cart()
	{
		$cart = new Cart;
		$carts = $cart->where('user_id', Auth::id())->get();
		if (!$carts->isEmpty()) {
			return $carts;
		}
		return false;
	}

}
