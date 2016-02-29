package base;

import dominio.Usuario;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class UsuarioDAO {
    
    private Conexao con;
    private Statement stm;
    
    public UsuarioDAO(Conexao con) {
        try {
            this.con = con;
            stm = con.getCon().createStatement();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
    
    public Usuario consultaUsuario(String nome, String senha) { 
        try { 
            String query = "SELECT * FROM login WHERE usuario='"+nome+"'";
            ResultSet rs = con.consultar(query,true);
            rs.next();
            if (rs.getString("usuario")!=null) {
                String usuario = rs.getString("usuario");
                String password = rs.getString("senha");
                String tipo = rs.getString("tipo");
                Usuario us;
                if (password.equals(senha)) {
                    us = new Usuario(usuario,password,tipo); // usuario encontrado, senha correta
                    return us;
                } else {
                    us = new Usuario("","",""); // usuario encontrado, senha incorreta
                    return us;
                }
            }
            return null; // usuario nao encontrado
        } catch (SQLException ex) {
           ex.printStackTrace();
           return null;
        }
    }
    
    public String inserirUsuario(Usuario user) {
        try {
            Usuario usuario = consultaUsuario(user.getNome(),user.getSenha()); 
            if (usuario==null) {
                String query = "INSERT INTO login(usuario,senha,tipo) VALUES ('"+user.getNome()+"','"+user.getSenha()+"','"+user.getTipoUsuario()+"')";
                con.consultar(query,false);
                return "Usuario inserido com sucesso.";
            } else {
                return "Já existe um usuário com esse login. Favor escolher outro.";
            }
        } catch (SQLException ex) {
            ex.printStackTrace();
            return "Erro ao incluir usuario";
        }
    }
    
}
