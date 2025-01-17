package e02_XML.src;

public class App {
    public static void main(String[] args) throws Exception {
        
        Etiqueta html = new Etiqueta("html");

        Etiqueta head1 = new Etiqueta("head");
        html.getSubEtiquetes().add(head1);

        Etiqueta title1 = new Etiqueta("title");
        title1.setContingut("Un titol per al browser de torn");

        head1.getSubEtiquetes().add(title1);

        title1.afegirAtribut("titol", "prova");
        title1.afegirAtribut("titol2", "prova2");
        System.out.println(html);
    }
}
