document.body.onload = productCart;

function productCart() {
  const headItem = ['Codi','Imatge', 'Descripció', 'Quantitat', 'Preu', 'Import', ''];

  const table = document.createElement('table');
  document.body.appendChild(table);

  const thead = document.createElement('thead');
  table.appendChild(thead);
  
  const headTR = document.createElement('tr');
  thead.appendChild(headTR);

  headItem.forEach(element => {
    const th = document.createElement('th');
    th.textContent = element;
    headTR.appendChild(th);
  });

  const products = [
    [101,'steelseires-arctis-5-rgb-negros.webp', 'Steelseires Arctis 5 Auriculars Gaming RGB Negres', 108.59],
    [102,'1202-agfa-photo-ac7000-camara-deportiva-16mp.webp', 'Agfa Photo AC7000 Càmera Esportiva 16MP', 119.50],
    [103,'1920-xiaomi-poco-m3-pro-5g-4-64gb-amarillo-libre.webp', 'Xiaomi POCO M3 Pro 5G 4/64GB Groc LLiure', 315.99],
    [104,'logitech.webp', 'Logitech G Saitek X52 Flight Control System Sistema de Control de Vol', 158.60],
    [105,'115-msi-raider.webp', 'MSI Raider GE77HX 12UGS-020ES Intel Core i9-12900HX/64GB/2TB SSD/RTX 3070Ti/17.3"', 3599.00]
  ];

  let tbodyString = '';
  products.forEach((element) => {
    tbodyString+='<tr>';
    tbodyString+=`<td class="${headItem[0]}">${element[0]}</td>`;
    tbodyString+=`<td class="${headItem[1]}"><img src="img/${element[1]}" alt="${element[1]}"></td>`;
    tbodyString+=`<td class="${headItem[2]}">${element[2]}</td>`;
    tbodyString+=`<td class="${headItem[3]}"><input type="number" min="0" max="10" value="1"></td>`;
    tbodyString+=`<td class="${headItem[4]}">${element[3].toFixed(2)}</td>`;
    tbodyString+=`<td class="${headItem[5]}">${element[3].toFixed(2)}</td>`;
    tbodyString+='<td class="eliminar"><button>X</button></td>';
    tbodyString+='</tr>';
  });

  const divTotal = document.createElement('div');
  const text = document.createElement('p');
  text.textContent = 'Import total:';

  const preuTotal = document.createElement('p');

  const boto = document.createElement('button');
  boto.textContent = 'Buidar Carretó';

  divTotal.appendChild(text);
  divTotal.appendChild(preuTotal);
  table.insertAdjacentHTML('beforeend', tbodyString);
  table.appendChild(divTotal);
  document.body.appendChild(boto);

  const styles = `
    table{
      border-collapse: collapse;
    }
    thead {
      background-color: cyan;
    }
    tr{
      border: 1px solid black;
    }
    td {
      padding: 20px;
    }
    img {
      max-width: 50%;
      height: auto;
    }
    .eliminar button{
      color: white;
      background-color: red;
      border: 0;
      border-radius: 50%;
      padding: 5px 8px;
      font-weight: bold;
    }
  `;
  const styleSheet = document.createElement('style');
  styleSheet.type = 'text/css';
  styleSheet.innerText = styles;
  document.head.appendChild(styleSheet);

  calcularTotal();

  document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', (e) => { // input.addEventListener('change', (e) => {
      
      let quantitat = Math.floor(parseFloat(input.value));
      input.value = quantitat;
      
      if (quantitat <= 0) {
        const fila = e.target.parentElement.parentElement;
        console.log(fila);
        fila.parentElement.removeChild(fila);
      } else if(quantitat > 10){
        quantitat = 10;
        input.value = 10;
      } else if(isNaN(quantitat)){
        quantitat = 1;
      } else {
        const preu = parseFloat(input.parentElement.nextElementSibling.textContent);
        const total = input.parentElement.nextElementSibling.nextElementSibling;
        total.textContent = (quantitat * preu).toFixed(2);
      }     
      calcularTotal();
    });
  });

  document.querySelectorAll('td.eliminar button').forEach(button => {
    button.addEventListener('click', eliminaRow);
  });

  boto.addEventListener('click', () => {
    document.body.querySelector('table').remove();
    boto.remove();
    const missatgeBuit = document.createElement('p');
    missatgeBuit.textContent = 'Carretó buit';
    document.body.appendChild(missatgeBuit);
  });

  function calcularTotal() {
    let total = 0;
    document.querySelectorAll(`td.${headItem[5]}`).forEach(td => {
      total += parseFloat(td.textContent);
    });
    preuTotal.textContent = total.toFixed(2);
  }

  function eliminaRow(event) {
    const fila = event.target.closest('tr');
    fila.remove();
    calcularTotal();
  }
  

}
