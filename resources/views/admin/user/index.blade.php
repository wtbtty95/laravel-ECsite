@extends('layouts.app_admin')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">会員一覧</div>
<div class="panel-body">
@if (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif

<table class="table table-striped">
<tr>
<th>会員ID</th>
<th>名前</th>
<th>メールアドレス</th>
</tr>
@foreach ($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td><a href="{{ route('admin.user.detail', $user->id) }}">{{ $user->name }}</a></td>
<td>{{ $user->email }}</td>
</tr>
@endforeach
</table>
<a href="{{ route('admin.index') }}">商品一覧</a>
</div>
</div>
</div>
</div>
</div>
@endsection
