package GO;

import java.io.File;

import com.db4o.*;

public class DBModel {
    private static final String DB4OFILENAME = System.getProperty("user.home") + "/examenDB.db4o";
    protected static ObjectContainer db; 

    public static ObjectContainer obrir() {
        if (db == null || db.ext().isClosed()) {
            db = Db4oEmbedded.openFile(Db4oEmbedded.newConfiguration(), DB4OFILENAME);
        }
        return db;
    }
    
    public static void dropDB() {
        tancar();
        File dbFile = new File(DB4OFILENAME);
        if (dbFile.exists()) {
            if (dbFile.delete()) {
                System.out.println("Base de datos eliminada correctamente.");
            } else {
                System.out.println("No se pudo eliminar la base de datos.");
            }
        } else {
            System.out.println("No se encontró el archivo de la base de datos.");
        }
    }


    public static void tancar() {
        if (db != null) {
            db.close();
            db = null;
        }
    }
    
    
}
