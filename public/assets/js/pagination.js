// public/js/custom.js

document.addEventListener("DOMContentLoaded", function () {
    var paginationLinks = document.querySelectorAll('.pagination a');

    paginationLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            paginationLinks.forEach(function (innerLink) {
                innerLink.classList.remove('selected');
            });

            link.classList.add('selected');
        });
    });
});
