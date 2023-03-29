@extends('layouts.app_admin')
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
<td>在庫なし</td>
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
<div align="right">
<button class="btn btn-primary" onclick="location.href='{{ route('admin.item.edit', ['id' => $detail->id]) }}'">編集</button>
</div>
<a href="{{ route('admin.index') }}">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
