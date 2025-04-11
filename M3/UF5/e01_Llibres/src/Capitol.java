import java.util.ArrayList;

public class Capitol {
    private ArrayList<Pagina> pagines;
    private String titol;

    public Capitol(String titol) {
        this.pagines = new ArrayList<>();
        this.titol = titol;
    }

    public void afegirPagina(Pagina pagina) {
        pagines.add(pagina);
    }

    public ArrayList<Pagina> getPagines() {
        return pagines;
    }

    public String getTitol() {
        return titol;
    }
}
