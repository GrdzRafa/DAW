package chat.model;

import java.sql.Connection;
import java.sql.DriverManager;

import javax.swing.JOptionPane;

public class Model {
	
	private String url;
	private String userName;
	private String password;
	
	protected Connection conn;
	
	public Model() throws ChatException{
		this.url = "jdbc:mysql://127.0.0.1/chat";
		this.userName = "appuser";
		this.password = "TiC.123456";
		
		try {
			if (this.conn == null) {
				Class.forName("com.mysql.cj.jdbc.Driver");
				this.conn = DriverManager.getConnection(this.url,this.userName, this.password);				
			}
		} catch (Exception e){
			JOptionPane.showMessageDialog(null, "No s'ha pobut connectar a la base de dades \n" + e.getMessage(), "Error de conexió", JOptionPane.ERROR_MESSAGE); 
			throw new ChatException("Al no poder connectar, no té sentit seguir amb el chat.\nTamquem");
		} 
	}
}
