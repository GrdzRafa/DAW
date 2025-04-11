package GO;

public class PO_Assistent {
	private int ID;
	private String Nom;
	private String Hora;
	private String Cicle;
	
	public PO_Assistent(int iD, String nom, String hora, String cicle) {
		super();
		ID = iD;
		Nom = nom;
		Hora = hora;
		Cicle = cicle;
	}

	public int getID() {
		return ID;
	}

	public void setID(int iD) {
		ID = iD;
	}

	public String getNom() {
		return Nom;
	}

	public void setNom(String nom) {
		Nom = nom;
	}

	public String getHora() {
		return Hora;
	}

	public void setHora(String hora) {
		Hora = hora;
	}

	public String getCicle() {
		return Cicle;
	}

	public void setCicle(String cicle) {
		Cicle = cicle;
	}
	
	
}
