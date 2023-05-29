function compareQuantity(a, b) {
    return parseInt(a, 10) - parseInt(b, 10);
}

function compareName(a, b) {
    return a.localeCompare(b);
}

function compareAddedAt(a, b) {
    const dateA = parseDate(a);
    const dateB = parseDate(b);
    return dateA - dateB;
}

function parseDate(dateString) {
    const parts = dateString.split('/');
    const day = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10) - 1;
    const year = parseInt(parts[2], 10);
    return new Date(year, month, day);
}


function sortTableData(columnIndex, compareFunction) {
    let table = document.getElementById('table-body');
    let rows = Array.from(table.getElementsByTagName('tr'));
    let sortOrder = table.getAttribute('data-sort-order');

    rows.sort(function (a, b) {
        let rowDataA = a.getElementsByTagName('td')[columnIndex].innerText;
        let rowDataB = b.getElementsByTagName('td')[columnIndex].innerText;

        if (sortOrder === 'asc') {
            return compareFunction(rowDataA, rowDataB);
        } else {
            return compareFunction(rowDataB, rowDataA);
        }
    });

    table.setAttribute('data-sort-order', sortOrder === 'asc' ? 'desc' : 'asc');

    rows.forEach(function (row) {
        table.appendChild(row);
    });
}

document.getElementById('quantity-header').addEventListener('click', function () {
    sortTableData(0, compareQuantity);
});

document.getElementById('brand-header').addEventListener('click', function () {
    sortTableData(1, compareName);
});

document.getElementById('name-header').addEventListener('click', function () {
    sortTableData(2, compareName);
});

document.getElementById('added-at-header').addEventListener('click', function () {
    sortTableData(5, compareAddedAt);
});