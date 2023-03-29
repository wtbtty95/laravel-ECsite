<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	public function selectedAddress(Request $request)
	{
		if ($this->order->payment($request)) {
			$address = $this->order->payment($request);
			if ($this->order->cart()) {
				$carts = $this->order->cart();
				dd('a');
				return view('order.order', compact('address'));
			} else {
				$request->session()->flash('message', 'カートに商品が存在しません');
				return redirect('/');
			}
		}
		return redirect('/address/select');
	}

}
