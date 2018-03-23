<?php
//include the document with the login and database information
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
/* $servername = "localhost";
 $username = "b2ctrial";
 $password = "3ThosRMD";
 $activeDB = "ethosicontrial";*/
function testComms2()
{
    return "sqlFunctions here!";
}

//not sure if this will be needed going forward as you have to connect for each of the other pieces too, but again going to keep it hanging about
function connectTomySQL($hostName, $userName, $userPassword, $dbActive)
{
    try {
        $conn = new PDO("mysql:host=$hostName;dbname=$dbActive", $userName, $userPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return   "Connected successfully to ".$dbActive;
    } catch (PDOException $e) {
        return  "Connection failed: " . $e->getMessage();
    }
};

//shouldnt really need this going forward but still nice to have it in the back ground just incases
function createNewmySQLDatabase($hostName, $userName, $userPassword, $dbActive, $newDBName)
{
    try {
        $conn = new PDO("mysql:host=$hostName;dbname=$dbActive", $userName, $userPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE ".$newDBName;
        //use exec() as no results are returned
        $conn->exec($sql);
        return "Database created successfully";
    } catch (PDOException $e) {
        return  "Connection failed: " . $e->getMessage();
    }
    $conn = null;
}

//this one is useful :D
function sqlRequestNoReturn($noSqlReturnRequestString, $returnIDYesNo)
{
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    /* $servername = "localhost";
     $username = "b2ctrial";
     $password = "3ThosRMD";
     $activeDB = "ethosicontrial";*/
     //error_log("sqpRequestNoReturn-->>   ".$noSqlReturnRequestString);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // use exec() because no results are returned
        $stmt = $conn->prepare($noSqlReturnRequestString);
        $stmt->execute();

        if ($returnIDYesNo == "Yes") {
            $last_id = $conn->lastInsertId();
            return "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;//$conn->exec($noSqlReturnRequestString);
        }
    } catch (PDOException $e) {
        return  "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

function DirectoryFetchSQLColumnData($sqlColumn, $sqlColumnValue, $returnColumn)
{
    
    //include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    /* $servername = "localhost";
     $username = "b2ctrial";
     $password = "3ThosRMD";
     $activeDB = "ethosicontrial";*/
    try {//echo "here";
         $handle = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
         $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //echo "here";
         $queryRef = $handle->prepare("SELECT * FROM directory WHERE $sqlColumn = '$sqlColumnValue'");
         //echo $sqlColumnValue."  this is the string passed  <br><br>";
         $queryRef->execute();
         //echo "here";
         // set the resulting array to associative
         $result = $queryRef->setFetchMode(PDO::FETCH_ASSOC);

        
         $result = $queryRef->fetchAll();
          
         $feedback =  ($result[0][$returnColumn]);
    } catch (PDOException $e) {
         $feedback =  "Error: " . $e->getMessage();
    }
    $handle = null;
    return $feedback;//wibble
}

function FetchSQLColumnData($sqlColumn, $sqlColumnValue, $returnColumn,$SQLTable)
{
    
    //include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
   /* $servername = "localhost";
    $username = "b2ctrial";
    $password = "3ThosRMD";
    $activeDB = "ethosicontrial";*/
    try {
         $handle = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
         $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $queryRef = $handle->prepare("SELECT * FROM $SQLTable WHERE $sqlColumn = '$sqlColumnValue'");
         //echo $sqlColumnValue."  this is the string passed  <br><br>";
         $queryRef->execute();

         // set the resulting array to associative
         $result = $queryRef->setFetchMode(PDO::FETCH_ASSOC);

        
         $result = $queryRef->fetchAll();
         //error_log("sqlfunctions_line 128--->".$returnColumn);
         $feedback =  ($result[0][$returnColumn]);
    } catch (PDOException $e) {
         $feedback =  "Error: " . $e->getMessage();
    }
    $handle = null;
    return $feedback;//wibble
}

function unitFetchSQLColumnData($sqlColumn, $sqlColumnValue, $returnColumn)
{
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    /* $servername = "localhost";
     $username = "b2ctrial";
     $password = "3ThosRMD";
     $activeDB = "ethosicontrial";*/
    try {
         $handle = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
         $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $queryRef = $handle->prepare("SELECT * FROM units WHERE $sqlColumn = '$sqlColumnValue'");
         //echo $sqlColumnValue."  this is the string passed  <br><br>";
         $queryRef->execute();

         // set the resulting array to associative
         $result = $queryRef->setFetchMode(PDO::FETCH_ASSOC);

        
         $result = $queryRef->fetchAll();
         $feedback =  ($result[0][$returnColumn]);
    } catch (PDOException $e) {
         $feedback =  "Error: " . $e->getMessage();
    }
    $handle = null;
    return $feedback;//wibble
}




function fetchTableColumnHeaders($tableName)
{
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    /* $servername = "localhost";
     $username = "b2ctrial";
     $password = "3ThosRMD";
     $activeDB = "ethosicontrial";*/

    try {
        $handle = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
        $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $rs = $handle->query("SELECT * FROM $tableName LIMIT 0");

        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = $col['name'];
            $feedback =  $columns;
        }
    } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
    }
    $conn = null;
    return $feedback;
}




function newUserSQLInsert($userPostedArray)
{

    $tableToFetchColumnsFrom = "directory";

    //check that there isnt already this oid... somehow;


    $existingUserCheckValue =  confirmNewUser($userPostedArray[oid]);

    
    //echo $existingUserCheckValue."   should be a zero <br>";


    if ($existingUserCheckValue == 0) {
        //echo "yup a zero indeed<br>";
        
        $columns = fetchTableColumnHeaders($tableToFetchColumnsFrom);
        $newUserInsertMaster = "INSERT INTO directory (";
        $newUserInsertColumns = "user, iconenable, iconadmin, registered_user,  ";
        $newUserInsertValues = "'".$userPostedArray[oid]."', 'no', 'no', 'no', ";

        foreach ($columns as $wanted) {
            $incomingValue = $userPostedArray[$wanted];
            
            switch ($wanted) {
                case "emails":
                    $incomingValue = $incomingValue[0];
                    break;
                default;
            }
            if ($incomingValue != "") {
                $newUserInsertColumns .= $wanted.", ";
                $newUserInsertValues .= "'".$incomingValue."', ";
            } else {
                //echo "twas empty my lord";
            }
        }

        //echo "<br><br>";
        $newUserInsertColumns = rtrim($newUserInsertColumns, ", \t\n");
        $newUserInsertValues = rtrim($newUserInsertValues, ", \t\n");
        $newUserInsertMaster .= $newUserInsertColumns.") VALUES (".$newUserInsertValues.")";


        $pushit = sqlRequestNoReturn($newUserInsertMaster, "yes");
    } else {
       // echo  "<br>existing user value ".$existingUserCheckValue."-->".$userPostedArray[oid];
    }

    
    return;
}

function confirmNewUser($incomingOID)
{

    $sqlTestForUserString = "SELECT COUNT(*) FROM directory WHERE oid = '$incomingOID'";
    $existingUserCheckArray =  sqlRequestNoReturn($sqlTestForUserString, 'no');
    $existingUserCheckValue = $existingUserCheckArray[0]['COUNT(*)'];
    return $existingUserCheckValue;
}

function passTheQuerry($noSqlReturnRequestString, $returnIDYesNo)
{
    
    include $_SERVER['DOCUMENT_ROOT']."/sql/sqlSettings.php";
    /* $servername = "localhost";
     $username = "b2ctrial";
     $password = "3ThosRMD";
     $activeDB = "ethosicontrial";*/
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$activeDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // use exec() because no results are returned
        $stmt = $conn->prepare($noSqlReturnRequestString);
        $stmt->execute();

        if ($returnIDYesNo == "Yes") {
            $last_id = $conn->lastInsertId();
            return "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;//$conn->exec($noSqlReturnRequestString);
        }
    } catch (PDOException $e) {
        return  "Connection failed: " . $e->getMessage();
    }

    $conn = null;
}

?>