/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mastercard_hackaton;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintStream;
import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.ServerSocket;
import java.net.Socket;
import java.net.URL;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;
import sun.misc.BASE64Encoder;

/**
 *
 * @author Raymond
 */
public class Mastercard_hackaton {
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException{
        // TODO code application logic here
        ServerSocket ss = new ServerSocket(8080);
        while(true) {
            System.out.println("waiting for connection");
            Socket s = ss.accept();
            if (handshake(s)) {
                new ProcessConnection(s).start();
            }
            //new ProcessConnection(s).start();
        }
        
    }
    
    private static boolean handshake(Socket sock) throws IOException {
        System.out.println("handshake start");
        PrintWriter out = new PrintWriter(sock.getOutputStream());
        BufferedReader in = new BufferedReader(new InputStreamReader(sock.getInputStream()));
        HashMap<String, String> keys = new HashMap<>();
        String str;

        while (!(str = in.readLine()).equals("")) {
            String[] s = str.split(": ");
            System.out.println(str);
            if (s.length == 2) {
                keys.put(s[0], s[1]);
            }
        }

        String hash;
        try {
            hash = new BASE64Encoder().encode(MessageDigest.getInstance("SHA-1").digest((keys.get("Sec-WebSocket-Key") + "258EAFA5-E914-47DA-95CA-C5AB0DC85B11").getBytes()));
        } catch (NoSuchAlgorithmException ex) {
            ex.printStackTrace();
            return false;
        }

        out.write("HTTP/1.1 101 Switching Protocols\r\n"
            + "Upgrade: websocket\r\n"
            + "Connection: Upgrade\r\n"
            + "Sec-WebSocket-Accept: " + hash + "\r\n"
            + "\r\n");
        out.flush();

        return true;
    }
}

class ProcessConnection extends Thread {
    private static Object doc;
    Socket s;
    ProcessConnection(Socket a) {
        s = a;
    }
    
    public void run() {
        try {
            System.out.println("thread start");
            Scanner sin = new Scanner(s.getInputStream()); // accepts
            PrintStream sout = new PrintStream(s.getOutputStream()); //the stream that sends back to site
            String input = sin.nextLine(); //next line of accept
            System.out.println(input);
            int request = 0; //figure out what it being requested
            String message = processRequest(request); //what we are sending back
            System.out.println(message); //test
            sout.print(message); //sends back to site
            
            s.close(); //closes the connection

            }
            catch(IOException e) {}
    }
    
    public static String processRequest(int code) {
        String data = "";
        //resturant = 5811
        switch(code) {
            case 0: //All nearby resturants
                return "hi jimmy";
                
        }
                
        
        return data;
    }
    
    public static ArrayList<Location> getLocations(String zip, String mcc) throws IOException{
        ArrayList<Location> locs = new ArrayList();
        
        URL url = new URL("http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode="
        + zip + "&MCCCode=" + mcc);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        
        BufferedReader rd = new BufferedReader(
            new InputStreamReader(conn.getInputStream()));
        StringBuilder sb = new StringBuilder();
        String line;
        while ((line = rd.readLine()) != null) {
            sb.append(line);
        }
        rd.close();

        conn.disconnect();
        String data = sb.toString();
        
        String[] sData = data.split("</MerchantPOI>");
        for (int i = 0; i < sData.length - 2; i++) { //the last value is useless
            String current = sData[i];
            String city = "<CleansedCityName";
            String name = "<CleansedMerchantName";
            String addr = "<CleansedMerchantStreetAddress";
            String phone = "<CleansedMerchantTelephoneNumber";
            String state = "<CleansedStateProvidenceCode";
            int cityIdx = current.indexOf(city) + city.length() - 1;
            int nameIdx = current.indexOf(name) + name.length() - 1;
            int addrIdx = current.indexOf(addr) + addr.length() - 1;
            int phoneIdx = current.indexOf(phone) + phone.length() - 1;
            int stateIdx = current.indexOf(state) + state.length() - 1;
            
            int cityIdx2 = current.substring(cityIdx).indexOf("</CleansedCityName");
            int nameIdx2 = current.substring(nameIdx).indexOf("</CleansedMerchantName");
            int addrIdx2 = current.substring(addrIdx).indexOf("</CleansedMerchantStreetAddress");
            int phoneIdx2 = current.substring(phoneIdx).indexOf("</CleansedMerchantTelephoneNumber");
            int stateIdx2 = current.substring(stateIdx).indexOf("</CleansedStateProvidenceCode");
            
            Location currentLoc = new Location();
            
            //System.out.println(current.substring(cityIdx+2, cityIdx2));
            
            if (current.substring(cityIdx+1, cityIdx+2).equals(">")) { currentLoc.city = current.substring(cityIdx+2, cityIdx2 + cityIdx); } 
            if (current.substring(nameIdx+1, nameIdx+2).equals(">")) { currentLoc.name = current.substring(nameIdx+2, nameIdx2 + nameIdx); }
            if (current.substring(addrIdx+1, addrIdx+2).equals(">")) { currentLoc.address = current.substring(addrIdx+2, addrIdx2 + addrIdx); }
            if (current.substring(phoneIdx+1, phoneIdx+2).equals(">")) { currentLoc.phone = current.substring(phoneIdx+2, phoneIdx2 + phoneIdx); }
            if (current.substring(stateIdx+1, stateIdx+2).equals(">")) { currentLoc.state = current.substring(stateIdx+2, stateIdx2 + stateIdx); }
            
            locs.add(currentLoc);
        }
        
        return locs;
    }
}



