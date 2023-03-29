<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->get();
		return view('admin.user.index', compact('users'));
	}

	public function detail($id)
	{
		$result = $this->user->where('id', $id)->first();
		if ($result) {
			$this->user->showDetail($id);
			$details = $this->user->showDetail($id);
			return view('admin.user.detail', compact('details', 'result'));
		}
		return redirect('/admin/user')->with('message', '存在しない会員IDです');
	}

}
