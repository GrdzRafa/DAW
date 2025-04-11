
import java.awt.Point;


public class MotoElec extends VMotor implements Comparable<MotoElec>{

    public MotoElec(Point geoL, double preu, Soci soci, String matricula, String motor, double kms) throws Exception {
        super(geoL, preu, soci, matricula, motor, kms);
    }

    @Override
    public int compareTo(MotoElec m) {
     if (this.getKms() > m.getKms()) {
      return 1;
     } else if (this.getKms() < m.getKms()) {
      return -1;
     } else {
        return m.getMatricula().compareTo(this.getMatricula());
     }
    }
}
