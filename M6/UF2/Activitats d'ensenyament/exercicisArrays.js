const usuaris = [
    {
        nom: "Joan", edat: 45, professio: "mecànic", sou: 1750, idioma:
            ["espanyol"]
    },
    {
        nom: "Pere", edat: 57, professio: "administratiu", sou: 1860,
        idioma: ["espanyol", "catala", "francès"]
    },
    {
        nom: "Laia", edat: 24, professio: "imformatica", sou: 1500, idioma
            : ["espanyol", "catala", "anglès", "francès"]
    },
    {
        nom: "Joana", edat: 88, professio: "jubilada", sou: 480, idioma:
            ["catala"]
    },
    {
        nom: "Mark", edat: 71, professio: "jubilat", sou: 650, idioma:
            ["anglès"]
    },
    {
        nom: "Josep", edat: 21, professio: "estudiant", sou: 0, idioma:
            ["espanyol", "catala", "anglès"]
    },
    {
        nom: "Maria", edat: 19, professio: "estudiant", sou: 0, idioma:
            ["espanyol", "catala", "anglès", "francès"]
    },
    {
        nom: "Eva", edat: 24, professio: "periodista", sou: 2750, idioma:
            ["espanyol", "catala", "italià", "francès"]
    },
    {
        nom: "Mireia", edat: 36, professio: "perruquera", sou: 1240,
        idioma: ["espanyol", "catala"]
    },
    {
        nom: "Esteve", edat: 54, professio: "dentista", sou: 4507, idioma
            : ["espanyol", "francès"]
    },
    {
        nom: "Joaquim", edat: 62, professio: "jubilat", sou: 1100, idioma
            : ["espanyol", "catala"]
    },
    {
        nom: "Ernest", edat: 14, professio: "estudiant", sou: 0, idioma:
            ["catala", "anglès"]
    },
    {
        nom: "Eric", edat: 28, professio: "disenyador", sou: 850, idioma:
            ["espanyol", "catala", "anglès", "alemany"]
    },
    {
        nom: "Maiol", edat: 20, professio: "estudiant", sou: 0, idioma:
            ["espanyol", "catala"]
    },
    {
        nom: "Carles", edat: 18, professio: "estudiant", sou: 0, idioma:
            ["espanyol"]
    },
    {
        nom: "Antoni", edat: 32, professio: "metge", sou: 7800, idioma:
            ["espanyol", "catala", "anglès"]
    },
];

//1. Mostra el nom i la professió de cada usuari. Utilitza forEach().

//usuaris.forEach((usuari) => console.log("Nom: " + usuari.nom + "\nProfessió: " + usuari.professio));


//2. Crea un nou amb el sou augmentat en un 2% si el sou és menor de 1000 
//i en un 1.7% si és igual o 7 més gran. Utilitza map().
const usuaris2 = JSON.parse(JSON.stringify(usuaris));
usuaris2.map(function (usuari) {
    if (usuari.sou < 1000) {
        usuari.sou += usuari.sou * 0.02;
    } else {
        usuari.sou += usuari.sou * 0.017;
    }
});


//3. A partir de l’array anterior retorna els items amb un sou entre 500 i 1500
//ambdós inclosos. Utilitza filter().
const sou = usuaris2.filter((usuari) => usuari.sou >= 500 && usuari.sou <= 1500);


//4. Utilitzant every() i some():

    //1. Mostra un missatge que indiqui si tots els usuaris 
    //són majors d’edat o no ho són. (every)
/*const esMajorEdat = (usuaris) => usuaris.edat >= 18;
if (usuaris2.every(esMajorEdat)) {
    console.log("Tothom es major d'edat.");
} else {
    console.log("No tothom es major d'edat.");
}*/
    //2. Mostra un missatge que indiqui si hi han 
    //usuaris que tenen 65 anys o més. (some)

/*const esJubilat = (usuaris) => usuaris.edat >= 65;
if (usuaris2.some(esJubilat)) {
    console.log("Hi han usuaris majors de 65.");
} else {
    console.log("No hi han usuaris majors de 65.");
}*/

//5. Retorna el valor de la suma total del sou de tots els usuaris. Utilitza reduce().
const souTotal = 0;
souTotal+=usuaris.reduce((acc, usuari) => acc + usuari.sou, 0);
//console.log("Suma sou total: " + souTotal);


//6. Mitjançant splice() a l’array usuaris:
    //1. Insereix dos elements nous a partir de la posició 7.
    usuaris.splice(7, 0, 
        {
            nom: "Pepito", edat: 29, professio: "dissenyador", sou: 1900, idioma: ["espanyol", "anglès"]
        },
        {
            nom: "Juanjo", edat: 40, professio: "metge", sou: 3000, idioma: ["català", "francès"]
        }
    );
    //console.log(usuaris);
    
    //2. Extreu els elements de les posicions 3 a 5 (ambdós inclosos) eliminant-los de l’array original i
    //desant-los en un de nou.
    const eliminats = usuaris.splice(3, 3);
    console.log(eliminats);