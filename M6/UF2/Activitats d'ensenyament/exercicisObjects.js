const producte = {
    S124234G: {
        Descripcio: "Samarreta",
        preu: 45,
        colors: ["blau", "negre", "blanc"],
        stock: {
            "M": { "blau": 5, "negre": 10, "blanc": 7 },
            "L": { "blau": 2, "negre": 5, "blanc": 1 },
            "XL": { "blau": 4, "negre": 7, "blanc": 0 }
        }
    },
    P785745Y: {
        Descripcio: "Pantaló",
        preu: 84,
        colors: ["blau", "negre"],
        stock: {
            "M": { "blau": 5, "negre": 10 },
            "L": { "blau": 2, "negre": 5 },
            "XL": { "blau": 4, "negre": 7 }
        }
    },
    A234578W: {
        Descripcio: "Abric",
        preu: 129,
        colors: ["blau", "verd"],
        stock: {
            "M": { "blau": 1, "verd": 0 },
            "L": { "blau": 7, "verd": 15 },
            "XL": { "blau": 4, "verd": 3 }
        }
    }
};

// 1. A partir del següent Object realitza els exercicis:

// Recupera la informació següent:
// 1. En quants colors està disponible l’article S124234G.
const quantcol = producte.S124234G.colors.length;
console.log("Colors disponibles de l’article S124234G: "+quantcol);

// 2. El nombre de samarretes de color blanc de la talla M de l'article S124234G.
const colorBlanc = producte.S124234G.stock.M.blanc;
console.log("Samarretes de color blanc de la talla M de l'article S124234G: "+ colorBlanc);

// 3. La suma de les unitats de la talla L de color blau dels tres articles.
let total = 0;
for (const prod in producte) {
    total+=producte[prod].stock.L.blau;
}
console.log("Unitats de talla L de color blau dels tres articles: " + total);

// 4. La suma de les unitats de totes les talles de color blau dels tres articles.
total= 0;
for (const prod in producte) {
    console.log(producte[prod]);
   // producte[prod].stock.
}

console.log(total);
