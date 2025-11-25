<?php
session_start();
/* 
	-Jet Line v8.0 Lite-
	Author: Just Adil
	GitHub: https://GitHub.com/A01L
	Version: Jetline v8.0 Lite
 */

//Set all config for gl-obal
require_once "config.php";
#--------------------------------------------DEFAULT FUNCTIONS-------------------------------------------

function phone($phone) {
    // Удаляем всё, кроме цифр
    $digits = preg_replace('/\D+/', '', $phone);

    // Если номер начинается с '8', заменяем на '7'
    if (strlen($digits) == 11 && $digits[0] == '8') {
        $digits[0] = '7';
    }

    // Если номер начинается с '7' и имеет 11 цифр — норм
    if (strlen($digits) == 11 && $digits[0] == '7') {
        return $digits;
    }

    // Если номер содержит 10 цифр, добавим '7' в начало
    if (strlen($digits) == 10) {
        return '7' . $digits;
    }

    // Если не удаётся привести к нормальному формату, возвращаем null или false
    return null;
}

//Get and saver file
function get_file($path, $name, $newn = "null")
	{
		if (!@copy($_FILES["$name"]['tmp_name'], "containers/".$path.$_FILES["$name"]['name'])){
			return 1;
			}
		else {
			$fn = $_FILES["$name"]['name'];
			$type = format($fn);
			if ($newn != "null") {
				rename("containers/$path$fn", "containers/$path$newn.$type");
				return "$newn.$type";
			}
			else{
				$fnn=str_replace( " " , "_" , $_FILES["$name"]['name']);
				rename("containers/$path$fn", "containers/$path$fnn");
				return "$fnn";
			}
		}
	}


//Get foramt from file
function format($file)
	{
		 $temp= explode('.',$file);
		 $extension = end($temp);
		 return $extension;
	}

# ---------------------------------------------CLASS--------------------------------------------------#

//Other tools
class GEN {

	//Generate random symbols
	public static function str($length = 6, $mod = '*'){	
		if($mod == 'A'){
			$arr = array(
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
				'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			);
		}
		elseif($mod == 'a'){
			$arr = array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
				'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			);
		}
		elseif($mod == '*'){
			$arr = array(
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
				'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
				'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			);
		}
		else{ return 'ERROR MOD'; }
	 
		$res = '';
		for ($i = 0; $i < $length; $i++) {
			$res .= $arr[random_int(0, count($arr) - 1)];
		}
		return $res;
	}
	
	//Generate random numbers
	public static function int($length = 6){
		$arr = array(
			'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
		);
	 
		$res = '';
		for ($i = 0; $i < $length; $i++) {
			$res .= $arr[random_int(0, count($arr) - 1)];
		}
		return $res;
	}

	//Generate random (numbers and symbols)
	public static function mix($length = 6){
		$arr = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
			'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
		);
	 
		$res = '';
		for ($i = 0; $i < $length; $i++) {
			$res .= $arr[random_int(0, count($arr) - 1)];
		}
		return $res;
	}

	//Generate link for whatsapp
	public static function wame($number, $msg = " "){
		$data=urlencode($msg);
		$link="https://api.whatsapp.com/send?phone=$number&text=$data";
		return $link;
	}

	//Generate link of text
	public static function url($msg){
		return urlencode($msg);
	}

}

// data base control
class DBC {

	//Count rows
	public static function count($table, $key){
		$ma = $key;
		$query = "SELECT * FROM `".$table."` WHERE ";
		$value = "VALUES (";
		foreach(array_keys($ma) as $key){
			$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
		}
		$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);
		$sql = $query;
		$conn = $GLOBALS['db'];

		if($result = $conn->query($sql)){
			$rowsCount = $result->num_rows; // ID - constant
			return $rowsCount;
			//return $rowsCount;
			$result->free();
		}

	}

	//Init direct SQL syntax
	public static function sql($sql, $fetch=false)
	{
		$query = mysqli_query($GLOBALS['db'], $sql);
		if($fetch){
			return mysqli_fetch_assoc($query);
		}
		return $query;
	}

