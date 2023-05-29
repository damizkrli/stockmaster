document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    selectAllCheckbox.addEventListener('click', function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = !checkbox.checked;
        });

        updateSelectAllButtonText();
    })

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateSelectAllButtonText();
        });
    });

    function updateSelectAllButtonText() {
        const allChecked = Array.from(checkboxes).every(function (checkbox) {
            return checkbox.checked;
        });

        selectAllCheckbox.textContent = allChecked ? 'Tout désélectionner' : 'Tout sélectionner';
    }

    updateSelectAllButtonText();

})