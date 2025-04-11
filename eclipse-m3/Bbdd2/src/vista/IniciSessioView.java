package vista;

import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.EventQueue;
import java.util.ArrayList;
import java.util.List;

import javax.swing.DefaultListModel;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableColumn;

import model.Usuari;

import javax.swing.JTable;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.Font;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.awt.event.ActionEvent;
import javax.swing.JTextField;

public class IniciSessioView extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private Usuari usuari;
	private JButton btnSortir;
	private JButton btnEntrar;
	private JTextField nickTextField;

	public IniciSessioView() {
		iniciComponents();
		iniciEsdeveniments();

	}

	private void iniciComponents() {

		setTitle("FINESTRA D'INICI DE SESSIÓ");
		setSize(453, 303);
		setLocation(50, 5);
		setResizable(false);
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);

		DefaultTableModel model = new DefaultTableModel();
		contentPane.setLayout(null);

		JLabel lblTitol = new JLabel("Iniciar sessió");
		lblTitol.setFont(new Font("Dialog", Font.BOLD, 20));
		lblTitol.setBounds(130, 6, 192, 31);
		contentPane.add(lblTitol);

		nickTextField = new JTextField();
		nickTextField.setBounds(75, 92, 278, 50);
		contentPane.add(nickTextField);
		nickTextField.setColumns(10);

		btnEntrar = new JButton("Entrar");

		btnEntrar.setBounds(75, 208, 130, 27);
		contentPane.add(btnEntrar);

		btnSortir = new JButton("Sortir");

		btnSortir.setBounds(217, 208, 139, 27);
		contentPane.add(btnSortir);

		JLabel lblNickTitol = new JLabel("Escrigui el seu nickname");
		lblNickTitol.setBounds(127, 49, 226, 31);
		contentPane.add(lblNickTitol);
	}

	private void iniciEsdeveniments() {		
		btnEntrar.addActionListener(new ActionListener() {
		    public void actionPerformed(ActionEvent e) {
		        String nick = nickTextField.getText().trim();
		        if (!nick.isEmpty()) {
		            try {
		                Usuari newUser = new Usuari(nick);
		                newUser.connectar();
		                Chat finestra = new Chat(newUser);
		                finestra.setVisible(true);
		                dispose();
		            } catch (Exception ex) {
		                ex.printStackTrace(); // Esto te dará más detalles sobre el error
		                JOptionPane.showMessageDialog(null, "Error al connectar l'usuari: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
		            }
		        }
		    }
		});

	}

}
