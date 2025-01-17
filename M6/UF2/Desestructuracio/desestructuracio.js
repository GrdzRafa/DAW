//se puede exportar así
export function Desestructuracio ({nom, poblacio}){
    console.log(`Hola ${nom} de ${poblacio}`);
}
const joan = {nom: 'Joan', poblacio: 'Barcelona'};

//y así:
//exportar con nombre de funcion
export{Desestructuracio};
//sin nombre de funcion
export default Desestructuracio;

//importar
//con nombre de funcion
import {Desestructuracio} from '.desestructuracio.js';
//import sin nombre del funcion
import Desestructuracio from '.desestructuracio.js';

//import sin nombre y con nombre a la vez
import Desestructuracio, {Desestructuracio} from '.desestructuracio.js';

import * as Desestructuracio from '.desestructuracio.js';