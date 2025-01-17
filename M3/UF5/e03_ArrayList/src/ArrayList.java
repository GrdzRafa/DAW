public class ArrayList {
    private class Element {
        protected Object dada;
        protected Element seguent;
        protected Element anterior;

        public Element() {
        }

        public Element(Object parametre) {
            this.dada = parametre;
        }

    }

    private Element primer;

    public ArrayList() {
        this.primer = new Element();
    }

    public boolean add(Object element) {
        try {
            Element aux = new Element(element);

            if (primer.seguent == null) {
                primer.seguent = aux;
                aux.anterior = aux;
                aux.seguent = aux;
                return true;
            } else {
                primer.seguent.anterior.seguent = aux;
                aux.seguent = primer.seguent;
                aux.anterior = primer.seguent.anterior;
                primer.seguent.anterior = aux;
            }
            return true;
        } catch (Exception e) {
            return false;
        }
    }

    public void add(int index, Object element) throws Exception {
        try {
            if (primer.seguent == null) {
                if (index != 0) {
                    throw new IndexOutOfBoundsException();
                }
                this.add(element);
                return;
            }

            if (index < 0) {
                throw new IndexOutOfBoundsException();
            }

            Element nou = new Element(element);
            Element aux = primer.seguent;
            int cont = 0;

            while (cont < index) {
                aux = aux.seguent;
                cont++;
                if (aux == primer.seguent) {
                    // Possibilitat 1
                    // si l'index es més gran que el size de la llista
                    // s'afegeix al final
                    System.out.println("primer if");
                    this.add(element);

                    // Possibilitat 2
                    // throw new IndexOutOfBoundsException();
                }
            }

            nou.seguent = aux;
            nou.anterior = aux.anterior;
            aux.anterior.seguent = nou;
            aux.anterior = nou;

            if (index == 0) {
                primer.seguent = nou;
            }
        } catch (Exception e) {
            throw new Exception(e);
        }
    }

    public void clear() {
        this.primer.seguent = null;
    }

    public boolean contains(Object o) {
        if (primer.seguent == null) {
            return false;
        }

        Element aux = primer.seguent;
        do {
            if ((o == null && aux.dada == null) || (o != null && o.equals(aux.dada))) {
                return true;
            }
            aux = aux.seguent;
        } while (aux != primer.seguent);
        return false;
    }

    public void ensureCapacity(int minCapacity) {
        // Increases the capacity of this ArrayList instance,
        // if necessary, to ensure that it can hold at least
        // the number of elements specified by the minimum capacity
        // argument.

        // no l'he fet perque en un ArrayList no li veig sentit
        // ES com el métode que vas dir que no fem de: crear
        // un arraylist amb un valor inicial. Perque a l'array list es poden
        // afegir elements sense modificar la capacitat abans de fer-ho
    }

    public Object get(int index) {
        if (primer.seguent == null) {
            throw new IndexOutOfBoundsException();
        }
        Element aux = primer.seguent;
        int cont = 0;
        do {
            if (cont == index) {
                return aux.dada;
            }
            aux = aux.seguent;
            cont++;
        } while (aux != primer.seguent);

        throw new IndexOutOfBoundsException();
    }

    public int indexOf(Object o) {
        if (primer.seguent == null) {
            return -1;
        }
        Element aux = primer.seguent;
        int index = 0;
        do {
            if ((o == null && aux.dada == null) || (o != null && o.equals(aux.dada))) {
                return index;
            }
            aux = aux.seguent;
            index++;
        } while (aux != primer.seguent);

        return -1;
    }

    public boolean isEmpty() {
        // return this.primer.seguent == null;
        return primer.seguent == null;
    }

    public int lastIndexOf(Object o) {
        if (primer.seguent == null) {
            return -1;
        }
        Element aux = primer.seguent;
        int index = -1;
        int currentIndex = 0;
        do {
            if ((o == null && aux.dada == null) || (o != null && o.equals(aux.dada))) {
                index = currentIndex;
            }
            aux = aux.seguent;
            currentIndex++;
        } while (aux != primer.seguent);
        return index;
    }

    public Object remove(int index) {
        try {
            Element aux = primer.seguent;
            int cont = 0;
            while (cont < index) {
                aux = aux.seguent;
                if (primer.seguent == aux) {
                    throw new IndexOutOfBoundsException();
                } else {
                    cont++;
                }
            }

            aux.anterior.seguent = aux.seguent;
            aux.seguent.anterior = aux.anterior;
            return aux.dada;
        } catch (IndexOutOfBoundsException e) {
            return e;
        }
    }

    public boolean remove(Object o) {
        if (primer.seguent == null) {
            return false; // Lista vacía
        }
        Element actual = primer.seguent;
        do {
            if ((o == null && actual.dada == null) || (o != null && o.equals(actual.dada))) {
                if (actual.seguent == actual) {
                    primer.seguent = null;
                } else {
                    actual.anterior.seguent = actual.seguent;
                    actual.seguent.anterior = actual.anterior;
                    if (actual == primer.seguent) {
                        primer.seguent = actual.seguent;
                    }
                }
                return true;
            }
            actual = actual.seguent;
        } while (actual != primer.seguent);
        return false;
    }

    public void removeRange(int fromIndex, int toIndex) throws Exception {
        try {
            if (fromIndex < 0 || toIndex <= fromIndex) {
                throw new Exception();
            }

            int cont = 0;
            Element actual = primer.seguent;
            while (cont < fromIndex && actual != null) {
                actual = actual.seguent;
                cont++;
            }
            for (int i = fromIndex; i < toIndex; i++) {
                Element siguiente = actual.seguent;
                actual.anterior.seguent = siguiente;
                siguiente.anterior = actual.anterior;
                if (actual == primer.seguent) {
                    primer.seguent = siguiente;
                    actual = siguiente;
                }
            }
        } catch (Exception e) {
            throw new Exception(e);
        }

    }

    public Object set(int index, Object element) throws Exception {

        try {
            if (index < 0 || primer.seguent == null) {
                throw new IndexOutOfBoundsException();
            }
            Element actual = primer.seguent;
            int cont = 0;
            do {
                if (cont == index) {
                    Object oldData = actual.dada;
                    actual.dada = element;
                    return oldData;
                }
                actual = actual.seguent;
                cont++;
            } while (actual != primer.seguent);
    
            throw new IndexOutOfBoundsException();
        } catch (Exception e) {
            throw new Exception(e);
        }

    }

    public int size() {
        int cont = 0;
        Element actual = primer.seguent;
        do {
            cont++;
            actual = actual.seguent;
        } while (actual != primer.seguent);
        return cont;
    }

    // public ArrayList subList(int fromIndex, int toIndex) {
    //     // Returns a view of the portion of this list between the specified
    //     // fromIndex, inclusive, and toIndex, exclusive.
    // }

    public Object[] toArray(){
        int size = size();
        Object[] array = new Object[size];
        Element actual = primer.seguent;
        for (int i = 0; i < size; i++) {
            array[i] = actual.dada;
            actual = actual.seguent;
        }
        return array;
    }

    // public void trimToSize() {
    //     // Trims the capacity of this ArrayList instance
    //     // to be the list's current size.
    // }

    // public Object clone() {
    //     // Returns a shallow copy of this ArrayList instance.
    //     // (The elements themselves are not copied.)

    // }

    @Override
    public String toString() {
        String cadena = "";
        int index = 0;
        Element punter = this.primer.seguent;
        if (!this.isEmpty() && this.primer.seguent != null && punter != null) {
            cadena = "";
            do {
                cadena += "[" + index + ", ant: " + punter.anterior.dada + ", dada: " + punter.dada + ", seg:"
                        + punter.seguent.dada + "] ";
                index++;
                punter = punter.seguent;
            } while (punter != this.primer.seguent);
        } else {
            System.err.println("ArrayList esta buït");
        }
        return cadena;
    }

}
