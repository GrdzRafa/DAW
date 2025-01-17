class DomElement{
    #tag;
    #attributes;
    #element;
    constructor(tag, attributes){
        this.#tag = tag;
        this.#attributes = attributes;
    }

    get getTag(){
        return this.#tag;
    }

    get getAttributes(){
        return this.#attributes;
    }

    get getElement(){
        return this.#element;
    }

    createElement() {
        let elem = document.createElement(this.#tag);
        for (const key in this.#attributes) {
            elem.setAttribute(key, this.#attributes[key]);
        }
        this.#element=elem;
        return this;
    }

    printElement(pos){
        pos?.parentId ?
        document.getElementById(pos.parentId).insertAdjacentElement(pos.position, this.#element) :
        document.body.insertAdjacentElement(pos.position, this.#element);
        return this;
    }

    deleteElement(){
        this.#element.remove();
        return this;
    }

    addListener(eventList){
        this.getElement.addEventListener(eventList.event, eventList.actionFn); 
        return this;
    }

    removeListener(eventList){
        this.getElement.removeEventListener(eventList.event, eventList.actionFn); 
        return this;
    };
}

export default DomElement;