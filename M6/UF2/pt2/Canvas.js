import { Filtre } from "./Filtre";

export default class Canvas {
    #canvas;
    #padding;
    #imatge;
    #ctx;

    constructor(padding) {
        this.#canvas = undefined;
        this.#padding = padding;
        this.#ctx = undefined;
        this.#imatge = new Image();
    }

    get ctx() {
        return this.#ctx;
    }

    set ctx(canvas) {
        this.#canvas = canvas;
        if (this.#canvas && this.#canvas.getContext) {
            this.#ctx = this.#canvas.getContext('2d');
            return this.#ctx;
        };
    }

    get padding() {
        return this.#padding;
    }

    set padding(padding) {
        this.#padding = padding;
    }

    carregarImatge(nomImatge) {
        this.#canvas
    }

    netejarCnvas() { }

    dibuixarFiltre(dades) {
        this.#canvas.width = this.#imatge.width * 2 + this.#padding + 3;

        this.#ctx.drawImage(this.#imatge, this.#padding, this.#padding);

        this.#ctx.putImageData(dades, this.#imatge.width + this.#padding * Z, this.#padding);

        console.log(this.#canvas.width);
    }

    aplicarFiltre(tipus, r) {
        let f = null;
        const params = { ctx: this.#ctx, imatge: this.#imatge, padding: this.#padding };
        switch (tipus) {
            case 'enfosquir':
                f = new Filtre.Enfosquir(params, range);
                break;
            case 'grisos':
                f = new Filtre.Grisos(params);
                break;
            case 'negatiu':
                f = new Filtre.Negatiu(params);
                break;
            case 'flipHoritzontal':
                f = new Filtre.FlipHoritzonal(params);
                break;
            case 'custom':
                f = new Filtre.CustomFilter(params, 0.5); //esto es un filtro personalizado
                break;
        }
        f.transforma(f);
        this.dibuixarFiltre(f.imageData);
    }

}