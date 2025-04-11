
import java.awt.Point;


public class BiciElec extends VNoMotor {

    public BiciElec(Point geoL, double preu, Soci soci) throws Exception {
        super(geoL, preu, soci);
    }

    public int compareTo(BiciElec b) {
        if (this.getPreu() > b.getPreu()) {
            return 1;
        } else if (this.getPreu() < b.getPreu()) {
            return -1;
        } else {
            return 0;
        }
    }
}
