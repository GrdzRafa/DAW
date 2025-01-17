const nums = [new  Array(3), new  Array(3), new  Array(3)];

/*  EXERCICI 1 */
console.log('********** EX 1');

for (let i = 0; i < nums.length; i++) {
  for (let j = 0; j < nums[i].length; j++) {

    //generar numero random entre 1-29
    let random = Math.floor(Math.random()*29)+1;

    //some comprueba si al menos un elemento de un array cumple x condición
    //entonces estoy haciendo que si un array de segunda dimension 
    //contiene el número random, ejecute el código en consecuencia.
    if (!nums.some(numero => numero.includes(random))) {
      nums[i][j] = random;
    } else{j--;}
  }  
}
console.log(nums);

/*  EXERCICI 2 */
console.log('********** EX 2');
const nums2 = [new  Array(3), new  Array(3), new  Array(3)];
for (let i = 0; i < nums2.length; i++) {
  for (let j = 0; j < nums2[i].length; j++) {

    let random = Math.floor(Math.random()*29)+1;

    if (!nums2.some(numero => numero.includes(random))) {
      //compruebo la columna y el valor del número random
      if (j == 0 && random < 10) {
        nums2[i][j] = random;
      } else if (j == 1 && random >= 10 && random < 20){
        nums2[i][j] = random;
      } else if(j == 2 && random >= 20){
        nums2[i][j] = random;
      } else{j--;}
    } else{j--;}

  }  
}

console.log(nums2);

/* EXERCICI 3 */
console.log('********** EX 3');

//copia del array anterior
const nums3 = JSON.parse(JSON.stringify(nums2));

for (let i = 0; i < nums.length; i++) {
  const ordena = new Array(3);
  for (let j = 0; j < nums[i].length; j++) {
    ordena[j] = nums3[j][i];
  }
  
  //si la columna es par, ordena ascendente. 
  //Sino, descendente
  if (i%2 == 0) {ordena.sort((a,b) => a-b);} 
  else{ordena.sort((a,b) => b-a);}

  //re ordena la columna según el orden escogido
  for (let k = 0; k < ordena.length; k++) 
  {nums3[k][i] = ordena[k];}
}


console.log(nums3);
