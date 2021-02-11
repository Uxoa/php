<!doctype html>
<html>

<head>
<!-- Datatable CSS -->
<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<style>
html{padding:25px;}
h1{color:#036;font-size:35px;}
td{width:200px;padding:15px;}
.fondo{background-color:#CCC;color:#ffffff; font-size:25px;font-weight:500;}
.contenido{color:#666666; font-size:22px;font-weight:500;}
</style>
</head>

<body>

<?php
// index.php
// ubicacion JSON online y local
define('JSON', 'https://delivery.oddsandstats.co/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0');
define('JSONlocal', 'NFL.json'); 
// leer JSON validamos si el fichero online e accesible y si no abrimos el json local
if($data = @file_get_contents(JSON)){
 $items = json_decode($data, true);
}
else{
 $data = file_get_contents(JSONlocal);
 $items = json_decode($data, true);
}
//lista de items a recorrer
$listaItems = $items["results"]["data"]["team"];
?>
 
<h1>NFL teams</h1>
 
<table width="100%" id="empTable" class="display dataTable">
  <tr>
    <td class="fondo">Name</td>
    <td class="fondo">Nickname</td>
    <td class="fondo">Display name</td>
    <td class="fondo">Id</td>
    <td class="fondo">Conference</td>
    <td class="fondo">Division</td>
  </tr>
  </table>
 <?php
 //bucle para recorrer los elementos del array
 for ($i = 0; $i<count($listaItems); $i++){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="contenido"><?php echo $listaItems[$i]["name"]; ?> </td>
    <td class="contenido"><?php echo $listaItems[$i]["nickname"]; ?></td>
    <td class="contenido"><?php echo $listaItems[$i]["display_name"]; ?></td>
    <td class="contenido"><?php echo $listaItems[$i]["id"]; ?></td>
    <td class="contenido"><?php echo $listaItems[$i]["conference"]; ?> </td>
    <td class="contenido"> <?php echo $listaItems[$i]["division"]; ?> </td>
  </tr>
</table><br />
<?php 
 } //cerramos bucle
?>
 
 
  <!-- Script -->
        <script>
        $(document).ready(function(){
            $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ajaxfile.php'
                },
                'columns': [
                    { data: 'name' },
                    { data: 'nickname' },
                    { data: 'display_name' },
                    { data: 'id' },
                    { data: 'conference' },
					{ data: 'division' },
                ]
            });
        });
        </script>
 </body>
</html>