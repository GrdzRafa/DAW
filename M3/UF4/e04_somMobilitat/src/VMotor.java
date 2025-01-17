import java.awt.Point;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

public abstract class VMotor extends Vehicle implements Reserves {
    private String matricula;
    private String motor; 
    private double kms;
    private ArrayList<Object> reserves;

    public VMotor(Point geoL, double preu, Soci soci, String matricula, String motor, double kms) throws Exception {
        super(geoL, preu, soci);
        this.matricula = matricula;
        this.motor = motor;
        this.kms = kms;
        this.reserves = new ArrayList<>();
    }

    
    @Override
    public void addReserva(Soci s, Date d) {
        ArrayList<Object> reserva = new ArrayList<>();
        SimpleDateFormat f = new SimpleDateFormat("dd/MM/yy HH:mm");

        //comprobar si la fecha ya está en el array (hacerlo más adelante si tengo tiempo)
        reserva.add(s);
        reserva.add(f.format(d));
        reserves.add(reserva);
    }

    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    public String getMotor() {
        return motor;
    }

    public void setMotor(String motor) {
        this.motor = motor;
    }

    public double getKms() {
        return kms;
    }

    public void setKms(double kms) {
        this.kms = kms;
    }

    public ArrayList<Object> getReserves() {
        return reserves;
    }

    public void setReserves(ArrayList<Object> reserves) {
        this.reserves = reserves;
    }
}
