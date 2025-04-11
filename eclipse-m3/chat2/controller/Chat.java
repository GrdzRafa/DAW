package chat.controller;

import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

import javax.swing.JOptionPane;

import chat.model.ChatException;
import chat.model.Missatge;
import chat.model.ModelMissatge;
import chat.model.ModelUsuari;
import chat.model.Usuari;

public class Chat {
	private Usuari mySelf;
	private boolean nousUsuaris;
	private boolean nousMissatges;
	
	private ModelUsuari mUsuari;
	private ModelMissatge mMissatge;
	
	private ArrayList<Usuari> usuarisConectats;
	private ArrayList<Missatge> llistaDeMissatges;
	
    public SimpleDateFormat formatejador = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");

   
    public Chat() throws ChatException {
        inicialitza();
    }

    private void inicialitza() throws ChatException {
    	this.mySelf = null;
    	this.nousUsuaris = false;
    	this.nousMissatges = false;
		this.llistaDeMissatges = new ArrayList<Missatge>();
		this.usuarisConectats = new ArrayList<Usuari>();
		this.mUsuari = new ModelUsuari();
		this.mMissatge = new ModelMissatge();
		this.usuarisConectats = new ArrayList<Usuari>();
		
    }
    
	/**
	 * Funció que verifica la validessa del nick i si és correcte, canvia la visibilitat de
	 * controls de la finestra.
	 * @param e Nick per validar
	 * @return true si el nick és vàlid, false si no hi nick o ja està en us
	 */
	public boolean validarNick (String e){
		boolean ret = false;
		try {
			if (e.length() == 0) {
				throw new ChatException("Has d'indicar un nick per conectar");
			} else {
				Usuari Aux = new Usuari(e);
				if (this.usuarisConectats.contains(Aux)) {
					throw new ChatException("Escull un altre nick-name. Aquest ja està en us");
				} else {
					this.mySelf=this.mUsuari.conectar(new Usuari(e));
					ret = true;
				}
			}
		} catch (ChatException p) {
			JOptionPane.showMessageDialog(null, p.getMessage(), "Nick-mame incorrecte", JOptionPane.ERROR_MESSAGE);
		} catch (SQLException p) {
			JOptionPane.showMessageDialog(null, "Problemes amb la conexió a BBDD \n"+p.getMessage(), "No es pot conectar al char", JOptionPane.ERROR_MESSAGE);
		} finally {
			return ret;
		}
	}
	
	/**
	 * Mètode que desactiva controls i crida la desconexió.
	 * @throws SQLException 
	 */
	public void desconectarNick() throws SQLException{
		this.mUsuari.desconectar();
		this.mySelf=null;
	}
	
	/**
	 * Mètode que envia un missatve al chat
	 * @param msg Missatge a enviar
	 */
	public void enviarMissatge(String msg){
		try {
			this.mMissatge.enviarMissatge(new Missatge(mySelf,msg,null));
		} catch (ChatException | SQLException e) {
			// TODO Auto-generated catch block
			JOptionPane.showMessageDialog(null, e.getMessage(), "Missatge d'error", JOptionPane.ERROR_MESSAGE);
			e.printStackTrace();
		}
	}

	
	/**
	 * Mètode per obtenir els usuaris conectats, presents a la BBDD
	 * @throws ChatException 
	 */
	public void actualitzaUsuaris() throws ChatException {
		ArrayList<Usuari> llistaLlegida = this.mUsuari.usuarisConectats();
		if (equalLists(this.usuarisConectats, llistaLlegida)) {
			this.nousUsuaris = false;
		} else {		
			this.nousUsuaris = true;
			this.usuarisConectats = this.mUsuari.usuarisConectats();
		}
	}
	
	/**
	 *  Mètode per obtenir els missateges de la BBDD. Si hi ha molts, només mantindrem els últims.
	 *  S'eliminen els innecessaris amb un iterador.
	 * @throws ChatException 
	 * @throws SQLException 
	 */
	public void actualitzaMissatges() throws SQLException, ChatException{
		ArrayList<Missatge> llistaDeMissatgesNous = new ArrayList<Missatge>(this.mMissatge.obtenirMissatges());
		if (llistaDeMissatgesNous.size() >0){
			this.nousMissatges=true;
			this.llistaDeMissatges.addAll(llistaDeMissatgesNous);
//			}
		}
	}
	
	public ArrayList<Missatge> getUltimsMissatges(int missatgesEnPantalla) {
		ArrayList<Missatge> ultimsMissatges = new ArrayList <Missatge>();
		for (int i=llistaDeMissatges.size()-1; i>=Math.max(0,llistaDeMissatges.size()-missatgesEnPantalla-1); i-- ) {
			ultimsMissatges.add(llistaDeMissatges.get(i));
		}
		return ultimsMissatges;
	}
	
	public  boolean equalLists(ArrayList<Usuari> a, ArrayList<Usuari> b){
		boolean result=true;
	    // comprobar que tienen el mismo tamaño y que no son nulos
	    if ((a.size() != b.size()) || (a == null && b!= null) || (a != null && b== null)){
	        result=false;
	    } else if (a == null && b == null) {
	    	result=true;
	    } else {
	    // ordenar las ArrayList y comprobar que son iguales          
		    Collections.sort(a);
		    Collections.sort(b);
		    for (int index=0; index<a.size(); index++) {
		    	if (!a.get(index).equals(b.get(index))) {
		    		result=false;
		    	}
		    }
	    }
	    return result;
	}

	public ArrayList<Usuari> getUsuarisConectats() {
		return usuarisConectats;
	}

	public ArrayList<Missatge> getLlistaDeMissatges() {
		return llistaDeMissatges;
	}

	public boolean isConectat() {
		return this.mySelf!=null;
	}

	public boolean isNousUsuaris() {
		return nousUsuaris;
	}
	
	public void setNousUsuaris(boolean e) {
		this.nousUsuaris = e;
	}

	public boolean isNousMissatges() {
		return nousMissatges;
	}
	
	public void setNousMissatges (boolean e) {
		this.nousMissatges = e;
	}

	public Usuari getMySelf() {
		return mySelf;
	}

	public ModelUsuari getmUsuari() {
		return mUsuari;
	}
}
