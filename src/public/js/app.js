/**
 * ナビの開閉
 */
function navDisplay() {
    const header = document.querySelector('.header');
    const nav = document.querySelector('.header-nav');

    // マウスオーバー時の処理
    header.addEventListener('mouseover', function () {
        // ナビメニューを見えるように
        nav.style.transform = 'translateY(0)';
    });
    // マウスリーブ時の処理
    header.addEventListener('mouseleave', function () {
        // ナビメニューを見えないように
        nav.style.transform = 'translateY(-300%)';
    });
}
navDisplay();

/**
 * ナビメニューのボタンをクリックした時の処理
 */
function buttonClicks() {
    const search = document.querySelector('.header-data.search');
    const shop = document.querySelector('.header-data.shop');
    const mail = document.querySelector('.header-data.mail');
    const setting = document.querySelector('.header-data.setting');
    const logout = document.querySelector('.header-data.logout');

    const nav = document.querySelector('.header-nav');
    const list = document.querySelector('.list-item__top');
    const headerSearch = document.querySelector('.header-search');

    // 飲食店抽出をクリックした時
    search.addEventListener('click', function () {
        nav.style.display = 'none';
        list.style.display = 'none';
        headerSearch.style.display = 'block';
    });

    // 飲食店追加ボタンをクリックした時
    shop.addEventListener('click', function () {
        location.href = '/owner/shop';
    });
    // メール送信ボタンをクリックした時
    mail.addEventListener('click', function () {
        location.href = '/owner/mail';
    });
    // 管理者設定ボタンをクリックした時
    setting.addEventListener('click', function () {
        location.href = '/owner/setting';
    });
    // ログアウトボタンをクリックした時
    logout.addEventListener('click', function () {
        location.href = '/logout';
    });
}
buttonClicks();

/**
 * サーチメニューの閉じるをクリックした時の処理
 */
function closeSearch() {
    const close = document.querySelector('.search-close__link');
    const nav = document.querySelector('.header-nav');
    const list = document.querySelector('.list-item__top');
    const headerSearch = document.querySelector('.header-search');

    close.addEventListener('click', function () {
        // サーチメニューを閉じる
        nav.style.display = 'block';
        list.style.display = 'block';
        headerSearch.style.display = 'none';
    });
}
closeSearch();

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
                location.href = `/owner/?area=${target}`;
                // セッションに値が両方(genre,all)入っている場合
            } else if (sessionStorage.getItem('genre') && sessionStorage.getItem('all')) {
                location.href = `/owner/?area=${target}&genre=${sessionStorage.getItem('genre')}&all=${sessionStorage.getItem('all')}`;
                // セッション(genre)のみ値が入っている場合
            } else if (sessionStorage.getItem('genre') && !sessionStorage.getItem('all')) {
                location.href = `/owner/?area=${target}&genre=${sessionStorage.getItem('genre')}&all=`;
                // セッション(all)のみ値が入っている場合
            } else if (!sessionStorage.getItem('genre') && sessionStorage.getItem('all')) {
                location.href = `/owner/?area=${target}&genre=&all=${sessionStorage.getItem('all')}`;
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
                location.href = `/owner/?genre=${target}`;
                // セッションに値が両方(area,all)入っている場合
            } else if (sessionStorage.getItem('area') && sessionStorage.getItem('all')) {
                location.href = `/owner/?area=${sessionStorage.getItem('area')}&genre=${target}&all=${sessionStorage.getItem('all')}`;
                // セッション(area)のみ値が入っている場合
            } else if (sessionStorage.getItem('area') && !sessionStorage.getItem('all')) {
                location.href = `/owner/?area=${sessionStorage.getItem('area')}&genre=${target}&all=`;
                // セッション(all)のみ値が入っている場合
            } else if (!sessionStorage.getItem('area') && sessionStorage.getItem('all')) {
                location.href = `/owner/?area=&genre=${target}&all=${sessionStorage.getItem('all')}`;
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
            window.location.href = `/owner/?all=${this.value}`;
        } else if (sessionStorage.getItem('area') && sessionStorage.getItem('genre')) {
            window.location.href = `/owner/?area=${sessionStorage.getItem('area')}&genre=${sessionStorage.getItem('genre')}&all=${this.value}`;
        } else if (sessionStorage.getItem('area') && !sessionStorage.getItem('genre')) {
            window.location.href = `/owner/?area=${sessionStorage.getItem('area')}&genre=&all=${this.value}`;
        } else if (!sessionStorage.getItem('area') && sessionStorage.getItem('genre')) {
            window.location.href = `/owner/?area=&genre=${sessionStorage.getItem('genre')}&all=${this.value}`;
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
        location.href = '/owner';
    });
}
clearSearch();