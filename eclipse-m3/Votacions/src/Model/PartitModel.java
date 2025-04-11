package src.Model;

import java.util.Set;
import java.util.TreeSet;

import com.db4o.ObjectSet;

public class PartitModel extends DBModel {
	public PartitModel() {
		super();
	}

	public Set<Partit> obtenirPartits() {
		ObjectSet<Partit> result = db.query(Partit.class);
		
		//para cualquier duda, revisar el txt en el paquete media_i_explicaciones
		Set<Partit> partitsOrdenats = new TreeSet<>((p1, p2) -> p1.getSiglesPartit().compareTo(p2.getSiglesPartit()));
		partitsOrdenats.addAll(result);
		return partitsOrdenats;

	}
}
