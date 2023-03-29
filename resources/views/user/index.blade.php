@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">商品一覧</div>
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
<th>商品名</th>
<th>値段</th>
<th>在庫</th>
<th>商品画像</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{ route('detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
<td>{{ $item->price }}RM</td>
@if ($item->inventory == 0)
<td class="text-danger">在庫なし</td>
@else
<td>在庫あり</td>
@endif
@if ($item->image == null)
<td>No image</td>
@else
<td width="20%"><img src="{{ asset('storage/images/' . $item->image) }}" width="70%"></td>
@endif
</tr>
@endforeach
</table>
</div>
</div>
</div>
</div>
</div>
@endsection
