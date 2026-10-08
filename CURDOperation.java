package mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Scanner;

public class CURDOperation {
	Connection con;
	Scanner sc = new Scanner(System.in);
	Statement st;
	PreparedStatement ps;

	CURDOperation() throws SQLException {
		String url = "jdbc:mysql://localhost:3306/ajwp";
		String user = "root";
		String pass = "dhrup";
		con = DriverManager.getConnection(url, user, pass);
		st = con.createStatement();

	}

	void insert() throws SQLException {
		System.out.println("Enter the ID :");
		int id = sc.nextInt();

		System.out.println("Enter the Name :");
		String nm = sc.next();

		System.out.println("Entre the Percentage :");
		double per = sc.nextDouble();

		String q = "insert into student01 values (?,?,?);";

		ps = con.prepareStatement(q);

		ps.setInt(1, id);
		ps.setString(2, nm);
		ps.setDouble(3, per);

		int rs = ps.executeUpdate();

		System.out.println("No Of Row Affected " + rs);

	}

	void update() throws SQLException {
		System.out.println("Enter the ID :");
		int id=sc.nextInt();
		
		System.out.println("Entre the Name :");
		String nm=sc.next();
		
		String q = "update student01 set name=? where id=?;";

		ps = con.prepareStatement(q);

		ps.setInt(2, id);
		ps.setString(1, nm);
	
		int rs = ps.executeUpdate();

		System.out.println("No Of Row Affected " + rs);
		
		}

	void delete() throws SQLException {
		System.out.println("Enter the row ID to delete it :");
		int id=sc.nextInt();
		
		String q = "delete from student01 where id=?";

		ps = con.prepareStatement(q);

		ps.setInt(1, id);
		
	
		int rs = ps.executeUpdate();

		System.out.println("No Of Row Affected " + rs);
		
	}

	void display() throws SQLException {
	    System.out.println("\n----------- Student Details -------------------");

	    String q = "CALL getall();";

	    ResultSet rs = st.executeQuery(q);

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
	
//	void display() throws SQLException {
//		System.out.println("----Table Display----");
//		
//		//String q="select * from student01;";
//		String q="call getall();";
//		
//		ResultSet rs=st.executeQuery(q);
//		
//		System.out.println("ID   Name   Per");
//		while(rs.next()) {
//			System.out.println(rs.getInt(1)+" "+rs.getString(2)+" "+rs.getFloat(3));
//		}
//		
//	}

}

//void create() throws SQLException {
//	
//	
//	System.out.println("Enter the table name :");
//	int nm=sc.nextInt();
//
//    st.executeUpdate("CREATE TABLE IF NOT EXISTS "+nm+"(id INT PRIMARY KEY,name VARCHAR(30),per DOUBLE)");
//
//}
