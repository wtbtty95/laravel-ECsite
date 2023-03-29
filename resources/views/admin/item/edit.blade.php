@extends('layouts.app_admin')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">商品編集ページ</div>
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
<form class="form-horizontal" method="POST" action="{{ route('admin.item.update') }}" enctype="multipart/form-data">
 {{ csrf_field() }}
<div class="form-group">
<label for="name" class="col-md-4 control-label"><span style="color:red;">（必須）</span>商品名</label>
<div class="col-md-6">
<input id="name" type="text" class="form-control" name="name" value="{{ old('name', $edit->name) }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="description" class="col-md-4 control-label"><span style="color:red;">（必須）</span>商品説明</label>
<div class="col-md-6">
<textarea id="description" type="text" class="form-control" name="description" required autofocus>{{ old('description', $edit->description) }}</textarea>
</div>
</div>
<div class="form-group">
<label for="inventory" class="col-md-4 control-label"><span style="color:red;">（必須）</span>在庫数</label>
<div class="col-md-6">
<input id="inventory" type="number" class="form-control" name="inventory" value="{{ old('inventory', $edit->inventory) }}" min="0" required autofocus>
</div>
</div>
<div class="form-group">
<label for="image" class="col-md-4 control-label">（任意）画像</label>
<div class="col-md-6">
<input id="image" type="file" name="image" accept=".jpeg, .jpg, .png">
</div>
</div>
@if ($edit->image == null)
<div style="margin:20px;" align="center">＊現在登録中の画像はありません</div>
@else
<div style="margin:20px;" align="center">＊下記の画像を登録中</div>
<div align="center"><img src="{{ asset('storage/images/' . $edit->image) }}" width="20%"></div>
@endif
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
<p><a href="{{ route('admin.item.detail', ['id' => $edit->id]) }}">商品詳細へ</a></p>
<a href="{{ route('admin.index') }}">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection
