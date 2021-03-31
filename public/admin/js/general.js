// # =================================================
// # side bar nav
// # =================================================

// side bar function
sideBar = function() {
    // toggle sidebar
    const sideBar = document.querySelector('.side-bar-menu');
    sideBar.classList.toggle('open');
    // toggle icon animation
    const sideBarIcon = document.querySelector('.side-bar-menu-icon');
    sideBarIcon.classList.toggle('menu-stage-3');
    // work with sidebar and modal
    const sideBarModal = document.querySelector('.side-bar-modal');
    if (sideBarModal.classList.contains('open')) {
        // closes sidebar
        sideBarModal.classList.toggle('open');
        // closes modal, makes modal disappear so we can touch elements beyond it
        setTimeout(function(){ sideBarModal.classList.toggle('appear'); }, 400);
    } else {
        // open modal
        sideBarModal.classList.toggle('appear');
        sideBarModal.classList.toggle('open');
    }
}
// side bar function click handlers
const sidebar = document.querySelector('.side-bar-menu-icon');
if (sidebar) {
    document.querySelector('.side-bar-menu-icon').addEventListener("click", sideBar);
    document.querySelector('.side-bar-modal').addEventListener("click", sideBar);
}

// # =================================================
// # bottom bar nav
// # =================================================

document.querySelector('.chef-add').addEventListener("click", (event) => {
    event.stopPropagation()
    document.querySelector('.chef-add-menu').classList.toggle('open');
    document.querySelector('.chef-add').classList.toggle('active');
});

document.querySelector('.chef-add-menu').addEventListener("click", (event) => {
    event.stopPropagation()
});

// # =================================================
// # general cleanup
// # =================================================

// this fires whenever the document is clicked, so most places you click will trigger this
document.querySelector('body').addEventListener("click", () => {
    const chefAddMenu = document.querySelector('.chef-add-menu');
    if (chefAddMenu.classList.contains('open')) {
        chefAddMenu.classList.toggle('open');
    }
    const chefAddBtn = document.querySelector('.chef-add');
    if (chefAddBtn.classList.contains('active')) {
        chefAddBtn.classList.toggle('active');
    }
});