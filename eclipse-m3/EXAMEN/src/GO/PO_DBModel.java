package GO;

import java.sql.Connection;
import java.sql.DriverManager;

public class PO_DBModel {
	
	private String url;
	private String userName;
	private String password;
	
	protected Connection conn;
	
	public PO_DBModel() throws Exception{
		this.url = "jdbc:mysql://localhost/portesObertes";
		this.userName = "root";
		this.password = "Rafa2025@";
		
		try {
			if (this.conn == null) {
				Class.forName("com.mysql.cj.jdbc.Driver");
				this.conn = DriverManager.getConnection(this.url,this.userName, this.password);
				System.out.println("Bien");
			}
		} catch (Exception e){ 
			throw new Exception("Al no poder connectar, no té sentit seguir amb el chat.\nTamquem");
		} 
	}
}
