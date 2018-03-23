<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <META> element to your page <HEAD>.      -->
<!--  If necessary, please modify the charset parameter to specify the        -->
<!--  character set of your HTML page.                                        -->
<!--  ----------------------------------------------------------------------  -->

<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
<?php include "public/header.php";?>
 <?php 
 session_start();
//include "cookietest.php";
//include "settings.php";
?>

<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <FORM> element to your page.             -->
<!--  ----------------------------------------------------------------------  -->
<div class="container">
<form action="https://cs1.salesforce.com/servlet/servlet.WebToCase?encoding=UTF-8" method="POST">

<input type=hidden name="orgid" value="00DS0000003EE1B">
<input type=hidden name="retURL" value="http://ethosicon.info">

<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
<!--  these lines if you wish to test in debug mode.                          -->
<!--  <input type="hidden" name="debug" value=1>                              -->
<!--  <input type="hidden" name="debugEmail"                                  -->
<!--  value="robert.nelson@ethosenergygroup.com">                             -->
<!--  ----------------------------------------------------------------------  -->
<br>
<div class="row">
<div class="col-sm-6">
<label for="name">Contact Name</label><input  class="form-control" id="name" maxlength="80" name="name" size="20" type="text" value="<?php echo $_SESSION["name"];?> <?php echo $_SESSION["family_name"];?>" placeholder="Enter name"/><br>
</div>

<div class="col-sm-6">
<label for="email">Email</label><input class="form-control" id="email" maxlength="80" name="email" size="20" type="text" value="<?php echo $_SESSION["emails"];?>" placeholder="Enter email"/><br>
</div>
</div>




<div class="row">

<div class="col-sm-6">
<label for="company">Company</label><input class="form-control" id="company" maxlength="80" name="company" size="20" type="text"  value="<?php $azureOID = $_SESSION['oid']; $company = DirectoryfetchSQLColumnData("oid", $azureOID, "extension_Company"); echo $company;?>" placeholder="Enter Company"/><br>
</div>

<div class="col-sm-6">
<label for="phone">Phone</label><input class="form-control" id="phone" maxlength="40" name="phone" size="20" type="text" placeholder="Enter contact number"/><br>
</div>

</div>

<div class="row">
<div class="form-group col-sm-12">
<label for="00NS0000001U0sG">Case Category (select one):</label>
<select  class="form-control" id="00NS0000001U0sG" name="00NS0000001U0sG" title="Case Category"><option value="">--None--</option><option value="Technical Support">Technical Support</option>
<option value="Product/Service Inquiry">Product/Service Inquiry</option>
<option value="Product/Service Order">Product/Service Order</option>
<option value="Non Technical Resolution Required">Non Technical Resolution Required</option>
<option value="Customer Complaint">Customer Complaint</option>
<option value="Customer Feedback">Customer Feedback</option>
</select>
</div>
</div>

<div class="row">
<div class="form-group col-sm-12">
<label for="00NS0000001U3Yd">Case Sub Category (select one):</label>
<select  class="form-control" id="00NS0000001U3Yd" name="00NS0000001U3Yd" title="Case Sub Category"><option value="">--None--</option><option value="N/A">N/A</option>
<option value="User Knowledge">User Knowledge</option>
<option value="PLC Controls">PLC Controls</option>
<option value="Start Up">Start Up</option>
<option value="Commissioning">Commissioning</option>
<option value="Installation">Installation</option>
<option value="Relay Controls">Relay Controls</option>
<option value="Mechanical">Mechanical</option>
<option value="Electrical">Electrical</option>
<option value="Emissions">Emissions</option>
<option value="Performance">Performance</option>
<option value="Vibration">Vibration</option>
<option value="Temperature">Temperature</option>
<option value="Other">Other</option>
<option value="Major Equipment">Major Equipment</option>
<option value="Term Service Agreement">Term Service Agreement</option>
<option value="Technical Training">Technical Training</option>
<option value="Bundled Product">Bundled Product</option>
<option value="Site Services">Site Services</option>
<option value="Parts">Parts</option>
<option value="Performance Testing">Performance Testing</option>
</select>
</div>
</div>

<div class="row">
<div class="form-group col-sm-12">
<label for="subject">Subject</label><input class="form-control" id="subject" maxlength="80" name="subject" size="20" type="text" placeholder="Subject matter here"/>
</div>
</div>



<div class="row">
<div class="form-group col-sm-12">


<label for="description">Description</label><textarea class="form-control" rows="5" name="description" ></textarea ><br>
</div>
</div>

<input type="hidden"  id="external" name="external" value="1" />


<div class="row">
<div class="form-group col-sm-12 text-center">

<input  class="btn btn-success" type="submit" name="submit">

</div>
</div>
</form>

</div>


