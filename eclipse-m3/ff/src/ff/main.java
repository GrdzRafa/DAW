package ff;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.UnknownHostException;

public class main {

	public static void main(String[] args) throws SocketException, UnknownHostException {

		try(final DatagramSocket socket = new DatagramSocket()){
		  socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
		  var ip = socket.getLocalAddress().getHostAddress();
			System.out.println(ip instanceof String);
		}

	}

}
