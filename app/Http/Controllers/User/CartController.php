<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

	public function __construct(Cart $cart)
	{
		$this->cart = $cart;
	}

	public function index()
	{
		$auth_id = Auth::id();
		$carts = $this->cart->where('user_id', $auth_id)->get();
		$total = $this->total($carts);
		return view('cart.index', compact('carts', 'total'));
	}

	private function total($carts)
	{
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}

	public function add(Request $request)
	{
		$item_id = $request->input('item_id');
		if ($this->cart->insert($item_id, 1)) {
			return redirect('/index')->with('success_message', '商品をカートに入れました。');
		} else {
			return redirect('/index')->with('message', '在庫が足りません。');
		}
	}

	public function delete(Request $request)
	{
		$cart_id = $request->input('cart_id');
		if ($this->cart->remove($cart_id)) {
			return redirect('/index')->with('success_message', 'カートから商品を削除しました。');
		} else {
			return redirect('/index')->with('message', '削除できませんでした');
		}
	}

}
