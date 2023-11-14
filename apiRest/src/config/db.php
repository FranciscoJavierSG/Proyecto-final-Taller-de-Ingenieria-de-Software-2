<?php
    class db {
        private $dbHost = 'localhost';
        private $dbUser = 'edeincl1_admin_turismo_bd';
        private $dbPass = 'rDCM5LL74KX{';
        private $dbName = 'edeincl1_atractivos_turisticos_bd';
        //aqui me conecto a la bd
        public function conectionDB(){
            $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
            $dbConnection = new PDO($mysqlConnect,$this->dbUser,$this->dbPass);
            $dbConnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $acentos = $dbConnection->query("SET NAMES 'utf8'");
            return $dbConnection;

        }
    }

  
/* API key encryption */
function apiToken($session_uid)
{
    $key=md5('SITE_KEY'.$session_uid);
    return hash('sha256', $key);
}  