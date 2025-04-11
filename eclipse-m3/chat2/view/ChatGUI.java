package chat.view;

import java.awt.BorderLayout;
import java.awt.GridLayout;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Iterator;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EtchedBorder;

import chat.controller.Chat;
import chat.model.ChatException;
import chat.model.Missatge;
import chat.model.Usuari;

public class ChatGUI extends JFrame {
	/**
	 * Classe per la creació d'objectes gràfics 'missatge' que pintarem a la pantalla.
	 * @author toni
	 *
	 */
	
	private Chat chat;
    private JTextField txtUser;
    private JTextField txtMissatge;
    private JPanel pnlBackground;
    private JPanel pnlUsers;
    private JPanel pnlMissatges;
    private JButton btnConectar;
	private JButton btnDesconectar;
	private JButton btnEnviarMissatge;
		
	private static final int TEMPS_DE_REFRESC = 5;  		// en segons
	private static final int MISSATGES_EN_PANTALLA = 12;  
	
    public SimpleDateFormat formatejador = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
    
    public ChatGUI(Chat param) {
    	this.chat = param;
        init();
    }

    private void init() {
        setTitle("FINESTRA PRINCIPAL DEL CHAT");
        setSize(600, 920);
        setLocation(50,5);
        setResizable(false);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        
/*
 * PANELL DE FONS
 */
        pnlBackground = new JPanel(null);
        getContentPane().add(pnlBackground);
        
/*
 * 	PANEL DE CONEXIÓ        
 */
        JPanel pnlConexio = new JPanel(null);
        pnlConexio.setBounds(10, 10, 580, 60);
        pnlConexio.setBorder(new EtchedBorder(EtchedBorder.LOWERED, null, null));
        pnlBackground.add(pnlConexio, BorderLayout.NORTH);
        
        txtUser = new JTextField();
        txtUser.setBounds(480, 20, 90, 20);
        pnlConexio.add(txtUser);
        txtUser.setColumns(10);
        
        btnConectar = new JButton("Conectar");
        btnConectar.setBounds(350, 2, 120, 25);
        btnConectar.setVisible(true);
		btnConectar.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseReleased(MouseEvent e) {
				validarNick(txtUser.getText());
			}
		});
		pnlConexio.add(btnConectar);
        
        btnDesconectar = new JButton("Desconectar");
        btnDesconectar.setBounds(350, 30, 120, 25);
        btnDesconectar.setVisible(false);
		btnDesconectar.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseReleased(MouseEvent e) {
				try {
					desconectarNick();
				} catch (SQLException e1) {
					// TODO Auto-generated catch block
					JOptionPane.showMessageDialog(null, e1.getMessage(), "Problemes en la desconexió de l'usuari", JOptionPane.ERROR_MESSAGE);
					e1.printStackTrace();
				}
			}
		});
        pnlConexio.add(btnDesconectar);
        
        txtMissatge = new JTextField();
        txtMissatge.setBounds(12, 5, 314, 19);
        txtMissatge.setVisible(false);
        pnlConexio.add(txtMissatge);
        txtMissatge.setColumns(10);
        
        btnEnviarMissatge = new JButton("Enviar missatge");
        btnEnviarMissatge.setBounds(176, 30, 150, 25);
        btnEnviarMissatge.setVisible(false);
        btnEnviarMissatge.addMouseListener(new MouseAdapter() {
        	@Override
        	public void mouseReleased(MouseEvent e) {
        		enviarMissatge(txtMissatge.getText());
        	}
        });

        pnlConexio.add(btnEnviarMissatge);

