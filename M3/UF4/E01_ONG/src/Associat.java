
import java.util.Objects;

public class Associat extends Persona{
    private int telefon;
    private String adresa;
    private String correu;
    
    public Associat(String dni, String nom, int edat, int telefon, String adresa, String correu) {
        super(dni, nom, edat);
        this.telefon = telefon;
        this.adresa = adresa;
        this.correu = correu;
    }

    public int getTelefon() {
        return telefon;
    }

    public void setTelefon(int telefon) {
        this.telefon = telefon;
    }

    public String getAdresa() {
        return adresa;
    }

    public void setAdresa(String adresa) {
        this.adresa = adresa;
    }

    public String getCorreu() {
        return correu;
    }

    public void setCorreu(String correu) {
        this.correu = correu;
    }

    @Override
    public String toString() {
        return "Associat [telefon=" + telefon + ", adresa=" + adresa + ", correu=" + correu + "]";
    }

    @Override
    public int hashCode() {
        int hash = 3;
        hash = 53 * hash + this.telefon;
        hash = 53 * hash + Objects.hashCode(this.adresa);
        hash = 53 * hash + Objects.hashCode(this.correu);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Associat other = (Associat) obj;
        if (this.telefon != other.telefon) {
            return false;
        }
        if (!Objects.equals(this.adresa, other.adresa)) {
            return false;
        }
        return Objects.equals(this.correu, other.correu);
    }
}
