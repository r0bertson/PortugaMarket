package dominio;

public class Usuario {
    
    private String nome;
    private String senha;
    private String tipoUsuario;
    
    public Usuario(String nome, String senha, String tipoUsuario) {
        this.nome = nome;
        this.tipoUsuario = tipoUsuario;
        this.senha = senha;
    }
    
    //Getters and Setters

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getSenha() {
        return senha;
    }

    public void setSenha(String senha) {
        this.senha = senha;
    }

    public String getTipoUsuario() {
        return tipoUsuario;
    }

    public void setTipoUsuario(String tipoUsuario) {
        this.tipoUsuario = tipoUsuario;
    }
 
}
