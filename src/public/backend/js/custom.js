$(function () {
    /**
     * フラッシュメッセージ
     */

    //フラッシュメッセージを一定時間表示後にフェイドアウトして消す
    $(".flash-msg").fadeIn("slow", function () {
        $(this).delay(1200).fadeOut("slow");
    });
    //せっかちな人用に、フェイドアウト前でも、要素かbodyをクリックすればフラッシュメッセージが消える
    $(".flash-msg, body").on("click", function () {
        $(".flash-msg").hide();
    });

    /**
     * ツール初期化系
     */

    //データピッカー
    $('.use-datepicker').datepicker({
        language: 'ja',
    });

    //データタイムピッカー
    $('.use-datetimepicker').datetimepicker({
        locale: 'ja',
    });

    //予測検索出来るselect2を利用
    $(function () {
        $('.use-select2').select2();
    });

    //Flat blue color scheme for iCheck
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    })
});
