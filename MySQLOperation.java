package mysql;

import java.sql.SQLException;
import java.util.*;

public class MySQLOperation {

	public static void main(String[] args) throws SQLException {
		Scanner sc=new Scanner(System.in);

		CURDOperation c=new CURDOperation();
		int ch;
		
		do {
            System.out.println("\n--- MySQL Operations ---");
            System.out.println("1 : Insert"); 
            System.out.println("2 : Update"); 
            System.out.println("3 : Delete"); 
            System.out.println("4 : Display"); 
            System.out.println("5 : Exit"); 
            System.out.print("Choose the Operation: "); 
            ch = sc.nextInt(); 

            switch(ch) {
                case 1:
                    c.insert();
                    break;
                case 2:
                   c.update();
                    break;
                case 3:
                    c.delete();
                    break;
                case 4:
                    c.display();
                    break;
                case 5:
                	 System.out.println("Exiting application. Goodbye!");
                     break;
                default:
                    System.out.println("Invalid choice! Please enter a number between 1 and 5.");
            }
        } while(ch != 5);
		
		sc.close();
	}

}

