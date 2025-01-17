import DomElement from "./domElement.js";
class ElementWithText extends DomElement{
    #text;
    constructor(tag, attributes, text){
        super(tag, attributes)
        this.#text = text;
    }

    createElement(){
        super.createElement()
        super.getElement.textContent = this.#text;
        return this;
    }
}

export default ElementWithText;