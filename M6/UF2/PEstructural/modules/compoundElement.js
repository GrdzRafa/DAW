import DomElement from "./domElement.js";

class CompoundElement extends DomElement{
    constructor(tag, attributes){
        super(tag, attributes)
    }

    addChildren(arrayChild) {
        arrayChild.forEach(element => {
            this.getElement.insertAdjacentElement('beforeend', element.getElement);
        });

        return this;
    }
}

export default CompoundElement;