package model;

import java.sql.SQLException;
import java.time.LocalDateTime;

public class Message extends Connexio {
    private String nick;
    private String message;
    private LocalDateTime timestamp;

    public Message(String nick, String message, LocalDateTime timestamp) throws ClassNotFoundException, SQLException  {
    	this.nick = nick;
		this.message = message;
		this.timestamp = timestamp;
        
    }

    public String getNick() {
        return nick;
    }

    public String getMessage() {
        return message;
    }

    public LocalDateTime getTimestamp() {
        return timestamp;
    }
}


