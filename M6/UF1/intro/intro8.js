
window.addEventListener('load', loadBingoProgress);

const bingo = [
  new Array(9), 
  new Array(9), 
  new Array(9)
];


do {
  crearCartilla(bingo);
} while (!arrangeBlack(bingo));


/*   CREACIÓ DE LA TAULA       */
const table = document.createElement('table');
document.body.appendChild(table);
const tbody = document.createElement('tbody');
table.appendChild(tbody);
for (let i = 0; i < 3; i++) {
  const tr = document.createElement('tr');
  tbody.appendChild(tr);
  for (let j = 0; j < 9; j++) {
    const td = document.createElement('td');
    td.textContent=bingo[i][j];
    if (bingo[i][j] == 0) {
      td.classList.add('black');
    }
    tr.appendChild(td);  
  }
}

const button = document.createElement('button');
button.textContent = 'Extreu bola';
document.body.appendChild(button);

const resetejaB = document.createElement('button');
resetejaB.textContent = 'Reseteja el joc';
document.body.appendChild(resetejaB);

const numsBingo = document.createElement('div');
document.body.appendChild(numsBingo);

const numsBolaBingo = getRandNumArr(89, 1, 90);
const arrayFiles = [];

button.addEventListener('click', function(){
  const bolaBingo = document.createElement('span');
  const tempBola = numsBolaBingo.pop();

  if (numsBolaBingo.length == 0) {
    alert('BINGO!');
  } else {
    bolaBingo.textContent = tempBola;
    numsBingo.insertAdjacentElement('afterbegin', bolaBingo);
  }

  setGreen(table, tempBola);

  const checkedRow = checkRow(table, arrayFiles);

  if (!(checkedRow == null)) {
    arrayFiles.push(checkedRow);  
  }
  
  saveBingoProgress();
});

resetejaB.addEventListener('click', function(){
  localStorage.clear();
  window.location.reload();
});



/*   STYLE DE LA TAULA    */
const styles = `
  td {
    border: 1px solid black;
    width: 100px;    
    height: 100px;
    text-align: center;
  }

  .black{
    background-color: black;
  }

  .green{
    background-color: green;
  }

  div{
    display: flex;
  }

  div span{
    border: 1px solid black;
    border-radius: 50%;
    padding: 30px;
  }
`;
const styleSheet = document.createElement('style');
styleSheet.type = 'text/css';
styleSheet.innerText = styles;
document.head.appendChild(styleSheet);


/*FUNCTIONS*/

// CREAR BINGO
function crearCartilla(bingo){
//asignar tots els nums
  let min = 1;
  let max = 9;
  for (let i = 0; i < bingo[0].length; i++) {
    for (let j = 0; j < bingo.length; j++) {

      let random = getRandNum(min, max);

      //comprovar que els numeros no es repeteixin
      if (!bingo.some(numero => numero.includes(random))) {
        bingo[j][i] = random;
      } else{j--;}
    }

    min+=10;
    max+=10;
  }

  //ordenar array
  sortColumn(bingo);

  //assignar els 0
  for (let i = 0; i < bingo.length; i++) {

    const negres = getRandNumArr(4, 0, 9);

    for (let j = 0; j < bingo[i].length; j++) {
      if (negres.includes(j)) {
        bingo[i][j] = 0;
      }
    }
  
  }
}

// GENERA NUM ALEATORI
function getRandNum(min, max){
  let random = Math.floor(Math.random() * (max-min)+min);
  return random;
}

//GENERA MÉS D'UN NUM ALEATORI
function getRandNumArr(lth, min, max){
  const nums = [];
  for (let i = 0; i < lth; i++) {
    let rand = getRandNum(min, max);
    if (!nums.includes(rand)) {
      nums[i] = rand;
    } else{i--;}
  }
  return nums;
}

//ORDENA COLUMNES
function sortColumn(array){
  for (let i = 0; i < array[0].length; i++) {
    const ordena = new Array(3);

    for (let j = 0; j < array.length; j++) {
      ordena[j] = array[j][i];
    }

    //si la columna es par, ordena ascendente. 
    //Sino, descendente
    if (i%2 == 0) {ordena.sort((a,b) => a-b);} 
    else{ordena.sort((a,b) => b-a);}

    //re ordena la columna según el orden escogido
    for (let k = 0; k < ordena.length; k++) 
    {array[k][i] = ordena[k];}
  }
}

// COMPROVA SI NEGRES
function arrangeBlack(array){
  //comprueba si todos los elementos de un array son iguales
  const todoIgual = arr => arr.every(v => v === arr[0]);
  let  comprovar = true;

  while (comprovar) {
    for (let i = 0; i < array[0].length; i++) {
      const col = new Array(3);
      for (let j = 0; j < array.length; j++) {
        col[j] = array[j][i];
      }

      if (!col.includes(0)) {
        comprovar = false;
      } else if(todoIgual(col)){
        comprovar = false;
      }
    }
    break;
  }
  return comprovar;
}

//ASSIGNAR COLOR VERD
function setGreen(element, numBola){
  for (let i = 0; i < element.rows.length; i++) {
    const tr = element.rows[i];
    for (let j = 0; j < tr.cells.length; j++) {
      const td = tr.cells[j];
      if (parseInt(td.textContent) === numBola) {
        return td.classList.add('green');
      }
    }
  }
}

//COMPROVAR FILES
function checkRow(element, arrayFiles){
  for (let i = 0; i < element.rows.length; i++) {
    const tr = element.rows[i];

    let rowBingo = false;

    if (!(arrayFiles.includes(i))) {
      const tds = [];
      for (let j = 0; j < tr.cells.length; j++) {
        const td = tr.cells[j];
        if (td.classList.contains('green')) {
          tds.push(td.getAttribute('class'));
        }
      }

      if (tds.length == 5) {
        rowBingo = true;
        if (rowBingo && !(arrayFiles.length==1)) {
          alert('Fila ' + (i+1) + ' completada.');
          return i;
        }
      }
    }
  }
}

//GUARDAR EN LOCAL STORAGE
function saveBingoProgress() {
  const tableData = [];
  
  for (let i = 0; i < table.rows.length; i++) {
    const rowData = [];
    for (let j = 0; j < table.rows[i].cells.length; j++) {
      const cell = table.rows[i].cells[j];
      rowData.push([cell.textContent, cell.className]);
    }
    tableData.push(rowData);
  }

  const spanNumbers = [];
  const spans = numsBingo.querySelectorAll('span');
  for (let i = 0; i < spans.length; i++) {
    spanNumbers.push(spans[i].textContent);
  }

  localStorage.setItem('bingoTable', JSON.stringify(tableData));
  localStorage.setItem('bingoNumbers', JSON.stringify(spanNumbers));
}

// CARREGAR LOCAL STORAGE
function loadBingoProgress() {
  const savedTable = JSON.parse(localStorage.getItem('bingoTable'));
  const savedNumbers = JSON.parse(localStorage.getItem('bingoNumbers'));
  if (savedTable) {
    
    for (let i = 0; i < savedTable.length; i++) {
      for (let j = 0; j < savedTable[i].length; j++) {
        const cell = table.rows[i].cells[j];
        cell.textContent = savedTable[i][j][0];
        cell.className = savedTable[i][j][1];
      }
    }
  }

  if (savedNumbers) {
    for (let i = 0; i < savedNumbers.length; i++) {
      const span = document.createElement('span');
      span.textContent = savedNumbers[i];
      numsBingo.appendChild(span);
    }
  }
}