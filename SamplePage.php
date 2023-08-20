
<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1> A 1ª Loja de Produtos A Granel do Brasil</h1>
<p> Seja muito bem-vindo(a) à 1ª loja de produtos a granel do Brasil que permite que você compre exatamente a quantidade que precisa, sem ser um peso tabelado longe do seu gosto!</p>
<p> Somente aqui você escolhe a quantidade de produtos e quantas gramas quer, sem desperdícios, à pronta-entrega para todas as regiões do Brasil! Tudo isso com uma forma totalmente inovadora estilo "honest bar", em que você mesmo digita quantos reais deu a compra! O objetivo da plataforma é testar quão honesta é a população brasileira, então contamos com você!
</p> 

<p> Em nosso cardápio temos: </br>
Mix de Nozes - R$104,90/kg </br>
Castanha do Pará - R$78,90/kg </br>
Uva Passa Preta - R$34,90/kg </br>  
Granola Orgânica com Cacau - R$29,90/kg </br>
Aveia em Flocos Grossos - R$14,90/kg </br>
Mais em breve...
</p>
<p> Faça suas compras:</p>

<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the EMPLOYEES table exists. */
  VerifyEmployeesTable($connection, DB_DATABASE);
  /* Ensure that the COMPRA table exists. */
  VerifyCompraTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the EMPLOYEES table. */
  $employee_name = htmlentities($_POST['NAME']);
  $employee_address = htmlentities($_POST['ADDRESS']);

  if (strlen($employee_name) || strlen($employee_address)) {
    AddEmployee($connection, $employee_name, $employee_address);
  }

  /* If input fields are populated, add a row to the COMPRA table. */
  $compra_produto = htmlentities($_POST['PRODUTO']);
  $compra_quantidade = htmlentities($_POST['QUANTIDADE']);
  $compra_gramatura = htmlentities($_POST['GRAMATURA']);
  $compra_preco = htmlentities($_POST['PRECO']);

  if (strlen($compra_produto) || strlen($compra_quantidade) || strlen($compra_gramatura) || strlen($compra_preco)) {
    AddCompra($connection, $compra_produto, $compra_quantidade, $compra_gramatura, $compra_preco);
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>Nome</td>
      <td>Endereço de residência</td>
      <td>Produto (nome)</td>
      <td>Qtd (itens)</td>
      <td>Gramas (g)</td>
      <td>Preço (R$)</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="20" />
      </td>
      <td>
        <input type="text" name="ADDRESS" maxlength="90" size="30" />
      </td>
      <td>
        <input type="text" name="PRODUTO" maxlength="45" size="20" />
      </td>
      <td>
        <input type="text" name="QUANTIDADE" maxlength="90" size="10" />
      </td>
      <td>
        <input type="text" name="GRAMATURA" maxlength="90" size="10" />
      </td>
      <td>
        <input type="text" name="PRECO" maxlength="90" size="10" />
      </td>
      <td>
        <input type="submit" value="Comprar" />
      </td>
    </tr>
    <tr>
    </tr>
  </table>
</form>


<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NAME</td>
    <td>ADDRESS</td>
    <td>PRODUTO</td>
    <td>QUANTIDADE</td>
    <td>GRAMATURA</td>
    <td>PREÇO</td>
  </tr>

<?php

$resultEmployees = mysqli_query($connection, "SELECT * FROM EMPLOYEES");
$resultCompras = mysqli_query($connection, "SELECT produto, quantidade, gramatura, preco FROM COMPRA");


while($employee_data = mysqli_fetch_row($resultEmployees)) {
  $compra_data = mysqli_fetch_row($resultCompras);
  echo "<tr>";
  echo "<td>",$employee_data[0], "</td>",
       "<td>",$employee_data[1], "</td>",
       "<td>",$employee_data[2], "</td>";
  echo "<td>",$compra_data[0], "</td>",
       "<td>",$compra_data[1], "</td>",
       "<td>",$compra_data[2], "</td>",
       "<td>",$compra_data[3], "</td>";
  echo "</tr>";
}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_resultEmployees($resultEmployees);
  mysqli_free_resultCompras($resultCompras);
  mysqli_close($connection);

?>

</body>
</html>


<?php

/* Add an employee to the table. */
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $queryEmployee = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $queryEmployee)) echo("<p>Error adding employee data.</p>");
}

/* Add an compra to the table. */
function AddCompra($connection, $produto, $quantidade, $gramatura, $preco) {
   $pro = mysqli_real_escape_string($connection, $produto);
   $q = mysqli_real_escape_string($connection, $quantidade);
   $g = mysqli_real_escape_string($connection, $gramatura);
   $pre = mysqli_real_escape_string($connection, $preco);

   $queryCompra = "INSERT INTO COMPRA (produto, quantidade, gramatura, preco) VALUES ('$pro', '$q', '$g', '$pre');";

   if(!mysqli_query($connection, $queryCompra)) echo("<p>Error adding compra.</p>");
}

/* Check whether the table EMPLOYEE exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $queryEmployee = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";

     if(!mysqli_query($connection, $queryEmployee)) echo("<p>Error creating table EMPLOYEE.</p>");
  }
}

/* Check whether the table COMPRA exists and, if not, create it. */
function VerifyCompraTable($connection, $dbName) {
  if(!TableExists("COMPRA", $connection, $dbName))
  {
     $queryCompra = "CREATE TABLE COMPRA (
         id INT AUTO_INCREMENT PRIMARY KEY,
         produto VARCHAR(50),
         quantidade INT,
         gramatura FLOAT,
         preco DOUBLE
       )";

     if(!mysqli_query($connection, $queryCompra)) echo("<p>Error creating table COMPRA.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>                        
                