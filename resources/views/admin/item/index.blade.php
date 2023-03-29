@extends('layouts.app_admin')
@section('content')

<script>
function select() {
	var select = confirm("本当に削除しますか？");
	if (!select) {
		alert('キャンセルしました');
		return select;
	}
}
</script>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">商品一覧</div>
<div class="panel-body">
@if (session('success_message'))
<div class="alert alert-success text-center">
{{ session('success_message') }}
</div>
@elseif (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif
<table class="table table-striped">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫</th>
<th>商品画像</th>
<th>削除</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{ route('admin.item.detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
<td>{{ $item->price }}RM</td>
@if ($item->inventory == 0)
<td>在庫なし</td>
@else
<td>在庫あり</td>
@endif
@if ($item->image == null)
<td>No image</td>
@else
<td width="30%"><img src="{{ asset('storage/images/' . $item->image) }}" width="20%"></td>
@endif
<td width="10%">
<form class="form-horizontal" method="POST" action="{{ route('admin.item.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="item_id" value="{{ $item->id }}">
<button class="btn btn-primary" onclick="return select()">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
<button class="btn btn-primary" onclick="location.href='{{ route('admin.item.add') }}'">商品追加</button>
</div>
</div>
</div>
</div>
</div>
@endsection
