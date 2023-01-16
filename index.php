<?php

use Database\KplGoogle;
use Google\GoogleSheets;
use Kpl\KplConfig;
use Kpl\KplMap;

require "./vendor/autoload.php";
//echo phpinfo();

$configJson=json_decode(file_get_contents(__DIR__."/config.json"));
$googleConfig = new Google\GoogleConfig("Integracao kpl",__DIR__.'/Integracao KPS-622017c1c2a1.json',$configJson->idSheet);
$googleSheets = new Google\GoogleSheets($googleConfig);
$googleSheets->connect();
$sheetData = $googleSheets->getData("Página1");
$firstLine = reset($sheetData);

$map = (array)$configJson->map;


$kplConfig= new Kpl\KplConfig("http://ws.kpl.onclick.com.br/AbacosWSPlataforma.asmx?wsdl","C9DE96B0-3D78-4DEB-8967-C61AC8ECF502");
$kplAbstract = new Kpl\KplPedidosDisponiveis($kplConfig);
$kplAbstract->connect();
$kplAbstract->callService();
$result = $kplAbstract->getData();
if(!$result){
    exit('ok');
}
$arrayMap = new KplMap($kplAbstract);
$data = $arrayMap->map($map,$configJson->dataFormats);
$kplGoogle = new KplGoogle();
$kplGoogle->replace(array_keys($map),$data);
unset($data);
unset($map);
$mapaSql = [];
$mapaSqlConfig = (array)$configJson->mapSql;
foreach($firstLine as $campo){
    $mapaSql[] = $mapaSqlConfig[$campo];
}


$newData = $kplGoogle->getByData($mapaSql,$configJson->diasExportar);
$googleSheets->clear("Página1!2:100000");
$protocolos = $arrayMap->map(["ProtocoloPedido"]);
$firstline = 2;
$lastLine = $firstline+count($newData  );
$googleSheets->putData("Página1!$firstline:$lastLine",$newData );
unset($newData);
$confimarPedidos = new Kpl\KplConfimarRecebimentoPedido($kplConfig);
$confimarPedidos->connect();

foreach($protocolos as $protocolo){
    $confimarPedidos->setProtocoloServico(reset($protocolo))->callService();
}
exit('ok');

