package src.Model;

public class ResultatEleccions{
    private Municipi municipi;
    private Partit partit;
    private int anyEleccio;
    private int vots;
    private double percentatgeVots;
    private int regidors;

    public ResultatEleccions(Municipi municipi, Partit partit, int anyEleccio, int vots, double percentatgeVots, int regidors) {
        this.municipi = municipi;
        this.partit = partit;
        this.anyEleccio = anyEleccio;
        this.vots = vots;
        this.percentatgeVots = percentatgeVots;
        this.regidors = regidors;
    }

    public Municipi getMunicipi() {
        return municipi;
    }

    public void setMunicipi(Municipi municipi) {
        this.municipi = municipi;
    }

    public Partit getPartit() {
        return partit;
    }

    public void setPartit(Partit partit) {
        this.partit = partit;
    }

    public int getAnyEleccio() {
        return anyEleccio;
    }

    public void setAnyEleccio(int anyEleccio) {
        this.anyEleccio = anyEleccio;
    }

    public int getVots() {
        return vots;
    }

    public void setVots(int vots) {
        this.vots = vots;
    }

    public double getPercentatgeVots() {
        return percentatgeVots;
    }

    public void setPercentatgeVots(double percentatgeVots) {
        this.percentatgeVots = percentatgeVots;
    }

    public int getRegidors() {
        return regidors;
    }

    public void setRegidors(int regidors) {
        this.regidors = regidors;
    }

    @Override
    public String toString() {
        return "ResultatEleccions{" +
                "municipi=" + municipi.getNomMunicipi() +
                ", partit=" + partit.getSiglesPartit() +
                ", anyEleccio=" + anyEleccio +
                ", vots=" + vots +
                ", percentatgeVots=" + percentatgeVots +
                ", regidors=" + regidors +
                '}';
    }
}
