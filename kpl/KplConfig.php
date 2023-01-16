<?php
namespace Kpl;
class KplConfig{
    private $wsdl;
    private $chaveIdentificacao;

    public function __construct($wsdl,$chaveIdentificacao)
    {
        $this->wsdl = $wsdl;
        $this->chaveIdentificacao = $chaveIdentificacao;
    }
    public function setWsdl($wsdl){
        $this->wsdl = $wsdl;
    }
    public function setChaveIdentificacao($chaveIdentificacao){
        $this->chaveIdentificacao = $chaveIdentificacao;
    }
    public function getWsdl(){
        return $this->wsdl;
    }
    public function getChaveIdentificacao(){
        return $this->chaveIdentificacao;
    }
}