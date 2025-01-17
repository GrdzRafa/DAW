/*APUNTS (OMITIR) */
//función constructora en mayúsucla

function Persona (nom, cognom, edat){
    this.nom = nom;
    this.cognom = cognom;
    this.edat = edat;
}

//para que funcione la herencia, hay que hacer el método fuera de la clase
//lo creamos en prototype
Persona.prototype.saludar = function(){
    console.log(this.nom+this.cognom);
}

Persona.prototype.nacionalitat = "Espanol";


function Estudiant (nom, cognom, edat, cicle){
    Persona.call(this, nom, cognom, edat)
    this.cicle = cicle;
    this.nacionalitat = "Moro";
}

Estudiant.prototype.constructor = Estudiant;

class DuesRodes{
    #numRodes;
    #tipusCarnet; //atributo privado
    constructor(numRodes, tipusCarnet) {
        this.#numRodes = numRodes;
        this.#tipusCarnet = tipusCarnet;
    }

    get rodes(){
        return this.#numRodes;
    }

    set rodes (numRodes){
        this.#numRodes = numRodes;
    }
}



/*EXERCICIS*/

/*1. Crea una funció constructora Llibres() 
amb els següents paràmetres.*/
function Llibre(titol, pagines, tematica, nomAutor, cognomAutor, valoracio){
    this.titol = titol;
    this.pagines = pagines;
    this.tematica = tematica;
    this.nomAutor = nomAutor;
    this.cognomAutor = cognomAutor;
    //this.valoracio = valoracio;
}
/*Afegeix al prototype: un mètode info() que mostri 
la informació del llibre emmagatzemada en els paràmetres*/

Llibre.prototype.info = function(){
    console.log(
        `\tTitol: ${this.titol}
        Pàgines: ${this.pagines}
        Temàtica: ${this.tematica}
        Nom de l'autor: ${this.nomAutor} ${this.cognomAutor}`
    );
}

const quijote = new Llibre("El Quijote de la mancha", 650, "Novel·la", "Miguel", "de Cervantes");
quijote.info();
//Llibre.prototype.valoracio = 10;
Llibre.prototype.valoracio;
Llibre.prototype.rating = function(){
    console.log(`Valoració de ${this.titol}: ${this.valoracio} punts.`);
}
//quijote.valoracio = 10;
//quijote.rating();

// Crear otros dos objetos con diferentes datos
const hobbit = new Llibre("The Hobbit", 310, "Fantasy", "J.R.R.", "Tolkien", 8);
//hobbit.valoracio = 9;
const sapiens = new Llibre("Sapiens: A Brief History of Humankind", 443, "Non-Fiction", "Yuval Noah", "Harari", 4);
//sapiens.valoracio = 5;
// Mostrar los objetos en la consola
 
hobbit.rating();
sapiens.rating();
//L'objecte creat té més pes que el prototype.

/*
2. Crea una funció que recorri la instància creada ue mitjançant hasOwnProperty() o
propertyIsEnumerable(): Mostri les “own properties” d’una de les instàncies creades en el punt 2.
Mostri les prototype properties d’una de les instàncies creades en el punt 2. Explica que ocorre amb la
propietat valoracio que es troba en les dues parts.
*/
Llibre.prototype.mostrarProp = function(){
    const props = Object.getOwnPropertyNames(this);
    console.log(props);

    const protoProps = Object.prototype.hasOwnProperty.call(hobbit, "valoracio");
    console.log(protoProps);
}

hobbit.mostrarProp();

/*3 */

function Vehicle (marca, model, matricula, color, combustible){
    this.marca = marca;
    this.model = model;
    this.matricula = matricula;
    this.color = color;
    this.combustible = combustible;
    this.disponibilitat = false;
}

Vehicle.prototype.mostrarCaracteristiques = function () {
    console.log("Característiques del vehicle:");
    for (let propietat in this) {
        if (this.hasOwnProperty(propietat)) {
            console.log(`${propietat}: ${this[propietat]}`);
        }
    }
}

Vehicle.prototype.teDisponibilitat = function () {
    if (this.disponibilitat) {
        console.log("Té disponibilitat.");    
    } else{console.log("No té disponibilitat.");}
}

const vehicle1 = new Vehicle("Toyota", "Corolla", "1234-XYZ", "Blanc", "Gasolina");

function QuatreRodes(marca, model, matricula, color, combustible, numRodes, tipusCarnet){
    Vehicle.call(this, marca, model, matricula, color, combustible);
    this.numRodes = numRodes;
    this.tipusCarnet = tipusCarnet;

}
QuatreRodes.prototype = Object.create(Vehicle.prototype);
QuatreRodes.prototype.constructor = QuatreRodes;

const vehicle2 = new QuatreRodes("Seat", "Ibiza", "5678-ABC", "Negre", "Diesel", 4, "B");
function Cotxe(marca, model, matricula, color, combustible, numRodes, tipusCarnet, nPlaces){
    QuatreRodes.call(this, marca, model, matricula, color, combustible, numRodes, tipusCarnet);
    this.tipusVehicle = "cotxe";
    this.nPlaces = nPlaces;
}

Cotxe.prototype = Object.create(QuatreRodes.prototype);
Cotxe.prototype.constructor = Cotxe;
const vehicle3 = new Cotxe("Toyota", "Corolla", "1234-XYZ", "Blau", "Híbrid", 4, "B", 5);

class Furgoneta extends QuatreRodes{
    constructor(marca, model, matricula, color, combustible, numRodes, tipusCarnet, nPlaces, pesCarrega){
        super(marca, model, matricula, color, combustible);
        this.numRodes = numRodes;
        this.tipusCarnet = tipusCarnet;
        this.tipusVehicle = "furgoneta";
        this.nPlaces = nPlaces;
        this.pesCarrega = pesCarrega;
    }
}

const furgoneta = new Furgoneta("Mercedes", "Sprinter", "1234ABC", "Blanco", "Diesel", 4, "B", 3, 2000);

class DuesRodes extends Vehicle {
    constructor(marca, model, matricula, color, combustible, numRodes, tipusCarnet) {
        super(marca, model, matricula, color, combustible);
        this.numRodes = numRodes;
        this.tipusCarnet = tipusCarnet;
    }
}

class Moto extends DuesRodes {
    constructor(marca, model, matricula, color, combustible, numRodes, tipusCarnet) {
        super(marca, model, matricula, color, combustible, numRodes, tipusCarnet);
        this.tipusVehicle = "Moto";
    }
}

class Bicicleta extends DuesRodes {
    constructor(marca, model, matricula, color, combustible, numRodes, tipusCarnet, esElectrica) {
        super(marca, model, matricula, color, combustible, numRodes, tipusCarnet);
        this.tipusVehicle = "Bicicleta";
        this.esElectrica = esElectrica;
    }
}

const moto = new Moto("Honda", "CBR", "5678DEF", "Negro", "Gasolina", 2, "A");
const bicicleta = new Bicicleta("Trek", "FX3", "N/A", "Azul", "Ninguno", 2, "No requerido", true);




