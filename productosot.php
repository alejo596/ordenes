 <?php
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: multipart/form-data'); 
$servername = "SERVER_BD";
$database = "gestion_ordenes";
$username = "contingencia";
$password = "123456";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

$ot=$_POST['ot'];


$sql="SELECT
gestion_ordenes.producto_compra.pro_id,
gestion_ordenes.producto_compra.pro_id_oc,
gestion_ordenes.producto_compra.pro_nombre,
gestion_ordenes.producto_compra.pro_cantidad,
gestion_ordenes.producto_compra.pro_descripcion,
gestion_ordenes.producto_compra.pro_precio,
gestion_ordenes.producto_compra.pro_id_aba,
gestion_ordenes.producto_compra.pro_ordenados_por_numero,
gestion_ordenes.producto_compra.pro_comprador,
gestion_ordenes.producto_compra.pro_id_detalle_compra,
gestion_ordenes.producto_compra.pro_oc_portal_id,
gestion_ordenes.producto_compra.pro_id_cpp,
gestion_ordenes.producto_compra.pro_estado_refrendacion,
gestion_ordenes.producto_compra.pro_cuenta_sigfe,
gestion_ordenes.producto_compra.pro_total,
gestion_ordenes.producto_compra.pro_uindad_medida,
gestion_ordenes.producto_compra.pro_nombre_sigfe,
gestion_ordenes.producto_compra.pro_nombre_producto,
gestion_ordenes.producto_compra.pro_sub_item_sigfe,
gestion_ordenes.producto_compra.pro_estado_producto,
gestion_ordenes.producto_compra.pro_estado_producto_anterior,
gestion_ordenes.producto_compra.pro_costo_unitario_incluye_todo,
gestion_ordenes.producto_compra.pro_justificacion,
gestion_ordenes.producto_compra.pro_cc,
gestion_ordenes.producto_compra.pro_oc_portal_individual,
gestion_ordenes.producto_compra.pro_amio,
gestion_ordenes.producto_compra.pro_convenio,
gestion_ordenes.producto_compra.pro_cantidad_solicitud,
gestion_ordenes.producto_compra.pro_precio_unitario,
gestion_ordenes.producto_compra.pro_cantidad_unitario,
gestion_ordenes.producto_compra.pro_costo_unitario_producto_sin_ajuste,
gestion_ordenes.producto_compra.pro_costo_unitario_ajuste,
gestion_ordenes.producto_compra.pro_factura_unitaria,
gestion_ordenes.producto_compra.pro_diferencia_adicionada,
gestion_ordenes.producto_compra.pro_ID_ZGEN,
gestion_ordenes.producto_compra.id_proceso,
gestion_ordenes.producto_compra.sigfe_item,
gestion_ordenes.producto_compra.pro_observacion,
gestion_ordenes.producto_compra.created_at,
gestion_ordenes.producto_compra.updated_at,
gestion_ordenes.producto_compra.pro_idORIGINALCENABAST
FROM
gestion_ordenes.producto_compra
where 

gestion_ordenes.producto_compra.pro_id_oc=".$ot." and gestion_ordenes.producto_compra.pro_estado_producto!= 9";



if($result=mysqli_query($conn,$sql)){ 



  while($row = mysqli_fetch_assoc($result)) 
  {
   $data[] = $row;
   
   }

   echo json_encode($data);
}

mysqli_close($conn);
?>