
import java.awt.Point;
import java.util.ArrayList;

public class App {
    public static void main(String[] args) throws Exception {


        ArrayList<CotxeElec> cotxes = new ArrayList<>();

        Soci pep = new Soci("Pep");
        Soci joan = new Soci("Joan");
        Soci marc = new Soci("Marc");

        CotxeElec cotxe1 = new CotxeElec(new Point(0, 0), 20000, pep, "ABC123", "Elèctric", 20000);
        CotxeElec cotxe2 = new CotxeElec(new Point(1, 1), 15000, joan, "XYZ789", "Híbrid", 20000);
        
        cotxe1.addOcupant(pep);
        cotxe1.addOcupant(joan);
        
        cotxes.add(cotxe1);
        cotxes.add(cotxe2);

        cotxes.sort(null);
    }
}
