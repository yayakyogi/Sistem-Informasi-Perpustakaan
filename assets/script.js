const humbergerButton = document.querySelector(".humberger-button");
const sideBar = document.querySelector(".sidebar");
const buttonClose = document.querySelector(".sidebar-close");

// Open slide menu
humbergerButton.addEventListener("click", function () {
  sideBar.classList.toggle("sidebarShow");
});
// Close slide menu
buttonClose.addEventListener("click", function () {
  sideBar.classList.toggle("sidebarShow");
});

// Close notif
const closeNotif = document.getElementById("#close");
