<?php
$PASSWORD = 'CHANGE ME';
$SEPARATOR = '## DATABASE ## ?>';
$QUERY_NOTATION = '//';


$save = isset($_POST['json']);
function exitMessage($success, $message, $message_key='message'){
  header('Content-Type: application/json');
  print '{"success":'.($success?'true':'false').',"'.$message_key.'":'.$message.'}';
  exit;
}
if($save && $_POST['pass'] == $PASSWORD):
  $new_json = json_encode($_POST['json']);
  if($new_json = json_decode($new_json)):
    $current = file_get_contents(__FILE__);
    $current_parts = explode($SEPARATOR, $current);
    if(count($current_parts) == 3):
      file_put_contents(__FILE__, $current_parts[0] . $SEPARATOR . $current_parts[1] . $SEPARATOR . $_POST['json']);
      exitMessage(TRUE, '"Saved!"');
    endif;
  else:
    exitMessage(FALSE, '"JSON parsing error."');
  endif;
elseif($save && isset($_POST['pass']) && $_POST['pass'] != $PASSWORD):
  header('Content-Type: application/json');
  print '{"success":false,"message":"Password did not match."}';
  exit;
endif;
if((isset($_GET['edit']) && (bool)$_GET['edit'] == TRUE) || (isset($_GET['edit']) && $_GET['edit'] == '')):
echo file_get_contents('https://cdn.rawgit.com/BOXNYC/JSON.DB/master/assets/json.db.htm'); exit;
elseif(isset($_GET['query']) && !empty($_GET['query'])):
$file = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['HTTP_HOST'].'/'.preg_replace('/\?.*$/','',$_SERVER['REQUEST_URI']);
$JSON = file_get_contents($file, true);
$JSON = json_decode($JSON, true);
$data = $JSON;
foreach(explode($QUERY_NOTATION, $_GET['query']) as $path) $data = $data[$path];
if($data) exitMessage(TRUE, json_encode($data), 'data');
else exitMessage(FALSE, '"Query retured null."');
else: header('Content-Type: application/json'); endif;


## DATABASE ## ?>{"JSON.DB.PHP":{"version":0.1}}
