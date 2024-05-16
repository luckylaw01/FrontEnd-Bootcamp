document.addEventListener("DOMContentLoaded", function() {
    const hideOrshowAllBtns = document.querySelectorAll('.hideOrshowAll');
    const tableWrapperDivs = document.querySelectorAll('.table-wrapper');


    hideOrshowAllBtns.forEach((btn, i) => {
        btn.addEventListener('click', function() {
            tableWrapperDivs[i].classList.toggle('open');
            if(btn.textContent == "Show All"){
                btn.textContent = "Show Less";
            }
            else{
                btn.textContent = "Show All";
            }
            
        });
    });

    // Show alert
    function showAlert() {
        const animatedAlert = document.querySelector('.animated-alert');
        animatedAlert.style.display = 'block';
        setTimeout(() => {
            animatedAlert.style.display = 'none';
        }, 5000);
    }

    // Call the showAlert function
    showAlert();
});

