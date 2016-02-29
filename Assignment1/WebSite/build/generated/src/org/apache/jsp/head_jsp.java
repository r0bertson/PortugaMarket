package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class head_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {


            String produto = "";
            String pedido = "";
            String quemSomos = "";
            String faleConosco = "";
        
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
      out.write("<!DOCTYPE html>\n");
      out.write("<html>\n");
      out.write("    <head>\n");
      out.write("\t<link href=\"css/layoutPrincipal.css\" rel=\"stylesheet\"/>  \n");
      out.write("    <javascript type=\"text/javascript\">\n");
      out.write("        ");
      out.write("\n");
      out.write("        function alterarCabecalho() {\n");
      out.write("            ");

                String pagina = request.getParameter("page");
                if (pagina.equals("produto")) {
                    produto = "selected";
                    pedido = "topmenu";
                    quemSomos = "topmenu";
                    faleConosco = "topmenu";
                } else if (pagina.equals("pedido")) {
                    pedido = "selected";
                    produto = "topmenu";
                    quemSomos = "topmenu";
                    faleConosco = "topmenu";
                } else if (pagina.equals("quemSomos")) {
                    quemSomos = "selected";
                    pedido = "topmenu";
                    produto = "topmenu";
                    faleConosco = "topmenu";
                } else if (pagina.equals("faleConosco")) {
                    faleConosco = "selected";
                    pedido = "topmenu";
                    quemSomos = "topmenu";
                    produto = "topmenu";
                } else {
                    produto = "selected"; // default
                }
            
      out.write("\n");
      out.write("        }\n");
      out.write("    </javascript>\n");
      out.write("    </head>\n");
      out.write("    <body>     \n");
      out.write("        <table border=\"0\" height=\"135\" class=\"menu\">\n");
      out.write("            <tr height=\"110\">\n");
      out.write("                <td colspan = \"4\" align=\"center\">\n");
      out.write("                    <img src = \"Imagens/header2.jpg\" width = \"95%\" height = \"180px\"/>\n");
      out.write("                </td>\n");
      out.write("            </tr>\n");
      out.write("            <tr>\n");
      out.write("                <th class=\"");
      out.print(produto);
      out.write("\">\n");
      out.write("                    <a class=\"menuLink\" href=\"head.jsp?pagina=produto\"/> Produtos </a>\n");
      out.write("                </th>\n");
      out.write("                <th class=\"");
      out.print(pedido);
      out.write("\">\n");
      out.write("                    <a class=\"menuLink\" href=\"head.jsp??pagina=pedido\"/> Pedidos </a>\n");
      out.write("                </th>\n");
      out.write("                <th class=\"");
      out.print(quemSomos);
      out.write("\">\n");
      out.write("                    <a class=\"menuLink\" href=\"head.jsp?pagina=quemSomos\"/> Quem Somos </a>\n");
      out.write("                </th>\n");
      out.write("                <th class=\"");
      out.print(faleConosco);
      out.write("\">\n");
      out.write("                    <a class=\"menuLink\" href=\"head.jsp?pagina=faleConosco\"/> Fale Conosco </a>\n");
      out.write("                </th>\n");
      out.write("            </tr>\n");
      out.write("        </table>\n");
      out.write("    </body>\n");
      out.write("    \n");
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
