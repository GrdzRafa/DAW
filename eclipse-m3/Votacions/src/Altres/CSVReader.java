package src.Altres;

import java.io.*;
import java.util.*;
import src.Model.*;
import com.db4o.ObjectContainer;

public class CSVReader {
	private String rutaCSV;
	private Set<Municipi> municipis;
	private Set<Partit> partits;
	private Set<ResultatEleccions> resultats;
	
	public CSVReader(String ruta) {
		this.rutaCSV = ruta;
		this.municipis = new HashSet<>();
		this.partits = new HashSet<>();
		this.resultats = new HashSet<>(); 
	}
	
	public void crearEstructuraObj() {
		try (BufferedReader br = new BufferedReader(new FileReader(rutaCSV))) {
			String linea;
			boolean primeraLinea = true;

			while ((linea = br.readLine()) != null) {

				// esto es para ignorar la primera línea, que no contiene datos
				if (primeraLinea) {
					primeraLinea = false;
					continue;
				}

				// esto sirve para usar la coma como separador, pero solo en comas fuera de
				// comillas dobles
				// e.j: 0801550006,Badalona,2015,"FEM B, PMB",460,0.51,0
				String[] datos = linea.split(",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)", -1);
				// y esto es para limpiar restos de comillas dobles
				for (int i = 0; i < datos.length; i++) {
					datos[i] = datos[i].replaceAll("^\"|\"$", "").trim();
				}

				if (datos.length >= 7) {
					String codiMunicipi = datos[0];
					String nomMunicipi = datos[1];
					int anyEleccio = Integer.parseInt(datos[2]);
					String siglesPartit = datos[3];
					int vots = Integer.parseInt(datos[4]);
					double percentatgeVots = Double.parseDouble(datos[5]);
					int regidors = Integer.parseInt(datos[6]);

					Municipi municipi = new Municipi(codiMunicipi, nomMunicipi);
					Partit partit = new Partit(siglesPartit);
					ResultatEleccions resultat = new ResultatEleccions(municipi, partit, anyEleccio, vots,
							percentatgeVots, regidors);

					
					municipis.add(municipi);
					partits.add(partit);
					resultats.add(resultat);

				} else {
					throw new Error("Falta algun camp.");
				}
			}
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	public Set<Municipi> getMunicipis() {
		return municipis;
	}

//	public void setMunicipis(List<Municipi> municipis) {
//		this.municipis = municipis;
//	}

	public Set<Partit> getPartits() {
		return partits;
	}

//	public void setPartits(List<Partit> partits) {
//		this.partits = partits;
//	}

	public Set<ResultatEleccions> getResultats() {
		return resultats;
	}

//	public void setResultats(List<ResultatEleccions> resultats) {
//		this.resultats = resultats;
//	}
//	
	
}
