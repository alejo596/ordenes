<?php 
$action = (\Route::getCurrentRoute()) ? \Route::getCurrentRoute()->getActionName() : "n/a";
$path = (\Route::getCurrentRoute()) ? \Route::getCurrentRoute()->getPath() : "n/a";

?>

Hubo un error en tu aplicación Laravel Ordenes de compra<br />

<hr />
<table border="1" width="100%">
    <tr><th >User:</th><td></td></tr>
    <tr><th >Message:</th><td>{{ $e['message'] }}</td></tr>
    <tr><th >Action:</th><td>{{ $action }}</td></tr>
    <tr><th >URI:</th><td>{{ $path }}</td></tr>
    <tr><th >Line:</th><td>{{ $exception['line'] }}</td></tr>
    <tr><th >Code:</th><td>{{ $exception['code'] }}</td></tr>
</table>