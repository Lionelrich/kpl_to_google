<?php
namespace Kpl;

class KplPedidosDisponiveis extends KplAbstract{

    public function callService(){
        $data =  parent::call("PedidosDisponiveis");

        $this->data = $data->PedidosDisponiveisResult->Rows->DadosPedidosDisponiveisWeb;
    }
}