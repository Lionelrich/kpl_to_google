<?php
namespace Google;

class GoogleConfig{
    private $applicationName;
    private $authConfig;
    private $sheetId;

    public function __construct($applicationName,$authConfig,$sheetId)
    {
        $this->applicationName = $applicationName;
        $this->authConfig = $authConfig;
        $this->sheetId = $sheetId;
        
    }

    public function getApplicationName(){
        return $this->applicationName;
    }
    public function getAuthConfig(){
        return $this->authConfig;
    }
    public function getSheetId(){
        return $this->sheetId;
    }
}