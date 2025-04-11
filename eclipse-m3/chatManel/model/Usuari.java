package chat.model;

import java.util.Date;

public class Usuari implements Comparable<Usuari>{
	private String nick;
	private Date dateConnexio;
	
	public Usuari(String pNick, Date pData) throws ChatException{
		if (pNick.length()>50) {
			throw new ChatException("Longitud del nick massa llarga (màxim permès 50 caràcters)");
		}
		this.nick = pNick;
		this.dateConnexio = pData;
	}
	
	public Usuari(String pNick) throws ChatException{
		if (pNick.length()>50) {
			throw new ChatException("Longitud del nick massa llarga (màxim permès 50 caràcters)");
		}
		this.nick = pNick;
		this.dateConnexio = null;
	}
	
	public String getNick() {
		return nick;
	}
	public Date getDateConnexio() {
		return dateConnexio;
	}

	public boolean equals(Usuari e){
		return this.nick.equals(e.getNick());
	}
	
	public int compareTo(Usuari e) {
		return this.nick.compareTo(e.getNick());
	}

	@Override
	public String toString() {
		return "Usuari [nick=" + nick + ", dateConnexio=" + dateConnexio ;
	}
	
	

	
}
