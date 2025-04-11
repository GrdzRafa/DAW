package model;

import java.sql.*;


public class Connexio {
	
	private Connection connexioBD = null;
    private String servidor = "jdbc:mysql://192.168.103.56:3306/chat";
    
//    private String bbdd = "chat";
    private String user = "rafa";
    private String password = "1234";
	
    public Connexio() throws SQLException, ClassNotFoundException {
    	
    	try {
			if (this.connexioBD == null) {
				Class.forName("com.mysql.cj.jdbc.Driver");
				this.connexioBD = DriverManager.getConnection(this.servidor/*+this.bbdd*/, this.user, this.password);				
			}
		} catch (Exception e){
			throw e;			
		} 
    }

	public Connection getConnexioBD() {
		return connexioBD;
	}
      

}
