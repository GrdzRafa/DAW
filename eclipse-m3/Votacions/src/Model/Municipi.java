package src.Model;

public class Municipi {
    private String codiMunicipi;
    private String nomMunicipi;
	
    public Municipi(String codiMunicipi, String nomMunicipi) {
        this.codiMunicipi = codiMunicipi;
        this.nomMunicipi = nomMunicipi;
    }
    
    public String getCodiMunicipi() {
        return codiMunicipi;
    }

    public void setCodiMunicipi(String codiMunicipi) {
        this.codiMunicipi = codiMunicipi;
    }

    public String getNomMunicipi() {
        return nomMunicipi;
    }

    public void setNomMunicipi(String nomMunicipi) {
        this.nomMunicipi = nomMunicipi;
    }

    @Override
    public String toString() {
        return "Municipi{" +
                "codiMunicipi='" + codiMunicipi + '\'' +
                ", nomMunicipi='" + nomMunicipi + '\'' +
                '}';
    }
    
    public int compareTo(Municipi o) {
        return this.nomMunicipi.compareTo(o.getNomMunicipi());
    }
}