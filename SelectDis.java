package mysql;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;

public class SelectDis {

	public static void main(String[] args) throws SQLException {

		String url="jdbc:mysql://localhost:3306/ajwp";
		String user="root";
		String pass="dhrup";
		
		Connection con=DriverManager.getConnection(url,user,pass);
		
		CallableStatement cs=con.prepareCall("call getAll()");
		
		boolean result= cs.execute();
		
		ResultSet rs=cs.executeQuery();
		
		System.out.println("Stored procedure execute "+result);
		
		System.out.println("\n--------------- Student Details ---------------");
		System.out.printf("%-10s %-20s %-10s%n", "ID", "Name", "Percentage");
	    System.out.println("-----------------------------------------------");

	    while (rs.next()) {
	        System.out.printf("%-10d %-20s %-10.2f%n",
	                rs.getInt(1),
	                rs.getString(2),
	                rs.getFloat(3));
	    }

	    rs.close();
	}

}
