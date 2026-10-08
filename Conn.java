package mysql;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;


public class Conn {

	public static void main(String args[]) throws ClassNotFoundException, SQLException {		
		
//		Class.forName("com.mysql.cj.jdbc.Driver");
		
		Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/ajwp","root","dhrup");
		
		Statement st=con.createStatement();
		
		String q="select * from student01";
		
		ResultSet rs=st.executeQuery(q);
		
		while(rs.next()) {
			System.out.println(rs.getInt(1)+" "+rs.getString(2)+"  "+rs.getFloat(3));			
			
		}
	}
}