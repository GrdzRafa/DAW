import DomElement from "./domElement.js";

class SelectElement extends DomElement{
    #options;

    constructor(attr, options){
        super('select', attr)
        this.#options = options;
    }

    #createOptions(options){
        options.forEach(option => {
            //const opt = new ElementWithText('options', option, option);
            const opt = document.createElement('option');
            opt.textContent = option;
            // opt.createElement();
            // console.log(opt);
            this.getElement.appendChild(opt);
            //this.insertAdjacentElement(opt);

        });
    };

    createElement(){
        super.createElement();
        this.#createOptions(this.#options);
        return this;
    }

    

}

export default SelectElement;