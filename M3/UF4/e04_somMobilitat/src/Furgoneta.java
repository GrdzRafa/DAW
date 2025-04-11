import java.awt.Point;

public class Furgoneta extends VCarrega implements Comparable<Furgoneta>{

    public Furgoneta(double pma, Boolean sortidaExt, double tara, Point geoL, double preu, Soci soci, String matricula,
            String motor, double kms) throws Exception {
        super(pma, sortidaExt, tara, geoL, preu, soci, matricula, motor, kms);
    }

    @Override
    public int compareTo(Furgoneta f) {
     if (this.getPma() > f.getPma()) {
      return 1;
     } else if (this.getPma() < f.getPma()) {
      return -1;
     } else {
        return f.getMatricula().compareTo(this.getMatricula());
     }
    }
}
