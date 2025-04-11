package chat.model;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Missatge implements Comparable<Missatge>{
	private Usuari user;
	private String missatge;
	private Date data;
	public SimpleDateFormat formatejador = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
	
	public Missatge(Usuari pNick, String pMissatge, Date pData){
		this.user = pNick;
		this.missatge = pMissatge;
		this.data = pData;
	}
	
	public Missatge(String pMissatge){
		this.missatge = pMissatge;
		this.user = null;
		this.data = null;
	}
	
	
	public Usuari getUser() {
		return user;
	}
	public String getMissatge() {
		return missatge;
	}
	public Date getData() {
		return data;
	}
	public String getDataStr() {
		return formatejador.format(data);
	}
	public void setData(Date data) {
		this.data = data;
	}

	public int compareTo(Missatge e) {
		return this.data.compareTo(e.getData());
	}
}
