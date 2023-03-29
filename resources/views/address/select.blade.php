@extends('layouts.app')
@section('content')

<script src='https://ajaxzip3.github.io/ajaxzip3.js' charset='UTF-8'></script>
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

@if (0 < $addresses->count())

<table class="table table-striped">
<tr>
<th>お届け先選択</th>
<th>氏名</th>
<th>郵便番号</th>
<th>住所</th>
<th>電話番号</th>
<th>編集</th>
<th>削除</th>
</tr>

@foreach ($addresses as $address)
<tr>
<td align="center"><input type="radio" form="select" name="select_address" value="{{ $address->id }}" required></td>
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

<form id="select" class="form-horizontal" method="POST" action="{{ route('order') }}">
{{ csrf_field() }}
<button class="btn btn-primary" type="submit">お届け先を確定する</button>
</form>

@else
<div style="margin:30px;" align=center><font size="5">お届け先が登録されていません</font></div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form class="form-horizontal" method="POST" action="{{ route('address.select.insert') }}">
{{ csrf_field() }}
<div class="text-center" style="margin:30px;">ー お届け先追加 ー</div>
<div class="form-group">
<label for="name" class="col-md-4 control-label">氏名</label>
<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name" maxlength="40" placeholder="役所南" value="{{ old('name') }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="postcode" class="col-md-4 control-label">郵便番号</label>
<div class="col-md-6">
<input id="postcode" type="text" class="form-control" name="postcode" maxlength="7" placeholder="3368586" value="{{ old('postcode') }}" onKeyUp="AjaxZip3.zip2addr(this, '', 'prefectures', 'city', 'address_detail');" required autofocus>
</div>
</div>
<div class="form-group">
<label for="prefectures" class="col-md-4 control-label">都道府県</label>
<div class="col-md-6">
<input id="prefectures" type="text" class="form-control" name="prefectures" maxlength="3" placeholder="埼玉県" value="{{ old('prefectures') }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="city" class="col-md-4 control-label">市区町村</label>
<div class="col-md-6">
<input id="city" type="text" class="form-control" name="city" maxlength="27" placeholder="さいたま市南区" value="{{ old('city') }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="address_detail" class="col-md-4 control-label">町名、番地、建物名、部屋番号等</label>
<div class="col-md-6">
<input id="address_detail" type="text" class="form-control" name="address_detail" maxlength="100" placeholder="別所７丁目２０−１" value="{{ old('address_detail') }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="tel" class="col-md-4 control-label">電話番号</label>
<div class="col-md-6">
<input id="tel" type="text" class="form-control" name="tel" maxlength="11" pattern="^0[0-9]{9,10}$" placeholder="0488381111" value="{{ old('tel') }}" required autofocus>
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">追加する</button>
</div>
</div>
</form>

<div align=left><a href="{{ route('cart.index') }}">カート一覧</a></div>
<div align=left><a href="{{ route('index') }}">商品一覧</a></div>

</div>
</div>
</div>
</div>
</div>
@endsection
