<%-- 
    Document   : identUser
    Created on : 12/11/2011, 17:46:01
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            a.troca {
                color: #990000;
                font-family: sans-serif
            }
        </style>
    </head>
    <body>
        <form name="user" action="identUser.jsp">
            <table border="0" cellspacing="10" style="font-size: 15px;color:white;text-align: left">
                <tr>
                    <th style="font-family:fantasy"> Usu&aacute;rio: </th>
                    <th style="font-size:13px"> <%=session.getAttribute("usuario")%> </th>
                </tr>
                <tr>
                    <th colspan="2" style="font-size:13px"> <%=session.getAttribute("tipo")%> </th>
                </tr>
                <tr>
                    <th colspan="2"> <a href="login.jsp" class="troca"> Trocar usu&aacute;rio </a> </th>
                </tr>
            </table>    
        </form>
    </body>
</html>
