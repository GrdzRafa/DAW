package control;

//import java.time.LocalDate;
//import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

import javax.swing.JOptionPane;

import model.Users;
import vista.ListUsers;

public class ManageChat {

	public static void main(String[] args) throws Exception {
		try {
//			LocalDateTime rightNow = LocalDateTime.now();
			List<Users> clients = new ArrayList<Users>();
//			clients.add(new Users("ssaibary", "192.168.103.55", rightNow, 0));
//			System.out.println(clients);
			
			ListUsers pantalla = new ListUsers(clients);
			pantalla.setVisible(true);

		} catch (Exception e) {
			JOptionPane.showMessageDialog(null, e.getMessage(), "Missatge d'error", JOptionPane.ERROR_MESSAGE);
			e.printStackTrace();
		}

	}

}
