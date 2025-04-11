import java.util.ArrayList;
import java.util.List;

public class Phrase {
    private String text;
    private Author author;
    private List<Theme> themes;

    public Phrase(String text, Author author) {
        this.text = text;
        this.author = author;
        this.themes = new ArrayList<>();
    }

    public String getText() {
        return text;
    }

    public void setText(String text) {
        this.text = text;
    }

    public Author getAuthor() {
        return author;
    }

    public List<Theme> getThemes() {
        return themes;
    }

    public void addTheme(Theme theme) {
        this.themes.add(theme);
    }
}
