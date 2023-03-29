@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">お届け先住所一覧</div>
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
@if (0 < $addresses->count())
<tr>
<th>氏名</th>
<th>郵便番号</th>
<th>住所</th>
<th>電話番号</th>
<th>編集</th>
<th>削除</th>
</tr>
@foreach ($addresses as $address)
<tr>
<td>{{ $address->name }}</td>
<td>{{ $address->postcode }}</td>
<td>{{ $address->prefectures }}{{ $address->city }}{{ $address->address_detail}}</td>
<td>{{ $address->tel }}</td>
<td>
<button class="btn btn-primary" onclick="location.href='{{ route('address.edit', ['id' => $address->id]) }}'">編集</button>
</td>
<td>
<form class="form-horizontal" method="POST" action="{{ route('address.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="address_id" value="{{ $address->id }}">
<button class="btn btn-primary" type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
@else
<div align=center>お届け先が登録されていません</div>
@endif

<div align=right>
<button class="btn btn-primary" onclick="location.href='{{ route('address.add') }}'">新規お届け先登録</button>
</div>

<div align=left><a href="{{ route('index') }}">商品一覧</a></div>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
