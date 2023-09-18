/**
 * 入力された文字列のみ抽出する
 */
function searchRecords() {
    const input = document.querySelector('.reserve-search__input');
    const records = document.querySelectorAll('.reserve-content__instance-record.name');

    input.addEventListener('change', function () {
        records.forEach(record => {
            if (!record.textContent.includes(input.value)) {
                record.parentNode.remove();
            }
        });
    });
}
searchRecords();

/**
 * 検索ボックスの×が押された場合の処理
 */
function clearSearch() {
    const btn = document.querySelector('.reserve-search__clear');

    btn.addEventListener('click', function () {
        location.href = '/owner/reserve';
    });
}
clearSearch();