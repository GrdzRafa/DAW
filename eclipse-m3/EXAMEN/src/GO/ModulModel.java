package GO;

public class ModulModel extends DBModel{
	
	public ModulModel() {
		super();
	}

	public static void inserirDades(Modul m) {
		DBModel.obrir();
		db.store(m);
		DBModel.tancar();
	}
	
	public static void eliminar(Modul m) {
		DBModel.obrir();
		db.delete(m);
		DBModel.tancar();
	}
}
