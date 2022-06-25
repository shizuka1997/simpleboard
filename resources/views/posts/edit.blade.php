@extends('layouts.layouts')

@section('title', 'ライター登録内容の編集')

@section('content')

<h1>ライター登録内容の編集</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="/writer_update/{{ $writer->id }}" method="POST" >
    {{ csrf_field() }}

    <div class="form-group">
        <label for="w_1">ライター名</label>
        <textarea class="form-control" name="w_n">{{ old('w_n', $writer->w_name) }}</textarea>
    </div>

    <div class="form-group">
        <label for="w_2">住所</label>
        <textarea class="form-control" name="w_a">{{ old('w_a', $writer->w_address) }}</textarea>
    </div>

    <div class="form-group">
        <label for="w_3">電話番号</label>
        <textarea class="form-control" name="w_t">{{ old('w_t', $writer->w_tel) }}</textarea>
    </div>

    <button type="submit" class="btn btn-outline-primary">編集</button>
</form>

<!-- <a href="/writer/{{ $writer->id }}">確認</a> |  -->
<a href="/writer">戻る</a>

@endsection
