<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{

	public function __construct(Address $address)
	{
		$this->address = $address;
	}

	public function index()
	{
		$auth_id = Auth::id();
		$addresses = $this->address->where('user_id', $auth_id)->get();
		return view('address.index', compact('addresses'));
	}

	public function add()
	{
		return view('address.add');
	}

	public function addressInsert(AddressRequest $request)
	{
		$user_id = Auth::id();
		if ($this->address->insert($user_id, $request)) {
			return redirect('/address')->with('success_message', 'お届け先を追加しました');
		} else {
			return redirect('/address')->with('message', 'お届け先を追加できませんでした');
		}
	}

	public function addressEdit()
	{
		$edit_id = request('id');
		$edit = $this->address->edit($edit_id);
		if ($edit) {
			return view('address.edit', compact('edit'));
		} else {
			return redirect('/address')->with('message', 'この住所は変更できません');
		}
	}

	public function update(AddressRequest $request)
	{
		if ($this->address->addressUpdate($request)) {
			return redirect('/address')->with('success_message', 'お届け先を更新しました');
		} else {
			return redirect('/address')->with('message', 'この住所は変更できません');
		}
	}

	public function delete(Request $request)
	{
		$address_id = $request->input('address_id');
		if ($this->address->addressDelete($address_id)) {
			return redirect('/address')->with('success_message', 'お届け先を削除しました。');
		} else {
			return redirect('/address')->with('message', 'この住所は削除できません');
		}
	}

	public function select()
	{
		$auth_id = Auth::id();
		$addresses = $this->address->where('user_id', $auth_id)->get();
		return view('address.select', compact('addresses'));
	}

	public function addressSelectInsert(AddressRequest $request)
	{
		$user_id = Auth::id();
		if ($this->address->insert($user_id, $request)) {
			return redirect('/address/select')->with('success_message', 'お届け先を追加しました');
		} else {
			return redirect('/address/select')->with('message', 'お届け先を追加できませんでした');
		}
	}

}
