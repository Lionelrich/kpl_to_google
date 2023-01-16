<?php
namespace Kpl;
class KplMap{

    private $kplAbstract;

    public function __construct(KplAbstract $kplAbstract)
    {
        $this->kplAbstract = $kplAbstract;
    }

    public function map(array $map, $format = null){
        $array = [];
        foreach($this->kplAbstract->getData() as $data){
            $line = [];
            foreach($map as $key=>$path){
                
                $cell = null;
                eval('$cell = (string)$data->'.str_replace('.','->',$path).";");
                
                if(isset($format->{$key})&& $cell){

                    $cell = strstr($cell,'.',true);
                    $cell = (\DateTime::createFromFormat($format->{$key}->from,$cell))->format($format->{$key}->to);
                }
                $line[] = $cell;
            }
            $array[] = $line;
        }
        return $array;
    }
}