(function () {
    document.addEventListener("DOMContentLoaded", function () {
        const burgerMenu = document.getElementById("burger__menu");
        const overlay = document.getElementById("menu");

        if (burgerMenu && overlay) {
            burgerMenu.addEventListener("click", function () {
                this.classList.toggle("close");
                overlay.classList.toggle("overlay");
            });
        }
    });

    window.$ = function (id) {
        return document.getElementById(id);
    };

    window.show = function (id) {
        $(id).style.display = "block";
    };

    window.hide = function (id) {
        $(id).style.display = "none";
    };
})();
