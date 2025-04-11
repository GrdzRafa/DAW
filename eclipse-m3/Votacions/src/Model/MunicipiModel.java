package src.Model;

import java.util.Set;
import java.util.TreeSet;

import com.db4o.ObjectSet;

public class MunicipiModel extends DBModel{
    public MunicipiModel() {
    	super();
    }
    
    public Set<Municipi> obtenirMunicipis() {
        ObjectSet<Municipi> result = db.query(Municipi.class);
        
        //para cualquier duda, revisar el txt en el paquete media_i_explicaciones
        Set<Municipi> municipisOrdenats = new TreeSet<>((m1, m2) -> m1.getNomMunicipi().compareTo(m2.getNomMunicipi()));
        municipisOrdenats.addAll(result);
        return municipisOrdenats;
    }
}
