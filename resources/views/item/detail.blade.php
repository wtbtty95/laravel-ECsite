@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">商品詳細ページ</div>
<div class="panel-body">
<table class="table table-striped">
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>値段</th>
<th>在庫</th>
</tr>
<tr>
<td>{{ $detail->name }}</td>
<td>{{ $detail->description }}</td>
<td>{{ $detail->price }}RM</td>
@if ($detail->inventory == 0)
<td class="text-danger">在庫なし</td>
@else
<td>在庫あり</td>
@endif
</tr>
</table>
<div style="font-size:25px;"><strong>商品画像</strong></div>
@if ($detail->image == null)
<div>＊現在登録中の画像はありません</div>
@else
<div><img src="{{ asset('storage/images/' . $detail->image) }}" width="40%"></div>
@endif
@if (Auth::id() == null && $detail->inventory !== 0)
<div align="right" class="text-danger">カートに追加するには<a href="{{ route('login') }}">ログイン</a>してください</div>
@elseif ($detail->inventory !== 0)
<form class="form-horizontal" method="POST" action="{{ route('add') }}">
{{ csrf_field() }}
<div class="form-group">
<div class="col-md-6">
<input type="hidden" name="item_id" value="{{ $detail->id }}">
</div>
</div>
<div align="right"><button type="submit" class="btn btn-primary">カートに追加</button></div>
@else
<div align="right" class="text-danger">在庫なし</div>
@endif
</form>
<a href="{{ route('index') }}">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection
