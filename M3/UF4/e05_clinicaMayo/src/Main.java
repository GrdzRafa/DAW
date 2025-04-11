public class Main {
    public static void main(String[] args) {

        Pacient pacient = new Pacient("Juan Pérez");
        Doctor doctor = new Doctor("Dr. María López");
        Homograma analisi = new Homograma(true);
        
        Analitic analisisSanguini = new Analitic(analisi.getEsHome());
        analisisSanguini.setHematies(4.7);
        analisisSanguini.setHematocrit(42.0);
        analisisSanguini.setHemoglobina(14.5);
        analisisSanguini.setLeucocits(6500);
        analisisSanguini.setLimfocits(2200);
        analisisSanguini.setNeutrofils(3800);
        analisisSanguini.setEosinofils(150);
        analisisSanguini.setPlaquetes(250000);
        analisisSanguini.setVCM(90.0);
        analisisSanguini.setHCM(30.0);
        analisisSanguini.setVSG(10);

        
        Bioquimic analisisBioquimic = new Bioquimic(analisi.getEsHome());
        analisisBioquimic.setGlucosa(90.0);
        analisisBioquimic.setTriglicerids(150.0);
        analisisBioquimic.setColesterol(200.0);
        analisisBioquimic.setHDL(50.0);
        analisisBioquimic.setLDL(130.0);
        analisisBioquimic.setBilirubina(1.0);
        analisisBioquimic.setCreatinina(1.0);
        analisisBioquimic.setFosfatasaAlcalina(90.0);
        analisisBioquimic.setUrea(20.0);
        analisisBioquimic.setAcidUric(5.0);
        analisisBioquimic.setCalci(9.5);
        analisisBioquimic.setFerro(100.0);
        analisisBioquimic.setPotassi(4.0);
        analisisBioquimic.setSodi(140.0);

        
        System.out.println("Paciente: " + pacient.getNom());
        System.out.println("Doctor: " + doctor.getNom());
        
        
        System.out.println("\nResultat Anàlisi Sanguini:");
        System.out.println(analisisSanguini.toString());
        
        System.out.println("\nResultat Anàlisi Bioquímic:");
        System.out.println(analisisBioquimic.toString());
    }
}
