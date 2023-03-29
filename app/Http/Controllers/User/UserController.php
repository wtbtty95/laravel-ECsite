<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function edit()
	{
		$user = Auth::user();
		return view('user.edit', compact('user'));
	}

	public function update(UserRequest $request)
	{
		$this->user->userUpdate($request);
		return redirect('/user/edit');
	}

}
