<?php
if(isset($_POST['json'])):
  $EPARATOR = '## DATABASE ## ?>';
  $new_json = json_encode($_POST['json']);
  if($new_json = json_decode($new_json)) {
    $current = file_get_contents(__FILE__);
    $current_parts = explode($EPARATOR, $current);
    if(count($current_parts) == 3)
      file_put_contents(__FILE__, $current_parts[0] . $EPARATOR . $current_parts[1] . $EPARATOR . $_POST['json']);
  }
  header('Content-Type: application/json');
  print $_POST['json'];
  exit;
endif;
if((isset($_GET['edit']) && (bool)$_GET['edit'] == TRUE) || (isset($_GET['edit']) && $_GET['edit'] == '')):
echo file_get_contents('https://cdn.rawgit.com/BOXNYC/JSON.DB.PHP/master/json.db.php.html5');
exit; else: header('Content-Type: application/json'); endif;



## DATABASE ## ?>{"JSON.DB.PHP":{"version":0.1}}
