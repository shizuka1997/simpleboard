<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Writer;
use DB;

class PostController extends Controller
{
    /**
     * ＴＯＰページの表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ws = Writer::all();

        return view('writer.index', compact('ws'));

    }

    /**
     * ライター新規登録の初期表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writer.create');
    }

    /**
     * ライターの新規登録
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $request->validate([
            'w_n' => 'required',
            'w_a' => 'required',
            'w_t' => 'required',
        ]);
       
        $writer = new Writer();
        $writer->w_name = $request->input('w_n');
        $writer->w_address = $request->input('w_a');
        $writer->w_tel = $request->input('w_t');
        $writer->save();

        return redirect()->route('writer.index')->with('message', '登録しました。');
    }

    /**
     * 個別の投稿ページの表示
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Writer $ws)
    {
        return view('writer.show', compact('writer'));
    }

    /**
     * 投稿編集 画面の表示
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Writer $writer)
    {
         return view('writer.edit', compact('writer'));
    }

    /**
     * 投稿の更新を保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Writer $writer)
    {
        $request->validate([
            'w_n' => 'required',
            'w_a' => 'required',
            'w_t' => 'required',
        ]);
        // dd($writer->id);
        // $writer->w_name = $request->input('w_n');
        // $writer->w_address = $request->input('w_a');
        // $writer->w_tel = $request->input('w_t');
        // $writer->save();
        $id = $writer->id;
        $w_name = $request->input('w_n');
        $w_address = $request->input('w_a');
        $w_tel = $request->input('w_t');
        $sql = "update writers set w_name = '$w_name', w_address = '$w_address', w_tel = '$w_tel' "
            ." where id = '$id' ";
        DB::update($sql);

        // return redirect()->route('writer.index', ['id' => $ws->id])->with('message', 'Writer was successfully updated.');
        return redirect('writer')->with('message', '更新に成功しました。');
    }

        /**
     * ライターの削除
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Writer $delete)
    {
        // dd($writer);
        $delete->delete();
        // return redirect()->route('writer.index');
        return redirect('writer')->with('message', '削除に成功しました。');
    }

}

