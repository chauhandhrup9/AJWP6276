package mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.Scanner;

public class UpdateData {

	public static void main(String args[]) throws SQLException {
		
		Scanner sc=new Scanner(System.in);
		
		String url="jdbc:mysql://localhost:3306/ajwp";
		String user="root";
		String pass="dhrup";
		
		Connection con=DriverManager.getConnection(url,user,pass);
		
		String q="update student01 set name=?  where id=?;";
		
		PreparedStatement ps=con.prepareStatement(q);
		
		System.out.println("Enter the ID:");
		int id=sc.nextInt();
		System.out.println("Entre the Name:");
		String nm=sc.next();
		
		ps.setInt(2,id);
		ps.setString(1,nm);
		
		int rs=ps.executeUpdate();
		
		System.out.println(" No of rows affected"+rs);
		
		System.out.println("Data insert Successfully");
	}
	
}
