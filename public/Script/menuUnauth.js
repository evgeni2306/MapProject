var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};       

if (isMobile.any()) {
    document.body.classList.add('_mobile');
} else {
    document.body.classList.add('_pc');

    const authorizationNotif = document.querySelector('.authorization-notification');
    authorizationNotif.classList.add('hide');
}

const iconMenu = document.querySelector('.menu__icon');
if (iconMenu) {
    const authorizationBtn = document.querySelector('.authorization-btn');
    const headerMenu = document.querySelector('.menu');
    iconMenu.addEventListener("click", function(e) {
        document.body.classList.toggle('_lock');
        iconMenu.classList.toggle('active__user-menu');
        authorizationBtn.classList.toggle('active__user-menu');
        headerMenu.classList.toggle('hide');
    });
}

const menuItems = document.querySelectorAll('.menu__item');
if (document.body.classList.contains('_mobile')) {
    
}