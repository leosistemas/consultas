<?php
session_start();
include("captcha/simple-php-captcha.php");$_SESSION['captcha'] = simple_php_captcha();
$_SESSION['captcha']['image_src'];

if(isset($_POST['int'])){$intent=$_POST['int'];}else{$intent=0;}

include "includes/fb_con.php"; /*configuracion de conexio firebird*/
include "includes/encc.php"; /* funciones de encriptacion */
$banner='<h2 class="banner"> Sistema de Consultas</h2>';
function verificar_login($user,$password,&$result)
 {
  $db = new odbc();
	$db->conectar();
  $sql ="SELECT * FROM segur_usuarios WHERE usuario='".strtoupper($user) ."'";
  $rec = $db->consulta($sql);
	$i= 0;
  echo "consulta";
  while ( $fila = ibase_fetch_object($rec) )
  {
    $pp=dec($fila->CLAVE);
  	$result=$fila->USUARIO;
    echo "autenticando";
  if (trim($pp)==trim($password)) {$i= $i+1;echo "autenticado";}else{echo ord($pp); echo $fila->clave. "  pp  "; echo ord($password);}
   }
	if($i == 1) { return 1; } else { return 0; }
	}
  //funcion verificar=1

if(isset($_POST['user'])) {$intent=$intent+1;

    if(verificar_login($_POST['user'],$_POST['password'],$result) == 1)
              {
echo "logeado";
			  $_SESSION['userid'] = $result;
			  $db = new odbc();
				$db->conectar();
		  	$sql ="SELECT * FROM segur_MIEMBROS WHERE usuario='".$result."'";
				$rec = $db->consulta($sql);

				$_SESSION['GRUPO'] = ibase_fetch_object($rec)->USUARIO
					?>
        			<script>
        				location.href='main.php'
        			</script><?php
        		  }else{$banner="<h2 class='banner' style='color:red' >Usuario y/o contrase&ntilde;a incorrectos.</h2>";}

            }//echo $intent;
      ?>

<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
      
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="icons/mutual.ico">
    <title>Mutual de Suboficiales de Polic&iacute;a Federal Argentina. Consulta de Socios</title>
	<link rel= "stylesheet" href= "estilos/login.css" type="text/css" />
	<link rel= "stylesheet" href= "estilos/captcha.css" type="text/css" />

    <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/UIs/UI_login.js"></script>
  </head>
  <body>
   
    <div id="popup" style="display: none;">
        <div class="close"><a href="#" id="close" onclick="close"><img src="../consultas/images/close.png"></a></div>
         
          <div class="cabecera">
             <h3>Ingrese las letras para vovler a interntarlo.</h3>
          </div>
        
          <form class ="f_cap" action="../consultas/captcha/rp.php" method="post" name="pr">
  				<table align="center">
                <tr>
                  <td align="center">
                   <?php
				echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                    ?>
				</td>
                  <td align="center">
					<input id="cap" name="cap" type="text" autofocus>
                  </td>
                </tr>
				</table>
				<table align="center">
                <tr>
                  <td align="center">
                    <p style="clear: both;"><label>&nbsp;</label><input value="Volver a intentar" id="capbutton" name="capbutton" type="submit"></p>
                  </td>
                </tr>
              </table>
          </form>
        </div>
	<?php
	if ($intent>1	){?>
        <script type="text/javascript">
			$('#popup').fadeIn('slow');
			
  			</script>
        <?php	}?>

    
  
      <div class="formulario">
          <img class="logo" src="../consultas/images/logogallo_t.png">
          <?php echo $banner; echo $_SESSION['captcha']['code'];?>
          <form id="formvalid" name="formvalid" action="../consultas/login.php" method="post" autocomplete="off">
          <input type="text" placeholder= "Usuario" name ="user" id="user"><BR>
        <input type="text" placeholder= "&#128272;Clave" name ="password" id="pass"  autocomplete="off"><BR>
                <input id="login" name="login" type="button" value="&#x21aa;Inicio">   <BR>
                <input name="int" value="<?php echo $intent; ?>" type="hidden"> 
               </form>
      </div>
    </body>