<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Controllers\Controller;

class ItemController extends Controller {

	public function index() {
		$items = Item::get();
		return view('user.index', compact('items'));
	}

	public function detail() {
		$result = request('id');
		$detail = Item::where('id', '=', $result)->first();
		if ($detail) {
			return view('item.detail', compact('detail'));
		} else {
			return redirect('/');
		}
	}

}
