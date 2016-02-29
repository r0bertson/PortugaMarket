<%@page import="base.UsuarioDAO"%>
<%@page import="base.Conexao"%>
<%@page import="dominio.Usuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
	<head>
		<title> Login Pizzaria </title>		
		<link rel="stylesheet" type="text/css" href="css/loginCSS.css">
              
	</head>
        
	<body style="overflow: hidden;" class="gradiente" onload="javascript:mudaImagem();javascript:setaText('<%=msgm%>')">		
                <br/><br/><br/>
                <table border="0" height="45%" style="margin-left: 200px">		
                        <tr height="300px">
                            <td width="800px">
                               <form name="login" action="login.jsp">
                                    <table border="0" width="30%">    
                                        <tr>
                                            <td><img src="Imagens/login.png"/></td>
                                            <td><input type="text" size="20" value ="<%=usuario%>" name="usuario"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="Imagens/senha.png"/></td>
                                            <td><input type="password" value ="<%=senha%>" name ="senha" size="20"/></td>                                                    
                                        </tr>
                                        <tr> 
                                            <td colspan="2"><img src="Imagens/entrar.png" style="cursor:pointer"  size="100" onclick="javascript:verificaCampos()"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="color:red;font-size:12px;font-family:'lucida calligraphy','arial'" width="30%"> <br/> <div id="txtResp"> </div> </td>
                                        </tr>    
                                  </table>
                               </form>        
                                  
                            </td>
                            <td width="800px">
                                <table border="0">
                                    <tr>
                                        <td width="150px"></td>
                                        <td>
                                             <img id = "img" src = "Imagens\login4.jpg"  height = "250" width = "400" class="border">                                                    
                                        </td>
                                    </tr>
                                </table>                                       
                            </td>
                        </tr>
                </table>
                <br/> <br/> <br/>
                <table border="0" height="20%">     
                      <tr>
                            <td valign="center" width="100%" >                                       
                                 <div class="rodape">
                                     Supermarket<br>
                                     University of West London <br> 
                                     Team Project - Module 2<br>                                        
                                     Desenvolvimento: Carolina Eufrasio, Filipe Neves, Robertson Lima<br>
                                 </div>
                           </td>
                           <td> 
                               <img src="Imagens/logo.jpg" height ="80px"  width="140px"/>
                           </td>
                     </tr>
              </table>
	</body>
</html>
