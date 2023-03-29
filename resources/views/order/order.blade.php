@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">ご注文確認</div>
<div class="panel-body">

@if (session('success_message'))
<div class="alert alert-success">
{{ session('success_message') }}
</div>
@elseif (session('message'))
<div class="alert alert-danger">
{{ session('message') }}
</div>
@endif

<table class="table table-striped">

<tr>
<th>氏名</th>
<th>郵便番号</th>
<th>住所</th>
<th>電話番号</th>
</tr>

<tr>
<td>{{ $address->name }}</td>
<td>{{ $address->postcode }}</td>
<td>{{ $address->prefectures }}{{ $address->city }}{{ $address->address_detail}}</td>
<td>{{ $address->tel }}</td>
</tr>

</table>

<div align=left><a href="{{ route('address.select') }}">お届け先選択画面へ戻る</a></div>
<div align=left><a href="{{ route('cart.index') }}">カート一覧</a></div>
<div align=left><a href="{{ route('index') }}">商品一覧</a></div>

</div>
</div>
</div>
</div>
</div>
@endsection
