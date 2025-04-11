package src.View;

import javax.swing.*;
import javax.swing.border.EmptyBorder;

import com.db4o.ObjectContainer;

import src.Altres.CSVReader;
import src.Controller.Controller;
import src.Model.DBModel;
import src.Model.ResultatEleccions;
import src.Model.ResultatEleccionsModel;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.util.List;

public class FileSelectorView extends JFrame {

	private static final long serialVersionUID = 1L;
	private JPanel contentPane;
	private JButton btnSeleccionarArchivo;
	private JButton btnAceptarArchivo;
	private JFileChooser fileChooser;
	private File selectedFile;

	public FileSelectorView() {
		iniciComponents();
		iniciEsdeveniments();
	}

	private void iniciComponents() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);

		btnSeleccionarArchivo = new JButton("Seleccionar arxiu CSV");
		contentPane.add(btnSeleccionarArchivo);

		btnAceptarArchivo = new JButton("Continuar");
		contentPane.add(btnAceptarArchivo);
	}

	private void iniciEsdeveniments() {
//		ObjectContainer db = DBModel.obrir();
		
		btnSeleccionarArchivo.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				
				fileChooser = new JFileChooser();
				fileChooser.setDialogTitle("Seleccionar un arxiu CSV");
				fileChooser.setFileFilter(new javax.swing.filechooser.FileNameExtensionFilter("Arxius CSV", "csv"));

				if (fileChooser.showOpenDialog(FileSelectorView.this) == JFileChooser.APPROVE_OPTION) {
					selectedFile = fileChooser.getSelectedFile();
					System.out.println("Arxiu seleccionat: " + selectedFile.getAbsolutePath());
				}
			}
		});
		
		btnAceptarArchivo.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				if (selectedFile == null) {
					JOptionPane.showMessageDialog(FileSelectorView.this, "Por favor, seleccioni un arxiu abans de continuar.", "Error", JOptionPane.ERROR_MESSAGE);
					return;
				}
				
				DBModel.dropDB();
				DBModel.obrir();
				CSVReader lector = new CSVReader(selectedFile.getAbsolutePath());
				lector.crearEstructuraObj();
				
//				System.out.println(lector.getMunicipis());
				try {
					ResultatEleccionsModel rm = new ResultatEleccionsModel();
					rm.inserirDades(lector.getMunicipis(), lector.getPartits(), lector.getResultats());
				} catch (Exception e1) {
					e1.printStackTrace();
				}

				dispose();
				new PartitoMunicipiView().setVisible(true);
			}
		});
	}
}
