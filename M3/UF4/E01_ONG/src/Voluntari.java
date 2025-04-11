
import java.util.Objects;

public class Voluntari extends Persona{
    private Boolean actiu;
    private int horesDedicades;

    public Voluntari(String dni, String nom, int edat, Boolean actiu2, int horesDedicades2) {
        super(dni, nom, edat);
        this.actiu = actiu2;
        this.horesDedicades = horesDedicades2;

    }


    public Boolean getActiu() {
        return actiu;
    }

    public void setActiu(Boolean actiu) {
        this.actiu = actiu;
    }

    public int getHoresDedicades() {
        return horesDedicades;
    }

    public void setHoresDedicades(int horesDedicades) {
        this.horesDedicades = horesDedicades;
    }    

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 79 * hash + Objects.hashCode(this.actiu);
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
        final Voluntari other = (Voluntari) obj;
        return Objects.equals(this.actiu, other.actiu);
    }

    @Override
    public String toString() {
        return "Voluntari [actiu=" + actiu + "]";
    }
}
