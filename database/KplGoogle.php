<?php
namespace Database;
class KplGoogle extends Mysqli{


    public function replace(array $fields, array $data){
        $this->connect();
        $sql = "REPLACE INTO pedidos (`".implode('`,`', $fields)."`) VALUES";
        foreach($data as $row){
            $sql .= "(";
            foreach($row as $column){
                if(!$column){
                    $sql .= 'NULL,';
                    continue;
                }
                $sql .= "'".$this->escape((string)trim($column))."',";
            }
            $sql = trim($sql,',');
            $sql .= "),";
        }
        $sql = trim($sql,',');
        
        $this->query($sql);
        $this->execute();
        $this->disconnect();
    }

    public function getByData($map,$dias){
        $this->connect();
        $this->query("SELECT `".implode("`,`",$map)."` FROM pedidos WHERE dt_pedido > ADDDATE(NOW(), INTERVAL -$dias DAY) ORDER BY dt_pedido DESC");
        $data = $this->execute();
        $this->disconnect();
        return $data;
    }
}