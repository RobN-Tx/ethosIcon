<!DOCTYPE html>
<html>

<!--
simple html page to show information about icon when you are not logged in

called from the iisstart.php file.

-->

<head>
<style>


</style>
</head>
<body>
<div class="container-fluid" style="background-color: #f5f5f5;">

<div class"=row" >

<div class="text-center hidden-xs " >
<h2 >Welcome to EthosEnergy <strong>iCon</strong></h2>
<p>		  &emsp;   Your home for machinery monitoring and diagnostics</p>
</div>
<div class="text-center visible-xs " >
<h2 >Welcome to EthosEnergy <br><strong>iCon</strong></h2>
<p>		  &emsp;   Your home for machinery monitoring and diagnostics</p>
</div>
</div>
</div>
<br>

<div class="col-md-5">

<div class"=row">



    <div class="col-sm-12">
    <button class="accordion  ">What is EthosEnergy <strong>iCon</strong>?</button>
        <div class="panel">
        <p><strong>iCon</strong> is a remote monitoring and diagnostics solution for <ul><li>any turbine</li><li> any driven unit - generator, compressor or pump</li></ul>
        Icon securely collects and transmits high resolution operational data for storage, processing and analysis by EthosEnergy's expert engineers. <br><br> Allowing you to <strong><ul><li>See more</li><li>Know more</li><li>Do more</li></strong>
        </ul></p>
        </div>
</div>



</div>


<div class"=row">
<div class="col-sm-12">
<button class="accordion rounded">How does <strong>iCon</strong> work?</button>
<div class="panel">
  <p>The <strong>iCon</strong> system consists of a secure on-site industrial router connected to the PLC. The router collects data and then securely transmits it back to the EthosEnergy data center.<br> Once in the data center it is stored in a high performance industry leading historian.
   The stored data is then monitored by our engineers as well as by our proprietary automated machine monitoring algorithms. </p>
</div>
</div>
</div>

<div class"=row">
<div class="col-sm-12">
<button class="accordion">How do I get <strong>iCon</strong>?</button>
<div class="panel">
  <p>Contact your local EthosEnergy representative</p><br>
  <p>Or click<a href='../caseicon.php'> here </a> to raise as support request </p>
</div>
</div>
</div>
</div>

<div class="col-md-7 hidden-sm hidden-xs">
    <div class="img-responsive rounded">
    <img src="/img/LT-Solar-Mars.jpg" class="media-object" style="width:92%">
    </div>
</div>
<?php //"http://www.ethosenergygroup.com/_catalogs/masterpage/ethos/img/slides/om-web-banner.gif"





?>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>

<div class="footer">      
<div class="container">      
<div class="text-center">        
<p class="text-muted">Unlock your turbine  and declare <i>independence</i>.... Freedom with No Limits</p>      
</div>      
</div>    
</div>


</body>


</html>
