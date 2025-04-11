@charset "UTF-8";
/*
1. Donada una llista de colors recorre-la per:
 - Crea una nova llista amb els seus complementaris
 - Aplica el segon color de la llista a una classe

*/
.second {
  color: lime;
}

/*
2. Crea un mixin amb tots els paràmetres per a crear 
sombres box-shadow i aplica'l a una classe.
*/
.shadow {
  box-shadow: 10px, 5px, 5px, lime;
}

/* 3. Modifica el mixin del punt anterior perquè: */
.shadow {
  box-shadow: 10px, 5px, 5px, rgba(220, 220, 220, 0.5);
}

/* 4.Crea un mixin que generi un gradient 
lineal entre dos colors i un angle donat*/
.gradient-1 {
  background: linear-gradient(45, cyan, #66ffff);
}

.gradient-2 {
  background: linear-gradient(90, magenta, #ff66ff);
}

.gradient-3 {
  background: linear-gradient(135, yellow, #ffff66);
}

.gradient-4 {
  background: linear-gradient(180, red, #ff6666);
}

/* 5. A partir d'aquest map crea'n un altre amb els valors 
incrementats amb 0.4rem i fusiona'ls*/
/*6. */
/*7*/

/*# sourceMappingURL=style.cs.map */
