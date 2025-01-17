import Canvas from "./Canvas"; 
import Filtre from "./Filtre";

const canvas = document.getElementById('canvas');
const canvasObj = new Canvas(20);
canvasObj.setctx(canvas);
console.log(canvas);