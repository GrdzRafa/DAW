package GO;

import java.sql.CallableStatement;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class PO_AssistentModel extends PO_DBModel {

	public PO_AssistentModel() throws Exception {
		super();
	}

	public void afegirAssistent(PO_Assistent a) throws Exception {
		try {
			String sSql = "{INSERT INTO assistents (ID, Nom, Hora, Cicle) VALUES (?, ?, ?, ?)}";
			PreparedStatement cs = this.conn.prepareCall(sSql);
			cs.setInt(1, a.getID());
			cs.setString(2, a.getNom());
			cs.setString(3, a.getHora());
			cs.setString(4, a.getCicle());
			cs.execute();
			cs.close();
		} catch (Exception e) {
			throw new Exception(e);
		}

	}

	public List<PO_Assistent> getAssistents() throws Exception {
		List<PO_Assistent> assistents = new ArrayList<>();
		try {
			String sql = "{ SELECT * FROM assistents ORDER BY Hora DESC}";
			ResultSet resultat = null;
			CallableStatement cs = this.conn.prepareCall(sql);
			cs.execute();
			resultat = cs.getResultSet();
			assistents = result2ArrayListMsg(resultat);
			cs.close();

		} catch (Exception e) {
			throw new Exception(e);
		}
		return assistents;
	}

	public ArrayList<PO_Assistent> result2ArrayListMsg(ResultSet e) throws SQLException {
		ArrayList<PO_Assistent> tree = new ArrayList<PO_Assistent>();

		while (e.next() == true) {
			tree.add(new PO_Assistent(e.getInt("ID"), e.getString("Nom"), e.getString("Hora"), e.getString("Cicle")));
		}
		return tree;
	}

}
