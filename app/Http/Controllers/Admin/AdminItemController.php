<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemInsertRequest;
use App\Http\Requests\ItemUpdateRequest;

class AdminItemController extends Controller
{

	public function __construct(Item $item)
	{
		$this->item = $item;
	}

	public function index()
	{
		$items = $this->item->get();
		return view('admin.item.index', compact('items'));
	}

	public function detail()
	{
		$result = request('id');
		if ($this->item->itemSearch($result)) {
			$detail = $this->item->itemSearch($result);
			return view('admin.item.detail', compact('detail'));
		}
		return redirect('/admin')->with('message', '存在しないidです');
	}

	public function add()
	{
		return view('admin.item.add');
	}

	public function insert(ItemInsertRequest $request)
	{
		$this->item->itemInsert($request);
		return redirect('/admin');
	}

	public function edit()
	{
		$result = request('id');
		if ($this->item->itemSearch($result)) {
			$edit = $this->item->itemSearch($result);
			return view('admin.item.edit', compact('edit', 'result'));
		}
		return redirect('/admin')->with('message', '存在しないidです');
	}

	public function update(ItemUpdateRequest $request)
	{
		if ($this->item->itemUpdate($request)) {
			return redirect('/admin')->with('success_message', '編集しました');
		}
		return redirect('/admin');
	}

	public function forceDelete(Request $request)
	{
		$this->item->itemForceDelete($request);
		return redirect('/admin');
	}

}
