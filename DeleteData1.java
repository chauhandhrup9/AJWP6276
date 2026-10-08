package mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

public class DeleteData1 {

	public static void main(String args[]) throws SQLException {
		
		String url="jdbc:mysql://localhost:3306/ajwp";
		String user="root";
		String pass="dhrup";
		
		Connection con=DriverManager.getConnection(url,user,pass);
		
		String q="delete from student01 where id=106;";
		
		PreparedStatement ps=con.prepareStatement(q);
		
		int rs=ps.executeUpdate();
		
		System.out.println(" No of rows affected"+rs);
		
		System.out.println("Data insert Successfully");
	}
	
}
