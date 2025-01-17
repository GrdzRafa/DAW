package e02_XML.src;

import java.util.Objects;

public class Atribut {
    private String name;
    private String value;

    public Atribut(String name, String value) {
        this.name = name;
        this.value = value;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getValue() {
        return value;
    }

    public void setValue(String value) {
        this.value = value;
    }

    @Override
    public String toString() {
        return " "+getName() + "=" + getValue() + " ";
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Atribut other = (Atribut) obj;
        return Objects.equals(this.name, other.name);
    }

    
}


