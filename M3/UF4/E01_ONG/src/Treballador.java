public class Treballador extends Persona{
    private int nass;
    private double souBrut;

    public Treballador(){};
    public Treballador(String dni, String nom, int edat, int nass, double souBrut) {
        super(dni, nom, edat);
        this.nass = nass;
        this.souBrut = souBrut;
    }

    public int getnass() {
        return nass;
    }
    public void setnass(int nass) {
        this.nass = nass;
    }
    public double getSouBrut() {
        return souBrut;
    }
    public void setSouBrut(double souBrut) {
        this.souBrut = souBrut;
    }

    @Override
    public String toString() {
        return "Treballador [nass=" + nass + ", souBrut=" + souBrut + "]";
    }
    
    @Override
    public int hashCode() {
        int hash = 3;
        hash = 23 * hash + this.nass;
        hash = 23 * hash + (int) (Double.doubleToLongBits(this.souBrut) ^ (Double.doubleToLongBits(this.souBrut) >>> 32));
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
        final Treballador other = (Treballador) obj;
        if (this.nass != other.nass) {
            return false;
        }
        return Double.doubleToLongBits(this.souBrut) == Double.doubleToLongBits(other.souBrut);
    }
}
