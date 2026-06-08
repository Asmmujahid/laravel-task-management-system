document.addEventListener("DOMContentLoaded", function () {

    console.log("Main JS Loaded");

    const currentLocation = window.location.href;

    const menuLinks = document.querySelectorAll(".sidebar-menu a");

    menuLinks.forEach(link => {

        if(link.href === currentLocation){
            link.classList.add("active");
        }

    });

});