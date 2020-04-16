
import java.io.*;
import java.net.*;

/**
 * SMTP command codes
 * 
211 System status, or system help reply
214 Help message
            [Information on how to use the receiver or the meaning of a
            particular non-standard command; this reply is useful only
            to the human user]
220 <domain> Service ready
221 <domain> Service closing transmission channel
250 Requested mail action okay, completed
251 User not local; will forward to <forward-path>
354 Start mail input; end with <CRLF>.<CRLF>
*/
public class MailServer // press Ctrl-C to terminate this program
{
	public static void main(String[] args) {
		try {
			ServerSocket ss = new ServerSocket(25); // specify port number.
			System.out.println(
				"MailServer listening at "
					+ InetAddress.getLocalHost()
					+ " on port "
					+ ss.getLocalPort());
			while (true) {
				Socket s = ss.accept(); //wait for new client to call

				BufferedReader dis =
					new BufferedReader(new InputStreamReader(s.getInputStream()));

				PrintWriter dos =
					new PrintWriter(
						new OutputStreamWriter(s.getOutputStream(), "US-ASCII"),
						true);

				dos.println("220");
				System.out.println("\nConnection made!!!!!");
				String message;

				System.out.println("Message coming from E-mail client :\n");
				message = "\t" + dis.readLine(); // wait for client to send
				System.out.println(message);
				dos.println("250 " + InetAddress.getLocalHost());

				message = "\t" + dis.readLine(); // wait for client to send
				System.out.println(message);
				dos.println("250 OK");

				message = "\t" + dis.readLine(); // wait for client to send
				System.out.println(message);
				dos.println("250 OK");

				message = "\t" + dis.readLine(); // wait for client to send
				System.out.println(message);
				dos.println("354 GO AHEAD");

				boolean done = false;
				while (!done) {
					message = "\t" + dis.readLine(); // wait for client to send
					if (message.trim().startsWith("."))
						done = true;
					System.out.println(message);
				}

				dos.println("250 OK");
				dos.println("221 " + InetAddress.getLocalHost() + "\r");

			}
		}
		catch (Exception e) {
			System.out.println(e);
		}
	}
}