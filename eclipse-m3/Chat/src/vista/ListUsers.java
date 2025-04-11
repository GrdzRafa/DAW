package vista;

import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.EventQueue;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.SwingUtilities;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import model.Messages;
import model.Users;
import java.awt.Dialog.ModalExclusionType;

public class ListUsers extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private Users user;
	private Messages message;
	private List<Users> clients;
	private List<Messages> messages;
	private JTable table;
	private JTextArea messageArea;
	private JTextField messageInput;
	private JButton sendButton;
	
	/**
	 * Launch the application.
	 */
//	public static void main(String[] args) {
//		EventQueue.invokeLater(new Runnable() {
//			public void run() {
//				try {
//					ListClients frame = new ListClients();
//					frame.setVisible(true);
//				} catch (Exception e) {
//					e.printStackTrace();
//				}
//			}
//		});
//	}

	/**
	 * Create the frame.
	 * 
	 * @throws Exception
	 * @throws SQLException
	 * @throws ClassNotFoundException
	 */
	public ListUsers(List<Users> clients) throws ClassNotFoundException, SQLException, Exception {

		LocalDateTime rightNow = LocalDateTime.now();
		this.user = new Users("rafa", rightNow);
		user.connect();
		

		
		
		this.clients = new Users().getConnectedUsers();
		this.messages = new Messages().getMessages();

		iniciComponents();
		cargarMensages();
		
//		iniciEsdeveniments();	
		this.addWindowListener(new WindowAdapter() {
		    @Override
		    public void windowClosing(WindowEvent e) {
		    	try {
					user.disconnect();
				} catch (Exception e1) {
					e1.printStackTrace();
				}
		    }
		});

	}
	
	public void cargarMensages() {
	    if (messages != null) {
	        SwingUtilities.invokeLater(() -> {
	            messageArea.setText(""); // Limpia antes de cargar nuevos mensajes
	            for (Messages msg : messages) {
	                messageArea.append(msg.getNick() + ": " + msg.getMessage() + "\n");
	            }
	            messageArea.revalidate();
	            messageArea.repaint();
	        });
	    }
	}

	


	private void iniciComponents() {

		setTitle("FINESTRA PRINCIPAL");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	    setLocationRelativeTo(null); // Centrar la ventana en la pantalla
	    setResizable(true); // Permitir que se ajuste el tamaño si es necesario

		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 462);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);

		DefaultTableModel model = new DefaultTableModel();
		contentPane.setLayout(null);

		JLabel lblTitol = new JLabel("Llistat de Clients");
		lblTitol.setFont(new Font("Dialog", Font.BOLD, 20));
		lblTitol.setBounds(127, -6, 192, 31);
		contentPane.add(lblTitol);
		table = new JTable(model);

		table.setPreferredScrollableViewportSize(new Dimension(450, 70));

		JScrollPane scrollPane = new JScrollPane(table);
		scrollPane.setBounds(-3, 37, 453, 73);
		contentPane.add(scrollPane);

		getContentPane().add(scrollPane, BorderLayout.CENTER);

		model.addColumn("Users");
		model.addColumn("Connected");
		model.addColumn("Cognoms");
		model.addColumn("Data Naixement");
		
		// Área de mensajes
	    messageArea = new JTextArea();
	    messageArea.setEditable(false);
	    JScrollPane messageScrollPane = new JScrollPane(messageArea);
	    messageScrollPane.setBounds(10, 250, 430, 100);
	    contentPane.add(messageScrollPane);
	    
	    // Campo de texto y botón para enviar mensajes
	    messageInput = new JTextField();
	    messageInput.setBounds(10, 360, 320, 30);
	    contentPane.add(messageInput);

	    sendButton = new JButton("Enviar");
	    sendButton.setBounds(340, 360, 100, 30);
	    contentPane.add(sendButton);

	    sendButton.addActionListener(new ActionListener() {
	        private Messages message;

			public void actionPerformed(ActionEvent e) {
	            String msg = messageInput.getText().trim();
	            if (!msg.isEmpty()) {
	        		try {
						this.message = new Messages();
						message.send(msg);
					} catch (ClassNotFoundException | SQLException e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					} catch (Exception e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					}
	        		
	                messageArea.append(user.getNick() + ": " + msg + "\n");
	                messageInput.setText("");
	            }
	        }
	    });


		if (clients != null) {
	        for (Users client : clients) {
	            Object[] data = new Object[4];
	            data[0] = client.getNick();
	            data[3] = client.getDate_con().format(DateTimeFormatter.ofPattern("yyyy-MM-dd kk:mm:ss"));
	            model.addRow(data);
	        }
	    }
	}
	


//	private void iniciEsdeveniments() {
//		btnModificar.addActionListener(new ActionListener() {
//			public void actionPerformed(ActionEvent e) {
//				ModifyClients finestra;
//				if (table.getSelectedRow()>=0) {
//					finestra = new ModifyClients(clients.get(table.getSelectedRow()));
//				}
//				else finestra = new ModifyClients(null);
//				
//				finestra.setVisible(true);
//			    setVisible(false);
//							}
//		});
//		btnEliminar.addActionListener(new ActionListener() {
//			public void actionPerformed(ActionEvent e) {
//			}
//		});
//	}
}

