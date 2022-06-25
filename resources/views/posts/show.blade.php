<div>{{ $writer->w_name }}</div>
<div>{{ $writer->w_address }}</div>
<div>{{ $writer->w_tel }}</div>
//以下追記
<form action="/writer_delete/{{ $writer->id }}" method="delete">
 @csrf
 @method('DELETE')
 <button type="submit" class="btn item-destroy">
   削除
 </button>
</form>
//ここまで
