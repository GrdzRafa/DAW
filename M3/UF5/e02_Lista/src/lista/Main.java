package lista;

public class Main {

	public static void main(String[] args) {
		
		Lista miLista = new Lista();
        miLista.add(Integer.valueOf(9));
        miLista.add(new String("hola"));
        miLista.add(Double.valueOf(3.33));
        miLista.add(new String("adeu"));
		miLista.add(new String("hola"));
		
        System.out.println(miLista.size());
        System.out.println(miLista.isIn("hola"));
        System.out.println(miLista);
        System.out.println(miLista.get(2));
        System.out.println(miLista.getIndex(3.33));
        System.out.println(miLista.lastIndexOf("hola"));
        miLista.removeIndex(1);
        System.out.println(miLista);
        miLista.set("nuevo", 0);
        System.out.println("------------------------");
		System.out.println(miLista);
		System.out.println("------------------------");
        Object[] array = miLista.toArray();
        for (Object obj : array) {
            System.out.println(obj);
        }
	}

}
