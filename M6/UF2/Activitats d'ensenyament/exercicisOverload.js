const obj = {
    nom: "Huawei P40 Lite",
    categoria: "Smartphone",
    preu: 199,
    log: [],
    gestionarDades: function (...args) {
        //console.log(args.length);
        if (args.length == 0) {
            Object.keys(this).forEach(val => {
                if (!(typeof this[val] === "function")) {
                    this[val] = null;
                }
            });
        } else if (args.length == 1) {
            if (typeof args[0] === "object") {
                for (const key in args[0]) {
                    if (this.hasOwnProperty(key)) {
                        this.log.add("La propietat " + key + " existeix.  ");
                    } else {console.log("");}
                }
                Object.keys(args[0]).forEach(val => {
                    //this[val] = null;
                    console.log(Object.values(args[0]));
                });
                // if (key in obj) {
                //     this.log.add("La propietat " + args[0]);
                // }
            }
        }
    }
};

const obj2 = {
    hola: "hola1",
    preu: "adeu1"
};
obj.gestionarDades(obj2);
//console.log(obj);