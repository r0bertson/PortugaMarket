<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
	<link href="css/layoutPrincipal.css" rel="stylesheet"/>  
        <script type="text/javascript">
            <%!
                String produto = "";
                String pedido = "";
                String quemSomos = "";
                String faleConosco = "";
                String pagina = "";
            %>
            function alterarCabecalho() {
                <%
                    if (request.getParameter("pagina")==null) {
                        pagina="produto";
                    } else {
                        pagina = request.getParameter("pagina");
                    }

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
                    } 
                %>
            }
        </script>
    </head>
    <body>     
        <table border="0" height="135" class="menu">
            <tr height="110" class="contato">
                <td colspan = "4">
                    <table width="100%" height="180px" background="Imagens/header.jpg">
                        <tr>
                            <td width="5%" text-align="left"> <jsp:include page="identUser.jsp" flush="true"/> </td> 
                            <td></td>
                        </tr>
                    </table> 
                </td>
            </tr>
            <tr>
                <th class="<%=produto%>">
                    <a class="menuLink" href="index.jsp?pagina=produto"/> Produtos </a>
                </th>
                <th class="<%=pedido%>">
                    <a class="menuLink" href="index.jsp?pagina=pedido"/> Pedidos </a>
                </th>
                <th class="<%=quemSomos%>">
                    <a class="menuLink" href="index.jsp?pagina=quemSomos"/> Quem Somos </a>
                </th>
                <th class="<%=faleConosco%>">
                    <a class="menuLink" href="index.jsp?pagina=faleConosco"/> Fale Conosco </a>
                </th>
            </tr>
        </table>
    </body>
    
</html>
