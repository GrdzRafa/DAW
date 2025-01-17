/*1. Funcions de Callback Crea una funció que rebi com a paràmetres un array d'enters i dues funcions
Callback.
    La primera retornarà la mitjana dels valors de l'array passat com a paràmetre.
    La segona retornarà la diferència entre el valor màxim i mínim dels valors de l'array passats
    com a paràmetre.
    La funció principal retornarà la potència del primer valor retornat per la primera funció elevat
    al valor retornat per la segona
 */
const obj = [1, 2, 3, 4, 5]; // m = 3;

function f1(arr, f2, f3) {
    return Math.pow(f2(arr), f3(arr));
}
function f2(...args) {
    let mitjana = 0;
    args[0].forEach(element => {
        mitjana += element;
    });
    return mitjana / args[0].length;
}
function f3(...args) {
    let min = Infinity;
    let max = -Infinity;

    args[0].forEach(element => {
        if (element < min) {
            min = element;
        } else if (element > max) {
            max = element;
        }
    });

    return max - min;
}
//console.log(f2(obj));
//console.log(f3(obj));
console.log(f1(obj, f2, f3));


/*2. Crea una funció que es pugui executar en diferents objectes mitjançant Apply() o Call(). Aquesta
funció calcularà:
    La mitjana de les puntuacions obtingudes a partir dels valors de l’array scores de l’objecte, i la
    desarà en una variable avgScores.
    Si la mitjana és igual o superior a 50 una variable overcame es posarà a true, en cas contrari a
    false
    Executa una funció mitjançant call(). L’objecte que es passarà com a paràmetre té el següent
format:

i se li han d’afegir dues propietats avgScores i overcame calculades per la funció
*/
const student = {
    name : "Antoni",
    surname : "Batllori",
    scores : [40,25,37,65,72,55]
};

const student1 = {
    name : "Antonis",
    surname : "Batlloris",
    scores : [40,25,37,65,72,70]
};

function f5(){
    let mitjana = 0;
    this.scores.forEach(element => {
        mitjana+=element;
    });

    this.avgScores = Math.floor(mitjana/this.scores.length);
    if (this.avgScores >= 50) {
        this.overcame = true;
    } else{this.overcame=false}
}

f5.call(student);
console.log(student);
f5.apply(student1);
console.log(student1);

/*3. Aplica la funció del punt anterior a un array d'objects*/
const students = [
    {name : "Antoni", surname : "Batllori", scores : [40,75,22,78]},
    {name : "Pere", surname : "Rodríguez", scores : [10,28,85,35]},
    {name : "Josepa", surname : "Rovira", scores : [62,71,23,44]},
    {name : "Joan", surname : "Revert", scores : [14,65,18,88]},
    {name : "Maria", surname : "Palau", scores : [52,45,24,55]}
];

students.forEach(element => {
    f5.call(element);
});
console.log(students);


/*TEORIA (OMITIR) 
//function f5(a){return a+1;}
//const obj1 = {};
//function f5(){console.log(...args);}
//f5.call(obj1, [1, 2, 3, 4, 5]); //el this será obj. Con call se ejecutará en el objeto establecido (obj1)
//f5.apply(obj1, 1, 2, 3, 4, 5); //hace lo mismo que call
//la diferencia entre uno y otro es que con call tienes que pasar 2 parametros directamente y en apply los que quieras
//this.avgScores en un objecto creará el valor si no existe*/


/*4. Altres característiques de les funcions*/
//const f1 = function(){};

//const result = (function(){const name = "a";})();