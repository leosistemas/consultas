<?php
/* CLASE PARA LA CONEXION DE PHP CON ACCES 2003 */
class odbc {
# variable para almacenar la conexion

private $conexion;
# one line
   /* METODO PARA CONECTAR CON LA BASE DE DATOS*/
public function conectar()
{
//  $host = 'localhost:c:\Embebed21\SOCIOS.FDB';
$host='localhost:socioss';
 // $host = '192.168.10.201:base';
  $nombre_usuario='SYSDBA';
   $contrasenya='masterkey';
  $this->conexion = ibase_connect($host, $nombre_usuario, $contrasenya,'UTF-8') or die( ibase_errmsg() );
}
public function conectar_servicios()
 {
	
  
  $host = '192.168.10.201:diar';
  $nombre_usuario='SYSDBA';
   $contrasenya='masterkey';
  $this->conexion = ibase_connect($host, $nombre_usuario, $contrasenya,'UTF-8') or die( ibase_errmsg() );
	 
 }

public function desconectar()
{
  ibase_close($this->conexion);

}

/*METODO PARA HACER UN INSERT
* INPUT:
* $tabla -> Nombre tabla
* $campos -> String con nombres de los campos -> campo1, campo2, campo_n
* $valores -> Valores a insertar -> 'Valor1','Valor2','Valor_n'
* OUTPUT:
* boolean -> TRUE/FALSE:
*/
function insert($tabla, $campos, $valores){
 #se forma la instruccion SQL
 $q = 'INSERT INTO '.$tabla.' ('.$campos.') VALUES ('.$valores.')';
echo $q;
 $resultado = $this->consulta($q);
 
 if($resultado) return true;
 else return false;
}

public function consulta($q)
{
 //ECHO $q;
   $resultado =  ibase_query( $this->conexion, $q) or die( ibase_errmsg() );
   return $resultado;

}
public function update($t){
  //echo $t;
$resultado = ibase_query( $this->conexion, $t) or die( ibase_errmsg() );
return 1;
}

function ibase_num_rows($q) {
 $i = 0;
  $resultado =  ibase_query( $this->conexion, $q) or die( ibase_errmsg() );
 while (ibase_fetch_row($resultado)) {    $i++;  }
 return $i;}
}//fin clase
?>
