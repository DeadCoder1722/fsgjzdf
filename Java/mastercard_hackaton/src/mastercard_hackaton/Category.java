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
public class Category {
    String name;
    int target;
    int currentAmt;
    
    Category(String n, int t) {
        name = n;
        target = t;
    }
}
