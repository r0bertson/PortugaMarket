<!DOCTYPE html>
<html>
	<head>
		<title> Supermarket </title>		
		<link rel="stylesheet" type="text/css" href="css/loginCSS.css">
        <link rel="shortcut icon" href="Images/loginPage.png"; /> 
               
	</head>
        
	<body style="overflow: hidden;" class="gradiente" onload="javascript:mudaImagem();javascript:setaText('<%=msgm%>')">		
                <br/><br/><br/>
                <table border="0" height="45%" style="margin-left: 200px">		
                        <tr height="300px">
                            <td width="800px">
                               <form name="login" action="login.jsp">
                                    <table border="0" width="30%">    
                                        <tr>
                                            <td><img src="Images/login.png"/></td>
                                            <td><input type="text" size="20" value ="" name="usuario"/></td>
                                        </tr>
                                        <tr>
                                            <td><img src="Images/senha.png"/></td>
                                            <td><input type="password" value ="" name ="senha" size="20"/></td>                                                    
                                        </tr>
                                        <tr> 
                                            <td colspan="2"><img src="Images/entrar.png" style="cursor:pointer"  size="100" onclick="javascript:verificaCampos()"/></td>
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
                                             <img id = "img" src = "Images\loginPage.png"  height = "281" width = "400" class="border">                                                    
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
                                     Supermaket - Business case<br>
                                     University of West London - Computer Science<br> 
                                     Team Project - Second Year, module 2<br>                                        
                                     Made by: Carolina Eufrasio, Filipe Neves and Robertson Lima<br>
                                 </div>
                           </td>
                           <td> 
                               <img src="Images/logouwl.png" height ="80px"  width="200px"/>
                           </td>
                     </tr>
              </table>
	</body>
</html>
