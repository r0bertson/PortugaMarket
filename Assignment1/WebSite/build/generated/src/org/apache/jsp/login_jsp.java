package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import base.UsuarioDAO;
import base.Conexao;
import dominio.Usuario;

public final class login_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.Vector _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public Object getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html;charset=UTF-8");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("<!DOCTYPE html>\n");
      out.write("<html>\n");
      out.write("\t<head>\n");
      out.write("\t\t<title> Login Pizzaria </title>\t\t\n");
      out.write("\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginCSS.css\">\n");
      out.write("                <script type = \"text/javascript\">\n");
      out.write("\t\t\tvar imagens = new Array (4);\n");
      out.write("\t\t\timagens[0] = \"Imagens/login1.jpg\";\n");
      out.write("\t\t\timagens[1] = \"Imagens/login2.jpg\";\n");
      out.write("\t\t\timagens[2] = \"Imagens/login3.jpg\";\n");
      out.write("\t\t\timagens[3] = \"Imagens/login4.jpg\";\n");
      out.write("\t\t\tvar cont=4;\n");
      out.write("                        \n");
      out.write("                        function mudaImagem(){\n");
      out.write("\t\t\t\tdocument.getElementById(\"img\").src = imagens[cont%4];\n");
      out.write("                                cont++;\n");
      out.write("\t\t\t}\n");
      out.write("                        \n");
      out.write("                        setInterval(\"mudaImagem()\",2000);\n");
      out.write("                        \n");
      out.write("                        function verificaCampos() {\n");
      out.write("                            if (document.login.usuario.value!=\"\") {\n");
      out.write("                                if (document.login.senha.value!=\"\") {\n");
      out.write("                                    document.login.submit();\n");
      out.write("                                } else {\n");
      out.write("                                    setaText(\"Preencha o campo <u>senha</u>\");\n");
      out.write("                                }\n");
      out.write("                            } else {\n");
      out.write("                                setaText(\"Preencha o campo <u>login</u>\");\n");
      out.write("                            }\n");
      out.write("                        }\n");
      out.write("                        \n");
      out.write("                        function setaText(txt) {\n");
      out.write("                            if (txt==\"Usuario encontrado, senha correta\") {\n");
      out.write("                                document.login.action=\"index.jsp\";\n");
      out.write("                                document.login.submit();\n");
      out.write("                            } else {\n");
      out.write("                                document.getElementById('txtResp').innerHTML = txt;\n");
      out.write("                            }\n");
      out.write("                        }\n");
      out.write("                        \n");
      out.write("                        ");

            String msgm = "Bem-vindo!";
            Conexao con = new Conexao();
            UsuarioDAO acessoUsuario = new UsuarioDAO(con);
            Usuario us = null;
            String usuario = "";
            String senha = "";
            if (request.getParameter("usuario")!=null) {
                usuario = request.getParameter("usuario"); 
                if (request.getParameter("senha")!=null) {
                    senha = request.getParameter("senha");
                    us = acessoUsuario.consultaUsuario(request.getParameter("usuario"), request.getParameter("login"));
                    if (us==null) {
                        msgm = "Usuario nao encontrado";
                    } else
                    if (us.getNome().equals("")) {
                        msgm = "Usuario encontrado, senha incorreta";
                    } else {
                        msgm = "Usuario encontrado, senha correta";
                    }
                }
            }
        
      out.write("\n");
      out.write("        \n");
      out.write("                        \n");
      out.write("\t\t</script>\n");
      out.write("\t</head>\n");
      out.write("        \n");
      out.write("\t<body style=\"overflow: hidden;\" class=\"gradiente\" onload=\"javascript:mudaImagem();javascript:setaText('");
      out.print(msgm);
      out.write("')\">\t\t\n");
      out.write("                <br/><br/><br/>\n");
      out.write("                <table border=\"0\" height=\"45%\" style=\"margin-left: 200px\">\t\t\n");
      out.write("                        <tr height=\"300px\">\n");
      out.write("                            <td width=\"800px\">\n");
      out.write("                               <form name=\"login\" action=\"login.jsp\">\n");
      out.write("                                    <table border=\"0\" width=\"30%\">    \n");
      out.write("                                        <tr>\n");
      out.write("                                            <td><img src=\"Imagens/login.png\"/></td>\n");
      out.write("                                            <td><input type=\"text\" size=\"20\" name=\"usuario\"/></td>\n");
      out.write("                                        </tr>\n");
      out.write("                                        <tr>\n");
      out.write("                                            <td><img src=\"Imagens/senha.png\"/></td>\n");
      out.write("                                            <td><input type=\"password\" name =\"senha\" size=\"20\"/></td>                                                    \n");
      out.write("                                        </tr>\n");
      out.write("                                        <tr> \n");
      out.write("                                            <td colspan=\"2\"><img src=\"Imagens/entrar.png\" style=\"cursor:pointer\"  size=\"100\" onclick=\"javascript:verificaCampos()\"/></td>\n");
      out.write("                                        </tr>\n");
      out.write("                                        <tr>\n");
      out.write("                                            <td colspan=\"2\" style=\"color:red;font-family:'lucida calligraphy','arial'\" width=\"30%\"> <br/> <div id=\"txtResp\"> </div> </td>\n");
      out.write("                                        </tr>    \n");
      out.write("                                  </table>\n");
      out.write("                               </form>        \n");
      out.write("                                  \n");
      out.write("                            </td>\n");
      out.write("                            <td width=\"800px\">\n");
      out.write("                                <table border=\"0\">\n");
      out.write("                                    <tr>\n");
      out.write("                                        <td width=\"150px\"></td>\n");
      out.write("                                        <td>\n");
      out.write("                                             <img id = \"img\" src = \"Imagens\\login4.jpg\"  height = \"250\" width = \"400\" class=\"border\">                                                    \n");
      out.write("                                        </td>\n");
      out.write("                                    </tr>\n");
      out.write("                                </table>                                       \n");
      out.write("                            </td>\n");
      out.write("                        </tr>\n");
      out.write("                </table>\n");
      out.write("                <br/> <br/> <br/>\n");
      out.write("                <table border=\"0\" height=\"20%\">     \n");
      out.write("                      <tr>\n");
      out.write("                            <td valign=\"center\" width=\"100%\" >                                       \n");
      out.write("                                 <div class=\"rodape\">\n");
      out.write("                                     Pizzaria La Brasiliana<br>\n");
      out.write("                                     Av. Brasil 867 - Santa Efig&ecirc;nia - Belo Horizonte - MG - Brasil <br> \n");
      out.write("                                     CEP: 30.421-169 Telefone: +55 (31) 3465-8732 - Fax: +55 (31) 3356-7854<br>                                        \n");
      out.write("                                     Desenvolvimento: Bruna Lara,Bruno Maciel, Carolina Kelly, Jéssica Borges<br>\n");
      out.write("                                 </div>\n");
      out.write("                           </td>\n");
      out.write("                           <td> \n");
      out.write("                               <img src=\"Imagens/logo.jpg\" height =\"80px\"  width=\"140px\"/>\n");
      out.write("                           </td>\n");
      out.write("                     </tr>\n");
      out.write("              </table>\n");
      out.write("\t</body>\n");
      out.write("</html>\n");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
