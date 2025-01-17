
import java.awt.Point;
import java.util.ArrayList;

public abstract class Vehicle extends SomMobilitat {
    private int numid;
    private static int id;
    private Point geoL;
    private double preu;
    private Soci soci;
    private ArrayList<Soci> registre;
    
    public Vehicle(Point geoL, double preu, Soci soci) throws Exception {
        this.numid = Vehicle.id;
        setId();
        this.geoL = geoL;
        this.preu = preu;
        this.soci = soci;
        this.registre=new ArrayList<>();
        addOcupant(soci);
    }
    
    public static int getId() {
        return id;
    }
    public static void setId() {
        id++;
    }

    public Point getGeoL() {
        return geoL;
    }
    public void setGeoL(Point geoL) {
        this.geoL = geoL;
    }
    public double getPreu() {
        return preu;
    }
    public void setPreu(double preu) {
        this.preu = preu;
    }
    public Soci getSoci() {
        return soci;
    }
    public void setSoci(Soci soci) {
        this.soci = soci;
    }
    public ArrayList<Soci> getRegistre() {
        return registre;
    }
    public void setRegistre(ArrayList<Soci> registre) {
        this.registre = registre;
    }

    public int getNumid() {
        return numid;
    }

    public void setNumid(int numid) {
        this.numid = numid;
    }

    public final void addOcupant(Soci s) throws Exception{
        //if (!(registre.get(registre.size()-1).equals(s))) {
            registre.add(s);
        //} else{throw new Exception("Aquest soci ja és l'ocupant actual del vehicle.");}
    }
}
