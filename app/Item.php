<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
	protected $guarded = ['id'];

	public function itemInsert($request)
	{
		$item = new Item;
		$item->name = $request->input('name');
		$item->description = $request->input('description');
		$item->price = $request->input('price');
		$item->inventory = $request->input('inventory');
		if ($request->file('image')) {
			$img = $request->file('image');
			$upload_dir = 'public/images/';
			$ext = $img->extension();
			$img_name = uniqid(mt_rand()) . '.' . $ext;
			if ($img->storeAs($upload_dir, $img_name)) {
				$item->image = $img_name;
			} else {
				$request->session()->flash('message', '画像がアップロードできませんでした');
				return false;
			}
		}
		if ($item->save()) {
			$request->session()->flash('success_message', '追加しました');
			return true;
		} else {
			$request->session()->flash('message', '追加できませんでした');
			return false;
		}
	}

	public function itemSearch($result)
	{
		$item = $this->where('id', $result)->first();
		if ($item) {
			return $item;
		}
		return false;
	}

	public function itemUpdate($request)
	{
		$item_id = $request->input('id');
		$item = $this->where('id', $item_id)->first();
		if ($item) {
			$update = $this->find($item_id);
			$update->name = $request->input('name');
			$update->description = $request->input('description');
			$update->inventory = $request->input('inventory');
			if ($request->file('image')) {
				$img = $request->file('image');
				$upload_dir = 'public/images/';
				$ext = $img->extension();
				$img_name = uniqid(mt_rand()) . '.' . $ext;
				if ($img->storeAs($upload_dir, $img_name)) {
					$delete_file = $upload_dir . $update->image;
					Storage::delete($delete_file);
					$update->image = $img_name;
				} else {
					$request->session()->flash('message', '画像がアップロードできませんでした');
					return false;
				}
			}
			if ($update->save()) {
				$request->session()->flash('success_message', '変更しました');
				return true;
			} else {
				$request->session()->flash('message', '変更できませんでした');
				return false;
			}
		}
		$request->session()->flash('message', '変更できませんでした。存在しないidです');
		return false;
	}

	public function itemForceDelete($request)
	{
		$item = $this->find($request->input('item_id'));
		if ($item) {
			$item->forceDelete();
			$request->session()->flash('success_message', '商品を削除しました');
			return;
		}
		$request->session()->flash('message', '削除できませんでした。存在しないidです');
		return;
	}

}
