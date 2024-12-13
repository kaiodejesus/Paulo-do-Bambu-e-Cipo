<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Select</title>
</head>
<body>
<php
include("Database.php");

$sql="SELECT nome, idade, email FROM clientes";
$resultado=mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado)){
echo "<table class="table table-dark"><tr>";
<th>Nome</th>
<th>Idade</th>
<th>E-mail</th></th>
while($row=mysqli_fetch_assoc($resultado)){
    echo "<tr><td>".$row['nome']. "</td><td>".$row['Idade']."</td><td>" $row['E-mail']."</td><tr>";
}
echo "</table>"
}
else{
    echo "Nada encontrado";

}
mysqli_close($conexao);
?>
</body>
</html>
