document.addEventListener('DOMContentLoaded', function () {
    var toasts = document.querySelectorAll('.toast');
    if (toasts !== null) {
        var toastList = new bootstrap.Toast(toasts[0]);
        toastList.show();
    }
});