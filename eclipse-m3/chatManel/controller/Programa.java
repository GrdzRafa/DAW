package chat.controller;

import javax.swing.JOptionPane;

import chat.view.ChatGUI;

public class Programa {

	public static void main(String[] args) {
    	try {
    		Chat base = new Chat();
    		ChatGUI finestra = new ChatGUI(base);
    		finestra.setVisible(true);
     	} catch (Exception e) {	
    		JOptionPane.showMessageDialog(null, e.getMessage(), "Missatge d'error", JOptionPane.ERROR_MESSAGE);
			e.printStackTrace();
    	}

    }
} 