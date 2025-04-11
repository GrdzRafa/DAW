import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

class Equip {
    private String nom;
    private List<Jugador> jugadors;
    private List<String> trofeusEquip;
    private Map<String, Integer> limitsPosicio;

    public Equip(String nom) {
        this.nom = nom;
        this.jugadors = new ArrayList<>();
        this.trofeusEquip = new ArrayList<>();
        this.limitsPosicio = new HashMap<>();
        limitsPosicio.put("Porter", 2);
        limitsPosicio.put("Defensa", 5);
        limitsPosicio.put("Mediocentre", 7);
        limitsPosicio.put("Davanter", 5);
    }

    public void afegirTrofeuEquip(String trofeu) {
        trofeusEquip.add(trofeu);
    }

    public void afegirJugador(Jugador jugador) throws DorsalRepetitException, JugadorsPerPosicioException {
        if (jugadors.size() >= 22) {
            throw new IllegalArgumentException("L'equip no pot tenir més de 22 jugadors.");
        }

        for (int i = 0; i < jugadors.size(); i++) {
            Jugador j = jugadors.get(i);
            if (j.getDorsal() == jugador.getDorsal()) {
                throw new DorsalRepetitException("El dorsal ja està assignat a un altre jugador.");
            }
        }

        String posicio = jugador.getPosicio();
        long count = 0;

        for (int i = 0; i < jugadors.size(); i++) {
            Jugador j = jugadors.get(i);
            if (j.getPosicio().equals(posicio)) {
                count++;
            }
        }

        int limit = limitsPosicio.getOrDefault(posicio, 0);

        if (count >= limit) {
            throw new JugadorsPerPosicioException("S'ha superat el límit de jugadors per a la posició: " + posicio);
        }

        jugadors.add(jugador);
    }

    public int getValorEquip() {
        int suma = 0;
        for (int i = 0; i < jugadors.size(); i++) {
            suma += jugadors.get(i).getValorJugador();
        }
        return suma;
    }

    public List<Jugador> getJugadors() {
        return jugadors;
    }

    @Override
    public String toString() {
        return "Equip: " + nom + ", Jugadors: " + jugadors.size() + ", Trofeus: " + trofeusEquip.size();
    }
}
