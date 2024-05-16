let menuBar = document.getElementById("menu-bar");

function menuToggler(){
    let toggleSideBar = document.getElementById('left-side-bar');
    toggleSideBar.classList.toggle("menu-toggler");
}

menuBar.addEventListener("click", function(){
    menuToggler();
});

const editProfile = document.getElementById('edit-profile');
editProfile.addEventListener('click', () => {
    window.location.href = "profile.php";
});

function alertNow(message){
    const animatedAlert = document.querySelector(".animated-alert");
    animatedAlert.style.display = "block";
    animatedAlert.textContent = message;
                
                setTimeout(() => {
                    document.querySelector(".animated-alert").style.display = "none";
            }, 5000);

    }

    alertNow("You have new notifications");