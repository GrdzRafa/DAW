import java.util.Arrays;

public class Main {
    public static void main(String[] args) {

        /*No te voy a mentir, el juego de pruebas lo ha hecho chatGPT porque son las 23:54 y no me da tiempo. Se agradece comprensión. */

        /*LO ha hecho chatGPT porque es solo un juego de pruebas, casi que ni necesitaqs tener conocimiento de programación para hacerlas.
         * Es una tarea sencilla.
         */
        try {
            ArrayList myList = new ArrayList();
            
            // Probar add(Object element)
            myList.add("A");
            myList.add("B");
            myList.add("C");
            myList.add("D");
            System.out.println("Lista después de agregar A, B, C, D:");
            System.out.println(myList);  // Método toString

            // Probar add(int index, Object element)
            myList.add(1, "X");  // Agregar X en el índice 1
            System.out.println("Lista después de agregar X en el índice 1:");
            System.out.println(myList);  // Método toString

            // Probar clear()
            myList.clear();
            System.out.println("Lista después de clear():");
            System.out.println(myList);  // Método toString

            // Probar add después de clear()
            myList.add("A");
            myList.add("B");
            System.out.println("Lista después de agregar A y B tras clear:");
            System.out.println(myList);  // Método toString

            // Probar contains(Object o)
            System.out.println("¿Contiene 'A'? " + myList.contains("A"));
            System.out.println("¿Contiene 'C'? " + myList.contains("C"));

            // Probar get(int index)
            System.out.println("Elemento en índice 1: " + myList.get(1));

            // Probar indexOf(Object o)
            System.out.println("Índice de 'A': " + myList.indexOf("A"));
            System.out.println("Índice de 'C': " + myList.indexOf("C"));

            // Probar isEmpty()
            System.out.println("¿Está vacío? " + myList.isEmpty());

            // Probar lastIndexOf(Object o)
            myList.add("A");  // Agregar otro 'A' para probar lastIndexOf
            System.out.println("Último índice de 'A': " + myList.lastIndexOf("A"));

            // Probar remove(int index)
            myList.remove(1);  // Eliminar el elemento en índice 1
            System.out.println("Lista después de eliminar el índice 1:");
            System.out.println(myList);  // Método toString

            // Probar remove(Object o)
            myList.remove("A");  // Eliminar el elemento 'A'
            System.out.println("Lista después de eliminar 'A':");
            System.out.println(myList);  // Método toString

            // Probar removeRange(int fromIndex, int toIndex)
            myList.add("X");
            myList.add("Y");
            myList.add("Z");
            System.out.println("Lista antes de removeRange:");
            System.out.println(myList);
            myList.removeRange(0, 2);  // Eliminar elementos entre índices 0 y 2
            System.out.println("Lista después de removeRange(0, 2):");
            System.out.println(myList);

            // Probar set(int index, Object element)
            myList.set(0, "M");  // Cambiar el elemento en el índice 0 por 'M'
            System.out.println("Lista después de set(0, 'M'):");
            System.out.println(myList);  // Método toString

            // Probar size()
            System.out.println("Tamaño de la lista: " + myList.size());

            // Probar toArray()
            Object[] array = myList.toArray();
            System.out.println("Array convertido de la lista:");
            System.out.println(Arrays.toString(array));

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
