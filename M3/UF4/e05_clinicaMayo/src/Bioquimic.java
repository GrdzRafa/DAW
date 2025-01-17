public class Bioquimic extends Homograma {
    private double glucosa;
    private double triglicerids;
    private double transaminases;
    private double colesterol;
    private double hdl;
    private double ldl;
    private double bilirubina;
    private double creatinina;
    private double fosfatasaAlcalina;
    private double urea;
    private double acidUric;
    private double calci;
    private double ferro;
    private double potassi;
    private double sodi;

    private final double minGlucosa = 0, maxGlucosa = 140;
    private final double minTriglicerids = 0, maxTriglicerids = 150;
    private final double minTransaminasesH = 10, maxTransaminasesH = 40;
    private final double minTransaminasesD = 7, maxTransaminasesD = 35;
    private final double minColesterol = 125, maxColesterol = 200;
    private final double minHDL = 40;
    private final double maxLDL = 100;
    private final double minBilirrubina = 0.1, maxBilirrubina = 1.2;
    private final double minCreatininaH = 0.7, maxCreatininaH = 1.3;
    private final double minCreatininaD = 0.6, maxCreatininaD = 1.1;
    private final double minFosfatasaAlcalina = 44, maxFosfatasaAlcalina = 147;
    private final double minUrea = 12, maxUrea = 54;
    private final double minAcidUric = 3.5, maxAcidUric = 7.2;
    private final double minCalci = 8.5, maxCalci = 10.2;
    private final double minFerro = 60, maxFerro = 170;
    private final double minPotassi = 3.7, maxPotassi = 5.2;
    private final double minSodi = 135, maxSodi = 145;
    
    public Bioquimic(Boolean esHome) {
        super(esHome);
    }

    public Bioquimic(Boolean esHome, double glucosa, double triglicerids, double transaminases, double colesterol,
            double hdl, double ldl, double bilirubina, double creatinina, double fosfatasaAlcalina, double urea,
            double acidUric, double calci, double ferro, double potassi, double sodi) {
        super(esHome);
        this.glucosa = glucosa;
        this.triglicerids = triglicerids;
        this.transaminases = transaminases;
        this.colesterol = colesterol;
        this.hdl = hdl;
        this.ldl = ldl;
        this.bilirubina = bilirubina;
        this.creatinina = creatinina;
        this.fosfatasaAlcalina = fosfatasaAlcalina;
        this.urea = urea;
        this.acidUric = acidUric;
        this.calci = calci;
        this.ferro = ferro;
        this.potassi = potassi;
        this.sodi = sodi;
    }

    public String getGlucosaString() {
        return (glucosa < minGlucosa || glucosa > maxGlucosa) ? "*" + glucosa : String.valueOf(glucosa);
    }
    
    public String getTrigliceridsString() {
        return (triglicerids < minTriglicerids || triglicerids > maxTriglicerids) ? "*" + triglicerids : String.valueOf(triglicerids);
    }
    
    public String getColesterolString() {
        return (colesterol < minColesterol || colesterol > maxColesterol) ? "*" + colesterol : String.valueOf(colesterol);
    }
    
    public String getHDLString() {
        return (hdl < minHDL) ? "*" + hdl : String.valueOf(hdl);
    }
    
    public String getLDLString() {
        return (ldl > maxLDL) ? "*" + ldl : String.valueOf(ldl);
    }
    
    public String getBilirrubinaString() {
        return (bilirubina < minBilirrubina || bilirubina > maxBilirrubina) ? "*" + bilirubina : String.valueOf(bilirubina);
    }
    
    public String getCreatininaString(boolean esHome) {
        double minCreatinina = esHome ? minCreatininaH : minCreatininaD;
        double maxCreatinina = esHome ? maxCreatininaH : maxCreatininaD;
        return (creatinina < minCreatinina || creatinina > maxCreatinina) ? "*" + creatinina : String.valueOf(creatinina);
    }
    
    public String getFosfatasaAlcalinaString() {
        return (fosfatasaAlcalina < minFosfatasaAlcalina || fosfatasaAlcalina > maxFosfatasaAlcalina) ? "*" + fosfatasaAlcalina : String.valueOf(fosfatasaAlcalina);
    }
    
    public String getUreaString() {
        return (urea < minUrea || urea > maxUrea) ? "*" + urea : String.valueOf(urea);
    }
    
    public String getAcidUricString() {
        return (acidUric < minAcidUric || acidUric > maxAcidUric) ? "*" + acidUric : String.valueOf(acidUric);
    }
    
    public String getCalciString() {
        return (calci < minCalci || calci > maxCalci) ? "*" + calci : String.valueOf(calci);
    }
    
    public String getFerroString() {
        return (ferro < minFerro || ferro > maxFerro) ? "*" + ferro : String.valueOf(ferro);
    }
    
    public String getPotassiString() {
        return (potassi < minPotassi || potassi > maxPotassi) ? "*" + potassi : String.valueOf(potassi);
    }
    
    public String getSodiString() {
        return (sodi < minSodi || sodi > maxSodi) ? "*" + sodi : String.valueOf(sodi);
    }

    @Override
    public String toString() {
        return String.format(
            "Glucosa                    %s                 (%s - %s mg/dL)%n" +
            "Triglicèrids               %s                 (< %s mg/dL)%n" +
            "Colesterol                 %s                 (%s - %s mg/dL)%n" +
            "Colesterol HDL             %s                 (>= %s mg/dL)%n" +
            "Colesterol LDL             %s                 (< %s mg/dL)%n" +
            "Bilirrubina                %s                 (%s - %s mg/dL)%n" +
            "Creatinina                 %s                 (%s - %s mg/dL)%n" +
            "Fosfatasa Alcalina         %s                 (%s - %s UI/L)%n" +
            "Urea                       %s                 (%s - %s mg/dL)%n" +
            "Àcid Úric                  %s                 (%s - %s mg/dL)%n" +
            "Calci                      %s                 (%s - %s mg/dL)%n" +
            "Ferro                      %s                 (%s - %s µg/dL)%n" +
            "Potassi                    %s                 (%s - %s mEq/L)%n" +
            "Sodi                       %s                 (%s - %s mEq/L)%n",
    
            getGlucosaString(), minGlucosa, maxGlucosa,
            getTrigliceridsString(), maxTriglicerids,
            getColesterolString(), minColesterol, maxColesterol,
            getHDLString(), minHDL,
            getLDLString(), maxLDL,
            getBilirrubinaString(), minBilirrubina, maxBilirrubina,
            getCreatininaString(super.getEsHome()), super.getEsHome() ? minCreatininaH : minCreatininaD, super.getEsHome() ? maxCreatininaH : maxCreatininaD,
            getFosfatasaAlcalinaString(), minFosfatasaAlcalina, maxFosfatasaAlcalina,
            getUreaString(), minUrea, maxUrea,
            getAcidUricString(), minAcidUric, maxAcidUric,
            getCalciString(), minCalci, maxCalci,
            getFerroString(), minFerro, maxFerro,
            getPotassiString(), minPotassi, maxPotassi,
            getSodiString(), minSodi, maxSodi
        );
    }
    
    public void setGlucosa(double glucosa) {
        this.glucosa = glucosa;
    }

    public double getTriglicerids() {
        return triglicerids;
    }

    public void setTriglicerids(double triglicerids) {
        this.triglicerids = triglicerids;
    }

    public double getTransaminases() {
        return transaminases;
    }

    public void setTransaminases(double transaminases) {
        this.transaminases = transaminases;
    }

    public double getColesterol() {
        return colesterol;
    }

    public void setColesterol(double colesterol) {
        this.colesterol = colesterol;
    }

    public double getHDL() {
        return hdl;
    }

    public void setHDL(double hdl) {
        this.hdl = hdl;
    }

    public double getLDL() {
        return ldl;
    }

    public void setLDL(double ldl) {
        this.ldl = ldl;
    }

    public double getBilirubina() {
        return bilirubina;
    }

    public void setBilirubina(double bilirrubina) {
        this.bilirubina = bilirrubina;
    }

    public double getCreatinina() {
        return creatinina;
    }

    public void setCreatinina(double creatinina) {
        this.creatinina = creatinina;
    }

    public double getFosfatasaAlcalina() {
        return fosfatasaAlcalina;
    }

    public void setFosfatasaAlcalina(double fosfatasaAlcalina) {
        this.fosfatasaAlcalina = fosfatasaAlcalina;
    }

    public double getUrea() {
        return urea;
    }

    public void setUrea(double urea) {
        this.urea = urea;
    }

    public double getAcidUric() {
        return acidUric;
    }

    public void setAcidUric(double acidUric) {
        this.acidUric = acidUric;
    }

    public double getGlucosa() {
        return glucosa;
    }

    public double getCalci() {
        return calci;
    }

    public void setCalci(double calci) {
        this.calci = calci;
    }

    public double getFerro() {
        return ferro;
    }

    public void setFerro(double ferro) {
        this.ferro = ferro;
    }

    public double getPotassi() {
        return potassi;
    }

    public void setPotassi(double potassi) {
        this.potassi = potassi;
    }

    public double getSodi() {
        return sodi;
    }

    public void setSodi(double sodi) {
        this.sodi = sodi;
    }

    public double getMinGlucosa() {
        return minGlucosa;
    }

    public double getMaxGlucosa() {
        return maxGlucosa;
    }

    public double getMinTriglicerids() {
        return minTriglicerids;
    }

    public double getMaxTriglicerids() {
        return maxTriglicerids;
    }

    public double getMinTransaminasesH() {
        return minTransaminasesH;
    }

    public double getMaxTransaminasesH() {
        return maxTransaminasesH;
    }

    public double getMinTransaminasesD() {
        return minTransaminasesD;
    }

    public double getMaxTransaminasesD() {
        return maxTransaminasesD;
    }

    public double getMinColesterol() {
        return minColesterol;
    }

    public double getMaxColesterol() {
        return maxColesterol;
    }

    public double getMinHDL() {
        return minHDL;
    }

    public double getMaxLDL() {
        return maxLDL;
    }

    public double getMinBilirrubina() {
        return minBilirrubina;
    }

    public double getMaxBilirrubina() {
        return maxBilirrubina;
    }

    public double getMinCreatininaH() {
        return minCreatininaH;
    }

    public double getMaxCreatininaH() {
        return maxCreatininaH;
    }

    public double getMinCreatininaD() {
        return minCreatininaD;
    }

    public double getMaxCreatininaD() {
        return maxCreatininaD;
    }

    public double getMinFosfatasaAlcalina() {
        return minFosfatasaAlcalina;
    }

    public double getMaxFosfatasaAlcalina() {
        return maxFosfatasaAlcalina;
    }

    public double getMinUrea() {
        return minUrea;
    }

    public double getMaxUrea() {
        return maxUrea;
    }

    public double getMinAcideUric() {
        return minAcidUric;
    }

    public double getMaxAcideUric() {
        return maxAcidUric;
    }

    public double getMinCalci() {
        return minCalci;
    }

    public double getMaxCalci() {
        return maxCalci;
    }

    public double getMinFerro() {
        return minFerro;
    }

    public double getMaxFerro() {
        return maxFerro;
    }

    public double getMinPotassi() {
        return minPotassi;
    }

    public double getMaxPotassi() {
        return maxPotassi;
    }

    public double getMinSodi() {
        return minSodi;
    }

    public double getMaxSodi() {
        return maxSodi;
    }


}