	//Add data to table
	public static function insert($table, $values){
		$ma = $values;
		$query = "INSERT INTO `".$table."`(";
		$value = "VALUES (";
		foreach(array_keys($ma) as $key){
			$query = $query."`".$key."`, ";
		}
		$query = mb_eregi_replace("(.*)[^.]{2}$", '\\1', $query);
		$query = $query.")";
		foreach(array_keys($ma) as $key){
			$value = $value."'".$ma["$key"]."', ";
		}
		$value = mb_eregi_replace("(.*)[^.]{2}$", '\\1', $value);
		$value = $value.")";
		$full = $query." ".$value;
		return mysqli_query($GLOBALS['db'], $full);
	}

	//Update data in table
	public static function update($table, $data, $id){
		$query = "UPDATE `".$table."` SET ";
		foreach(array_keys($data) as $key){
			$query = $query."`".$key."` = '".$data["$key"]."', ";
		}
		$query = mb_eregi_replace("(.*)[^.]{2}$", '\\1', $query);



		$ma = $id;
		$query = $query."WHERE ";
		foreach(array_keys($ma) as $key){
			$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
		}
		$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

		mysqli_query($GLOBALS['db'], $query);
		return $query;
	}

	//Get data from table
	public static function select($table, $index, $data='a', $limit='none'){
			
		if($data != 'a'){
			$db = $GLOBALS['db'];
			
			$ma = $index;
			$query = "SELECT * FROM `$table` WHERE ";
			foreach(array_keys($ma) as $key){
				$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
			}
			$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

			$query = mysqli_query($db, $query);
			$datas = mysqli_fetch_assoc($query);
			return $datas[$data];
		}
		else{
			$db = $GLOBALS['db'];
			
			$ma = $index;
			$query = "SELECT * FROM `$table` WHERE ";
			foreach(array_keys($ma) as $key){
				$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
			}
			$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

			if($limit!='none'){
				$query .= " LIMIT ".$limit;
			}

			$query = mysqli_query($db, $query);
			// $datas = mysqli_fetch_assoc($query);
			return $query;
		}
    }

	//Get data from table
	public static function pin($table, $index, $data='a'){
			
		if($data != 'a'){
			$db = $GLOBALS['db'];
			
			$ma = $index;
			$query = "SELECT * FROM `$table` WHERE ";
			foreach(array_keys($ma) as $key){
				$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
			}
			$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

			$query = mysqli_query($db, $query);
			$datas = mysqli_fetch_assoc($query);
			return $datas[$data];
		}
		else{
			$db = $GLOBALS['db'];
			
			$ma = $index;
			$query = "SELECT * FROM `$table` WHERE ";
			foreach(array_keys($ma) as $key){
				$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
			}
			$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

			$query = mysqli_query($db, $query);
			$datas = mysqli_fetch_assoc($query);
			return $datas;
		}
    }

	//Delete data
	public static function delete($table, $index){
		$db = $GLOBALS['db'];

		$ma = $index;
		$query = "DELETE FROM `$table` WHERE ";
		foreach(array_keys($ma) as $key){
			$query = $query."`".$key."` = '".$ma["$key"]."' AND ";
		}
		$query = mb_eregi_replace("(.*)[^.]{4}$", '\\1', $query);

    	mysqli_query($db, $query);
    }

	//Get data from table
	public static function show($table, $fetch = false, $limit=100000 ){
		$query = "SELECT * FROM `$table` ORDER BY 'id' DESC  LIMIT $limit ";
		$query = mysqli_query($GLOBALS['db'], $query);
        if($fetch){
            $query = mysqli_fetch_assoc($query);
        }
		return $query;
    }

}

//Text control
class STR {

	//Cleaning string
	public static function clean($data) {
		// Удаляем пробелы в начале и конце строки
		$data = trim($data);
		// Удаляем слеши (например, если используется magic quotes)
		$data = stripslashes($data);
		return $data;
	}

	//cuting text
	public static function cut($start, $textf, $end){
    $t1 = mb_eregi_replace("(.*)[^.]{".$end."}$", '\\1', $textf);
    $t2 = mb_eregi_replace("^.{".$start."}(.*)$", '\\1', $t1);
    $textf = $t2;
    return $textf;
	}

	//get format (value after dote)
	public static function format($file){
		 $temp= explode('.',$file);
		 $extension = end($temp);
		 return $extension;
	}

}

//Data control
class DTC{

