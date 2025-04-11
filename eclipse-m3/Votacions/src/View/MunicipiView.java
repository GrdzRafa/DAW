package src.View;

import java.awt.EventQueue;
import com.db4o.ObjectContainer;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.db4o.ObjectSet;

import src.Model.DBModel;
import src.Model.Municipi;
import src.Model.MunicipiModel;

import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Set;

import javax.swing.DefaultComboBoxModel;
import javax.swing.JButton;
import javax.swing.JComboBox;

public class MunicipiView extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private JComboBox<String> comboBox;
	private JButton btnContinuar; 
	
	public MunicipiView() {
		iniciComponents();
		iniciEsdeveniments();
	}

	private void iniciComponents() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(new FlowLayout(FlowLayout.CENTER, 5, 5));
		
		comboBox = new JComboBox<String>();
		contentPane.add(comboBox);
		
		DBModel.obrir();
		MunicipiModel mm = new MunicipiModel();
		Set<Municipi> municipis = mm.obtenirMunicipis();
		DefaultComboBoxModel<String> model = new DefaultComboBoxModel<>();
        for (Municipi municipi : municipis) {
            model.addElement(municipi.getNomMunicipi());
        }
        DBModel.tancar();
        comboBox.setModel(model);
        
        btnContinuar = new JButton("Continuar");
        btnContinuar.setBounds(291, 180, 105, 27);
		contentPane.add(btnContinuar);
	} 
	
	private void iniciEsdeveniments() {
		btnContinuar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				String municipiSelec = (String) comboBox.getSelectedItem();
				dispose();
				System.out.println(municipiSelec);
				new EleccionsMunicipi(municipiSelec).setVisible(true);
			}
		});
	}
	
	

}
