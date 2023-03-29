<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
	use SoftDeletes;
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function insert($user_id, $request)
	{
		$insert = new Address;
		$insert->user_id = $user_id;
		$insert->name = $request->input('name');
		$insert->postcode = $request->input('postcode');
		$insert->prefectures = $request->input('prefectures');
		$insert->city = $request->input('city');
		$insert->address_detail = $request->input('address_detail');
		$insert->tel = $request->input('tel');
		if ($insert->save()) {
			return true;
		}
		return false;
	}

	public function edit($edit_id)
	{
		$edit = $this->find($edit_id);
		if ($edit) {
			if (Auth::id() == $edit->user_id) {
				return $edit;
			}
		}
		return false;
	}

	public function addressUpdate($request)
	{
		$address = $this->find($request->input('id'));
		if ($address) {
			if ($address->user_id == Auth::id()) {
				$address->name = $request->input('name');
				$address->postcode = $request->input('postcode');
				$address->prefectures = $request->input('prefectures');
				$address->city = $request->input('city');
				$address->address_detail = $request->input('address_detail');
				$address->save();
				return true;
			}
		}
		return false;
	}

	public function addressDelete($address_id)
	{
		$address = $this->find($address_id);
		if ($address) {
			if ($address->user_id == Auth::id()) {
				$address->delete();
				return true;
			}
		}
		return false;
	}

}