	// Amo CRM
	public static function amo($name, $phone, $type = 'Общая консультация'){
		// Данные формы
		$form_id = '1563066';
		$hash = '37adc78d77b3768dd28ef29db9939e41';

		// Формируем массив данных
		$data = [
			"fields" => [
				"name_1" => $name,
				"name_2" => $type,
				"686217_1" => [ // ID поля формы (получен из отладчика браузера)
					"1118877" => $phone // Вложенное значение — сам номер
				]
			],
			"form_id" => $form_id,
			"hash" => $hash,
			"visitor_uid" => uniqid(), // можно сгенерировать, как идентификатор клиента
			"form_request_id" => uniqid(), // можно любое уникальное значение
			"user_origin" => json_encode([
				"datetime" => date("r"),
				"referer" => $_SERVER['HTTP_REFERER'] ?? ''
			]),
			"gso_session_uid" => null
		];

		// Отправляем POST-запрос
		$ch = curl_init("https://forms.amocrm.ru/queue/add");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded'
		]);
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		// Ответ
		if ($httpcode === 200) {
			return true;
		} else {
			return false;
		}		
	}

	//Storage control
	public static function storage($path_storage, $name_form){

		date_default_timezone_set('UTC');
		$dir = date("Ym");
		$gen1 = date("dHis"); 
		$gen2 = GEN::int(3);
		$fname = "$gen1$gen2";

		if (is_dir("containers/$path_storage/$dir")) {
			get_file("/$path_storage/$dir/", $name_form, $fname);
		} 
		else {
			mkdir("containers/$path_storage/$dir", 0777, true);
			get_file("/$path_storage/$dir/", $name_form, $fname);
		}

		$ex = format($_FILES["$name_form"]['name']);
		$call_back = array(
			"name" => "$fname.$ex",
			"path" => "$dir/",
			"full" => "$dir/$fname.$ex"
		);
		return $call_back;
	}

	//Getting file 
	public static function save($path, $name, $newn = "null"){

		if (!@copy($_FILES["$name"]['tmp_name'], "containers/".$path.$_FILES["$name"]['name'])){
			return 'error';
			}
		else {
			$fn = $_FILES["$name"]['name'];
			$type = format($fn);
			if ($newn != "null") {
				rename("containers/$path$fn", "containers/$path$newn.$type");
				return "$newn.$type";
			}
			else{
				$fnn=str_replace( " " , "_" , $_FILES["$name"]['name']);
				rename("containers/$path$fn", "containers/$path$fnn");
				return "$fnn";
			}
		}
	}

	//Upload Files
	public static function upload($formName, $targetPath) {
		$uploadedFiles = array(); // Массив для хранения имен загруженных файлов
		$targetPath = 'containers/'.$targetPath;
		// Проверяем, была ли отправлена форма
		if(isset($_FILES[$formName])) {
			// Проверяем, есть ли файлы для загрузки
			if(!empty($_FILES[$formName]['name'])) {
				// Получаем текущую дату и время
				$currentDateTime = new DateTime();
				// Формируем название папки для сохранения файлов (год-месяц-день)
				$folderName = $currentDateTime->format('Y-m-d');
				// Создаем путь для сохранения файлов, если он не существует
				$targetPath .= $folderName . '/';
				if(!file_exists($targetPath)) {
					if(!mkdir($targetPath, 0777, true)) {
						echo "Failed to create directory";
						return $folderName."/".$uploadedFiles;
					}
				}
				
				// Обработка каждого загруженного файла
				if(is_array($_FILES[$formName]['tmp_name'])) {
					foreach($_FILES[$formName]['tmp_name'] as $key => $tmp_name) {
						$uploadOk = 1;
						// Получаем текущее время для формирования имени файла (час-минута-секунда-миллисекунда)
						$currentTime = microtime(true);
						$randomNumber = mt_rand(100, 999); // Генерируем случайное число из 2 символов
						$fileExtension = pathinfo($_FILES[$formName]['name'][$key], PATHINFO_EXTENSION);
						$fileName = $currentDateTime->format('H-i-s-u') . '-' . $randomNumber . '.' . $fileExtension;
						$target_file = $targetPath . $fileName;
						
						// Если все проверки пройдены, попытка загрузки файла
						if(move_uploaded_file($_FILES[$formName]['tmp_name'][$key], $target_file)) {
							$uploadedFiles[] = $folderName."/".$fileName; // Добавляем имя файла в массив
						} else {
							echo "Failed to upload file: " . $_FILES[$formName]['name'][$key] . ". ";
							$error = error_get_last();
							echo "Error message: " . $error['message'];
						}
					}
				} else {
					$uploadOk = 1;
					// Получаем текущее время для формирования имени файла (час-минута-секунда-миллисекунда)
					$currentTime = microtime(true);
					$randomNumber = mt_rand(100, 999); // Генерируем случайное число из 2 символов
					$fileExtension = pathinfo($_FILES[$formName]['name'], PATHINFO_EXTENSION);
					$fileName = $currentDateTime->format('H-i-s-u') . '-' . $randomNumber . '.' . $fileExtension;
					$target_file = $targetPath . $fileName;
					
					// Если все проверки пройдены, попытка загрузки файла
					if(move_uploaded_file($_FILES[$formName]['tmp_name'], $target_file)) {
						$uploadedFiles[] = $folderName."/".$fileName; // Добавляем имя файла в массив
					} else {
						echo "Failed to upload file: " . $_FILES[$formName]['name'] . ". ";
						$error = error_get_last();
						echo "Error message: " . $error['message'];
					}
				}
			} else {
				echo "No files were uploaded.";
			}
		}
		
		return $uploadedFiles; // Возвращаем массив с именами загруженных файлов
	}

	//Send [GET] data to link
	public static function get($link, $data){
		$ch = curl_init("$link?" . http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$return = curl_exec($ch);
		curl_close($ch);
		return $return;
		
	}

	//Send [POST] data to link
	public static function post($link, $data){
			$ch = curl_init("$link");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, false);
			$re = curl_exec($ch);
			curl_close($ch);	
			return $re;
		
	}

	//Get all data in global param GET, POST
	public static function dump($type){
		if ($type == "post" OR $type == "p") {
			$a = array();
			if (isset($_POST)){
			    foreach ($_POST as $key=>$value){
			        $a[$key]=$value;
			    }
			}
			print_r($a);
		}
		elseif ($type == "get" OR $type == "g") {
			$a = array();
			if (isset($_GET)){
			    foreach ($_GET as $key=>$value){
			        $a[$key]=$value;
			    }
			}
			print_r($a);
		}
		else{
			echo "Error type!";
		}
	}

	//Listening calls from other sources (API gate)
	public static function gate(){
		$a = array();
			if (isset($_POST)){
			foreach ($_POST as $key=>$value){
			    $a[$key]=$value;
			}
		}
		$inputs['post'] = $a;

			
		$a = array();
		if (isset($_GET)){
			foreach ($_GET as $key=>$value){
			    $a[$key]=$value;
			}
		}
		$inputs['get'] = $a;

		return $inputs;
	}

	//Writing datas to file
	public static function file($path, $data){
		// Запись данных в файл, перезапись существующего содержимого
		file_put_contents($path, $data);
	}
}

