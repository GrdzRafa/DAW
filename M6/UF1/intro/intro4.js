/****   DESCOMENTAR CADA LINEA PER ACTIVAR L'EXERCICI */

//document.body.onload = addElement;
//document.body.onload = rellotge;

function addElement() {

  const calculadora = document.createElement('form');
  calculadora.setAttribute('action', '#');
  calculadora.setAttribute('method', 'post');

  const num1 = document.createElement('input');
  num1.setAttribute('type', 'text');

  const operadorsSelect = document.createElement('select');
  operadorsSelect.setAttribute('id', 'lang');

  const suma = document.createElement('option');
  const resta = document.createElement('option');
  const multiplicacio = document.createElement('option');
  const divisio = document.createElement('option');
  const potencia = document.createElement('option');

  suma.setAttribute('value', 'suma');
  resta.setAttribute('value', 'divisio');
  multiplicacio.setAttribute('value', 'multiplicacio');
  divisio.setAttribute('value', 'divisio');
  potencia.setAttribute('value', 'potencia');


  suma.appendChild(document.createTextNode('+'));
  resta.appendChild(document.createTextNode('-'));
  multiplicacio.appendChild(document.createTextNode('x'));
  divisio.appendChild(document.createTextNode('/'));
  potencia.appendChild(document.createTextNode('^'));

  const num2 = document.createElement('input');
  num2.setAttribute('type', 'text');

  const signeIgual = document.createElement('label');
  signeIgual.textContent = '=';

  const total = document.createElement('input');
  total.setAttribute('type', 'text');

  const calcular = document.createElement('button');
  calcular.setAttribute('type', 'button');
  //calcular.setAttribute('onclick', 'calcularResultat()');
  calcular.onclick=calcularResultat;
  calcular.textContent = 'Calcula';

  const reseteja = document.createElement('button');
  reseteja.setAttribute('type', 'button');
  //reseteja.setAttribute('onclick', 'resetejarLabels()');
  reseteja.onclick=resetejarLabels;
  reseteja.textContent = 'Reseteja';

  const br = document.createElement('br');

  calculadora.appendChild(num1);
  calculadora.appendChild(operadorsSelect);

  operadorsSelect.appendChild(suma);
  operadorsSelect.appendChild(resta);
  operadorsSelect.appendChild(multiplicacio);
  operadorsSelect.appendChild(divisio);
  operadorsSelect.appendChild(potencia);

  calculadora.appendChild(num2);
  calculadora.appendChild(signeIgual); 
  calculadora.appendChild(total);

  calculadora.appendChild(br);

  calculadora.appendChild(calcular);
  calculadora.appendChild(reseteja);

  document.body.appendChild(calculadora);

  //ESTILS
  num1.style.background = 'linear-gradient(to top, #f9f9f9, #e3e3e3)';
  num1.style.border = '1px solid gray';
  num1.style.borderRadius = '5px';
  num1.style.height = '20px';
  num1.style.marginRight = '10px';

  operadorsSelect.style.background = 'linear-gradient(to bottom, #f9f9f9, #e3e3e3)';
  operadorsSelect.style.border = '1px solid gray';
  operadorsSelect.style.borderRadius = '5px';
  operadorsSelect.style.padding = '0px 10px';
  operadorsSelect.style.width = '45px';
  operadorsSelect.style.height = '25px';
  operadorsSelect.style.marginRight = '10px';

  num2.style.background = 'linear-gradient(to top, #f9f9f9, #e3e3e3)';
  num2.style.border = '1px solid gray';
  num2.style.borderRadius = '5px';
  num2.style.height = '20px';
  num2.style.marginRight = '5px';

  calcular.style.margin = '20px 5px';
  calcular.style.padding = '5px 20px';
  calcular.style.background = 'linear-gradient(to bottom, #f9f9f9, #e3e3e3)';
  calcular.style.border = '1px solid gray';
  calcular.style.borderRadius = '5px';
  calcular.style.boxShadow = '0px 1px 2px -1px black';

  reseteja.style.padding = '5px 20px';
  reseteja.style.background = 'linear-gradient(to bottom, #f9f9f9, #e3e3e3)';
  reseteja.style.border = '1px solid gray';
  reseteja.style.borderRadius = '5px';
  reseteja.style.boxShadow = '0px 1px 2px -1px black';

  total.style.background = 'linear-gradient(to top, #f9f9f9, #e3e3e3)';
  total.style.border = '1px solid gray';
  total.style.borderRadius = '5px';
  total.style.height = '20px';

  //operacions
  function calcularResultat(){

    const numeradors = document.getElementsByTagName('input');
    if (numeradors[0].value.includes(',')) {
      numeradors[0].value = numeradors[0].value.replace(',', '.');
      console.log(numeradors[0]);
    } else if (numeradors[1].value.includes(',')) {
      numeradors[1].value = numeradors[1].value.replace(',', '.');
    }
    
    const numerador1 = parseFloat(numeradors[0].value);
    const numerador2 = parseFloat(numeradors[1].value);
    console.log(numerador1);
    let resultat = 1;
    const operacio = document.getElementsByTagName('select')[0].options[document.getElementsByTagName('select')[0].selectedIndex].textContent;
    
    switch (operacio) {
    case '+':
      resultat = numerador1+numerador2;
      break;
    case '-':
      resultat = numerador1-numerador2;
      break;
    case 'x':
      resultat = numerador1*numerador2;
      break;
    case '/':
      resultat = numerador1/numerador2;
      break;
    case '^':
      num2.value = Math.trunc(numerador2);
      resultat = Math.pow(numerador1, Math.trunc(numerador2));
      break;
    default:
      alert('hola');
      return;
    }

    if (isNaN(resultat)) {
      total.style.color = 'red';
      total.value = 'Error: NaN';
    } else if (resultat =='Infinity') {
      total.style.color = 'red';
      total.value = 'Error: Infinity';
    } else{
      total.style.color= 'black';
      total.value = resultat.toFixed(2);
    }
  }
  
  //buidar
  function resetejarLabels(){
    const numeradors = document.getElementsByTagName('input');
    numeradors[0].value = '';
    numeradors[1].value = '';
    numeradors[2].value = '';
  }
}


/////////// EXERCICI 32


function formulari(){





  
}








/////////// EXERCICI 31
function rellotge() {
  const mostrarData = document.createElement('div');
  document.body.appendChild(mostrarData);

  let canviFormat = true;

  // Función para obtener la fecha en formato 1: DD-MM-YYYY HH:MM:SS
  function data1() {
    const now = new Date();
    let day = now.getDate();
    let month = now.getMonth();
    let year = now.getFullYear();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    if (day<10) {
      day = '0'+day;
    }

    if (month<10) {
      month = '0'+month;
    }

    if (hours<10) {
      hours = '0'+hours;
    }

    if (minutes<10) {
      minutes = '0'+minutes;
    }

    if (seconds<10) {
      seconds = '0'+seconds;
    }
    
    return day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
  }

  function data2() {
    const now = new Date();
    const options = {
      weekday: 'short',
      year: 'numeric',
      month: 'short', 
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false 
    };

    return now.toLocaleString('en-US', options);
  }

  function displayDateTime() {
    if (canviFormat) {
      mostrarData.textContent = data1();
    } else {
      mostrarData.textContent = data2();
    }
  }

  mostrarData.addEventListener('dblclick', function() {
    if (canviFormat) {
      canviFormat=false;
    } else {
      canviFormat=true;
    }
  });

  setInterval(displayDateTime, 1000);

}