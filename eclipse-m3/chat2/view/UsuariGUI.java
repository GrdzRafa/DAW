package chat.view;

import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;

import javax.swing.JLabel;

import chat.model.Missatge;
import chat.model.Usuari;

public class UsuariGUI extends Canvas {
	private Usuari usuari;
			
	    public UsuariGUI(Usuari user) {
	    	this.usuari = user;
	    	this.setSize(119, 40);
	    }
	    
	    @Override
	    public void paint(Graphics g) {
	       	g.setColor(Color.BLACK);
	   		g.fillRoundRect(2, 2, 115, 40, 20, 20);
	     	g.setColor(Color.WHITE);
	   		g.fillRoundRect(0, 0, 113, 38, 20, 20);
	   		
	   		g.setColor(Color.GRAY);
	   	    g.drawString(this.usuari.getNick(), 10, 25);
	   	    
	   	}
	    
	    
	    

	}