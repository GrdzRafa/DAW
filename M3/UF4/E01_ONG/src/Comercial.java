

public class Comercial extends Treballador{
    private double incentius;
    private int vendes;

    public Comercial(){};

    public Comercial(double incentius, int vendes, String dni, String nom, int edat, int nass, double souBrut) {
        super(dni, nom, edat, nass, souBrut);
        this.incentius = incentius;
        this.vendes = vendes;
    }

    
    public double souTotal(Comercial comercial){
        double sou = super.getSouBrut()+(comercial.getIncentius()*comercial.getVendes());
        return sou;
    }



    public double getIncentius() {
        return incentius;
    }

    public void setIncentius(double incentius) {
        this.incentius = incentius;
    }

    public int getVendes() {
        return vendes;
    }

    public void setVendes(int vendes) {
        this.vendes = vendes;
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 47 * hash + (int) (Double.doubleToLongBits(this.incentius) ^ (Double.doubleToLongBits(this.incentius) >>> 32));
        hash = 47 * hash + this.vendes;
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
        final Comercial other = (Comercial) obj;
        if (Double.doubleToLongBits(this.incentius) != Double.doubleToLongBits(other.incentius)) {
            return false;
        }
        return this.vendes == other.vendes;
    }

    @Override
    public String toString() {
        return "Comercial [incentius=" + incentius + ", vendes=" + vendes + "]";
    }
}
