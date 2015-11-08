/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mastercard_hackaton;

/**
 *
 * @author Raymond
 */
public class Profile {
    User user;
    Budget budget;
    String cycle = "BiWeekly";
    
    Profile(User u, Budget b) {
        user = u;
        budget = b;
    }

}
