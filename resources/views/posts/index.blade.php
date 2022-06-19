@extends('layouts.layouts')

@section('title', 'ライター一覧')

@section('content')

    @if (session('message'))
        {{ session('message') }}
    @endif

    <h1>ライター一覧</h1>
    <h4><a href="/writer/create">ライター新規作成</a></h4>

    @foreach($ws as $writer)

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $writer->w_name }}</h5>
                <p class="card-text">{{ $writer->w_address }}</p>
                <p class="card-text">{{ $writer->w_tel }}</p>

                <div class="d-flex" style="height: 36.4px;">
                    <!-- 編集画面を表示 -->
                    <a href="/writer/{{ $writer->id }}/edit" class="btn btn-outline-primary">編集</a>
                    <!-- 削除処理 -->
                    <form action="/writer_delete/{{ $writer->id }}" method="POST" onsubmit="if(confirm('削除してもよろしいですか？')) { return true } else {return false };">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
