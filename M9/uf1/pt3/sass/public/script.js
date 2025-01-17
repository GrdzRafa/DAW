const desplegable = document.getElementById('desplegable');
const nav = document.querySelector('nav');

desplegable.addEventListener('click', () => {
    if (nav.style.display === "block") {
        nav.style.display = "none";
    } else {
        nav.style.display = "block";
    }
});

const tema = document.querySelector('.icon-brightness-contrast');
const tipoVista = document.querySelector('html');

const temaGuardat = localStorage.getItem('tema');
if (temaGuardat) {
  tipoVista.className = temaGuardat;
} else {
  tipoVista.className = 'claro';
}

tema.addEventListener('click', function (e) {
    if (tipoVista.className === 'oscuro') {
        tipoVista.className = 'claro';
        localStorage.setItem('tema', 'claro');
    } else {
        tipoVista.className = 'oscuro';
        localStorage.setItem('tema', 'oscuro');
    }
});