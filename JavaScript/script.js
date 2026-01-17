const menu = document.getElementById('menu');
const notifiche = document.getElementById('notifiche');
const btnChiudiNotifiche = document.getElementById('chiudi-notifiche');
const btnChiudiMenu = document.getElementById('chiudi-menu');
const btnMenu = document.getElementById('bottone-menu');
const btnNotifiche = document.getElementById('bottone-notifiche');

btnChiudiMenu.addEventListener('click', function() {
    menu.classList.remove('show');
})

btnChiudiNotifiche.addEventListener('click', function() {
    notifiche.classList.remove('show');
})

btnMenu.addEventListener('click', function() {
    menu.classList.add('show');
})

btnNotifiche.addEventListener('click', function() {
    notifiche.classList.add('show');
})
