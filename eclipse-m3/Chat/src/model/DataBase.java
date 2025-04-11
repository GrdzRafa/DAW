package model;

import java.sql.*;

// IP PROFE 50

public class DataBase {

	private Connection connection = null;
	private String server = "jdbc:mysql://192.168.103.56/chat";
	//private String bbdd = "chat";
	private String user = "appuser";
	private String password = "TiC.123456";
	

	public DataBase() throws SQLException, ClassNotFoundException {

		try {
			if (this.connection == null) {
				Class.forName("com.mysql.cj.jdbc.Driver");
				this.connection = DriverManager.getConnection(this.server, this.user, this.password);
				System.out.println("Connect");
			}
		} catch (Exception e) {
			throw e;
		}
	}

	public Connection getConnection() {
		return connection;
	}

}

//while (result.next()) {
//System.out.println(result.getInt(1) + " " + result.getString(2) + " " + result.getString(3) + " " + result.getString(4) + " " + result.getString(5));
//}
