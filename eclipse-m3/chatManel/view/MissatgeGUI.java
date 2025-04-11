package chat.view;

import java.awt.Canvas;
import java.awt.Color;
import java.awt.Graphics;

import chat.model.Missatge;

public class MissatgeGUI extends Canvas {
	private Missatge missatge;
			
	    public MissatgeGUI(Missatge msg) {
	    	this.missatge = msg;
	    }

	    @Override
	    public void paint(Graphics g) {
	    	int longitudDeLaLinia = 60;
	    	//Dibuix del fons dels missatges
	    	g.setColor(Color.BLACK);
			g.fillRoundRect(2, 2, 440, 56, 20, 20);
	  		g.setColor(Color.WHITE);
			g.fillRoundRect(0, 0, 438, 54, 20, 20);

			// Escribim el missatge en una dos o tres linies, en funció
			// de la seva llargada, tallant per espais en blanc.

			String missatgeOriginal = this.missatge.getMissatge();
			String primeraLinia = "";
			String segonaLinia = "";
			String terceraLinia = "";

			if (missatgeOriginal.length()<=longitudDeLaLinia) {
				primeraLinia = missatgeOriginal;
			}
			if (missatgeOriginal.length()>50){
				int posicioDelBlanc = missatgeOriginal.lastIndexOf(" ",longitudDeLaLinia);
				if (posicioDelBlanc == -1) {
					primeraLinia = missatgeOriginal.substring(0, longitudDeLaLinia);
					segonaLinia = missatgeOriginal.substring(longitudDeLaLinia);
				} else {
	    			primeraLinia = missatgeOriginal.substring(0, posicioDelBlanc);
	    			segonaLinia = missatgeOriginal.substring(posicioDelBlanc+1);
				}
				
				if (missatgeOriginal.length()>longitudDeLaLinia*2) {
					posicioDelBlanc = segonaLinia.lastIndexOf(" ",longitudDeLaLinia);
					if (posicioDelBlanc == -1) {
						terceraLinia = segonaLinia.substring(longitudDeLaLinia);
						segonaLinia = segonaLinia.substring(0, longitudDeLaLinia);
					} else {
						terceraLinia = segonaLinia.substring(posicioDelBlanc+1);
		    			segonaLinia = segonaLinia.substring(0, posicioDelBlanc);
					}
				}
				
				if (terceraLinia.length()>25) {
					terceraLinia = terceraLinia.substring(0,20);
				}
			} 
			
			
			// Dibuix del text
			g.setColor(Color.GRAY);
		    g.drawString(primeraLinia,20, 15);
		    g.drawString(segonaLinia, 20, 30);
		    g.drawString(terceraLinia,20, 45);
		    g.setColor(Color.BLUE);
		    g.drawString(this.missatge.getUser().getNick(), 330, 50);
		    g.drawString(this.missatge.getDataStr(), 190, 50);	    
	    }
	    

	}