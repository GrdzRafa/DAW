
/* EXERCICI 1 */
const num = 55.387348;

if (typeof num === 'number') {
  console.log(num.toFixed(2)); 
} else {
  console.log(typeof(num));
}

/* EXERCICI 2 */

const title = ['La casa de paper', 'La catedral del mar', 'Panegre', 'Polseres vermelles'];
const newTit = title.map( element => element.replaceAll(' ', '-').toLowerCase());


//title.forEach(element => {console.log(element.replaceAll(' ', '-'));});
console.log(newTit);

/* EXERCICI 3 */

/* EXERCICI 4 */

/* EXERCICI 5 */

const arrSuma = [3, false, 7, 'Maria', 9];
var nume = 0;
arrSuma.forEach(element => {

  if (typeof element === 'number') {
    nume = nume+element;
  }
});

console.log(nume);

/* EXERCICI 6 */
const emptyString = '';
//una cadena vacía es igual a false, una NO vacía es igual a true
//haces una comparación si la primera es false, comprueba lo siguiente
emptyString || console.log('cadena buida');

//el ?? sirve para comprobar si una variable es null o undefined. Si es, devuelve lo otro. Sino, devuelve el valor.
const nullString = null ?? 'null string';
console.log(nullString);

const undefString = undefined ?? 'undefined string';
console.log(undefString);

/* EXERCICI 7 */
const str2 = 'Desenvolupament web en entorn client';
const arrStr2 = str2.split(' ');
console.log(arrStr2);

/* EXERCICI 8 */
const str3 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua';

console.log(str3.match(/do/g).length);

/* EXERCICI 9 */
//usamos al constante str3 del ejercicio anterior

console.log();


/* EXERCICI 10 */