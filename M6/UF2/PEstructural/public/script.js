//import * as Elem from '../main.js';
import OnlyTagElement from "../modules/onlyTagElement.js";
import ElementWithText from "../modules/elementWithText.js";
import SelectElement from "../modules/selectElement.js";
import CompoundElement from "../modules/compoundElement.js";

/*ONLYTAG */
// const ele1 = new OnlyTagElement("button", { id: "parentCont" });

// ele1.createElement().printElement({position: 'beforeend'});
// console.log(ele1)
// ele1.deleteElement();

// const obj = {
//     actionFn: function(){
//         this.textContent = "hello";
//     },
//     event: "click"
// };
// ele1.addListener(obj);
// ele1.removeListener(obj);

/*SELECT */
// const sele =
//     new SelectElement({ name: "pets", id: "pets-select" }, 
//     ["dog", "cat", "hamster", "parrot"]);
// sele.createElement().printElement({ position: 'beforeend' });

/*COMPOUND */
// const ele2 = new CompoundElement("div", {id: "divCont"});
// ele2.createElement().printElement({position: 'beforeend'});
// ele2.addChildren(ele1)
// console.log(ele2.getElement);

/*WITHTEXT */
// const ele3 = new ElementWithText("h1", {id: "hola", class: "adeu"}, "Aixó es un títol.");
// ele3.createElement().printElement({parentId: "divCont", position: 'beforeend'});

/* CREACIÓ FORMULARI */
const divCont = new CompoundElement('div', { id: 'formCont' })
divCont.createElement().printElement({ position: 'beforeend' })



const form = new CompoundElement('form', { id: 'form' })
form.createElement()

const imgTit = new ElementWithText('label', {}, "Image:")
const imgRead = new OnlyTagElement("input", { type: "file", id: 'imgCont' })

const charTit = new ElementWithText('label', {}, "Character:")
const charText = new OnlyTagElement("input", { type: "text" })

const descTit = new ElementWithText('label', {}, "Description:")
const descText = new OnlyTagElement("textarea", {})

const origTit = new ElementWithText('label', {}, "Origin:")
const origText = new OnlyTagElement("input", { type: "text" })

const kindTit = new ElementWithText('label', {}, "Kind:")
const kindOpts = new SelectElement({}, ["God", "Demigod", "Titan"])

const homeTit = new ElementWithText('label', {}, "Home:")
const homeText = new OnlyTagElement("input", { type: "text" })

const stateTit = new ElementWithText('label', {}, "State:")
const stateOpts = new SelectElement({}, ["Alive", "Dead", "Unknown"])

//contenidor pels botons
const btnDiv = new CompoundElement('div', { id: 'btnCont' })
btnDiv.createElement()

//els creem aquí perque no aniràn a l'array d'elements
const saveBtn = new ElementWithText('button', {}, "Save")
saveBtn.createElement()
const rstBtn = new ElementWithText('button', {}, "Reset")
rstBtn.createElement()


const formElements = [
    imgTit, imgRead, charTit, charText,
    descTit, descText, origTit, origText,
    kindTit, kindOpts, homeTit, homeText,
    stateTit, stateOpts, btnDiv
]

formElements.forEach(element => {
    element.createElement()
})

const myListener = {
    actionFn: () => {
        document.querySelector('#imgCont').src = document.querySelector('#img-result').src
        document.querySelector('#char-name').textContent = charText.element.value
        document.querySelector('#char-desc').textContent = descText.element.value
        document.querySelector('#char-origin').textContent = `Origin: ${origText.element.value}`
        document.querySelector('#char-kind').textContent = `Kind: ${kindOpts.element.value}`
        document.querySelector('#char-home').textContent = `Home: ${homeText.element.value}`
        document.querySelector('#char-state').textContent = `State: ${stateOpts.element.value}`
    },
    event: 'change'
}

formElements.forEach(element => {
    if (element.getTag === 'input' || element.getTag === 'textarea') {
        element.addListener(myListener)
    }
})

//afegir botons a la div
btnDiv.addChildren([saveBtn, rstBtn])

/*Objecte per l'addListener del input type file (imgRead)*/
const imgReadChangeListener = {
    actionFn: () => {
        const file = document.querySelector('#imgCont').files[0];
        const reader = new FileReader()

        reader.readAsDataURL(file)

        reader.onload = function () {
            const img = document.querySelector('#img-result')
            img.src = reader.result
            //Ajustar la div al width de l'imatge
            img.onload = function () {
                const imgWidth = img.naturalWidth
                const divContForm = document.querySelector('#cardCont')
                divContForm.style.maxWidth = `${imgWidth}px`
            }
        }

        reader.onerror = function () {
            console.log(reader.error)
        }
    },
    event: 'change'
}

imgRead.addListener(imgReadChangeListener)

form.addChildren(formElements)
divCont.addChildren([form])
divCont.printElement({ position: 'beforeend' })

const divCard = new CompoundElement('div', { id: 'cardCont' })
divCard.createElement().printElement({ position: 'beforeend' })

const imgField = new OnlyTagElement('img', { id: 'img-result', alt: 'Character image' })
const nameInpt = new ElementWithText('h2', { id: 'charName' }, '')
const descInpt = new ElementWithText('p', { id: 'charDesc' }, '')
const originInpt = new ElementWithText('p', { id: 'charOrigin' }, '')
const kindOptions = new ElementWithText('p', { id: 'charKind' }, '')
const homeInpt = new ElementWithText('p', { id: 'charHome' }, '')
const stateOptions = new ElementWithText('p', { id: 'charState' }, '')

const divContElements = [imgField, nameInpt, descInpt, originInpt, kindOptions, homeInpt, stateOptions]
divContElements.forEach(element => {
    element.createElement()
})


// Crear una div contenedora para cada título y elemento
const nameDiv = new CompoundElement('div')
nameDiv.createElement()
nameDiv.addChildren([new ElementWithText('h3', {}, 'Character Name').createElement(), nameInpt])

const descDiv = new CompoundElement('div')
descDiv.createElement()
descDiv.addChildren([new ElementWithText('h3', {}, 'Description').createElement(), descInpt])

const originDiv = new CompoundElement('div')
originDiv.createElement()
originDiv.addChildren([new ElementWithText('h3', {}, 'Origin').createElement(), originInpt])

const kindDiv = new CompoundElement('div')
kindDiv.createElement()
kindDiv.addChildren([new ElementWithText('h3', {}, 'Kind').createElement(), kindOptions])

const homeDiv = new CompoundElement('div')
homeDiv.createElement();
homeDiv.addChildren([new ElementWithText('h3', {}, 'Home').createElement(), homeInpt])

const stateDiv = new CompoundElement('div')
stateDiv.createElement()
stateDiv.addChildren([new ElementWithText('h3', {}, 'State').createElement(), stateOptions])

// Crear div para la imagen
const imgDiv = new CompoundElement('div')
imgDiv.createElement()
imgDiv.addChildren([new ElementWithText('h3', {}, 'Character Image').createElement(), imgField])

divCard.addChildren([imgDiv, nameDiv, descDiv, originDiv, kindDiv, homeDiv, stateDiv])

const divArray = [imgDiv, nameDiv, descDiv, originDiv, kindDiv, homeDiv, stateDiv]
divCard.addChildren(divArray)

divCard.printElement({ position: 'beforeend' })



// saveBtn.addListener(myListener)


