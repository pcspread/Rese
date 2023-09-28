/**
 * メニューの開閉時の処理
*/
function openMenu() {
    // DOM要素を取得
    const header = document.querySelector('.header');
    const icon = document.querySelector('.header-icon');

    // クリック時に背景色を変化
    icon.addEventListener('click', function () {
        header.classList.toggle('color');
    });
}
openMenu();

/**
 * 予約削除の確認
 */
function confirmDel() {
    if (window.confirm('予約を削除してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

/**
 * 予約更新の確認
 */
function confirmUpdate() {
    if (window.confirm('予約を更新してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}