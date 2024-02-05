let menuBar = document.getElementById("menu-bar");

function menuToggler(){
    let toggleSideBar = document.getElementById('left-side-bar');
    toggleSideBar.classList.toggle("menu-toggler");
}

menuBar.addEventListener("click", function(){
    menuToggler();
});