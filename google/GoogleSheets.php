<?php
namespace Google;

class GoogleSheets{


    private $googleConfig;
    private $service;
    public function __construct(GoogleConfig $googleConfig)
    {
        $this->googleConfig = $googleConfig;
    }
    public function connect(){
        $client = new \Google_Client();
        $client->setApplicationName($this->googleConfig->getApplicationName());
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig($this->googleConfig->getAuthConfig());
        $this->service = new \Google_Service_Sheets($client);
    }

    public function getData($range){
        $response = $this->service->spreadsheets_values->get($this->googleConfig->getSheetId(),$range);
        return $response->values;
    }
    public function clear($range){
        $requestBody = new \Google_Service_Sheets_ClearValuesRequest();
        $this->service->spreadsheets_values->clear($this->googleConfig->getSheetId(), $range, $requestBody);
    }

    public function putData($range, $data){
        $body = new \Google_Service_Sheets_ValueRange([
            'values'=>$data
        ]);
        $params = ["valueInputOption"=>"RAW"];
        $retorno = $this->service->spreadsheets_values->update(
            $this->googleConfig->getSheetId(),
            $range,
            $body,
            $params
        );
        
    }

    
}