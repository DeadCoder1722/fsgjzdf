/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mastercard_hackaton;

import static java.lang.Math.random;
import java.util.ArrayList;
import java.util.Random;
/**
 *
 * @author Richie
 */
public class JsonParse {
    public static String jsonParse(ArrayList<Location> locs, String zip){
       String JSONString = "{ \"Business\" :[ ";
       Random random = new Random();
        for (int i = 0; i< locs.size() - 1;i++){
            int price = random.nextInt(50 - 5 + 1) + 5;
            JSONString = JSONString + "{ \"Name\": \"" + locs.get(i).name + "\", "  + 
                                      "\"Address\": \"" + locs.get(i).address + "\", " + 
                                      "\"City\": \"" + locs.get(i).city + "\", "  + 
                                      "\"State\": \"" + locs.get(i).state + "\", "  + 
                                      "\"ZIP\": \"" + zip + "\", "  + 
                                      "\"Phone\": \"" + locs.get(i).phone + "\", " +
                                      "\"Website\": \"www.ThisIsAWebsite.com\", " +
                                      "\"Price\": \"" + price + "\"}," ; 
        }
        JSONString = JSONString.substring(0, JSONString.length()-1);
        JSONString = JSONString + "] }";
        return JSONString;
    }
}
