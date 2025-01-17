import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.xml.sax.Attributes;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;
import org.xml.sax.XMLReader;
import org.xml.sax.helpers.DefaultHandler;
import org.xml.sax.helpers.XMLReaderFactory;

/**
 * @author toni
 *
 */
public class CopyOfSAX extends DefaultHandler {

    // Camps per a compartir valors entre tot els mètodes
    private List<Phrase> phrases;
    private List<Theme> themes;
    private Author author;
    private Phrase phrase;
    private StringBuilder text;

    /**
     * Mètode principal des d'on es carrega el fitxer xml.
     * Sel.lecciona la font des d'on es llegeix el fitxer i activa els events per
     * realitzar la
     * lectura.
     * 
     * @return llista d'autors
     * @throws SAXException
     * @throws FileNotFoundException
     * @throws IOException
     */
    public List<Phrase> run() throws SAXException, IOException {
        phrases = new ArrayList<>();
        themes = new ArrayList<>();
        text = new StringBuilder();

        XMLReader reader = XMLReaderFactory.createXMLReader();
        reader.setContentHandler(this);
        reader.parse(new InputSource(new FileInputStream("src/frases.xml")));
        return phrases;
    }

    /**
     * @param uri
     * @param localName
     * @param qName
     * @param attributes
     * @throws SAXException
     */
    @Override
    public void startElement(String uri, String localName, String qName, Attributes attributes) throws SAXException {
        // aixó es per si queda text al afegir-lo en el métode characters.
        //Si no ho faig, s'afegeix tot el contingut nou amb el que ja havia
        text.setLength(0); 
        switch (qName) {
            case "autor":
                author = new Author(attributes.getValue("url"));
                break;
            case "frase":
                phrase = new Phrase(null, author);
                break;
            case "tema":
                break;
        }
    }

    /**
     * @param ch
     * @param start
     * @param length
     * @throws SAXException
     */
    @Override
    public void characters(char[] ch, int start, int length) throws SAXException {
        text.append(ch, start, length);
    }

    /**
     * @param uri
     * @param localName
     * @param qName
     * @throws SAXException
     */
    @Override
    public void endElement(String uri, String localName, String qName) throws SAXException {
        String content = text.toString().trim();
        switch (qName) {
            case "nombre":
                if (author != null) {
                    author.setName(content);
                }
                break;
            case "texto":
                if (phrase != null) {
                    phrase.setText(content);
                }
                break;
            case "tema":
                Theme theme = new Theme(content);
                phrase.addTheme(theme);
                if (!themes.contains(theme)) {
                    themes.add(theme);
                }
                break;
            case "frase":
                if (author != null) {
                    author.addPhrase(phrase);
                }
                phrases.add(phrase);
                break;
        }
    }

}