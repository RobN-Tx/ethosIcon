<?php
/*This is the string used to define the SQL table for the directory - refer back here 
when working out what is going on, if a variable is NOT NULL then it has to have shit in it!!*/
$sqlCreateMyGuestsTable = "CREATE TABLE Directory (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    user VARCHAR(40) NOT NULL,
    sub VARCHAR(40) NOT NULL,
    aud VARCHAR(40) NOT NULL,
    oid VARCHAR(40) NOT NULL,
    family_name VARCHAR(30) NOT NULL,
    given_name VARCHAR(30) NOT NULL,
    name VARCHAR(30) NOT NULL,
    country VARCHAR(30),
    city VARCHAR(30),
    emails VARCHAR(50),
    extension_Company VARCHAR(30),
    extension_Site VARCHAR(30),
    iconenable VARCHAR(3),
    iconadmin VARCHAR(3),
    username VARCHAR(30),
    password VARCHAR(30),
    jobTitle VARCHAR(30),
    postalCode VARCHAR(10),
    state VARCHAR(20),
    reg_date TIMESTAMP
    )";

//$sqlNewUserInsertString = "INSERT INTO Directory (user, sub, emails, aud, oid, family_name, given_name, name, extension_Company, extension_Site, iconenable, iconadmin, username, password)    VALUES ('e85c6b9b-f37d-4d1d-9c2d-f1dc96e7425f', 'e85c6b9b-f37d-4d1d-9c2d-f1dc96e7425f', 'mike@yachtcations.com', 'b8a7e1a2-c9bc-4c00-b777-652fb0343873','e85c6b9b-f37d-4d1d-9c2d-f1dc96e7425f', 'Fisher','Mike','Mike','PCM','Monterrey','yes','no','fs','Pa55word')";

//"INSERT INTO directory (sub,aud,oid,family_name,given_name,name,country,city,emails,jobTitle,postalCode,state,) VALUES ('cadb97bb-c0ef-46aa-813b-c42317a02901','b8a7e1a2-c9bc-4c00-b777-652fb0343873','cadb97bb-c0ef-46aa-813b-c42317a02901','Nelson','Rob','Boblar','United States','Houston','robert.nelson@ethosenergygroup.com','Tech App Manager and Web Dev','77019','Cushing',)

//INSERT INTO directory (sub, aud, oid, family_name, given_name, name, country, city, emails, jobTitle, postalCode, state, ) VALUES ('cadb97bb-c0ef-46aa-813b-c42317a02901', 'b8a7e1a2-c9bc-4c00-b777-652fb0343873', 'cadb97bb-c0ef-46aa-813b-c42317a02901', 'Nelson', 'Rob', 'Boblar', 'United States', 'Houston', 'robert.nelson@ethosenergygroup.com', 'Tech App Manager and Web Dev', '77019', 'Cushing', )

?>