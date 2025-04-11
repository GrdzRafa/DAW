package GO;

public class Modul {
	private int codi;
	private String descripcio;
	private int hores;
    private Professor professor;
    
	public Modul(int codi, String descripcio, int hores) {
		super();
		this.codi = codi;
		this.descripcio = descripcio;
		this.hores = hores;
	}
	
	public int getCodi() {
		return codi;
	}
	public void setCodi(int codi) {
		this.codi = codi;
	}
	public String getDescripcio() {
		return descripcio;
	}
	public void setDescripcio(String descripcio) {
		this.descripcio = descripcio;
	}
	public int getHores() {
		return hores;
	}
	public void setHores(int hores) {
		this.hores = hores;
	}
	public Professor getProfessor() {
		return professor;
	}
	public void setProfessor(Professor professor) {
		this.professor = professor;
	}
}
