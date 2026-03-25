document.addEventListener('DOMContentLoaded', () => {
    eventListener();

    darkMode();
});

function darkMode() {
    //Obtiene si el usuario tiene su pc en modo oscuro desde el sistema operativo
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode);

    if (prefiereDarkMode.matches) {//verifica si esta el modo oscuro en true o false
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    //Esto es para que se actualize automaticamente mientras el usuario cambio el modo en su Sistema operativo
    prefiereDarkMode.addEventListener('change', () => {
        if (prefiereDarkMode.matches) {//verifica si esta el modo oscuro en true o false
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}


function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');


    /*if(navegacion.classList.contains('mostrar')) { 
        navegacion.classList.remove('mostrar');
    }else {
        navegacion.classList.add('mostrar');
    }*/

    //Los que esta arriba es equivalente a esto -> navegacion.classList.toggle('mostrar')
}