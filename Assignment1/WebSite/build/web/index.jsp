<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <title> La Brasiliana Pizzaria </title>
    </head>
    
    <body>
        <%
            String pagina;
            String url;
            if (request.getParameter("pagina")==null) {
                pagina = "produto";
            } else {
                pagina = request.getParameter("pagina");
            }
            url = pagina+".jsp";
        %>
        <jsp:include page="head.jsp" flush="true">
            <jsp:param name="page" value="<%=pagina%>"/>
        </jsp:include>
        <br/> <br/>
        <jsp:include page="<%=url%>" flush="true"/>
        <br/> <br/>
        <jsp:include page="footer.jsp" flush="true"/>
    </body>
 </html>