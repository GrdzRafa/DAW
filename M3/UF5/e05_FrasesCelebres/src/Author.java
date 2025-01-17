import java.util.ArrayList;
import java.util.List;

public class Author {
    private String name;
    private List<Phrase> phrases;

    public Author(String name) {
        this.name = name;
        this.phrases = new ArrayList<>();
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
    
    public List<Phrase> getPhrases() {
        return phrases;
    }

    public void addPhrase(Phrase phrase) {
        this.phrases.add(phrase);
    }
}
