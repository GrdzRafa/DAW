package src.Model;

public class Partit{
    private String siglesPartit;

    public Partit(String siglesPartit) {
        this.siglesPartit = siglesPartit;
    }

    public String getSiglesPartit() {
        return siglesPartit;
    }

    public void setSiglesPartit(String siglesPartit) {
        this.siglesPartit = siglesPartit;
    }

    @Override
    public String toString() {
        return "Partit{" +
                "siglesPartit='" + siglesPartit + '\'' +
                '}';
    }
}
