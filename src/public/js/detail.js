/**
 * 評価数の表示を変更する
 */
function rateDisplay() {
    let rates = document.querySelectorAll('.rate-comment__content-rates');
    rates.forEach(rate => {
        switch (rate.textContent) {
            case '1':
                rate.textContent = '★';
                break;
            case '2':
                rate.textContent = '★★';
                break;
            case '3':
                rate.textContent = '★★★';
                break;
            case '4':
                rate.textContent = '★★★★';
                break;
            case '5':
                rate.textContent = '★★★★★';
                break;
        }
    });
}
rateDisplay();

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

/**
 * ログイン中の画面レイアウトの変更
 */
function screenDesign() {
    const reserve = document.querySelector('.detail-reserve');
    const rate = document.querySelector('.detail-rate');

    if (reserve) {
        rate.style.width = '100%'
    }
}
screenDesign();

/**
 * 予約ボタンの切り替え
 */
function changeBtn() {
    const input = document.querySelector('.reserve-card__input-group');
    const description = document.querySelector('.reserve-card__content-description');
    const txts = document.querySelectorAll('.reserve-item__content');
    const addBtn = document.querySelector('.reserve-card__button-reserve');

    if (txts[1].textContent !== '予約無') {
        input.style.display = 'none';
        description.style.display = 'block';
        addBtn.style.display = 'none';
    }
}
changeBtn();

