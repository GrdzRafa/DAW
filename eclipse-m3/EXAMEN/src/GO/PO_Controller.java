package GO;

import java.util.ArrayList;
import java.util.Scanner;

public class PO_Controller {

	public static void main(String[] args) throws Exception {
		try {
			PO_AssistentModel m = new PO_AssistentModel();
			ArrayList<PO_Assistent> assistents = (ArrayList<PO_Assistent>) m.getAssistents();
			for (PO_Assistent po_Assistent : assistents) {
				System.out.println(po_Assistent.getID() + ", " + po_Assistent.getNom() + ", " + po_Assistent.getHora() + ", " + po_Assistent.getCicle());
			}
		} catch (Exception e) {
			throw new Exception(e);
		}

	}

}
