package e02_XML.src;
import java.util.ArrayList;

public class Etiqueta extends Document{
    private String nom;
    private ArrayList<Etiqueta> subEtiquetes = new ArrayList<>();
    private String contingut;
    private ArrayList<Atribut> atributs = new ArrayList<>();
    
    public Etiqueta(String nom, ArrayList<Etiqueta> subEtiquetes, String contingut, ArrayList<Atribut> atributs) {
        this.nom = nom;
        this.subEtiquetes = subEtiquetes;
        this.contingut = contingut;
        this.atributs = atributs;
    }

    public Etiqueta(String nom) {
        this.nom = nom;
    }



    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public ArrayList<Etiqueta> getSubEtiquetes() {
        return subEtiquetes;
    }

    public void setSubEtiquetes(ArrayList<Etiqueta> subEtiquetes) {
        this.subEtiquetes = subEtiquetes;
    }

    public String getContingut() {
        return contingut;
    }

    public void setContingut(String contingut) {
        this.contingut = contingut;
    }

    public String getAtributs() {
        String textAtr = "";

        for (Atribut atribut : atributs) {
            textAtr += atribut.toString();
        }

        return textAtr;
    }

    public void setAtributs(ArrayList<Atribut> atributs) {
        this.atributs = atributs;
    }

    public String subetiquetesAtext(){
        String text = "";

        for (int i = 0; i < subEtiquetes.size(); i++) {
            text += subEtiquetes.get(i).toString();
        }
        return text;
    }

    @Override
    public String toString() { 
        return "<"+ getNom() + getAtributs()+">" + getContingut() + " " + subetiquetesAtext()+ "</" + getNom()+">";
    }

    public void afegirAtribut(String name, String value){
        if(!this.atributs.contains(new Atribut(name, value))){
            this.atributs.add(new Atribut(name, value));
        }
    }
}