/*
 * PANELL DE MISSATGES
 */
        
        pnlMissatges = new JPanel(new GridLayout(13,1,0,5));
        pnlMissatges.setBorder(new EtchedBorder(EtchedBorder.LOWERED, null, null));
        pnlMissatges.setBounds(10, 80, 450, 800);
        pnlBackground.add(pnlMissatges);
       
        pnlUsers = new JPanel(new GridLayout(15,1, 0 ,5));
        pnlUsers.setBorder(new EtchedBorder(EtchedBorder.LOWERED, null, null));
        pnlUsers.setBounds(470, 80, 120, 800);
        pnlBackground.add(pnlUsers);

        javax.swing.Timer timer = new javax.swing.Timer(this.TEMPS_DE_REFRESC*1000, 
			new java.awt.event.ActionListener() {
				@Override
				public void actionPerformed(java.awt.event.ActionEvent ae) {
					if (btnDesconectar.isVisible()){
						try {
							actualitzaMissatges();
						} catch (SQLException | ChatException e) {
							// TODO Auto-generated catch block
							JOptionPane.showMessageDialog(null, e.getMessage(), "Problemes en l'actualització de missatges", JOptionPane.ERROR_MESSAGE);
							e.printStackTrace();
						}
					}
					try {
						actualitzaUsuaris();
					} catch (ChatException e) {
						// TODO Auto-generated catch block
						JOptionPane.showMessageDialog(null, e.getMessage(), "Problemes d'actualització d'usuaris", JOptionPane.ERROR_MESSAGE);
						e.printStackTrace();
					}
				}
			});
		timer.start();
		
   		this.addWindowListener( new WindowAdapter() {
			public void windowClosing( WindowEvent evt ) {
				JOptionPane.showMessageDialog(null, "Pues bueno, pues vale, pues adiós", "Gud bai", JOptionPane.ERROR_MESSAGE);
				try {
					chat.desconectarNick();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
			   		JOptionPane.showMessageDialog(null, e.getMessage(), "Problemes en la desconexió", JOptionPane.ERROR_MESSAGE);
					e.printStackTrace();
				}
			}
		} );
	

	}
 
	
    
    public void enviarMissatge(String txt) {
		if (txt.length()==0) {
			JOptionPane.showMessageDialog(null, "Escriu alguna cosa per poder enviar-la", "Missatge incorrecte", JOptionPane.ERROR_MESSAGE);
		} else if (txt.length()>255) {
			JOptionPane.showMessageDialog(null, "El missatge no pot superar del 255 caràcters. El retallo", "Missatge incorrecte", JOptionPane.ERROR_MESSAGE); 
			txtMissatge.setText(txtMissatge.getText().substring(0,254));
		} else {
			this.chat.enviarMissatge(txt);
			txtMissatge.setText("");
		}
    }
    
    public void desconectarNick() throws SQLException {
    	this.chat.desconectarNick();
   		btnConectar.setVisible(true);
   		btnDesconectar.setVisible(false);
   		txtUser.setVisible(true);
   		txtMissatge.setVisible(false);
   		btnEnviarMissatge.setVisible(false);
    }
    
    public void validarNick(String txt) {
    	if (this.chat.validarNick(txt)) {
    		btnConectar.setVisible(false);
			btnDesconectar.setVisible(true);
			txtUser.setVisible(false);
			txtMissatge.setVisible(true);
			btnEnviarMissatge.setVisible(true);
    	}
    }
       
	public void actualitzaUsuaris() throws ChatException {
		this.chat.actualitzaUsuaris();
		
		if (this.chat.isNousUsuaris()) {
			pnlUsers.removeAll();
			ArrayList<Usuari> llista = this.chat.getUsuarisConectats();
			for (int i=0; i<llista.size(); i++ ) {
				this.pnlUsers.add(new UsuariGUI(llista.get(i)));
			}
			pnlUsers.updateUI();
		}
	}
	
	public void actualitzaMissatges() throws SQLException, ChatException{
		this.chat.actualitzaMissatges();
		
		if (this.chat.isNousMissatges()) {
			this.chat.setNousMissatges(false);

			ArrayList<Missatge> llistaDeMissatgesNous = this.chat.getUltimsMissatges(ChatGUI.MISSATGES_EN_PANTALLA);
			if (llistaDeMissatgesNous.size() >0){
				pnlMissatges.removeAll();
				Iterator<Missatge> iter = llistaDeMissatgesNous.iterator();
				while (iter.hasNext()) {
					MissatgeGUI msg = new MissatgeGUI(iter.next());
					this.pnlMissatges.add(msg);
				}
				pnlMissatges.updateUI();
			}
		}

	}
	
	
} 