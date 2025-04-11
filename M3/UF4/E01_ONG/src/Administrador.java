public class Administrador extends Treballador{
    private int oficina;

    public Administrador(int oficina, String dni, String nom, int edat, int nass, double souBrut) {
        super(dni, nom, edat, nass, souBrut);
        this.oficina = oficina;
    }

    public int getOficina() {
        return oficina;
    }

    public void setOficina(int oficina) {
        this.oficina = oficina;
    }

    @Override
    public String toString() {
        return "Administrador [oficina=" + oficina + "]";
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 53 * hash + this.oficina;
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
        final Administrador other = (Administrador) obj;
        return this.oficina == other.oficina;
    }
}
