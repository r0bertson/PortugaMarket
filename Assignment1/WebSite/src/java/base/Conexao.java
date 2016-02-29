package base;

import java.sql.Statement;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;

public class Conexao {
        private Connection con;
	private ResultSet rs;
	private ResultSetMetaData rsmd;
	private Statement stm;

	public Conexao() {
		try {
                    con = DriverManager.getConnection("jdbc:postgresql://localhost:5432/pizzaria","postgres","aluno"); 
                    stm = (Statement) con.createStatement();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	public ResultSet Construtor (String consulta) {
		ResultSet retorno = null;
		return retorno;
	}

	public ResultSet consultar (String consulta, boolean metaData) throws SQLException{
		stm = (Statement) con.createStatement(); //para ele poder ser executado várias vezes sem que feche o resultset
                stm.execute(consulta);
                if (metaData) { // algumas operaçoes, como as de inserção, o metaData retorna nulo, portanto só sera pego em algumas
                    rs = stm.getResultSet();
                    rsmd = rs.getMetaData();
                }
		return rs;

	}           
       
	/**Getters and Setters*/
	public Connection getCon() {
		return con;
	}

	public void setCon(Connection con) {
		this.con = con;
	}

	public ResultSet getRs() {
		return rs;
	}

	public void setRs(ResultSet rs) {
		this.rs = rs;
	}

	public ResultSetMetaData getRsmd() {
		return rsmd;
	}

	public void setRsmd(ResultSetMetaData rsmd) {
		this.rsmd = rsmd;
	}

	public Statement getStm() {
		return stm;
	}

	public void setStm(Statement stm) {
		this.stm = stm;
	}
}
