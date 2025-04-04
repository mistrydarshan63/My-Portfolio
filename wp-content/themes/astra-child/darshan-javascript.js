window.addEventListener("scroll", function() {
    var header = document.getElementById("masthead");
    if (window.scrollY > 50) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});
