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