package mysql;

import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

public class InsertCallable {

	public static void main(String[] args) throws SQLException {

		Scanner sc=new Scanner(System.in);
		
		String url="jdbc:mysql://localhost:3306/ajwp";
		String user="root";
		String pass="dhrup";
		
		Connection con=DriverManager.getConnection(url,user,pass);
		
		CallableStatement cs=con.prepareCall("call insertAll(?,?,?)");
		
		System.out.println("Enter ID :");
		int rn=sc.nextInt();
		
		System.out.println("Enter Name :");
		String nm=sc.next();
		
		System.out.println("Enter Per :");
		double per=sc.nextDouble();
		
		
		cs.setInt(1, rn);
		cs.setString(2, nm);
		cs.setDouble(3, per);
		
//		boolean result= cs.execute();
		
		int rs=cs.executeUpdate();
		
		System.out.println("Stored procedure execute "+rs);
		
//		System.out.println("\n--------------- Student Details ---------------");
//		System.out.printf("%-10s %-20s %-10s%n", "ID", "Name", "Percentage");
//	    System.out.println("-----------------------------------------------");
//
//	    while (rs.next()) {
//	        System.out.printf("%-10d %-20s %-10.2f%n",
//	                rs.getInt(1),
//	                rs.getString(2),
//	                rs.getFloat(3));
//	    }
//
//	    rs.close();
	    sc.close();
	}

}

//mysql> create procedure insertAll(
//	    -> IN id int,
//	    -> IN name varchar(25),
//	    -> IN per float
//	    -> )
//	    -> begin
//	    -> insert into student01 values(id,name,per);
//	    -> end
//	    -> @@
//	Query OK, 0 rows affected (0.04 sec)
