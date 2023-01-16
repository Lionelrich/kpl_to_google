<?php
namespace Kpl;

class KplConfimarRecebimentoPedido extends KplAbstract{

    private $protocoloServico;

    public function setProtocoloServico($protocoloServico){
        $this->protocoloServico = $protocoloServico;
        return $this;
    }

    function callService(){
        $data =  parent::call("ConfirmarRecebimentoPedido",["ProtocoloPedido"=>$this->protocoloServico]);

    }
}