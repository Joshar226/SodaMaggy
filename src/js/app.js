document.addEventListener("DOMContentLoaded", function() {
    iniciarApp();
})

function iniciarApp() {
    menu()
}

function menu() {
    const menu = document.querySelector('#menu')
    const sidebar = document.querySelector('#sidebar')
    const cerrar = document.querySelector('#cerrar')
    menu.addEventListener('click', function() {
        sidebar.classList.add('mostrar')
        setTimeout(() => {
            sidebar.classList.add('opacity-in')
        }, 0);
    })
    cerrar.addEventListener('click', function() {
        sidebar.classList.add('opacity-out')
        sidebar.classList.remove('opacity-in')
        setTimeout(() => {
            sidebar.classList.remove('mostrar')
            sidebar.classList.remove('opacity-out')
        }, 200);
        

    })
}