document.addEventListener('DOMContentLoaded', function() {
    const hideZeroCheckbox = document.getElementById('hideZeroCheckbox');

    hideZeroCheckbox.addEventListener('change', function() {
        const tableRows = document.querySelectorAll('.table tbody tr');
        const isChecked = hideZeroCheckbox.checked;

        tableRows.forEach(function(row) {
            if (isChecked && row.classList.contains('zero-quantity')) {
                row.style.display = 'none';
            } else {
                row.style.display = '';
            }
        });
    });
});