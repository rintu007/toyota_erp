<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
h1 {
    border: 1px solid black;
    text-align:center;
    background:black;
    Color:white;
}
h4 {
	border: 1px solid black;
    text-align:center;
   
}
.P2{
text-align:left;
}

.P1{
position: relative;
    bottom: 32px;
}

body{
-webkit-print-color-adjust: exact;
}


}
</style>
</head>
<body>

<div class="container">
 <table style="width:100%">
<h1>Invention Control Class</h1>
<h4> FEB-17 <h4>
<p class="P2">Very Fast Moving (A) - A-S-1 </p>
<p class="P1">Mad >30 </p>
  <tr>
    <th>S No</th>
    <th>Part Number</th> 
    <th>Discription</th>
    <th>N</th>
    <th>N 1</th> 
    <th>N 2</th>
    <th>N 3</th>
    <th>N 4</th> 
    <th>N 5</th>
    <th>Total Sale</th>
    <th>Mad</th> 
    <th>Total Stock</th>
    <th>Stock Mouth</th>
    
  </tr>
  <?php 
  for($a=0;$a<count($Parts);$a++){ 
    echo'
  <tr>
    <td>'.($a+1).'</td>
    <td>'.$Parts[$a]['PartNumber'].'</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
  </tr>';
  
  }
 ?>
</table>

</div>
<div class="row">
<div class="col-md-6">
<div class="col-md-3 pull-left">
<h4 Style="background:black;color:White;    width: 192%;
">note</h4>
<p>N</p>
<br>
<p>Mad</p>
<p>Stock Month</p>
<p>Before Report Ask</p>
<p>Date Range</p>
<p>Fast (B)</p>
<p>Medium Moving (C)</p>
<p>Slow Moving</p>
<br>
<p>Very Slow Moving</p>
</div>
<div class="col-md-3 pull-right">
<br>
<br>
<p>Current Mounth/First Month </p>
<br>
<p>Total Sale / No.of Months</p>
<p>Total Stock / Mad</p>
<br>
<p>3/6/12</p>
<p>>30</p>
<p>>18</p>
<p>>08</p>
<br>
<p>>02</p>
</div>
</div>
</div>
</div>

</body>
</html>