package lista;

public class Lista {
	public class Node {
		private Object dada;
		private Node seguent;

		public Node(Object e) {
			if (e == null) {
				throw new NullPointerException("No se puede añadir un nulo");
			}
			this.dada = e;
			this.seguent = null;
		}
	}

	private Node primer;

	public Lista() {
		this.primer = null;
	}

	public boolean isEmpty() {
		return this.primer == null;
	}

	public void add(Object e) {
		Node aux = new Node(e);
		aux.seguent = this.primer;
		this.primer = aux;
	}

	public boolean isIn(Object e) {
		Node aux = this.primer;
		while (aux != null) {
			if (aux.dada.equals(e))
				return true;
			aux = aux.seguent;
		}
		return false;
	}

	public void remove(Object e) {
		if (this.isIn(e)) {
			if (this.primer.equals(e)) {
				this.primer = this.primer.seguent;
			} else {
				Node aux = this.primer.seguent;
				Node anterior = this.primer;
				while (aux != null) {
					if (!aux.dada.equals(e)) {
						aux = aux.seguent;
						anterior = anterior.seguent;
					} else {
						anterior.seguent = aux.seguent;
						aux = null;
					}
				}
			}
		}
	}

	public int size() {
		int tamany = 0;
		Node aux = this.primer;

		while (aux != null) {
			tamany++;
			aux = aux.seguent;
		}
		return tamany;
	}

	public void clear() {
		this.primer = null;
	}

	public Object get(int i) {
		//

		Node aux = this.primer;
		int j = 0;
		while (aux != null) {
			if (j == i) {
				return aux.dada;
			}
			aux = aux.seguent;
			j++;

		}
		return null;
	}

	public int getIndex(Object e) {
		Node aux = this.primer;
		int i = 0;

		while (aux != null) {
			if (aux.dada.equals(e)) {
				return i;
			}
			aux = aux.seguent;
			i++;
		}
		return -1;
	}

	public int lastIndexOf(Object e) {
		Node aux = this.primer;
		int i = 0;
		int lastIndex = -1;

		while (aux != null) {
			if (aux.dada.equals(e)) {
				lastIndex = i;
			}
			aux = aux.seguent;
			i++;
		}
		return lastIndex;
	}

	public void removeIndex(int i) {
		if (i == 0) {
			this.primer = this.primer.seguent;
			return;
		}

		Node aux = this.primer;
		int j = 0;

		while (aux.seguent != null) {
			if (j == i - 1) {
				aux.seguent = aux.seguent.seguent;
				return;
			}
			aux = aux.seguent;
			j++;
		}
	}

	public void set(Object e, int i) {
		Node aux = this.primer;
		int index = 0;
	
		while (aux != null) {
			if (index == i) {
				aux.dada = e;
				return;
			}
			aux = aux.seguent;
			index++;
		}
	}

	public Object[] toArray() {
		Object[] array = new Object[this.size()];
		Node aux = this.primer;
		int index = 0;
	
		while (aux != null) {
			array[index] = aux.dada;
			aux = aux.seguent;
			index++;
		}
		return array;
	}

	@Override
	public String toString() {
		String result = "";
		Node aux = this.primer;

		while (aux != null) {
			result += aux.dada.toString() + "-";
			aux = aux.seguent;
		}
		return result;
	}

}
