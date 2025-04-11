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

public class ModelUsuari extends Model {
	
	public ModelUsuari() throws ChatException{
		super();
	}
	
	public Usuari conectar(Usuari usuari) throws SQLException, ChatException  {
		String sSql = "{call connect (?) }";
		CallableStatement cs = this.conn.prepareCall(sSql);
		cs.setString(1, usuari.getNick());
		cs.execute();
		
		sSql = "{call getConnectedUsers() }";
		cs = this.conn.prepareCall(sSql);
		cs.execute();
		ResultSet resultat = cs.getResultSet();
		
		Usuari mySelf=null;
		while (resultat.next() == true) {
	       	mySelf = new Usuari(
	       			resultat.getString("nick"),	       			
	       			resultat.getTimestamp("date_con"));
	    } 
		cs.close();
		
		System.out.println(mySelf);
		return mySelf;
	}
	
	public void desconectar() throws SQLException{
		String sSql = "{call disconnect() }";
		CallableStatement cs = this.conn.prepareCall(sSql);
		cs.execute();
		cs.close();
	}

	public ArrayList<Usuari> usuarisConectats() throws ChatException {
		String sSql = "{call getConnectedUsers() }";
		ResultSet resultat = null;
		ArrayList<Usuari> result;
		
		try {
			CallableStatement cs = this.conn.prepareCall(sSql);
			cs.execute();
			resultat = cs.getResultSet();
			result = result2ArrayListUser(resultat);
			cs.close();
			return result;
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			JOptionPane.showMessageDialog(null, e.getMessage(), "Missatge d'error", JOptionPane.ERROR_MESSAGE);
			e.printStackTrace();
			return null;
		}
	}
	
	public ArrayList<Usuari> result2ArrayListUser (ResultSet e) throws SQLException, ChatException{
		ArrayList<Usuari> tree = new ArrayList<Usuari>();

		while (e.next() == true) {
	       	tree.add(
	       			new Usuari(
	       					e.getString("nick"),
	       					e.getTimestamp("date_con")));
	    } 
		return tree;
	}
}
