const humbergerButton = document.querySelector('.humberger-button');
const sideBar = document.querySelector('.sidebar');
const buttonClose = document.querySelector('.sidebar-close');

humbergerButton.addEventListener('click', function(){
    sideBar.classList.toggle('sidebarShow');
})
buttonClose.addEventListener('click',function(){
    sideBar.classList.toggle('sidebarShow');
});