//Router controller
class Router {
	//For auto craeting router list
	public static function scan($directory, $outputFile){
		// Проверяем, существует ли каталог и является ли он каталогом
		if (!is_dir("containers/".$directory)) {
			echo "Указанный путь не является каталогом.";
			return;
		}
	
		// Открываем файл для записи (режим 'w' - перезапись файла)
		$fileHandle = fopen($_SERVER["DOCUMENT_ROOT"]."/global/router/".$outputFile.".php", 'w');
		if (!$fileHandle) {
			echo "Не удалось открыть файл для записи.";
			return;
		}
	
		// Сканируем каталог и получаем массив файлов и подкаталогов
		$files = scandir("containers/".$directory);
		fwrite($fileHandle, "<?php " . PHP_EOL);

		// Перебираем каждый элемент массива
		foreach ($files as $file) {
			// Пропускаем '.' и '..'
			if ($file === '.' || $file === '..') {
				continue;
			}
	
			// Получаем полный путь к файлу/подкаталогу
			$filePath = "containers/".$directory . DIRECTORY_SEPARATOR . $file;
	
			// Проверяем, является ли элемент файлом
			if (is_file($filePath)) {
				// Записываем имя файла в выходной файл
				fwrite($fileHandle, "Router::set('/".$file. "', '".$directory."/".$file."');" . PHP_EOL);
			}
		}

		fwrite($fileHandle, "?>" . PHP_EOL);
	
		// Закрываем файл
		fclose($fileHandle);
	}

	//Routing for getting content (adding new url)
	public static function set($link, $path){
		global $routes_ectr;
		$routes_ectr["$link"] = "$path";
	}

	//Router collection set
	public static function collection($name){
		include "global/router/".$name.".php";
	}

