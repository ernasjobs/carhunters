<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "carstore");
$output = '';
/* gets input from previus page and runs a query as below */
if(isset($_POST["query"]))
{
    
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 if(is_numeric($search))
 echo '';
 else
 echo '';
 $query = "
  SELECT * FROM cars 
  WHERE 
  carIndex LIKE '%".$search."%'
  OR make LIKE '%".$search."%' 
  OR model LIKE '%".$search."%' 
  OR town LIKE '%".$search."%' 
  OR dealer LIKE '%".$search."%'
  OR colour LIKE '%".$search."%'

 ";
}
else
{
 $query = "
  SELECT * FROM cars ORDER BY carIndex
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
 <table class="table table-sm table-dark">
 <thead class="col-md-offset-2">
     <tr>
         <th >CarIndex</th>
         <th>Make</th>
         <th>Model</th>
         <th>Reg</th>
         <th>Colour</th>
         <th>Miles</th>
         <th>Price</th>
         <th>Picture</th>
         <th></th>
         <th>Action</th>
         <th></th>
     </tr>
 </thead>
 <tbody>
 ';
 while($row = mysqli_fetch_array($result))
 {
     $pathx="images/";
     $file=$row['picture'];
     $carIndex=$row['carIndex'];
     $viewCarDetails="viewCarDetails.php?carIndex=";
     $editCarDetails="editCarDetails.php?carIndex=";
     $deleteCar="deleteCar.php?carIndex=";
  $output .= '
   <tr>
    <td>'.$row["carIndex"].'</td>
    <td>'.$row["make"].'</td>
    <td>'.$row["model"].'</td>
    <td>'.$row["Reg"].'</td>
    <td>'.$row["colour"].'</td>
    <td>'.$row["miles"].'</td>
    <td>'.$row["price"].'</td>
    <td><img src="'.$pathx.$file.'" width=160 height=80></td>
    <td><a  href="'.$viewCarDetails.$carIndex.'" class="btn btn-info">More</a></td>
    <td><a href="'.$editCarDetails.$carIndex.'" class="btn btn-success">Edit</a></td>
    <td><a href="'.$deleteCar.$carIndex.'" class="btn btn-danger">Delete</a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>
  
    