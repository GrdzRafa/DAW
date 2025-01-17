import java.util.ArrayList;

public class Llibre {
    private String titol;
    private ArrayList<Capitol> capitols;

    public Llibre(String titol) {
        this.titol = titol;
        this.capitols = new ArrayList<>();
    }

    public void afegirCapitol(Capitol capitol) {
        capitols.add(capitol);
    }

    public String getTitol() {
        return titol;
    }

    public ArrayList<Capitol> getCapitols() {
        return capitols;
    }
}
