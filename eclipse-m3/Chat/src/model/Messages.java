package model;

import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

public class Messages extends DataBase {
	
	public String idMessage;
	public String nick;
	public String message;
	
	public Messages(String message) throws SQLException, ClassNotFoundException {
		super();
		this.message = message;
	}
	
	public Messages() throws SQLException, ClassNotFoundException {
		super();
	}

	public Messages(String idMessage, String nick, String message) throws SQLException, ClassNotFoundException {
		super();
		this.idMessage = idMessage;
		this.nick = nick;
		this.message = message;
	}

	public String getIdMessage() {
		return idMessage;
	}

	public void setIdMessage(String idMessage) {
		this.idMessage = idMessage;
	}

	public String getNick() {
		return nick;
	}

	public void setNick(String nick) {
		this.nick = nick;
	}

	public String getMessage() {
		return message;
	}

	public void setMessage(String message) {
		this.message = message;
	}
	
	public void send(String missatge) throws Exception {
		try {
			String sql = "{ call send(?) }";
			CallableStatement sentencia = super.getConnection().prepareCall(sql);
			sentencia.setString(1, missatge);
			
			sentencia.execute();
			sentencia.close();
		} catch (Exception e) {
			throw e;
		}	
	}
	
	public List<Messages> getMessages() throws Exception {
	    List<Messages> messages = new ArrayList<>();
	    try {
	        String sql = "{ call getMessages() }";
	        CallableStatement sentencia = super.getConnection().prepareCall(sql);
	        ResultSet resultat = sentencia.executeQuery();

	        while (resultat.next()) {
	            String nick = resultat.getString("nick");
	            String messageText = resultat.getString("message");

	            Messages message = new Messages();
	            message.setNick(nick);
	            message.setMessage(messageText);
	            messages.add(message);
	        }

	        resultat.close();
	        sentencia.close();

	    } catch (Exception e) {
	        throw e;
	    }
	    return messages;
	}


	
	
	

}
