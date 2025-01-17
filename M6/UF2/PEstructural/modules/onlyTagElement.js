import DomElement from "./domElement.js";
class OnlyTagElement extends DomElement{

    constructor(tag, attributes){
        super(tag, attributes);
    }

    createElement(){
        super.createElement()
        return this;
    }
}


export default OnlyTagElement;