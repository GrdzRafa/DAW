
import java.awt.Point;


public abstract class VCarrega extends VMotor{
    private double tara; //peso permitido de SOLO el vehículo
    private double pma; //peso permitido del vehículo + pasajeros, etc
    private Boolean sortidaExt;

    public VCarrega(double pma, Boolean sortidaExt, double tara, Point geoL, double preu, Soci soci, String matricula, String motor, double kms) throws Exception {
        super(geoL, preu, soci, matricula, motor, kms);
        this.pma = pma;
        this.sortidaExt = sortidaExt;
        this.tara = tara;
    }

    public double getTara() {
        return tara;
    }

    public void setTara(double tara) {
        this.tara = tara;
    }

    public double getPma() {
        return pma;
    }

    public void setPma(double pma) {
        this.pma = pma;
    }

    public Boolean getSortidaExt() {
        return sortidaExt;
    }

    public void setSortidaExt(Boolean sortidaExt) {
        this.sortidaExt = sortidaExt;
    }


    
}
