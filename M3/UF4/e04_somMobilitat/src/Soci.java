
import java.util.ArrayList;

public class Soci extends SomMobilitat{
    private String nom;
    private ArrayList<Boolean> carnet; //bici:true, moto:false, etc

    public Soci(String nom) {
        this.carnet = new ArrayList<>();
        this.nom = nom;
        carnet.add(false); // Bici
        carnet.add(false); // Moto
        carnet.add(false); // cotxe
        carnet.add(false); // furgo
        carnet.add(false); // camió

    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj)
            return true;
        if (obj == null)
            return false;
        if (getClass() != obj.getClass())
            return false;
        Soci other = (Soci) obj;
        if (nom == null) {
            if (other.nom != null)
                return false;
        } else if (!nom.equals(other.nom))
            return false;
        return true;
    } 

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public ArrayList<Boolean> getCarnet() {
        return carnet;
    }

    public void setCarnet(ArrayList<Boolean> carnet) throws Exception {
        if (!(carnet.size() > 5)) {
            this.carnet = carnet;    
        } else{throw new Exception("Excés de quantitat de carnets possibles.");}
        
    }

    @SuppressWarnings("ConvertToStringSwitch")
    public void afegirCarnet(String s) throws Exception{
        if (s.equals("Bici")) {
            carnet.set(0, true);
        } else if (s.equals("Moto")) {
            carnet.set(1, true);
        }  else if (s.equals("Cotxe")) {
            carnet.set(2, true);
        }  else if (s.equals("Furgoneta")) {
            carnet.set(3, true);
        } else if (s.equals("Camio")) {
            carnet.set(4, true);
        } else{throw new Exception("El vehicle introduït no és correcte (Bici, Moto, Cotxe, Furgoneta, Camio).");}
    }


}
