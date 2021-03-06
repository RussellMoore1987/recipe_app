// # =================================================
// # side bar nav
// # =================================================

// side bar function
sideBar = function() {
    const sideBar = document.querySelector('.side-bar-menu');
    sideBar.classList.toggle('open');
    const sideBarModal = document.querySelector('.side-bar-modal');
    if (sideBarModal.classList.contains('open')) {
        sideBarModal.classList.toggle('open');
        setTimeout(function(){ sideBarModal.classList.toggle('appear'); }, 400);
    } else {
        sideBarModal.classList.toggle('appear');
        sideBarModal.classList.toggle('open');
    }
}
// side bar function click handlers
document.querySelector('.side-bar-menu-icon').addEventListener("click", sideBar);
document.querySelector('.side-bar-modal').addEventListener("click", sideBar);

// # =================================================
// # bottom bar nav
// # =================================================

document.querySelector('.chef-add').addEventListener("click", (event) => {
    event.stopPropagation()
    document.querySelector('.chef-add-menu').classList.toggle('open');
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
});