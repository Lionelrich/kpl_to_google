<?php
namespace Kpl;
abstract class KplAbstract{

    /**
     * @var \SoapClient
     */
    protected $soapClient;

    /**
     * @var \KplConfig
     */
    protected $kplConfig;

    protected $data =[];
    public function __construct(KplConfig $config){
        $this->kplConfig = $config;
    }

    public function connect(){
        $this->soapClient = new \SoapClient($this->kplConfig->getWsdl());
    }

    protected function call($service,$params = null){
        $input = ['ChaveIdentificacao'=>$this->kplConfig->getChaveIdentificacao()];
        if($params){
            $input += $params;
        }
        return $this->soapClient->__soapCall($service, [$input]);
    }
    abstract function callService();

    public function getData(){
        if(is_object($this->data)){
            return [$this->data];
        }
        return $this->data;
    }
}