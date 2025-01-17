import java.util.ArrayList;

public class Pagina {
    private ArrayList<Paragraf> paragrafs;
    private int maxLinies;

    public Pagina(int tamanyLletra) {
        this.paragrafs = new ArrayList<>();
        this.maxLinies = calcularMaxLiniesPerPagina(tamanyLletra);
    }

    private int calcularMaxLiniesPerPagina(int tamanyLletra) {
        switch (tamanyLletra) {
            case 3: return 208;
            case 4: return 158;
            case 5: return 125;
            case 6: return 105;
            case 7: return 90;
            case 8: return 79;
            case 9: return 70;
            case 10: return 63;
            case 11: return 57;
            case 12: return 48;
            case 13: return 48;
            case 14: return 42;
            case 15: return 39;
            case 16: return 39;
            default: return 39;
        }
    }

    public boolean afegirParagraf(Paragraf paragraf) {
        int liniesUtilitzades = getLiniesUtilitzades();
        if (liniesUtilitzades + paragraf.getLinies().size() <= maxLinies) {
            paragrafs.add(paragraf);
            return true;
        } else {
            return false;
        }
    }

    private int getLiniesUtilitzades() {
        int linies = 0;
        for (Paragraf p : paragrafs) {
            linies += p.getLinies().size();
        }
        return linies;
    }

    public ArrayList<Paragraf> getParagrafs() {
        return paragrafs;
    }
}
