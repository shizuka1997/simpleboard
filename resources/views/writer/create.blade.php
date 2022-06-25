@extends('layouts.layouts')

@section('title', 'ライター新規登録')

@section('content')

<h1>ライター新規登録</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form method="POST" action="/writer_insert">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="w_1">ライター名</label>
        <input type="text" class="form-control" name="w_n" value="{{old('w_name')}}">
    </div>
    <div class="form-group">
        <label for="w_2">住所</label>
        <input type="text" class="form-control" name="w_a" value="{{old('w_address')}}">
    </div>
    <div class="form-group">
        <label for="w_3">電話番号</label>
        <input type="text" class="form-control" name="w_t" value="{{old('w_tel')}}">
    </div>

    <button type="submit" class="btn btn-outline-primary">登録</button>
</form>

<a href="/writer">戻る</a>

@endsection
