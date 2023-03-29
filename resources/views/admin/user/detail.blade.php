@extends('layouts.app_admin')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">会員詳細ページ</div>
<div class="panel-body">

<table class="table table-striped">
<tr>
<th>名前</th>
<th>メールアドレス</th>
</tr>
<tr>
<td>{{ $result->name }}</td>
<td>{{ $result->email }}</td>
</tr>
</table>

@if (0 < $details->count())
<table class="table table-striped">
<tr>
<th>郵便番号</th>
<th>お届け先住所</th>
</tr>
@foreach ($details as $detail)
<tr>
<td>{{ $detail->postcode }}</td>
<td>{{ $detail->prefectures . $detail->city .  $detail->address_detail }}</td>
</tr>
@endforeach
</table>
@else
<div style="margin:40px;" align="center">お届け先住所が登録されていません</div>
@endif

<a href="{{ route('admin.user.index') }}">会員一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection

