<?php
$data = array(
  array("name" => "1", "type" => "ก่อนติดเครื่องยนต์", "thickness" => ".01", "price" => "$10"),
  array("name" => "2", "type" => "ก่อนติดเครื่องยนต์", "thickness" => ".02", "price" => "$20"),
  array("name" => "3", "type" => "ก่อนติดเครื่องยนต์", "thickness" => ".03", "price" => "$30"),
  array("name" => "4", "type" => "หลังติดเครื่องยนต์", "thickness" => ".04", "price" => "$40"),
  array("name" => "5", "type" => "หลังติดเครื่องยนต์", "thickness" => ".05", "price" => "$50"),
  array("name" => "6", "type" => "หลังติดเครื่องยนต์", "thickness" => ".06", "price" => "$60"),
  array("name" => "7", "type" => "หลังติดเครื่องยนต์", "thickness" => ".07", "price" => "$70")
);

$output = array();
$prevSizeVal = null;
$typeStartRow = 0;

$counter = 0; 
$totalRows = count($data);

while ($counter < $totalRows) {
  $result = $data[$counter];
  $row = array();

  $row[0] = "<td>".$result["type"]."</td>";
  $row[1] = "<td>".$result["name"]."</td>";
  $row[2] = "<td>".$result["thickness"]."</td>";
  $row[3] = "<td>".$result["price"]."</td>";

  $typeCol = "";

  if ($prevSizeVal != $result["type"]) {
      $typeStartRow = $counter;
      $typeCol = '<td rowspan="1" style="text-rotate:90">'.$result["type"].'</td>';
  }else{
      $output[$typeStartRow][0] = preg_replace('/rowspan="[\d]+"/', 'rowspan="'.($counter-$typeStartRow +1).'"', $output[$typeStartRow][0]);
  }

  $row[0] = $typeCol;

  $output[$counter] = $row;
  $prevSizeVal = $result["type"];
  $counter++;
}

echo "<table border='1'>
        <th colspan='2'>ลำดับ</th>
        <th>Thickness</th>
        <th>Price</th>";
    for ($i = 0; $i < count($output); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($output[$i]); $j++){
            $cell = $output[$i][$j];
            echo $cell;
        }
        echo "</tr>";
    }
echo "</table>";
?>