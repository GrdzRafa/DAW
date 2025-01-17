public class Membre extends Voluntari{
    private double dinersAportats;

    public Membre(String dni, String nom, int edat, Boolean actiu2, int horesDedicades2, double dinersAportats) {
        super(dni, nom, edat, actiu2, horesDedicades2);
        this.dinersAportats = dinersAportats;
    }

    public double getDinersAportats() {
        return dinersAportats;
    }

    public void setDinersAportats(double dinersAportats) {
        this.dinersAportats = dinersAportats;
    }

    @Override
    public String toString() {
        return "Membre [dinersAportats=" + dinersAportats + "]";
    }
    @Override
    public int hashCode() {
        int hash = 7;
        hash = 97 * hash + (int) (Double.doubleToLongBits(this.dinersAportats) ^ (Double.doubleToLongBits(this.dinersAportats) >>> 32));
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
        final Membre other = (Membre) obj;
        return Double.doubleToLongBits(this.dinersAportats) == Double.doubleToLongBits(other.dinersAportats);
    }

}
