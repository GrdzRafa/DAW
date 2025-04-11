package src.View;

import java.awt.BorderLayout;
import java.awt.EventQueue;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.List;
import java.util.Set;

import javax.swing.DefaultComboBoxModel;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import src.Model.DBModel;
import src.Model.Municipi;
import src.Model.MunicipiModel;
import src.Model.ResultatEleccions;
import src.Model.ResultatEleccionsModel;

public class EleccionsPartit extends JFrame {
	
	private String partit;

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private JScrollPane scrollPane;
	private JTable table;
	
	public EleccionsPartit(String partit) {
		this.partit = partit;
		iniciComponents();
		iniciEsdeveniments();
	}

	private void iniciComponents() {
		contentPane = new JPanel();
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new FlowLayout(FlowLayout.CENTER, 5, 5));
		
		table = new JTable();
		scrollPane = new JScrollPane(table);
		
		contentPane.add(scrollPane, BorderLayout.CENTER);
		// per buidar la taula
		DefaultTableModel model = new DefaultTableModel();
		model.setColumnIdentifiers(new Object[] {"Any", "Partit", "Vots", "Percentatge", "Regidors", "Municipi"});
		table.setModel(model);
		model.setRowCount(0);

		DBModel.obrir();
		
		List<ResultatEleccions> res = ResultatEleccionsModel.obtenerResultatsPerPartit(this.partit);
		
		for (ResultatEleccions re : res) {
			model.addRow(new Object[] { re.getAnyEleccio(), re.getPartit().getSiglesPartit(), re.getVots(),
					re.getPercentatgeVots(), re.getRegidors(), re.getMunicipi().getNomMunicipi() });
		}
		table.setModel(model);

		DBModel.tancar();
	} 
	
	private void iniciEsdeveniments() {
//		btnContinuar.addActionListener(new ActionListener() {
//			public void actionPerformed(ActionEvent arg0) {
//				dispose();
////				new PartitView().setVisible(true);
//			}
//		});
	}
	

}
