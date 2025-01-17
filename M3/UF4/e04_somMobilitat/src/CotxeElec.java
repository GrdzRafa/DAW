import java.awt.Point;

public class CotxeElec extends VMotor implements Comparable<CotxeElec>{

    public CotxeElec(Point geoL, double preu, Soci soci, String matricula, String motor, double kms) throws Exception {
        super(geoL, preu, soci, matricula, motor, kms);
    }

    @Override
    public int compareTo(CotxeElec c) {
     if (this.getKms() > c.getKms()) {
      return 1;
     } else if (this.getKms() < c.getKms()) {
      return -1;
     } else {
        return c.getMatricula().compareTo(this.getMatricula());
     }
    }
}
