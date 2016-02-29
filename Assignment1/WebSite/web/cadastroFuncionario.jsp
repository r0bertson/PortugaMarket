
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml">
       <head>
           <title>Cadastro de Clientes</title>
       </head>


       <body onload="javascript:preencherCampos()">
           <h1> <center> Cadastro de Clientes </center> </h1>
           <br/><br/><br/>
           <table border="0" cellspacing="3">
               <form name = "myForm" method="post" action="Index.jsp">
                   <tr>
                       <td> <strong> Nome: </strong> </td>
                       <td> <input type = "text" name = "nome" size="100%"/> </td>
                   </tr>
                   <tr>
                       <td> <strong> Email: </strong> </td>
                       <td> <input type = "text" name = "email" size = "100%"/> </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> CPF: </strong> 
                       </td>
                       <td> 
                           <input type = "text" name = "cep" size = "50%"/> 
                       </td>
                   </tr> 
                   <tr>
                       <td> 
                           <strong> RG: </strong> 
                       </td>
                       <td> 
                           <input type = "text" name = "cep" size = "50%"/> 
                       </td>
                   </tr>                     
                   <tr>
                       <td> <strong> Rua: </strong> </td>
                       <td> <input type = "text" name = "rua" size = "100%"/> </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> N&uacute;mero: </strong> 
                       </td>
                       <td> 
                           <input type = "text" name = "numero" size = "10%"/> 
                       </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> Bairro: </strong> 
                       </td>
                       <td> 
                           <input type = "text" name = "bairro" size = "50%"/> 
                       </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> CEP: </strong> 
                       </td>
                       <td> 
                           <input type = "text" name = "cep" size = "50%"/> 
                       </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> Estado: </strong> 
                       </td>
                       <td> 
                           <select name = "estado" style="width:50%">
                               <option value = "Minas Gerais"> Minas Gerais </option>
                               <option value = "Rio de Janeiro"> Rio de Janeiro </option>
                               <option value = "Sao Paulo"> Sao Paulo </option>
                               <option value = "Parana"> Parana </option>
                               <option value = "Goias"> Goias </option>
                           </select> 
                       </td>
                   </tr>
                   <tr>
                       <td> 
                           <strong> Cidade: </strong> 
                       </td>
                       <td> 
                           <select name = "cidade" style="width:50%">
                               <option value = "Belo Horizonte"> Belo Horizonte </option>
                               <option value = "Rio de Janeiro"> Rio de Janeiro </option>
                               <option value = "Sao Paulo"> Sao Paulo </option>
                               <option value = "Curitiba"> Curitiba </option>
                               <option value = "Brasilia"> Brasilia </option>
                           </select> 
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td> <br/> <br/>
                           <input type = "submit" value="Cadastrar" style="width:45%"/>
                           <input type = "reset" value="Limpar" style="width:45%"/>
                       </td>
                   </tr>
              </form>
           </table>
       </body>
</html>
