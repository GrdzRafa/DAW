package GO;


public class ProfessorModel extends DBModel{
	
	public static void inserirDades(Professor p) {
		DBModel.obrir();
		db.store(p);
		DBModel.tancar();
	}
	
	public static void eliminar(Professor p) {
		DBModel.obrir();
		db.delete(p);
		DBModel.tancar();
	}
}
