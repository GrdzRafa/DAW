import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class App {
    public static void main(String[] args) {
        try {
            Equip barcelona = new Equip("Barcelona");
            Jugador messi = new Jugador("Lionel", "Messi", 36, "Davanter", 10, 5000000, new Date());
            messi.afegirTrofeuIndividual("Baló d'Or");
            barcelona.afegirJugador(messi);

            Jugador terStegen = new Jugador("Marc", "Ter Stegen", 31, "Porter", 1, 2000000, new Date());
            barcelona.afegirJugador(terStegen);

            System.out.println(barcelona);

            List<Jugador> topJugadores = new ArrayList<>(barcelona.getJugadors());

            for (int i = 0; i < topJugadores.size() - 1; i++) {
                for (int j = i + 1; j < topJugadores.size(); j++) {
                    if (topJugadores.get(i).getValorJugador() < topJugadores.get(j).getValorJugador()) {
                        Jugador temp = topJugadores.get(i);
                        topJugadores.set(i, topJugadores.get(j));
                        topJugadores.set(j, temp);
                    }
                }
            }

            System.out.println("\nTop 5 jugadores:");

            for (int i = 0; i < 5 && i < topJugadores.size(); i++) {
                System.out.println(topJugadores.get(i));
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
