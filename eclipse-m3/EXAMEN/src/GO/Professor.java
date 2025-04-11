package GO;

import java.util.HashSet;
import java.util.Set;

public class Professor {
	private int id;
	private String nom;
	private String anysDocent;
	private Set<Modul> moduls;
	
	public Professor(int id, String nom, String anysDocent) {
		super();
		this.id = id;
		this.nom = nom;
		this.anysDocent = anysDocent;
		this.moduls = new HashSet<>();
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getAnysDocent() {
		return anysDocent;
	}

	public void setAnysDocent(String anysDocent) {
		this.anysDocent = anysDocent;
	}

	public Set<Modul> getModuls() {
		return moduls;
	}

	public void addModuls(Modul m) {
		this.moduls.add(m);
	}
}
