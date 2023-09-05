/**
 * メニューの開閉時の処理
*/
function openMenue() {
    // DOM要素を取得
    const header = document.querySelector('.header');
    const icon = document.querySelector('.header-icon');

    // クリック時に背景色を変化
    icon.addEventListener('click', function () {
        header.classList.toggle('color');
    });
}
openMenue();