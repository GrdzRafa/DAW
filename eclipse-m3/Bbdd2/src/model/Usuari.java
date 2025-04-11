//package model;
//
//import java.net.DatagramSocket;
//import java.net.InetAddress;
//import java.sql.PreparedStatement;
//import java.sql.ResultSet;
//import java.sql.SQLException;
//import java.time.LocalDate;
//import java.time.LocalDateTime;
//
//import com.mysql.cj.jdbc.CallableStatement;
//
//public class Usuari extends Connexio {
//	private String nickName;
//	private String hostName;
//	private LocalDateTime dateCon;
//	private int lastRead;
//
//	public Usuari() throws SQLException, ClassNotFoundException {
//		super();
//	}
//
//	public Usuari(String nickName) throws SQLException, ClassNotFoundException {
//		super();
//		this.nickName = nickName;
//	}
//
//	public String getNickName() {
//		return nickName;
//	}
//
//	public void setNickName(String nickName) {
//		this.nickName = nickName;
//	}
//
//	public String getHostName() {
//		return hostName;
//	}
//
//	public void setHostName(String hostName) {
//		this.hostName = hostName;
//	}
//
//	public LocalDateTime getDateCon() {
//		return dateCon;
//	}
//
//	public void setDateCon(LocalDateTime dateCon) {
//		this.dateCon = dateCon;
//	}
//
//	public int getLastRead() {
//		return lastRead;
//	}
//
//	public void setLastRead(int lastRead) {
//		this.lastRead = lastRead;
//	}
//
//	public void connectar() throws Exception {
//		try {
//			String sql = "{ call connect(?) }";
//			CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
//			cs.setString(1, this.getNickName());
//			cs.execute();
//			cs.close();
//			super.getConnexioBD().close();
//		} catch (Exception e) {
//			throw e;
//		}
//	}
//	
//	public void desconnectar() throws Exception {
//		try {
//			
//			String sql = "{ call disconnect() }";
//			CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
//			cs.execute();
//			cs.close();
//			super.getConnexioBD().close();
//
//		} catch (Exception e) {
//			throw e;
//		}
//	}
//}

package model;

import java.sql.CallableStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

public class Usuari extends Connexio {
    private String nickName;
    private String hostName;

    public Usuari() throws SQLException, ClassNotFoundException {
        super();
    }

    public Usuari(String nickName) throws SQLException, ClassNotFoundException {
        super();
        this.nickName = nickName;
    }

    public String getNickName() {
        return nickName;
    }

    public void setNickName(String nickName) {
        this.nickName = nickName;
    }

    public String getHostName() {
        return hostName;
    }

    public void setHostName(String hostName) {
        this.hostName = hostName;
    }


    public void connectar() throws Exception {
        try {
            String sql = "{ call connect(?) }";
            CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
            cs.setString(1, this.getNickName());
            cs.execute();
            cs.close();
        } catch (Exception e) {
            throw e;
        }
    }


    public void desconnectar() throws Exception {
        try {
            String sql = "{ call disconnect() }";
            CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
            cs.execute();
            cs.close();
        } catch (Exception e) {
            throw e;
        }
    }


    public void getMissatges() throws SQLException {
        try {
            String sql = "{ call getMessages() }";
            CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
            cs.execute();
            cs.close();
        } catch (SQLException e) {
            throw e;
        }
    }


    public void enviarMissatge(String msg) throws SQLException {
        try {
            String sql = "{ call send(?) }";
            CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
            cs.setString(1, msg);
            cs.execute();
            cs.close();
        } catch (SQLException e) {
            throw e;
        }
    }

    public List<String> obtenirUsuarisConnectats() throws SQLException {
        List<String> usuarisConectats = new ArrayList<>();
        
        try {
            String sql = "{ call getConnectedUsers() }";
            CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
            ResultSet rs = cs.executeQuery();
            
            while (rs.next()) {
                String nickname = rs.getString("nick");
                usuarisConectats.add(nickname);
            }
            
            cs.close();
        } catch (SQLException e) {
            e.printStackTrace();
            throw e;
        }
        
        return usuarisConectats;
    }
    
    public List<Message> obtenirMissatges() throws SQLException, ClassNotFoundException {
        List<Message> missatges = new ArrayList<>();
        String sql = "{ call getMessages() }";
        CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
        ResultSet rs = cs.executeQuery();
        while (rs.next()) {
            String nick = rs.getString("nick");
            String message = rs.getString("message");
            LocalDateTime timestamp = rs.getTimestamp("ts").toLocalDateTime();
            missatges.add(new Message(nick, message, timestamp));
        }
        rs.close();
        cs.close();
        return missatges;
    }

}

