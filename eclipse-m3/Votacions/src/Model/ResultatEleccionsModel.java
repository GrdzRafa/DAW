package src.Model;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.Set;
import java.util.TreeSet;

import com.db4o.ObjectSet;
import com.db4o.query.Predicate;

public class ResultatEleccionsModel extends DBModel {
	public ResultatEleccionsModel() {
		super();
	}

	public static List<ResultatEleccions> obtenerResultatsPerPartit(String siglesPartit) {
		ObjectSet<ResultatEleccions> result = db.query(new Predicate<ResultatEleccions>(){public boolean match(ResultatEleccions re) {
			return re.getPartit().getSiglesPartit().equalsIgnoreCase(siglesPartit);}});
		
        //para cualquier duda, revisar el txt en el paquete media_i_explicaciones
        List<ResultatEleccions> resultatsOrdenats = new ArrayList<ResultatEleccions>(result);
        
        resultatsOrdenats.addAll(result);
        resultatsOrdenats.sort(Comparator.comparingInt(ResultatEleccions::getAnyEleccio));
		return resultatsOrdenats;
	}

	public static List<ResultatEleccions> obtenerResultatsPerMunicipi(String nomMunicipi) {
		ObjectSet<ResultatEleccions> result = db.query(new Predicate<ResultatEleccions>(){public boolean match(ResultatEleccions re) {
			return re.getMunicipi().getNomMunicipi().equalsIgnoreCase(nomMunicipi);}});
		
        //para cualquier duda, revisar el txt en el paquete media_i_explicaciones
        List<ResultatEleccions> resultatsOrdenats = new ArrayList<ResultatEleccions>(result);
        
        resultatsOrdenats.addAll(result);
        resultatsOrdenats.sort(Comparator.comparingInt(ResultatEleccions::getAnyEleccio));
		return resultatsOrdenats;
	}

	public void inserirDades(Set<Municipi> municipis, Set<Partit> partits, Set<ResultatEleccions> resultats)
			throws Exception {
		DBModel.obrir();
		try {
			for (Municipi m : municipis) {
				db.store(m);
			}
			for (Partit p : partits) {
				db.store(p);
			}
			for (ResultatEleccions r : resultats) {
				db.store(r);
			}

			DBModel.tancar();
		} catch (Exception e) {
			throw new Exception(e);
		}
	}
}
