@extends('layouts.app')
@section('content')

<script src='https://ajaxzip3.github.io/ajaxzip3.js' charset='UTF-8'></script>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">お届け先編集ページ</div>
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

<form class="form-horizontal" method="POST" action="{{ route('address.update') }}">
{{ csrf_field() }}
<div class="form-group">
<label for="name" class="col-md-4 control-label">氏名</label>
<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name"  maxlength="40" placeholder="役所南" value="{{ old('name', $edit->name) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="postcode" class="col-md-4 control-label">郵便番号</label>
<div class="col-md-6">
<input id="postcode" type="text" class="form-control" name="postcode" maxlength="7" placeholder="3368586" value="{{ old('postcode', $edit->postcode) }}" onKeyUp="AjaxZip3.zip2addr(this, '', 'prefectures', 'city', 'address_detail');" required autofocus>
</div>
</div>
<div class="form-group">
<label for="prefectures" class="col-md-4 control-label">都道府県</label>
<div class="col-md-6">
<input id="prefectures" type="text" class="form-control" name="prefectures" maxlength="3" placeholder="埼玉県" value="{{ old('prefectures', $edit->prefectures) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="city" class="col-md-4 control-label">市区町村</label>
<div class="col-md-6">
<input id="city" type="text" class="form-control" name="city" maxlength="27" placeholder="さいたま市南区" value="{{ old('city', $edit->city) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="address_detail" class="col-md-4 control-label">町名、番地、建物名、部屋番号等</label>
<div class="col-md-6">
<input id="address_detail" type="text" class="form-control" name="address_detail" maxlength="100" placeholder="別所７丁目２０−１" value="{{ old('address_detail', $edit->address_detail) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="tel" class="col-md-4 control-label">電話番号</label>
<div class="col-md-6">
<input id="tel" type="text" class="form-control" name="tel" maxlength="11"  pattern="^0[0-9]{9,10}$" placeholder="0488381111" value="{{ old('tel', $edit->tel) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="id" class="col-md-4 control-label"></label>
<div class="col-md-6">
<input id="id" type="hidden" class="form-control" name="id" value="{{ $edit->id }}" required autofocus>
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">変更する</button>
</div>
</div>
</form>

<div><a href="{{ route('address.index') }}">お届け先一覧へ</a></div>
<div><a href="{{ route('index') }}">商品一覧へ</a></div>

</div>
</div>
</div>
</div>
</div>
@endsection
