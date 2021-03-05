// =================================================
// side bar nav
// =================================================
document.querySelector('.side-bar-menu-icon').addEventListener("click", () => {
    const sideBar = document.querySelector('.side-bar-menu');
    sideBar.classList.toggle('open');
});