<?php
    class MacAddressCtrl 
    {
        var $dataObj;
        var $link;

        function connectDB($ipAddress,$dbUserName,$dbPassword,$dbName) 
        {
            $this->link = mssql_connect($ipAddress,$dbUserName,$dbPassword);
             if (!$this->link || !mssql_select_db($dbName, $this->link)) 
            {
                //displayMsg("alert-danger","<b>Error</b> : Unable to connect or select database!"); 
                return false;
            }
            else
            {
                return true;
            }
        }

        function execQuery($cmd)
        {
            $this->dataObj = null; 
            $queryObj = mssql_query($cmd);
            $this->dataObj = mssql_fetch_array($queryObj);
            mssql_free_result($queryObj);
            return $this->dataObj;
        }

        function execQueryArray($cmd)
        {
            //ini_set('mssql.charset', 'TIS-620');
            $this->dataObj = array();
            $queryObj = mssql_query($cmd);
            if(mssql_num_rows($queryObj))
            {
                while($row = mssql_fetch_assoc($queryObj))
                {
                    $this->dataObj[] = $row;
                }
            }
            mssql_free_result($queryObj);
            return $this->dataObj;
        }

        function execQueryArray2($cmd)
        {
            //ini_set('mssql.charset', 'TIS-620');
            $this->dataObj = array();
            $queryObj = mssql_query($cmd);
            if(mssql_num_rows($queryObj))
            {
                while($row = mssql_fetch_assoc($queryObj))
                {
                    //$this->dataObj[] = $row;
                    $this->dataObj["Mac"] = iconv("TIS-620","UTF-8",$row["Mac"]);
                    $this->dataObj["UserName"] = iconv("TIS-620","UTF-8",$row["UserName"]);
                }
            }
            mssql_free_result($queryObj);
            return $this->dataObj;
        }

        function execNonQuery($cmd)
        {
            if(mssql_query($cmd,$this->link))
                return true;
            else
                return false;
            /*
            try{
            if(!mssql_query($cmd,$this->link))
            {
                //die("Error-> " .mssql_get_last_message());
                print_r(error_get_last());
            }
            }
            catch (Exception $e){
                echo 'Error xxxx : '.$e->getMessage();
            }
            */

/*
            try{
                mssql_query($cmd,$this->link);
            }
            catch (Exception $e){
                echo 'Error xxxx : '.$e->getMessage();
            }
*/
        }

        function disconnectDB()
        {
            mssql_close();
        }
    }
?>