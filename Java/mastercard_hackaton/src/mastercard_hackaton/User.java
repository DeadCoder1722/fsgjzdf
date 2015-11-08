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
public class User {
    String username; //madatory
    String password; //mandatory
    String fname; //optional
    String lname; //optional
    int salary; //optional
    String email; //optional
    
    User(String name, String pass, String mail) {
        username = name;
        password = pass;
        email = mail;
    }
    
    User(String name, String pass, String first, String last, int cash, String mail) {
        username = name;
        password = pass;
        fname = first;
        lname = last;
        salary = cash;
        email = mail;
    }
    
    
}
