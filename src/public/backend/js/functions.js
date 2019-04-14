/**
 * ユニークなファイル名を生成して返すメソッド
 *
 * @param myStrong
 * @returns {string}
 */
function getBaseFileName(myStrong) {
    var strong = 1000;
    if (myStrong) strong = myStrong;
    return new Date().getTime().toString(16) + Math.floor(strong * Math.random()).toString(16)
}

/**
 * カレンダーのヘッダ設定を返すメソッド
 *
 * @returns {{left: string, center: string, right: string}}
 */
function getCalendarHeaderTools(){
    return {
        left: 'prev,next today',
        center: 'title',
        right: 'month,listYear'
    };
}