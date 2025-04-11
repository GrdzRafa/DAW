package src.View;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JButton;

public class PartitoMunicipiView extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private JLabel lblPartitoMunicipi;
	private JButton btnPartit; 
	private JButton btnMunicipi;


	public PartitoMunicipiView() {
		iniciComponents();
		iniciEsdeveniments();
	}
	

	private void iniciComponents() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		lblPartitoMunicipi = new JLabel("Veure resultats per partit o per municipi?");
		lblPartitoMunicipi.setBounds(119, 12, 267, 17);
		contentPane.add(lblPartitoMunicipi);
		
		btnPartit = new JButton("Partit");
		btnPartit.setBounds(90, 180, 105, 27);
		contentPane.add(btnPartit);
		
		btnMunicipi = new JButton("Municipi");
		btnMunicipi.setBounds(291, 180, 105, 27);
		contentPane.add(btnMunicipi);
	}
	
	private void iniciEsdeveniments() {
		btnMunicipi.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				dispose();
				new MunicipiView().setVisible(true);
			}
		});
		
		btnPartit.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				dispose();
				new PartitView().setVisible(true);
			}
		});
	}
}
