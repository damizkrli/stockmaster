document.addEventListener('DOMContentLoaded', function() {
    var loadingOverlay = document.getElementById('loading-overlay');
    var table = document.querySelector('.table');

    // Afficher l'overlay de chargement
    loadingOverlay.style.display = 'block';

    // Masquer l'overlay de chargement et afficher le tableau après 2 secondes
    setTimeout(function() {
        loadingOverlay.style.display = 'none';
        table.style.display = 'table';
    }, 2000);
});