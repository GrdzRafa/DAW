package model;

import java.net.DatagramSocket;
import java.net.InetAddress;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.LocalDateTime;

import com.mysql.cj.jdbc.CallableStatement;

public class Usuari extends Connexio {
	private String nickName;
	private String hostName;
	private LocalDateTime dateCon;
	private int lastRead;

	public Usuari() throws SQLException, ClassNotFoundException {
		super();
	}

	public Usuari(String nickName, String hostName, LocalDateTime dateCon, int lastRead)
			throws SQLException, ClassNotFoundException {
		super();
		this.nickName = nickName;
		this.hostName = hostName;
		this.dateCon = dateCon;
		this.lastRead = lastRead;
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

	public LocalDateTime getDateCon() {
		return dateCon;
	}

	public void setDateCon(LocalDateTime dateCon) {
		this.dateCon = dateCon;
	}

	public int getLastRead() {
		return lastRead;
	}

	public void setLastRead(int lastRead) {
		this.lastRead = lastRead;
	}

	public void connectar() throws Exception {
		try {
			String sql = "{ call connect(?) }";
			CallableStatement cs = (CallableStatement) super.getConnexioBD().prepareCall(sql);
			cs.setString(1, this.getNickName());
			cs.execute();
			cs.close();
			super.getConnexioBD().close();

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
			super.getConnexioBD().close();

		} catch (Exception e) {
			throw e;
		}
	}
}
