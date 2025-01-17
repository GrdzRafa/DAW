const imageList = [
    'hp-105716.jpg',
    'lenovo-10.jpg',
    'macbook-1111.jpg',
    'msi-1290130.jpg',
    'asus-1319740.jpg',
    'msi-1343430.jpg',
    'asus-1348350.jpg',
    'asus-1348530.jpg',
    'msi-1369500.jpg',
    'hp-1373110.jpg',
    'hp-1373200.jpg',
    'acer-1378900.jpg',
    'acer-1381680.jpg',
    'lenovo-1387310.jpg',
    'msi-1393140.jpg',
    'toshiba-1417610.jpg',
    'msi-11.jpg',
    'lenovo-1.jpg',
    'hp-21.jpg',
    'lenovo-4.jpg',
    'lenovo-7.jpg',
    'msi-811.jpg',
    'msi-919.jpg',
    'msi-1011.jpg',
    'hp-911487.jpg'
];

//1. L'array inicial s'ha de tranformar a un array d'objectes. (1.5)
const obj = [];
imageList.forEach(element => {
    const paraulaSeparada = element.split('-');
    paraulaSeparada[1] = paraulaSeparada[1].substring(0, paraulaSeparada[1].indexOf('.'));
    obj.push({ nom: paraulaSeparada[0], codi: paraulaSeparada[1] });
});

//productes ordenats descendentment pel codi
obj.sort(function (a, b) {
    if (parseInt(b.codi) > parseInt(a.codi)) {
        return 1;
    }
    if (parseInt(b.codi) < parseInt(a.codi)) {
        return -1;
    }
    return 0;
});

//Quan carrega la pàgina es mostra en el document mitjançant 
//una llista el nom i el codi. Es crea amb template string. 
let productes = `<ul>`;
obj.forEach(producte => {
    productes += `<li>Nom: ${producte.nom} - Codi: ${producte.codi}</li>`;
});
productes += `</ul>`;

document.body.insertAdjacentHTML('beforeend', productes);

//2. Crear un botó Save Data amb createElement() 
//per emmagatzemar a localStorage: (2,5 punts)

const boto = document.createElement("button");
boto.textContent = "Save Data";
document.body.appendChild(boto);

boto.addEventListener('click', function () {
    const subProductes = [];
    const nums = [];

    for (let i = 0; i < 6; i++) {
        const random = Math.floor(Math.random() * (obj.length - 1));
        //console.log(random);
        if (!(nums.includes(random))) {
            nums.push(random);
            subProductes.push(obj[i]);
        } else {
            i--;
        }
    }
    subProductes.push(new Date().toLocaleString());
    localStorage.setItem("Imatges", JSON.stringify(subProductes));
    const element = document.querySelector("ul");
    element.remove();
});
localStorage.clear();

//3. Mitjançant un altre botó Mostrar creat amb createElement()
//es recuperen les dades:

const boto2 = document.createElement("button");
boto2.textContent = "Mostrar";
document.body.appendChild(boto2);
boto2.addEventListener('click', function () {
    const p = document.createElement("p");
    p.textContent = new Date().toLocaleString();
    document.body.appendChild(p);

    const subProductes = [];
    const nums = [];

    for (let i = 0; i < 6; i++) {
        const random = Math.floor(Math.random() * (obj.length - 1));
        //console.log(random);
        if (!(nums.includes(random))) {
            nums.push(random);
            subProductes.push(obj[i]);
        } else {
            i--;
        }
    }

    subProductes.forEach(element => {
        const div = document.createElement("div");
        div.textContent = element.nom+"-"+element.codi;
        const img = document.createElement("img");
        img.setAttribute("src", "imatges/"+element.nom+"-"+element.codi+".jpg");
        img.setAttribute("height", "100px");
        img.setAttribute("width", "100px");
        div.appendChild(img);
        document.body.appendChild(div);
    });
});


