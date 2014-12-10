Есть возможность возвращать массив из результата выполнения функции и кода ошибки. Очень удобно использовать для функций, выполняющих валидацию:

<?php
list($result, $error) = validateString($str);

if($error){
	// Что-нибудь сделать.
}
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
 
$url = $_GET['url'];
 
require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
function validateString($str){
	return array(false, "Строка не валидна");
}
?>
Использование and и or:

<?php
$foo and $this->bar(); // вызывается $this->bar(), если $foo имеет значение true
$bar or $this->foo(); // вызывается $this->foo(), когда $bar имеет значение false
?>
используя оператор or:

<?php
$array = [1, 2, 3, 4, 5];
empty($array) OR do_something();
?>
<input type="text" value="<?php $check AND print 'Hello World!' ?>" />
Печатаем массив в читабельном виде:

<?php
private function displayTree($array)
{
  $newline = "<br>";
  $output = "";
  foreach($array as $key => $value) {
      if (is_array($value) || is_object($value)) {
          $value = "Array()" . $newline . "(<ul>" . $this->displayTree($value) . "</ul>)" . $newline;
      }
     $output .= "[$key] => " . $value . $newline;
  }
  return $output;
}
  public function SetEncoding($encoding = "utf8", $collation = "utf8_unicode_ci")
  {   
    if(empty($encoding)) $encoding = "utf8";
    if(empty($collation)) $collation = "utf8_unicode_ci";    
    $sql_variables = array(
        'character_set_client'  =>$encoding,
        'character_set_server'  =>$encoding,
        'character_set_results' =>$encoding,
        'character_set_database'=>$encoding,
        'character_set_connection'=>$encoding,
        'collation_server'      =>$collation,
        'collation_database'    =>$collation,
        'collation_connection'  =>$collation
    );
    foreach($sql_variables as $var => $value){
      $sql = "SET $var=$value;";
      $this->Query($sql);
    }        
  }

  function check_db() {
    global $db;

    $sql = 'CREATE TABLE IF NOT EXISTS users ( 
           id INTEGER PRIMARY KEY,
           name TEXT,
           email TEXT,
           password TEXT,
           create_ip TEXT,
           create_date TEXT,
           status INTEGER
        )';
    $query = $db->prepare($sql);
    $query->execute();
  }
  if ($_SESSION['timeout'] + 30 * 60 < time()){
      session_destroy();
    }


    
function xls_check_server_environment()
{
  $phpinfo = parse_php_info();
  //We check all the elements we need for a successful install and pass back the report
  $checked = array();

  $checked['MySQLi'] = isset($phpinfo['mysqli']) ? "pass" : "fail";
  $checked['PHP Session'] = ($phpinfo['session']['Session Support'] == "enabled" ? "pass" : "fail");
  $checked['cURL Support'] = isset($phpinfo['curl']) ? "pass" : "fail";
  if ($checked['cURL Support'] == "pass") {
    $checked['cURL SSL Support'] = (
    (stripos($phpinfo['curl']['cURL Information'], "OpenSSL") !== false
      || stripos($phpinfo['curl']['cURL Information'], "NSS") !== false
      || $phpinfo['curl']['SSL'] == "Yes") ? "pass" : "fail");
  }
  $checked['Multi-Byte String Library'] = (
  $phpinfo['mbstring']['Multibyte Support'] == "enabled" ? "pass" : "fail");
  $checked['GD Library'] = ($phpinfo['gd']['GD Support'] == "enabled" ? "pass" : "fail");
  $checked['GD Library GIF'] = ($phpinfo['gd']['GIF Create Support'] == "enabled" ? "pass" : "fail");
  if (isset($phpinfo['gd']['JPG Support']))
    $checked['GD Library JPG'] = ($phpinfo['gd']['JPG Support'] == "enabled" ? "pass" : "fail");
  else $checked['GD Library JPG']= "fail";
  if ($checked['GD Library JPG'] == "fail") {
    $checked['GD Library JPG'] = (
    $phpinfo['gd']['JPEG Support'] == "enabled" ? "pass" : "fail");
  }
  $checked['GD Library PNG'] = ($phpinfo['gd']['PNG Support'] == "enabled" ? "pass" : "fail");
//  $checked['GD Library Freetype Support'] = (
//  $phpinfo['gd']['FreeType Support'] == "enabled" ? "pass" : "fail");
  $checked['MCrypt Encryption Library'] = isset($phpinfo['mcrypt']) ? "pass" : "fail";
  $checked['session.use_cookies must be turned On'] = (
  $phpinfo['session']['session.use_cookies'] == "On" ? "pass" : "fail");
//  $checked['session.use_only_cookies must be turned Off'] = (
//  $phpinfo['session']['session.use_only_cookies'] == "Off" ? "pass" : "fail");
  $checked['PDO Library'] = isset($phpinfo['PDO']) ? "pass" : "fail";
  $checked['pdo_mysql Library'] = isset($phpinfo['pdo_mysql']) ? "pass" : "fail";
  $checked['pdo_sqlite Library'] = isset($phpinfo['pdo_sqlite']) ? "pass" : "fail";
  $checked['Php_xml library'] = isset($phpinfo['xml']) ? "pass" : "fail";
  $checked['Zip Library'] = isset($phpinfo['zip']) ? "pass" : "fail";
  $checked['Soap Library'] = ($phpinfo['soap']['Soap Client'] == "enabled" ? "pass" : "fail");
  $checked['OpenSSL'] = ($phpinfo['openssl']['OpenSSL support'] == "enabled" ? "pass" : "fail");

  //Check php.ini settings

  //Removed in 5.4.0 so just check if we're running an older version

  if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $checked['magic_quotes_gpc in Php.ini must be turned Off'] = (
    $phpinfo['Core']['magic_quotes_gpc'] == "Off" ? "pass" : "fail");
    $checked['allow_call_time_pass_reference in Php.ini must be turned On'] = (
    $phpinfo['Core']['allow_call_time_pass_reference'] == "On" ? "pass" : "fail");
    $checked['register_globals in Php.ini must be turned Off'] = ($phpinfo['Core']['register_globals'] == "Off" ? "pass" : "fail");
    $checked['short_open_tag in Php.ini must be turned On'] = ($phpinfo['Core']['short_open_tag'] == "On" ? "pass" : "fail");
  }

  if (version_compare(PHP_VERSION, '5.3.27', '>='))
    $checked['Default timezone'] = ($phpinfo['date']['date.timezone'] == "no value" ? "fail" : "pass");


  //Check folder permissions
  if (file_exists('images'))
    $checked['/images folder must be writeable'] = (is_writable('images') ? "pass" : "fail");
  if (file_exists('assets'))
    $checked['/assets folder must be writeable'] = (is_writable('assets') ? "pass" : "fail");
  if (file_exists('runtime'))
    $checked['/runtime folder must be writeable'] = (is_writable('runtime') ? "pass" : "fail");
  if (file_exists('runtime/cache'))
    $checked['/runtime/cache folder must be writeable'] = (is_writable('runtime/cache') ? "pass" : "fail");
  if (file_exists('config'))
    $checked['/config folder must be writeable'] = (is_writable('config') ? "pass" : "fail");

  //If any of our items fail, be helpful and show them where the php.ini is. Otherwise, we hide it since working servers shouldn't advertise this
  if (in_array('fail',$checked))
    $checked = array_merge(array('<b>php.ini file is at</b> '.$phpinfo['phpinfotemp']['Loaded Configuration File']=>"pass"),$checked);
  return $checked;
}
?>