	public static function on() {
		global $routes_ectr;

		$url = $_SERVER['REQUEST_URI'];
		$url = explode('?', $url)[0]; 
		$basePath = $GLOBALS['all_trafic'];

		if (array_key_exists($url, $routes_ectr)) {
			$handler = $routes_ectr[$url];
			include $basePath . "/" . $handler;
			return;
		}

		$path = realpath($basePath . $url);

		if ($path && is_dir($path)) {
			if (file_exists($path . "/index.php")) {
				include $path . "/index.php";
				return;
			} elseif (file_exists($path . "/index.html")) {
				header('Content-Type: text/html');
				readfile($path . "/index.html");
				return;
			}
		} elseif ($path && is_file($path)) {
			$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
			$mimeTypes = [
				'png'  => 'image/png',
				'jpg'  => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'gif'  => 'image/gif',
				'svg'  => 'image/svg+xml',
				'css'  => 'text/css',
				'js'   => 'application/javascript',
				'json' => 'application/json',
				'pdf'  => 'application/pdf',
				'html' => 'text/html',
				'txt'  => 'text/plain'
			];

			if ($ext === 'php') {
				include $path;
			} else {
				header('Content-Type: ' . ($mimeTypes[$ext] ?? 'application/octet-stream'));
				readfile($path);
			}
			return;
		}

		include $GLOBALS['404'];
	}


	//Absolute path creator 
	public static function path($path='/'){
		return $_SERVER["DOCUMENT_ROOT"].$path;
	}

	//Redirecting 
	public static function redirect($url, $sleep = 0){
		header('Refresh: '.$sleep.'; url='.$url);
		exit();
	}

	//Get host (may add path)
	public static function host($path = ""){
		if ($path) {
			$link="$path";
		}
		else {
			$link=null;
		}
			$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$link";		
		
		return $actual_link;
	}

	//Get full real url
	public static function url(){
		$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return $actual_link;
	}
}

//Session controller
class Session {

	//Create new Session
	public static function set($name, $array){
		$_SESSION["$name"] = $array;
	}

	//Close Session
	public static function close($name){
		unset($_SESSION["$name"]);
	}

	//Route if not session
	public static function not($name, $locate){
		if (!isset($_SESSION["$name"])) {
    		header('Location: '.$locate);
			exit;
		}
	}

	//Route if have Session
	public static function yes($name, $locate){
		if (isset($_SESSION["$name"])) {
    		header('Location: '.$locate);
			exit;
		}
	}

	//Check session (have = 1 / not = 0)
	public static function check($name){
		if (!isset($_SESSION["$name"])) { return 0; }
		else { return 1; }
	}

}

//Interface for debuging
class ERRC{
	public function __construct(){
		if(DEBUG){error_reporting(-1);}
		else{error_reporting(0);}
		set_error_handler([$this, 'errorHandler']);
		ob_start();
		register_shutdown_function([$this, 'fatalErrorHandler']);
	}

	public function errorHandler($errno, $errstr, $errfile, $errline){
		$this->displayErr($errno, $errstr, $errfile, $errline);
		return true;
	}

	public function fatalErrorHandler(){
		$error = error_get_last();
		if( !empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)){
			ob_end_clean();
			$this->displayErr($error['type'], $error['message'], $error['file'], $error['line']);
		}
		else{
			ob_end_flush();
		}
	}

	protected function displayErr($errno, $errstr, $errfile, $errline, $response=500){
		http_response_code($response);
		if(true){require_once 'modules/DEBUG/Dview.php';}
		else{require_once 'modules/DEBUG/Pview.php';}
		die;
	}
}

//Collection (requires) controller
class Collection{

	//For creating new list
	public static function new($list){
		foreach($list as $source){
			include "containers/".$source;
		}
	}

	//For connect template list
	public static function set($template){
		include $_SERVER["DOCUMENT_ROOT"]."/global/collection/".$template.".php";
	}

}

//Telegram bot API
class TB{
    
    // Отправка запроса
    public static function sendRequest($method, $params = []) {
        $url = 'https://api.telegram.org/bot' . $GLOBALS['tb_token'] . '/' . $method;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return json_decode(file_get_contents($url), true);
    }
    
    // Установка вебхука
    public static function setWebhook() {
        return self::sendRequest('setWebhook', ['url' => Router::host($GLOBALS['tb_port'])]);
        // return Router::host($GLOBALS['tb_port']);
    }
    
