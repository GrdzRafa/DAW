// import java.io.IOException;
// import java.util.ArrayList;

// public class App {
//     public static void main(String[] args) throws Exception {
//         try {
            
//             String nomFitxer = "text.txt";
//             ArrayList<String> paragrafs = llegirParagrafsDelFitxer(nomFitxer);

            
//             Llibre llibre = new Llibre("El meu llibre des del fitxer");
//             Capitol capitol = new Capitol("Capítol 1: Introducció");

            
//             int tamanyLletra = 8;

            
//             Pagina paginaActual = new Pagina(tamanyLletra);

//             for (String text : paragrafs) {
//                 try {
//                     Paragraf paragraf = new Paragraf(text, tamanyLletra);
                    
//                     if (!paginaActual.afegirParagraf(paragraf)) {
//                         capitol.afegirPagina(paginaActual);
//                         paginaActual = new Pagina(tamanyLletra);
//                         paginaActual.afegirParagraf(paragraf);
//                     }
//                 } catch (FormatException e) {
//                     System.out.println("Error en el paràgraf: " + e.getMessage());
//                 }
//             }

            
//             capitol.afegirPagina(paginaActual);

            
//             llibre.afegirCapitol(capitol);

//             // mostrar contingut del llibre
//             imprimirLlibre(llibre);

//         } catch (IOException e) {
//             System.out.println("Error al llegir el fitxer: " + e.getMessage());
//         }
//     }
// }
