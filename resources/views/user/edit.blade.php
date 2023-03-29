@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">ユーザー情報編集ページ</div>
<div class="panel-body">

@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

@if (session('success_message'))
<div class="alert alert-success text-center">
{{ session('success_message') }}
</div>
@elseif (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif

<form class="form-horizontal" method="POST" action="{{ route('user.update') }}">
{{ csrf_field() }}
<div class="form-group">
<label for="name" class="col-md-4 control-label">名前</label>
<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name"  maxlength="40" value="{{ old('name', $user->name)  }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="email" class="col-md-4 control-label">メールアドレス</label>
<div class="col-md-6">
<input id="email" type="text" class="form-control" name="email" maxlength="255" value="{{ old('email', $user->email) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="password" class="col-md-4 control-label">新しいパスワード</label>
<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password">
</div>
</div>
<div class="form-group">
<label for="password_confirmation" class="col-md-4 control-label">新しいパスワード（確認用）</label>
<div class="col-md-6">
<input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
</div>
</div>
<div class="form-group">
<label for="current_password" class="col-md-4 control-label">現在のパスワード</label>
<div class="col-md-6">
<input id="current_password" type="password" class="form-control" name="current_password" required autofocus>
</div>
</div>
<div class="form-group">
<label for="id" class="col-md-4 control-label"></label>
<div class="col-md-6">
<input id="id" type="hidden" class="form-control" name="id" value="{{ $user->id }}" required autofocus>
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">変更する</button>
</div>
</div>
</form>

<div><a href="{{ route('index') }}">商品一覧へ</a></div>

</div>
</div>
</div>
</div>
</div>
@endsection
