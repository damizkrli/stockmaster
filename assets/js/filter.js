document.addEventListener('DOMContentLoaded', function() {
    var showLessCheckbox = document.getElementById('showLessCheckbox');
    var showMoreCheckbox = document.getElementById('showMoreCheckbox');
    var tableRows = document.querySelectorAll('#table-body tr');

    showLessCheckbox.addEventListener('change', function() {
        updateTableVisibility();
    });

    showMoreCheckbox.addEventListener('change', function() {
        updateTableVisibility();
    });

    function updateTableVisibility() {
        var showLess = showLessCheckbox.checked;
        var showMore = showMoreCheckbox.checked;

        for (var i = 0; i < tableRows.length; i++) {
            var row = tableRows[i];
            var quantity = parseInt(row.querySelector('.start').innerText);

            if ((showLess && quantity >= 5) || (showMore && quantity <= 5)) {
                row.style.display = 'none';
            } else {
                row.style.display = '';
            }
        }
    }
});