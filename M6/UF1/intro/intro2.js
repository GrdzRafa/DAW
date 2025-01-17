// 12. Escriu un script per comprovar si un paràmetre és un array o no
const LLISTA = ['🦖'];

console.log(Array.isArray(LLISTA));

// 13. Crea un script per clonar un array

const dynos = ['🦖', '🦕', '🐉'];
const copyOfDynos = [...dynos];
console.log(copyOfDynos);

const dynos2 = [['🦖'], ['🦕'], ['🐉']];
const copyOfDynos2 = JSON.parse(JSON.stringify(dynos2));
console.log(copyOfDynos2);

// 14. Crea un script per ordenar pel valor numèric els elements d'un array de manera ascendent
const numbers = [4, 2, 5, 1, 3];
numbers.sort(function (a, b) {
  return a - b;
});
console.log(numbers);

// 15. Crea una funció per desordenar un array numèric
let num = [4, 2, 5, 1, 3];
// function desordena(array){
//   array.sort(() => Math.random() - 0.5); 
// }
// desordena(num);
// console.log(num);

function desordena(array) {
  for (let i = array.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
}
desordena(num);
console.log(num);

// 16. Escriu una funció per ordenar el següent array d'objectes pel valor del libraryID
const library = [
  { author: 'Bill Gates', title: 'The Road Ahead', libraryID: 1254},
  { author: 'Steve Jobs', title: 'Walter Isaacson', libraryID: 4264},
  { author: 'Suzanne Collins', title: 'Mockingjay: The Final Book of The Hunger Games', libraryID: 3245}
];
  
library.sort(function (a, b) {
  if (a.libraryID > b.libraryID) {
    return 1;
  }
  if (a.libraryID < b.libraryID) {
    return -1;
  }
  return 0;
});
console.log(library);


// 17. Crea un script per fusionar dos arrays
const dynos3 =[...dynos, ...dynos];

console.log(dynos3);

// 18. Converteix la data actual al següent format: 
//'9/6/2022, 17:46:49' de la manera més concisa possible
console.log(new Date().toLocaleString());

// 19. Crea un script per comparar dues dates. En el cas de comparar dues dates iguals s'ha d'utilitzar
// l'operador '==='
const date1 = Date.parse(new Date('01/01/2022'));
const date2 = Date.parse(new Date('01/01/2023'));

if (date1 === date2) {
  console.log('dates iguales');
} else if (date1 > date2) {
  console.log('data 1 més gran');
} else{
  console.log('data 2 més gran');
}

// 20. Crea un script que mostri els dies que han passat des de l'inici d'any
//dia=(ms/(1000*60*60*24))
console.log(Math.round(((Date.parse(new Date()))-Date.parse(new Date('01/01/2024')))/(1000*60*60*24)));

// 22. Crea un script que retorni un array d'enters entre 1 i 10 aleatoris sense que es repeteixi cap número.
// Mostra el nombre d'iteracions que es realitzen

let funcionar = true;
let iteracions = 0;
const nums = [];
while (funcionar) {
  iteracions++;
  const randNum = Math.floor((Math.random()*10)+1);

  if (nums.length<10) {
    if (nums.indexOf(randNum) == -1) {
      
      nums.push(randNum);
    } else{
      continue;
    }
  } else {
    funcionar = false;
  }

}
console.log(nums);
console.log('Iteracions: ' + iteracions);

