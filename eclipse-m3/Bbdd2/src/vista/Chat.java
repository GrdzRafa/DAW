//package vista;
//
//import javax.swing.JFrame;
//import javax.swing.JPanel;
//import javax.swing.border.EmptyBorder;
//import model.Usuari;
//
//import javax.swing.JLabel;
//import javax.swing.JOptionPane;
//
//import java.awt.Font;
//import java.awt.event.ActionEvent;
//import java.awt.event.ActionListener;
//import java.time.LocalDate;
//import java.time.format.DateTimeFormatter;
//
//import javax.swing.JTextField;
//import javax.swing.JButton;
//
//
//public class Chat extends JFrame {
//
//	private static final long serialVersionUID = 1L;
//	private JPanel contentPane;
//	private Usuari usuari;
//
//	public Chat(/*Usuari c*/) {
//
////		this.usuari = c;
//		iniciComponents();
////		iniciEsdeveniments();
//
//	}
//
//	public void iniciComponents() {
//		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
//		setBounds(100, 100, 450, 300);
//		contentPane = new JPanel();
//		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
//
//		setContentPane(contentPane);
//		contentPane.setLayout(null);
//
//		JLabel lblNewLabel = new JLabel("Modificar Client");
//		lblNewLabel.setFont(new Font("Dialog", Font.BOLD, 20));
//		lblNewLabel.setBounds(139, 12, 161, 28);
//		contentPane.add(lblNewLabel);
//	}
//
////	private void iniciEsdeveniments() {
////
////		btnGuardar.addActionListener(new ActionListener() {
////			public void actionPerformed(ActionEvent e) {
////				try {
////					if (usuari == null)
////						usuari = new Usuari();
////					usuari.setDni(txtDni.getText());
////					usuari.setNom(txtNom.getText());
////					usuari.setCognoms(txtCognoms.getText());
////					usuari.setDataNaixement(
////							LocalDate.parse(txtData.getText(), DateTimeFormatter.ofPattern("dd/MM/yyyy")));
////					usuari.actualitzar();
////				} catch (Exception ex) {
////					JOptionPane.showMessageDialog(null, ex.getMessage(), "Missatge d'error", JOptionPane.ERROR_MESSAGE);
////					ex.printStackTrace();
////				}
////
////			}
////		});
////		btnCancelar.addActionListener(new ActionListener() {
////			public void actionPerformed(ActionEvent e) {
////				dispose();
////				LlistatClients finestra = new LlistatClients(null);
////				finestra.setVisible(true);
////
////			}
////		});
////
////	}
//}
package vista;

import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.EventQueue;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;
import javax.swing.*;
import javax.swing.border.EmptyBorder;

import model.Message;
import model.Usuari;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Chat extends JFrame {

    private static final long serialVersionUID = 1L;
    private JPanel contentPane;
    private Usuari usuari;
    private JButton btnDisconnect;
    private JButton btnEnviar;
    private JTextArea textArea;
    private JTextField textFieldMsg;
    private JList<String> listUsuaris;
    private JTextArea textAreaMissatges;
    private DefaultListModel<String> modelUsuaris;
    private javax.swing.Timer timer;

    public Chat(Usuari usuari) {
        this.usuari = usuari;
        iniciComponents();
        iniciEsdeveniments();
        int tempsDeRefresc = 5;

        timer = new javax.swing.Timer(tempsDeRefresc * 1000, new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent ae) {
                if (usuari != null) {
                    try {
                        carregarMissatges();
                        carregarUsuarisConnectats();
                    } catch (ClassNotFoundException e) {
                        JOptionPane.showMessageDialog(Chat.this, "Error al actualizar los datos", "Error", JOptionPane.ERROR_MESSAGE);
                    }
                }
            }

			private void carregarMissatges() {
				// TODO Auto-generated method stub
				
			}
        });

        timer.start();
    }
    
    private void iniciComponents() {
        setTitle("Finestra de Chat");
        setSize(600, 400);
        setLocation(50, 50);
        setResizable(true);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        contentPane = new JPanel();
        contentPane.setLayout(null);
        setContentPane(contentPane);

        JLabel lblTitol = new JLabel("Chat");
        lblTitol.setBounds(250, 10, 100, 30);
        contentPane.add(lblTitol);

        textArea = new JTextArea();
        textArea.setEditable(false);
        JScrollPane scrollPane = new JScrollPane(textArea);
        scrollPane.setBounds(20, 50, 400, 200);
        contentPane.add(scrollPane);

        textFieldMsg = new JTextField();
        textFieldMsg.setBounds(20, 270, 400, 30);
        contentPane.add(textFieldMsg);

        btnEnviar = new JButton("Enviar");
        btnEnviar.setBounds(430, 270, 100, 30);
        contentPane.add(btnEnviar);

        btnDisconnect = new JButton("Desconnectar");
        btnDisconnect.setBounds(430, 10, 130, 30);
        contentPane.add(btnDisconnect);

        modelUsuaris = new DefaultListModel<>();
        listUsuaris = new JList<>(modelUsuaris);
        JScrollPane userScrollPane = new JScrollPane(listUsuaris);
        userScrollPane.setBounds(430, 50, 130, 200);
        contentPane.add(userScrollPane);
    }



    private void iniciEsdeveniments() {
        btnEnviar.addActionListener(e -> {
            String msg = textFieldMsg.getText().trim();
            if (!msg.isEmpty()) {
                try {
                    usuari.enviarMissatge(msg);
                    textArea.append("Tu: " + msg + "\n");
                    textFieldMsg.setText("");
                } catch (SQLException ex) {
                    JOptionPane.showMessageDialog(this, "Error al enviar el mensaje", "Error", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        btnDisconnect.addActionListener(e -> {
            try {
                usuari.desconnectar();
                JOptionPane.showMessageDialog(this, "Desconnectat amb èxit!", "Desconnexió", JOptionPane.INFORMATION_MESSAGE);
                dispose();
            } catch (Exception ex) {
                JOptionPane.showMessageDialog(this, "Error al desconnectar", "Error", JOptionPane.ERROR_MESSAGE);
            }
        });
    }

    private void carregarUsuarisConnectats() throws ClassNotFoundException {
        try {
            List<String> usuaris = usuari.obtenirUsuarisConnectats();
            modelUsuaris.clear();
            
            for (String nickname : usuaris) {
                modelUsuaris.addElement(nickname);
            }
            
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(this, "No es van poder carregar els usuaris connectats", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
    
    private void carregarMissatges() throws SQLException, ClassNotFoundException {
        List<Message> missatges = usuari.obtenirMissatges();
        textAreaMissatges.setText("");
        for (Message missatge : missatges) {
            String msgFormatat = missatge.getNick() + " (" + missatge.getTimestamp().format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss")) + "): " + missatge.getMessage() + "\n";
            textAreaMissatges.append(msgFormatat);
        }
    }
    
    @Override
    public void dispose() {
        if (timer != null) {
            timer.stop();
        }
        super.dispose();
    }
}
