package GO;

import java.util.HashSet;
import java.util.Scanner;
import java.util.Set;

public class Controller {

	public static void main(String[] args) throws Exception {
		
		try (Scanner myObj = new Scanner(System.in)) {
			try {		
				Professor pere = new Professor(1, "Pere", "30");
				Professor manel = new Professor(2, "Manel", "124");
				Modul m1 = new Modul(123, "Sistemes", 60);
				Modul m2 = new Modul(124, "Sistemes2", 50);
				Modul m3 = new Modul(125, "Sistemes3", 20);
				Modul m4 = new Modul(126, "Sistemes4", 50);
				
				Set<Modul> m = new HashSet<>();
				m.add(m1);
				m.add(m2);
				m.add(m3);
				m.add(m4);
				
				Set<Professor> p = new HashSet<>();
				p.add(pere);
				p.add(manel);
				
				m1.setProfessor(pere);
				m2.setProfessor(pere);
				m3.setProfessor(manel);
				m4.setProfessor(manel);
				
				pere.addModuls(m1);
				pere.addModuls(m2);
				manel.addModuls(m3);
				manel.addModuls(m4);
				
				ModulModel.inserirDades(m1);
				ModulModel.inserirDades(m2);
				ModulModel.inserirDades(m3);
				ModulModel.inserirDades(m4);
				
				ProfessorModel.inserirDades(pere);
				ProfessorModel.inserirDades(manel);
				
				
				System.out.println("Si vols eliminar algún professor, escriu la seva id:");
				int professorEliminar = myObj.nextInt();
				System.out.println("Segur que vols eliminar al profesor amb id: " + professorEliminar + "? (S/N)");
				String confirmació = myObj.nextLine();
				
				if(confirmació == "S") {
					for (Modul modul : m) {
						if (modul.getProfessor().getId() == professorEliminar) {
							ModulModel.eliminar(modul);
							modul.setProfessor(null);
							ModulModel.inserirDades(modul);
						}
					}
					
					for (Professor professor : p) {
						if (professor.getId() == professorEliminar) {
							ProfessorModel.eliminar(professor);
						}
					}
				} else if(confirmació == "N") {
					System.out.println("No s'ha eliminat cap professor.");
				}
				
			} catch (Exception e) {
				throw new Exception(e);
			}
		}


	}

}
