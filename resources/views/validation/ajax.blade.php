<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ajax</title>
    </head>
    <body>
        <h1>
            <a href="ajax_validation">ajax送信</a>
        </h1>
        <form id="hogeForm">
        <div>
            ID:<input type="text" id="a_id" name="a_id" value="1" />
        </div>
        <div>
            名前:<input type="text" id="a_name" name="a_name" value="あいうえお" />
        </div>
        </form>
        <input type="button" id="btn_ajax" value="ajax送信" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(function() {
                $("#btn_ajax").on('click', function() {
                    // IDを取得
                    let a_id = $("#a_id").val();
                    // 名前を取得
                    // let a_name = $("#a_name").val();
                    // 送信用データの設定
                    let sendData = {
                            "a_id": a_id,
                            "a_name": a_name
                    };
                    // let sendData = $("#hogeForm").serializeArray();
                    // console.log(sendData);

                    // ajax設定
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    $.ajax({
                        type: 'post',
                        url: 'validation_ajax',
                        dataType: 'json',
                        data: sendData
                    }).done(function(data) {
                        console.log(data);

                        // CSSの初期化
                        $("#a_id").css("color", "black").attr("title", "");
                        $("#a_name").css("color", "black").attr("title", "");

                        // 入力チェックNG
                        if (data.status === 'NG') {
                            alert(data.msg);
                            for (let i = 0; i < data.errkeys.length; i++) {
                                let id_key = "#" + data.errkeys[i];
                                console.log(id_key);
                                let msg = data.messages[i];
                                $(id_key).css("color", "red").attr("title", msg);
                            }
                        // 入力チェックOK
                        } else {
                            alert(data.msg);
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    });
                });
            });
        </script>
    </body>
</html>