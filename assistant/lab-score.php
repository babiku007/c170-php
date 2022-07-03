<pre>
<?php
  if (!isset($_GET["score"])) {
    exit();
  } 
  $score = $_GET["score"];
  if ($score > 100 || $score < 0) {
    echo "out of range";
    exit();
  }

  // if practice
  echo "if practice: \n";
  $level = "";
  if ($score >= 85 && $score <= 100) {
    $level = "A";
  } else if ($score >= 75 && $score < 85) {
    $level = "B";
  } else if ($score >= 65 && $score < 75) {
    $level = "C";
  } else {
    $level = "不評分";
  }
  echo $level;

  // switch practice
  echo "\nswitch practice: \n";
  switch ($level) {
    case "A":
      echo "Very good.";
      break;
    case "B":
      echo "Not bad.";
      break;
    case "C":
      echo "You can do it.";
      break;
    default:
      echo "keep it up";
      break;
  }
?>
</pre>
