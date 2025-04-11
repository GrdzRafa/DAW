package model;

import java.sql.*;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

public class Users extends DataBase {

	public String nick;
//	public String userhost;
	public LocalDateTime date_con;
//	public int last_read;

	public Users() throws SQLException, ClassNotFoundException {
		super();
	}

	public Users(String nick, LocalDateTime date_con)
			throws SQLException, ClassNotFoundException {
		super();
		this.nick = nick;
		this.date_con = date_con;
	}

	public String getNick() {
		return nick;
	}

	public void setNick(String nick) {
		this.nick = nick;
	}

//	public String getUserhost() {
//		return userhost;
//	}
//
//	public void setUserhost(String userhost) {
//		this.userhost = userhost;
//	}

	public LocalDateTime getDate_con() {
		return date_con;
	}

	public void setDate_con(LocalDateTime date_con) {
		this.date_con = date_con;
	}

//	public int getLast_read() {
//		return last_read;
//	}
//
//	public void setLast_read(int last_read) {
//		this.last_read = last_read;
//	}
	
	public void connect() throws Exception {
		try {
			String sql = "{ call connect(?) }";
			CallableStatement sentencia = super.getConnection().prepareCall(sql);
			sentencia.setString(1, this.nick);
			
			sentencia.execute();
			sentencia.close();
		} catch (Exception e) {
			throw e;
		}	
	}
	
	public void disconnect() throws Exception {
		try {
			String sql = "{ call disconnect() }";
			CallableStatement sentencia = super.getConnection().prepareCall(sql);
			
			sentencia.execute();
			sentencia.close();
		} catch (Exception e) {
			throw e;
		}
	}
	
	public List<Users> getConnectedUsers() throws Exception {	
		List<Users> users = new ArrayList<Users>();
		try {
			String sql = "{ call getConnectedUsers() }";
			CallableStatement sentencia = super.getConnection().prepareCall(sql);
			
			ResultSet resultat = sentencia.executeQuery();
			
			Users user;
			
			while (resultat.next()) {
				user = new Users(resultat.getString(1),
						LocalDateTime.parse(resultat.getString(2), DateTimeFormatter.ofPattern("yyyy-MM-dd kk:mm:ss")));
				users.add(user);
			}

			sentencia.close();
			
		} catch (Exception e) {
			throw e;
		}
		return users;
	}
	


}
