<%-- 
    Document   : faleConosco
    Created on : 05/11/2011, 19:31:16
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <table cellspadding="0" cellspacing="0" class ="contato" >
            <tr>
                <td colspan = "3" width ="100%"><h1>Fale Conosco</h1></td>
            </tr>
            <tr>
                <td text-align ="right">Nome: </td>
                <td text-align ="left" width ="400px"><input name = 'nome' type = 'text'  size = '105' maxlength = '100' class ="form""/></td>
            </tr>
            <tr>
                <td text-align ="right">Telefone: </td>
                <td text-align="left"><input name = 'telefone' type = 'text'  size = '10' maxlength = '8' style ="border: 1px solid #990000"/></td>

            </tr>
            <tr>
                <td text-align="right">E-mail: </td>
                <td text-align="left"><input name = 'email' type = 'text' size = '105' maxlength = '100' class ="form"/></td>

            </tr>
            <tr rowspan ="3">
                <td text-align="right" valign="top">Mensagem: </td>
                <td text-align="left"><textarea name ="msg" class ="form"></textarea></td>
  
            </tr>
            <tr>
                <td colspan="2">
                    <table width ="100%">
                        <tr>
                            <td align ="right" width ="88%"><input name ="resetContato" type ="reset" class ="botao" value ="Limpar"></td>
                            <td align ="right"><input name ="submitContato" type ="submit" class ="botao" value ="Enviar"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

