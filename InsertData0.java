package mysql;

import java.util.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class InsertData0 {

	public static void main(String args[]) throws SQLException {
		Scanner sc = new Scanner(System.in);
		String url="jdbc:mysql://localhost:3306/ajwp";
		String user="root";
		String pass="dhrup";
		
		Connection con=DriverManager.getConnection(url,user,pass);
		
		Statement st=con.createStatement();
		
		String q="insert into student01 values (?,?,?)";
		
		PreparedStatement ps=con.prepareStatement(q);
		System.out.println("Enter the ID:");
		int rn=sc.nextInt();
		System.out.println("Enter the Name:");
		String nm=sc.next();
		System.out.println("Enter the Per:");
		float per=sc.nextFloat();
		
		ps.setInt(1,rn);
		ps.setString(2,nm);
		ps.setFloat(3,per);
		
		int result=ps.executeUpdate();
		
		ResultSet rs=st.executeQuery("select * from student01;");
		
		System.out.println(" No of rows affected"+result);
		
		System.out.println("Data insert Successfully");
		System.out.println("");
		
		System.out.println(" Roll No: "+" Name "+" Per ");
		while(rs.next()) {
			System.out.println(rs.getInt(1)+"  "+rs.getString(2)+"  "+rs.getFloat(3));
		}
	}
	
}
