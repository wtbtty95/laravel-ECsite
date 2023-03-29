@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">カート</div>
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
@if (0 < $carts->count())
<table class="table table-striped">
<tr>
<th>商品名</th>
<th>値段</th>
<th>購入数</th>
<th>小計</th>
<th>削除</th>
</tr>
@foreach ($carts as $cart)
<tr>
<td>{{ $cart->item->name }}</td>
<td>{{ $cart->item->price }}RM</td>
<td>{{ $cart->quantity }}</td>
<td>{{ $cart->subtotal() }}RM</td>
<td>
<form class="form-horizontal" method="POST" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<div class="form-group">
<div class="col-md-6">
<input type="hidden" name="cart_id" value="{{ $cart->id }}">
</div>
</div>
<button class="btn btn-primary" type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
<td colspan="3"><strong>合計</strong></td>
<td><strong>{{ $total }}RM</strong></td>
</table>
@else
<p align=center>カートが空です</p>
@endif
<div align=right>
<button class="btn btn-primary" onclick="location.href='{{ route('address.select') }}'">お届け先選択</button>
</div>
<div align=left>
<a href="{{ route('index') }}">商品一覧</a>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
