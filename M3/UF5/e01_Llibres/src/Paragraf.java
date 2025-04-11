// import java.util.ArrayList;
// import java.util.List;

// public class Paragraf {
//     private ArrayList<String> linies;
//     private int maxCaractersPerLinia;

//     public Paragraf(String text, int tamanyLletra) throws FormatException {
//         this.maxCaractersPerLinia = calcularMaxCaractersPerLinia(tamanyLletra);
//         this.linies = formatejarText(text);
//     }

//     private int calcularMaxCaractersPerLinia(int tamanyLletra) {
//         switch (tamanyLletra) {
//             case 3: return 266;
//             case 4: return 200;
//             case 5: return 160;
//             case 6: return 133;
//             case 7: return 114;
//             case 8: return 100;
//             case 9: return 88;
//             case 10: return 80;
//             case 11: return 72;
//             case 12: return 66;
//             case 13: return 61;
//             case 14: return 57;
//             case 15: return 53;
//             case 16: return 50;
//             default: return 50;  // Valor per defecte
//         }
//     }

//     private List<String> formatejarText(String text) throws FormatException {
//         ArrayList<String> result = new ArrayList<>();
//         String[] paraules = text.split(" ");
//         StringBuilder liniaActual = new StringBuilder();

//         for (String paraula : paraules) {
//             if (paraula.length() > maxCaractersPerLinia) {
//                 throw new FormatException("Paraula massa llarga ");
//             }

//             if (liniaActual.length() + paraula.length() + 1 <= maxCaractersPerLinia) {
//                 if (liniaActual.length() > 0) liniaActual.append(" ");
//                 liniaActual.append(paraula);
//             } else {
//                 result.add(liniaActual.toString());
//                 liniaActual = new StringBuilder(paraula);
//             }
//         }

//         if (liniaActual.length() > 0) {
//             result.add(liniaActual.toString());
//         }

//         return result;
//     }

//     public List<String> getLinies() {
//         return linies;
//     }
// }