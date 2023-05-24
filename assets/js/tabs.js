window.onload = function() {
    var links = document.querySelectorAll('.nav-link');
    var currentUrl = window.location.pathname;

    for (var i = 0; i < links.length; i++) {
        var linkUrl = links[i].getAttribute('href');
        if (linkUrl === currentUrl) {
            links[i].classList.add('active');
            break;
        }
    }
};