<script>

    /**
     * Dropzone.jsのinit用functionを返すメソッド
     *
     * @param intputName
     * @param className
     * @returns {Function}
     */
    function getDZInit(intputName, className) {

        return function () {

            this.on("addedfile", function (file) { //ファイルを追加した際の処理
                //プレビューエリアにプレビューを追加
                $('#pict-preview-box').append(file.previewTemplate);
            });

            this.on("sending", function (file, xhr, formData) { //ファイル送信時の処理
                file.baseFileName = getBaseFileName(); //ユニークな名前を生成
                formData.append('baseFileName', file.baseFileName);
            });

            this.on("success", function (file, res) { //アップロードが成功した際の処理
                file.serverFileName = res.fileName; //サーバに保存してあるファイル名（拡張子付）
                $(file.previewTemplate).append("<input type='hidden' name='" + intputName + "' value='" + res.fileName + "'>"); //フォームを追加
            });

            this.on("removedfile", function (file) { //削除が成功した際の処理

                $.ajax({
                    type: 'POST',
                    url: "/" + className + "/pict/delete",
                    data: {
                        fileName: file.serverFileName,
                        tmpFlg: true
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('.pict-input-box input').val(file.serverFileName).remove();
                        showPictUpload(); //ドロップゾーンを表示
                    },
                    error: function (res) {
                        console.log('error!'); //TODO
                    }
                });
            });
        }
    }

    $(function () {
        // Disabling autoDiscover, otherwise Dropzone will try to attach twice. だそうな。
        Dropzone.autoDiscover = false;

        /**
         * アップロード「済」画像の削除リンク押した時の処理
         */
        $('.uploaded-preview .remove').on('click', function () {
            $.ajax({
                type: 'POST',
                url: "/{{ $className }}/pict/delete",
                data: {
                    actId: $(this).attr('data-act-id'),
                    pictId: $(this).attr('data-pict-id'),
                    fileName: $(this).attr('data-pict-name'),
                },
                context: this, //自身をajaxの中に渡す
                success: function (res) {
                    $(this).parent('div').remove();
                },
                error: function (res) {
                    console.log('error! Uploaded Topimage couldnt delete.'); //TODO
                }
            });

            showPictUpload(); //ドロップゾーンを表示
        });
    });

    /**
     * 画像のドロップゾーンの表示・非表示メソッド
     */
    function showPictUpload() {
        $('#pictUpload').show();
    }
    function hidePictUpload(){
        $('#pictUpload').hide();
    }

</script>