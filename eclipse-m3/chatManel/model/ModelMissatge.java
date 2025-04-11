package chat.model;

import java.awt.List;
import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Set;
import java.util.TreeSet;

import javax.swing.JOptionPane;

public class ModelMissatge extends Model {
	
	public ModelMissatge() throws ChatException{
		super();
	}
	
	public void enviarMissatge(Missatge missatge) throws ChatException, SQLException {
		if (missatge.getMissatge().length()>255) {			
			throw new ChatException("Longitud del missatge massa llarga (màxim permès 255 caràcters)"+missatge.getMissatge().length());
		}
		String sSql = "{call send (?) }";
		CallableStatement cs = this.conn.prepareCall(sSql);
		cs.setString(1, missatge.getMissatge());
		cs.execute();
		cs.close();
	}
	
	public ArrayList<Missatge> obtenirMissatges() throws SQLException, ChatException {
		String sSql = "{call getMessages() }";
		ResultSet resultat = null;
		ArrayList<Missatge> result;

		CallableStatement cs = this.conn.prepareCall(sSql);
		cs.execute();
		resultat = cs.getResultSet();
		result = result2ArrayListMsg(resultat);
		cs.close();
		return result;
	}

	public ArrayList<Missatge> result2ArrayListMsg (ResultSet e) throws SQLException, ChatException{
		ArrayList<Missatge> tree = new ArrayList<Missatge>();

		while (e.next() == true) {
		   	tree.add(new Missatge(
		   			new Usuari(e.getString("nick")),
		   			e.getString("message"),
		   			e.getTimestamp("ts")));
		}
		return tree;
	}

}