    // Отправка фото
    public static function sendPhoto($chatId, $photoPath, $caption = '') {
        $url = 'https://api.telegram.org/bot' . $GLOBALS['tb_token'] . '/sendPhoto';
    
        $postFields = array(
            'chat_id' => $chatId,
            'photo' => new CURLFile($photoPath),
            'caption' => $caption
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($result, true);
    }
    
    // Отправка документа
    public static function sendDocs($chatId, $docPath, $caption = ''){
        $response = array(
            'chat_id' => $chatId,
            'document' => new CURLFile($docPath),
            'caption' => $caption
        );	
                
        $ch = curl_init('https://api.telegram.org/bot' . $GLOBALS['tb_token'] . '/sendDocument');  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_exec($ch);
        curl_close($ch);
    }
    
    // Отправка сообщений
    public static function sendMessage($chatId, $text) {
        self::sendRequest('sendMessage', ['chat_id' => $chatId, 'text' => $text]);
    }
    
    // Получение документа
    public static function downloadTelegramFile($fileId, $savePath) {
        $fileInfo = self::sendRequest('getFile', ['file_id' => $fileId]);
    
        if ($fileInfo['ok']) {
            $fileUrl = 'https://api.telegram.org/file/bot' . $GLOBALS['tb_token'] . '/' . $fileInfo['result']['file_path'];
    
            $content = file_get_contents($fileUrl);
    
            file_put_contents($savePath, $content);
    
            return true;
        } else {
            return false;
        }
    }
    
    // Показать командные кнопки
    public static function displayButtons($chatId, $buttons) {
        $keyboard = [
            'keyboard' => [],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
    
        foreach ($buttons as $button) {
            $keyboard['keyboard'][] = [$button];
        }
    
        $replyMarkup = json_encode($keyboard);
    
        self::sendRequest('sendMessage', [
            'chat_id' => $chatId,
            'text' => '',
            'reply_markup' => $replyMarkup
        ]);
    }
    
    // Скрыть командные кнопки
    public static function hideKeyboard($chatId, $message = '') {
        $replyMarkup = json_encode(['remove_keyboard' => true]);
    
        self::sendRequest('sendMessage', [
            'chat_id' => $chatId,
            'text' => $message,
            'reply_markup' => $replyMarkup
        ]);
    }

    // Приеменый канал бота
    public static function init(){
        $update = json_decode(file_get_contents('php://input'), true, 512, JSON_UNESCAPED_UNICODE);

        if (isset($update['message'])) {
            $message = $update['message'];
            return array('id'=>$message['chat']['id'], 'text'=>$message['text'], 'first_name'=>$message['chat']['first_name']); 
        }
        else {
            self::setWebhook();
        }
    }
}

class BIT{
	// Отправка формы
    public static function form($url, $params) {
		// Формируем строку запроса с массивом FIELDS
		$fields = [];
		foreach ($params as $key => $value) {
			if ($key === 'PHONE' && isset($value['VALUE']) && isset($value['VALUE_TYPE'])) {
				$fields[] = 'FIELDS[' . urlencode($key) . '][VALUE]=' . urlencode($value['VALUE']);
				$fields[] = 'FIELDS[' . urlencode($key) . '][VALUE_TYPE]=' . urlencode($value['VALUE_TYPE']);
			} elseif ($key === 'PHONE' && isset($value['VALUE'])) {
				$fields[] = 'FIELDS[' . urlencode($key) . '][VALUE]=' . urlencode($value['VALUE']);
			} else {
				$fields[] = 'FIELDS[' . urlencode($key) . ']=' . urlencode($value);
			}
		}
		$url .= implode('&', $fields) . '&';
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return json_encode(file_get_contents($url), true);
    }
}

//Cookie controller
class Cookie {
    public static function set($name, $value) {
        // Устанавливаем куки с указанным именем и значением
        setcookie($name, $value, time() + (86400 * 30), '/'); // куки действительны в течение 30 дней
    }
    
    public static function select($name) {
        if(isset($_COOKIE[$name])) {
            // Получаем значение куки и декодируем его из JSON в массив
            $value = json_decode($_COOKIE[$name], true);
            return $value;
        } else {
            return null;
        }
    }
    
    public static function delete($name) {
        // Устанавливаем куки с прошедшей датой, чтобы они истекли
        setcookie($name, '', time() - 3600, '/');
    }
}

#-----------------------------------------------AUTO RUN----------------------------------------------
new ERRC;
?>