import org.xml.sax.SAXException;
import java.io.IOException;
import java.util.List;

public class Main {
    public static void main(String[] args) {
        try {
            // Crea una instancia de tu handler SAX
            CopyOfSAX handler = new CopyOfSAX();

            // Ejecuta el análisis y obtén la lista de frases
            List<Phrase> phrases = handler.run();

            // Imprime los resultados
            System.out.println("Frases cargadas: " + phrases.size());
            for (Phrase phrase : phrases) {
                System.out.println("Autor: " + phrase.getAuthor().getName());
                System.out.println("Texto: " + phrase.getText());
                System.out.print("Temas: ");
                for (Theme theme : phrase.getThemes()) {
                    System.out.print(theme.getName() + " ");
                }
                System.out.println();
                System.out.println("-------------------");
            }
        } catch (SAXException | IOException e) {
            System.err.println("Error al procesar el XML: " + e.getMessage());
        }
    }
}
