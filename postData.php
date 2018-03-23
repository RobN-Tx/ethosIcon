
<?php

//################################################
//########### STRING UPLOAD ######################
//################################################

$params = "No params";
if (isset($_POST["postparam"]))
{
	$params = "Params : ";
	foreach ($_POST["postparam"] as $_item)
	{
		$params .= htmlspecialchars($_item).", ";
	}
}


//################################################
//########### FILE UPLOAD ########################
//################################################

$FilesUploaded = "No file received";
if(isset($_FILES['file']))
{
	$upload_dir = 'upload/';
	$file = basename($_FILES['file']['name']);
	$max_size = 500000;
	$file_size = filesize($_FILES['file']['tmp_name']);
	$allowed_extensions = array('.txt');
	$extension = strrchr($_FILES['file']['name'], '.'); 

	if ($file != "") //could occur if no file is uploaded from HTML form
	{	
		if(!in_array($extension, $allowed_extensions)) //Check extension
			 $FilesUploaded = 'Only extension txt, jpg, jpeg, txt, csv and png are allowed (Extension used ' .$extension . ').' ;

		if($file_size>$max_size)
			 $FilesUploaded = 'File too big';

		if($FilesUploaded == "No file received") //If no error, start upload
		{
			 //format file name
			 $file = strtr($file, 
				  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			 $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);
			 
			 if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . date('m-d-Y_His')."_".$file)) //If true is returned -> it worked
			 {
				  $FilesUploaded = " File uploaded :". $file." (Click <a href='upload/".$_SERVER['REMOTE_ADDR']."_".$file."'>here</a> to access the file)";
				  echo "File Uploaded successfully";
			 }
			 else //if false, upload has failed
				  echo "File Upload failed (eWON return code : POSTERROR)";
		}
		else
			 echo $FilesUploaded." (eWON return code : POSTERROR)";
			 
	}
}

//################################################
//########### LOG RESULT #########################
//################################################


//YOU COMMENTED OUT THIS TO STOP THE BOT FROM DELETING EVERYTHING SO FREAKING OFTEN!
 //remove uploaded file and log file if filesize > 3 kb
//if (file_exists('postresults.txt'))
//{
//	if (filesize('postresults.txt') > 3000)
//		clearAll();
//}

//log result in file
$fp = fopen('postresults.txt', 'a');
	fwrite($fp, date('Y-m-d H:m:s')." [".$_SERVER['REMOTE_ADDR']."]"." : ".$params." ".$FilesUploaded."\r\n");
fclose($fp);

//remove uploaded file and log file on demand
if (isset($_POST["clearlist"]))
	clearAll();

//redirect to main page
echo "<head><SCRIPT LANGUAGE='JavaScript'>document.location.href='index.php'</SCRIPT></head>"; 

function clearAll()
{
	try
	{
	  deleteDir('upload');
	  mkdir('upload');
	  unlink('postresults.txt');
	}
	catch(Exception $e)
	{}
}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

?>
