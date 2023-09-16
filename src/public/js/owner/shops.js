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
            sessionStorage.setItem('area', this.textContent);
            const target = sessionStorage.getItem('area');
            // セッションに値が両方(genre,all)入っていない場合
            if (!sessionStorage.getItem('genre') && !sessionStorage.getItem('all')) {
                location.href = `/?area=${target}`;
                // セッションに値が両方(genre,all)入っている場合
            } else if (sessionStorage.getItem('genre') && sessionStorage.getItem('all')) {
                location.href = `/?area=${target}&genre=${sessionStorage.getItem('genre')}&all=${sessionStorage.getItem('all')}`;
                // セッション(genre)のみ値が入っている場合
            } else if (sessionStorage.getItem('genre') && !sessionStorage.getItem('all')) {
                location.href = `/?area=${target}&genre=${sessionStorage.getItem('genre')}&all=`;
                // セッション(all)のみ値が入っている場合
            } else if (!sessionStorage.getItem('genre') && sessionStorage.getItem('all')) {
                location.href = `/?area=${target}&genre=&all=${sessionStorage.getItem('all')}`;
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
            sessionStorage.setItem('genre', this.textContent);
            const target = sessionStorage.getItem('genre');
            // セッションに値が両方(area,all)入っていない場合
            if (!sessionStorage.getItem('area') && !sessionStorage.getItem('all')) {
                location.href = `/?genre=${target}`;
                // セッションに値が両方(area,all)入っている場合
            } else if (sessionStorage.getItem('area') && sessionStorage.getItem('all')) {
                location.href = `/?area=${sessionStorage.getItem('area')}&genre=${target}&all=${sessionStorage.getItem('all')}`;
                // セッション(area)のみ値が入っている場合
            } else if (sessionStorage.getItem('area') && !sessionStorage.getItem('all')) {
                location.href = `/?area=${sessionStorage.getItem('area')}&genre=${target}&all=`;
                // セッション(all)のみ値が入っている場合
            } else if (!sessionStorage.getItem('area') && sessionStorage.getItem('all')) {
                location.href = `/?area=&genre=${target}&all=${sessionStorage.getItem('all')}`;
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
        window.sessionStorage.setItem('all', target.value);

        if (!sessionStorage.getItem('area') && !sessionStorage.getItem('genre')) {
            window.location.href = `/?all=${this.value}`;
        } else if (sessionStorage.getItem('area') && sessionStorage.getItem('genre')) {
            window.location.href = `/?area=${sessionStorage.getItem('area')}&genre=${sessionStorage.getItem('genre')}&all=${this.value}`;
        } else if (sessionStorage.getItem('area') && !sessionStorage.getItem('genre')) {
            window.location.href = `/?area=${sessionStorage.getItem('area')}&genre=&all=${this.value}`;
        } else if (!sessionStorage.getItem('area') && sessionStorage.getItem('genre')) {
            window.location.href = `/?area=&genre=${sessionStorage.getItem('genre')}&all=${this.value}`;
        }
    });
}
allSearch();

/**
 * 検索窓横の削除ボタンをクリックした際の処理
 */
function clearSearch() {
    const button = document.querySelector('.search-not__button');

    button.addEventListener('click', function () {
        sessionStorage.clear();
        location.href = '/';
    });
}
clearSearch();

/**
 * 「削除」を押した場合の処理
 */
function confirmDel() {
    if (window.confirm('削除してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}