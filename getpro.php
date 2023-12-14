<?php
include 'connection.php';

$sql="SELECT * FROM products ORDER BY pro_id ASC";
$result = mysqli_query($conn,$sql);

echo "<table>
<tr>
<th>Image</th>
<th>ID</th>
<th>Product Name</th>
<th>Category ID</th>
<th>Price</th>

<th>Details</th>
<th>Function</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td><img style='width: 100%' src='" . $row['pro_img'] . "'></img></td>";
  echo "<td>" . $row['pro_id'] . "</td>";
  echo "<td>" . $row['pro_name'] . "</td>";
  echo "<td>" . $row['cat_id'] . "</td>";
  echo "<td>" . $row['pro_price'] . "</td>";

  echo "<td>" . $row['pro_details'] . "</td>";
  echo "<td> <form method='post' action=''><input type='hidden' name='p_id' value='". $row["pro_id"] ."' /> <button type='submit' name='deletepro'> Delete </button> </form></td>";
  echo "</tr>";
}
echo "</table>";

    
mysqli_close($conn);
?>