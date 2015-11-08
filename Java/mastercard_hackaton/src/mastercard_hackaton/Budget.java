/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mastercard_hackaton;

import java.util.ArrayList;

/**
 *
 * @author Raymond
 */
public class Budget {
    int budget;
    public static ArrayList<Category> catas = new ArrayList();
    
    Budget(int b) {
        budget = b;
    }
    
    void addCategories(int food, int rent, int util, int transport, int other) {
        catas.add(new Category("food", food));
        catas.add(new Category("utility", util));
        catas.add(new Category("transport", transport));
        catas.add(new Category("other", other));
    }
    
}
