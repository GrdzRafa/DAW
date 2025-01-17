import java.sql.Date;
import java.util.ArrayList;
import java.util.List;

class Jugador {
    private String nom;
    private String cognom;
    private int edat;
    private String posicio;
    private int dorsal;
    private double salari;
    private java.util.Date dataProfessional;
    private List<String> equipsAnteriors;
    private List<String> trofeusIndividuals;

    public Jugador(String nom, String cognom, int edat, String posicio, int dorsal, double salari,
            java.util.Date dataProfessional) {
        this.nom = nom;
        this.cognom = cognom;
        this.edat = edat;
        this.posicio = posicio;
        this.dorsal = dorsal;
        this.salari = salari;
        this.dataProfessional = dataProfessional;
        this.equipsAnteriors = new ArrayList<>();
        this.trofeusIndividuals = new ArrayList<>();
    }

    public void afegirEquipAnterior(String equip) {
        equipsAnteriors.add(equip);
    }

    public void afegirTrofeuIndividual(String trofeu) {
        trofeusIndividuals.add(trofeu);
    }

    public int getValorJugador() {
        return trofeusIndividuals.size() * 10 + equipsAnteriors.size() * 5 + (int) salari / 1000;
    }

    public String getNom() {
        return nom;
    }

    public String getCognom() {
        return cognom;
    }

    public String getPosicio() {
        return posicio;
    }

    public int getDorsal() {
        return dorsal;
    }

    public double getSalari() {
        return salari;
    }

    public int getEdat() {
        return edat;
    }

    public Date getDataProfessional() {
        return (Date) dataProfessional;
    }

    public List<String> getEquipsAnteriors() {
        return equipsAnteriors;
    }

    public List<String> getTrofeusIndividuals() {
        return trofeusIndividuals;
    }

    @Override
    public String toString() {
        return "Nom: " + nom + " " + cognom +
                ", Edat: " + edat + " anys" +
                ", Posició: " + posicio +
                ", Dorsal: " + dorsal +
                ", Salari: " + salari + "€" +
                ", Data Professional: " + dataProfessional.toString() +
                ", Equips Anteriors: " + equipsAnteriors +
                ", Trofeus Individuals: " + trofeusIndividuals;
    }

}