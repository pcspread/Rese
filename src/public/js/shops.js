/**
 * メニューボタンをクリックした時の処理
 */
function clickMenu() {
    const menus = document.querySelectorAll('.search-menu__icon');

    menus.forEach(item => {
        item.addEventListener('click', function () {
            this.nextElementSibling.classList.toggle('open');
            this.parentElement.previousElementSibling.classList.toggle('color');
        });
    });
}
clickMenu();

/**
 * エリアをクリックした際の処理
 */
function areaClick() {
    const areas = document.querySelectorAll('.search-menu__record.area');

    areas.forEach(area => {
        area.addEventListener('click', function () {
            window.sessionStorage.setItem('area', this.textContent);
            const target = window.sessionStorage.getItem('area');
            // セッションにジャンルが入っている場合
            if (window.sessionStorage.getItem('genre')) {
                window.location.href = `/?area=${target}&genre=${window.sessionStorage.getItem('genre')}`;
            } else {
                window.location.href = `/?area=${target}`;
            }
        });
    });
}
areaClick();

/**
 * ジャンルをクリックした際の処理
 */
function genreClick() {
    const genres = document.querySelectorAll('.search-menu__record.genre');

    genres.forEach(genre => {
        genre.addEventListener('click', function () {
            window.sessionStorage.setItem('genre', this.textContent);
            const target = window.sessionStorage.getItem('genre');
            // セッションにエリアが入っている場合
            if (window.sessionStorage.getItem('area')) {
                window.location.href = `/?area=${window.sessionStorage.getItem('area')}&genre=${target}`;
            } else {
                window.location.href = `/?genre=${target}`;
            }
        });
    });
}
genreClick();

/**
 * 検索窓に入力があった場合の処理
 */
function allSearch() {
    const target = document.querySelector('.search-input__box');

    target.addEventListener('change', function () {
        window.location.href = `/?all=${this.value}`;
    });
}
allSearch();