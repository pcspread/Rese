/**
 * 「飲食店一覧」が押された場合の処理
 */
function backHome() {
    const backBtn = document.querySelector('.setting-button.home');

    backBtn.addEventListener('click', function () {
        location.href = '/owner';
    });
}
backHome();