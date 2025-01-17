
export class Filtre {
    constructor({ ctx, imatge, padding }) {
        this.w = imatge.width;
        this.h = imatge.height;
        this.padding = padding;
        this.ctx = ctx;
        this.imageData = this.ctx.getImageData(this.padding, this.padding, this.w, this.h);
    }

    transforma() { }
}

export class Enfosquir extends Filtre {
    #range
    constructor({ ctx, imatge, padding }, range) {
        super((ctx, imatge, padding));
        this.#range = range;
    }

    transforma() {
        for (let i = 0; i < this.imageData.data.length; i += 4) {
            this.imageData.data[i] = this.imageData.data[i] + this.#range;
            this.imageData.data[i + 1] = this.imageData.data[i + 1] + this.#range;
            this.imageData.data[i + 2] = this.imageData.data[i + 2] + this.#range;
        }
    }
}

export class Grisos extends Filtre {
    constructor({ ctx, imatge, padding }) {
        super((ctx, imatge, padding));
    }

    transforma() {
        for (let i = 0; i < this.imageData.data.length; i += 4) {
            this.gris = (this.imageData.data[i] + this.imageData.data[i + 1] + this.imageData.data[i + 2]) / 3;
            this.imageData.data[i] = this.gris; // vermell
            this.imageData.data[i + 1] = this.gris; // verd
            this.imageData.data[i + 2] = this.gris; // blau
        }

    }
}

export class Negatiu extends Filtre {
    constructor({ ctx, imatge, padding }) {
        super((ctx, imatge, padding));
    }

    transforma() {
        for (let i = 0; i < this.imageData.data.length; i += 4) {
            this.imageData.data[i] = 255 - this.imageData.data[i];
            this.imageData.data[i + 1] = 255 - this.imageData.data[i + 1];
            this.imageData.data[i + 2] = 255 - this.imageData.data[i + 2];
        }
    }
}

export class FlipHoritzontal extends Filtre {
    constructor({ ctx, imatge, padding }) {
        super((ctx, imatge, padding));
    }

    transforma() {

    }
    //uint8clampedarray???
}

export class CustomFilter extends Filtre {
    constructor({ctx, imatge, padding}, factor) {
      
    }
   
    transforma() {
      
    }
 
  }

