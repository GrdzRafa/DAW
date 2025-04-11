public class Analitic extends Homograma{
    private double hematies;
    private double hematocrit;
    private double hemoglobina;
    private double leucocits;
    private double limfocits;
    private double neutrofils;
    private double eosinofils;
    private double plaquetes;
    private double VCM;
    private double HCM;
    private double VSG;

    // Rang de valors normals homes
    private final double H_minHematies = 4.5, H_maxHematies = 5.9;
    private final double H_minHematocrit = 38.3, H_maxHematocrit = 48.6;
    private final double H_minHemoglobina = 13.2, H_maxHemoglobina = 16.6;
    private final double H_maxVSG = 15;

    // Rang de valors normals dones
    private final double D_minHematies = 4.1, D_maxHematies = 5.1;
    private final double D_minHematocrit = 35.5, D_maxHematocrit = 44.9;
    private final double D_minHemoglobina = 11.6, D_maxHemoglobina = 15.0;
    private final double D_maxVSG = 20;

    private final double minLeucocits = 4500, maxLeucocits = 11000;
    private final double minLimfocits = 1000, maxLimfocits = 4800;
    private final double minNeutrofils = 2000, maxNeutrofils = 7500;
    private final double minEosinofils = 40, maxEosinofils = 450;
    private final double minPlaquetes = 150000, maxPlaquetes = 400000;
    private final double minVCM = 80.0, maxVCM = 100.0;
    private final double minHCM = 23.0, maxHCM = 31.0;
    
    public Analitic(Boolean esHome, double hematies, double hematocrit, double hemoglobina, double leucocits,
            double limfocits, double neutrofils, double eosinofils, double plaquetes, double vCM, double hCM,
            double vSG) {
        super(esHome);
        this.hematies = hematies;
        this.hematocrit = hematocrit;
        this.hemoglobina = hemoglobina;
        this.leucocits = leucocits;
        this.limfocits = limfocits;
        this.neutrofils = neutrofils;
        this.eosinofils = eosinofils;
        this.plaquetes = plaquetes;
        VCM = vCM;
        HCM = hCM;
        VSG = vSG;
    }
    
    public Analitic(Boolean esHome) {
        super(esHome);
    }

    public String getHematiesString() {
        if (super.getEsHome()) {
            return hematies < H_minHematies || hematies > H_maxHematies ? "*" + hematies : String.valueOf(hematies);
        } else {
            return hematies < D_minHematies || hematies > D_maxHematies ? "*" + hematies : String.valueOf(hematies);
        }
    }
    
    public String getHematocritString() {
        if (super.getEsHome()) {
            return hematocrit < H_minHematocrit || hematocrit > H_maxHematocrit ? "*" + hematocrit : String.valueOf(hematocrit);
        } else {
            return hematocrit < D_minHematocrit || hematocrit > D_maxHematocrit ? "*" + hematocrit : String.valueOf(hematocrit);
        }
    }
    
    public String getHemoglobinaString() {
        if (super.getEsHome()) {
            return hemoglobina < H_minHemoglobina || hemoglobina > H_maxHemoglobina ? "*" + hemoglobina : String.valueOf(hemoglobina);
        } else {
            return hemoglobina < D_minHemoglobina || hemoglobina > D_maxHemoglobina ? "*" + hemoglobina : String.valueOf(hemoglobina);
        }
    }
    
    public String getVSGString() {
        double maxVSG = super.getEsHome() ? H_maxVSG : D_maxVSG;
        return VSG > maxVSG ? "*" + VSG : String.valueOf(VSG);
    }
    
    public String getLeucocitsString() {
        return leucocits < minLeucocits || leucocits > maxLeucocits ? "*" + leucocits : String.valueOf(leucocits);
    }
    
    public String getLimfocitsString() {
        return limfocits < minLimfocits || limfocits > maxLimfocits ? "*" + limfocits : String.valueOf(limfocits);
    }
    
    public String getNeutrofilsString() {
        return neutrofils < minNeutrofils || neutrofils > maxNeutrofils ? "*" + neutrofils : String.valueOf(neutrofils);
    }
    
    public String getEosinofilsString() {
        return eosinofils < minEosinofils || eosinofils > maxEosinofils ? "*" + eosinofils : String.valueOf(eosinofils);
    }
    
    public String getPlaquetesString() {
        return plaquetes < minPlaquetes || plaquetes > maxPlaquetes ? "*" + plaquetes : String.valueOf(plaquetes);
    }
    
    public String getVCMString() {
        return VCM < minVCM || VCM > maxVCM ? "*" + VCM : String.valueOf(VCM);
    }
    
    public String getHCMString() {
        return HCM < minHCM || HCM > maxHCM ? "*" + HCM : String.valueOf(HCM);
    }
    


    @Override
    public String toString() {
        return String.format(
            "Hematies                 %s                 (%.1f - %.1f mm³)%n" +
            "Hematocrit               %s                 (%.1f - %.1f %% %n" +
            "Hemoglobina              %s                 (%.1f - %.1f g/dL)%n" +
            "Leucocits                %s                 (%.0f - %.0f mm³)%n" +
            "Limfocits                %s                 (%.0f - %.0f mm³)%n" +
            "Neutrofils               %s                 (%.0f - %.0f mm³)%n" +
            "Eosinofils               %s                 (%.0f - %.0f mm³)%n" +
            "Plaquetes                %s                 (%.0f - %.0f mm³)%n" +
            "VCM                      %s                 (%.1f - %.1f fL)%n" +
            "HCM                      %s                 (%.1f - %.1f pg)%n" +
            "VSG                      %s                 (0 - %.1f mm/h)%n",
    
            getHematiesString(), super.getEsHome() ? H_minHematies : D_minHematies, super.getEsHome() ? H_maxHematies : D_maxHematies,
            getHematocritString(), super.getEsHome() ? H_minHematocrit : D_minHematocrit, super.getEsHome() ? H_maxHematocrit : D_maxHematocrit,
            getHemoglobinaString(), super.getEsHome() ? H_minHemoglobina : D_minHemoglobina, super.getEsHome() ? H_maxHemoglobina : D_maxHemoglobina,
            getLeucocitsString(), minLeucocits, maxLeucocits,
            getLimfocitsString(), minLimfocits, maxLimfocits,
            getNeutrofilsString(), minNeutrofils, maxNeutrofils,
            getEosinofilsString(), minEosinofils, maxEosinofils,
            getPlaquetesString(), minPlaquetes, maxPlaquetes,
            getVCMString(), minVCM, maxVCM,
            getHCMString(), minHCM, maxHCM,
            getVSGString(), super.getEsHome() ? H_maxVSG : D_maxVSG
        );
    }
    
    public double getHematies() {
        return hematies;
    }
    public void setHematies(double hematies) {
        this.hematies = hematies;
    }
    public double getHematocrit() {
        return hematocrit;
    }
    public void setHematocrit(double hematocrit) {
        this.hematocrit = hematocrit;
    }
    public double getHemoglobina() {
        return hemoglobina;
    }
    public void setHemoglobina(double hemoglobina) {
        this.hemoglobina = hemoglobina;
    }
    public double getLeucocits() {
        return leucocits;
    }
    public void setLeucocits(double leucocits) {
        this.leucocits = leucocits;
    }
    public double getLimfocits() {
        return limfocits;
    }
    public void setLimfocits(double limfocits) {
        this.limfocits = limfocits;
    }
    public double getNeutrofils() {
        return neutrofils;
    }
    public void setNeutrofils(double neutrofils) {
        this.neutrofils = neutrofils;
    }
    public double getEosinofils() {
        return eosinofils;
    }
    public void setEosinofils(double eosinofils) {
        this.eosinofils = eosinofils;
    }
    public double getPlaquetes() {
        return plaquetes;
    }
    public void setPlaquetes(double plaquetes) {
        this.plaquetes = plaquetes;
    }
    public double getVCM() {
        return VCM;
    }
    public void setVCM(double vCM) {
        VCM = vCM;
    }
    public double getHCM() {
        return HCM;
    }
    public void setHCM(double hCM) {
        HCM = hCM;
    }
    public double getVSG() {
        return VSG;
    }
    public void setVSG(double vSG) {
        VSG = vSG;
    }

    public double getH_minHematies() {
        return H_minHematies;
    }

    public double getH_maxHematies() {
        return H_maxHematies;
    }

    public double getH_minHematocrit() {
        return H_minHematocrit;
    }

    public double getH_maxHematocrit() {
        return H_maxHematocrit;
    }

    public double getH_minHemoglobina() {
        return H_minHemoglobina;
    }

    public double getH_maxHemoglobina() {
        return H_maxHemoglobina;
    }

    public double getH_maxVSG() {
        return H_maxVSG;
    }

    public double getD_minHematies() {
        return D_minHematies;
    }

    public double getD_maxHematies() {
        return D_maxHematies;
    }

    public double getD_minHematocrit() {
        return D_minHematocrit;
    }

    public double getD_maxHematocrit() {
        return D_maxHematocrit;
    }

    public double getD_minHemoglobina() {
        return D_minHemoglobina;
    }

    public double getD_maxHemoglobina() {
        return D_maxHemoglobina;
    }

    public double getD_maxVSG() {
        return D_maxVSG;
    }

    public double getMinLeucocits() {
        return minLeucocits;
    }

    public double getMaxLeucocits() {
        return maxLeucocits;
    }

    public double getMinLimfocits() {
        return minLimfocits;
    }

    public double getMaxLimfocits() {
        return maxLimfocits;
    }

    public double getMinNeutrofils() {
        return minNeutrofils;
    }

    public double getMaxNeutrofils() {
        return maxNeutrofils;
    }

    public double getMinEosinofils() {
        return minEosinofils;
    }

    public double getMaxEosinofils() {
        return maxEosinofils;
    }

    public double getMinPlaquetes() {
        return minPlaquetes;
    }

    public double getMaxPlaquetes() {
        return maxPlaquetes;
    }

    public double getMinVCM() {
        return minVCM;
    }

    public double getMaxVCM() {
        return maxVCM;
    }

    public double getMinHCM() {
        return minHCM;
    }

    public double getMaxHCM() {
        return maxHCM;
    }

    
}
