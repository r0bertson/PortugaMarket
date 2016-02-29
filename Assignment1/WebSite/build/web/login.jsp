<%@page import="base.UsuarioDAO"%>
<%@page import="base.Conexao"%>
<%@page import="dominio.Usuario"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
	<head>
		<title> Login Pizzaria </title>		
		<link rel="stylesheet" type="text/css" href="css/loginCSS.css">
                <script type = "text/javascript">
			var imagens = new Array (4);
			imagens[0] = "Imagens/login1.jpg";
			imagens[1] = "Imagens/login2.jpg";
			imagens[2] = "Imagens/login3.jpg";
			imagens[3] = "Imagens/login4.jpg";
			var cont=4;
                        
                        function mudaImagem(){
				document.getElementById("img").src = imagens[cont%4];
                                cont++;
			}
                        
                        setInterval("mudaImagem()",2000);
                       
                        function verificaCampos() {
                            if (document.login.usuario.value!="") {
                                if (document.login.senha.value!="") {
                                    document.login.submit();
                                } else {
                                    setaText("Preencha o campo <u>senha</u>");
                                }
                            } else {
                                setaText("Preencha o campo <u>login</u>");
                            }
                        }
                        
                        function setaText(txt) {
                            if (txt=="Usuario encontrado, senha correta") {
                                document.login.action="index.jsp";
                                document.login.submit();
                            } else {
                                document.getElementById('txtResp').innerHTML = txt;
                            }
                        }
                        
                        <%
                            String msgm = "Bem-vindo!";
                            Conexao con = new Conexao();
                            UsuarioDAO acessoUsuario = new UsuarioDAO(con);
                            Usuario us = new Usuario("","","");
                            String usuario = "";
                            String senha = "";
                            if (request.getParameter("usuario")!=null) {
                                usuario = request.getParameter("usuario"); 
                                if (request.getParameter("senha")!=null) {
                                    senha = request.getParameter("senha");
                                    us = acessoUsuario.consultaUsuario(request.getParameter("usuario"), request.getParameter("senha"));
                                    if (us==null) {
                                        msgm = "Usuario nao encontrado";
                                    } else
                                    if (us.getNome().equals("")) {
                                        msgm = "Usuario encontrado, senha incorreta";
                                        session.setAttribute("usuario", usuario);
                                        session.setAttribute("tipo", us.getTipoUsuario());
                                    } else {
                                        msgm = "Usuario encontrado, senha correta";
                                    }
                                }
                            }
                        %> 
                        alert("<%=usuario%>");    
                        alert("<%=session.getAttribute("usuario")%>");    
		</script>
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
                                     Pizzaria La Brasiliana<br>
                                     Av. Brasil 867 - Santa Efig&ecirc;nia - Belo Horizonte - MG - Brasil <br> 
                                     CEP: 30.421-169 Telefone: +55 (31) 3465-8732 - Fax: +55 (31) 3356-7854<br>                                        
                                     Desenvolvimento: Bruna Lara,Bruno Maciel, Carolina Kelly, Jéssica Borges<br>
                                 </div>
                           </td>
                           <td> 
                               <img src="Imagens/logo.jpg" height ="80px"  width="140px"/>
                           </td>
                     </tr>
              </table>
	</body>
</html>
