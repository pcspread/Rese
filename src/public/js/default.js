/**
 * メニューボタンをマウスオーバーした時の処理
 */
function hoverMenu() {
    const icon = document.querySelector('.header-icon');
    const title = document.querySelector('.header-title');

    // マウスオーバー時
    icon.addEventListener('mouseover', function () {
        // テキストを変える
        title.textContent = 'Menu';
    });

    //　マウスリーブ時
    icon.addEventListener('mouseleave', function () {
        // テキストを戻す
        title.textContent = 'Rese';
    });
}
hoverMenu();

/**
 * メニューの開閉
*/
function openMenue() {
    // DOM要素を取得
    const header = document.querySelector('.header');
    const icon = document.querySelector('.header-icon');
    const title = document.querySelector('.header-title');
    const menu = document.querySelector('.header-mene');
    const main = document.querySelector('.main');

    // クリック時にメニュー開閉
    icon.addEventListener('click', function () {
        header.classList.toggle('sub');
        icon.classList.toggle('spin');
        title.classList.toggle('close');
        main.classList.toggle('close');
        menu.classList.toggle('open');
    });
}
openMenue();

/**
 * ページ上方へ移動するボタンを押した時の処理
 */
function upperMove() {
    const upper = document.querySelector('.upper');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 0) {
            upper.style.display = 'block';
        } else {
            upper.style.display = 'none';
        }
    });

    upper.addEventListener('click', function (event) {
        window.location.hash = 'header';
        history.replaceState('', '', '/');
    });
}
upperMove();