<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

/**
 * ajax入力チェック処理
 */
class AjaxValidationController extends Controller {

    /**
     * 初期表示
     * @return object view形式
     */
    public function index() {
        // 出力値
        $outPut = [];
        return view('validation.ajax')->with($outPut);
    }

    /**
     * ajax送信ボタン押下処理
     * @param Request $request リクエスト情報
     * @return object json形式
     */
    public function entry(Request $request) {

        $a_id = $request->input('a_id');
        $a_name = $request->input('a_name');

        Log::debug($a_name);

        // 出力値
        $response = [];

        // 入力チェック処理
        // ルール
        $rules = [];
        $rules['a_id'] = "required|digits:1";
        $rules['a_name'] = "required";
        // メッセージ
        $messages = [];
        $messages['a_id.required'] = "IDは必須です。";
        $messages['a_id.digits'] = "IDは、数値1桁で入力して下さい。";
        $messages['a_name.required'] = "名前は必須です。";

        // 入力チェック開始
        $validator = Validator::make($request->all(), $rules, $messages);

        // チェックエラーの場合
        if ($validator->fails()) {
            $keys = [];
            $msgs = [];
            $ary = json_decode($validator->errors(), true);
            foreach ($ary as $key => $value) {
                // キーを配列に設定
                $keys[] = $key;
                // 値(メッセージ)を設定
                $msgs[] = $value;
            }
            $response["status"] = "NG";
            $response['msg'] = "入力チェックがあります。";
            $response["messages"] = $msgs;
            $response["errkeys"] = $keys;
            return response()->json($response);
        }

        // 出力値
        $response["status"] = "OK";
        $response['msg'] = "登録に成功しました。";
        return response()->json($response);
    }
}