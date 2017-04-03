<?php
	header("Content-Type: text/html;charset=utf-8");

	class PostgreSQL {
		var $db;

		function __construct($host, $port, $dbase, $user, $pass){
			$cn = sprintf("host=%s;port=%s;dbname=%s;user=%s;password=%s", 
				$host, $port, $dbase, $user, $pass);

			if ($this->db = new PDO("pgsql:".$cn)){
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				if (@$this->db->query("SET NAMES 'utf8'"))
					return true;
			}

			return false;
		}

		/*
			+-------+-----------------------------------------------------------+
			|       Lista de códigos que representan actividades o eventos.      |
			+-------+-----------------------------------------------------------+
			| Code 	|	Descripción												|
			+-------+-----------------------------------------------------------+
			|  -1 	|	Apertura de cuenta										|
			|   0 	|	Cierre de sesión										|
			|   1 	|	Inicio de sesión										|
			|   2 	|	Actualización del nombre de usuario						|
			|   3 	|	Actualización de la contraseña							|
			|   4 	|	Actualización del correo electrónico					|
			|   5 	|	Actualización de la imagen de perfil					|
			|   6 	|	Eliminación de un usuario								|
			|   7 	|	Creación de un usuario									|
			+-------+-----------------------------------------------------------+
		*/
	    public function addActivity($usr, $code, $description){
	    	$usr = $this->CleanString($usr);
	    	
	    	$Reason = $this->db->prepare("INSERT INTO vip_user_activity (username, code, description, date_log, date_log_unix) VALUES (:username,:code,:description,:date_log,:date_log_unix)");

	    	$Reason->bindValue(":username", $usr);
	    	$Reason->bindValue(":code", $code);
	    	$Reason->bindValue(":description", $description);
	    	$Reason->bindValue(":date_log", date('Y-n-j'));
	    	$Reason->bindValue(":date_log_unix", time());

	    	if ($Reason->execute())
	    		return true;

	    	return false;
	    }

	    public function getMyActivity($Quantity){
	    	@session_start();
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username='".@$_SESSION['usr']."' ORDER BY date_log_unix DESC LIMIT ".$Quantity.";");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		return $UsersData;
	    	}

	    	return false;
	    }

	    public function getActivityWithOutMe($Quantity){
	    	@session_start();
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username!='".@$_SESSION['usr']."' ORDER BY date_log_unix DESC LIMIT ".$Quantity.";");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		return $UsersData;
	    	}

	    	return false;
	    }

	    public function addNewUser($usr, $pwd, $email, $usr_author){	    	
	    	$q = "INSERT INTO vip_user (username, password) VALUES (:username,:password);";
	    	$usr = $this->CleanString($usr);

	    	$stmt = $this->db->prepare($q);

	    	$stmt->bindValue(":username", $usr);
	    	$stmt->bindValue(":password", password_hash($pwd, PASSWORD_DEFAULT));

	    	if ($stmt->execute())
	    		if ($this->addNewUserInfo($usr, $email))
	    			if ($this->DirUser($usr))
	    				if ($this->addActivity($usr_author, 7, "Agregando nuevo usuario: ".$usr))
	    					return true;

	    	return false;
	    }

	    public function addNewUserInfo($usr, $email){
	    	$q = "INSERT INTO vip_user_info (username, email, date_log, date_log_unix) VALUES (:username,:email,:date_log,:date_log_unix);";
	    
	    	$stmt = $this->db->prepare($q);

	    	$stmt->bindValue(":username", 		$usr);
	    	$stmt->bindValue(":email", 			$email);
	    	$stmt->bindValue(":date_log", 		date('Y-n-j'));
	    	$stmt->bindValue(":date_log_unix", 	time());

	    	if ($stmt->execute())
	    		return true;

	    	return false;
	    }

	    public function addUserImgPerfil($usr, $folder, $src){
	    	$src = $this->CleanString($src);

	    	$QueryImgPerfil = $this->db->prepare("INSERT INTO vip_user_img_perfil (username, folder, src, date_log, date_log_unix) VALUES (:username,:folder,:src,:date_log,:date_log_unix)");

	    	$QueryImgPerfil->bindValue(":username", $usr);
	    	$QueryImgPerfil->bindValue(":folder", $folder);
	    	$QueryImgPerfil->bindValue(":src", $src);
	    	$QueryImgPerfil->bindValue(":date_log", date('Y-n-j'));
	    	$QueryImgPerfil->bindValue(":date_log_unix", time());

	    	if ($this->addActivity($usr, 5, "Agregando nueva imagen de perfil:  ".$src))
		    	if ($QueryImgPerfil->execute())
		    		return true;

	    	return false;
	    }

	    public function deleteUser($usr){
	    	$Reason = $this->db->prepare('DELETE FROM vip_user '
                . 'WHERE username = :usr');
        	$Reason->bindValue(':usr', $usr);

        	@session_start();
        	if ($this->addActivity(@$_SESSION['usr'], 6, "Eliminando al usuario: ".$usr))
	       		if ($Reason->execute())
	       			return true;

        	return false;
	    }

	    public function updateUser($new_usr, $usr){
	    	$new_usr = $this->CleanString($new_usr);

	    	$Reason = $this->db->prepare('UPDATE vip_user '
                . 'SET username = :new_usr '
                . 'WHERE username = :current_usr');

        	$Reason->bindValue(':new_usr', $new_usr);
        	$Reason->bindValue(':current_usr', $usr);

        	$path = "../../../../private/desktop0/users/";

        	rename($path.$usr."/", $path.$new_usr."/");

        	@session_start();
        	@$_SESSION['usr'] = $new_usr;

        	if ($this->addActivity($usr, 2, "Nombre de usuario modificado de ".$usr." a ".$new_usr))
		    	if ($Reason->execute())
		    		if ($this->updateUserPathImg($new_usr, $usr))
		    			return true;

	    	return false;
	    }

	    public function updateUserEmail($usr, $email){
	    	$email = $this->CleanString($email);

	    	$Reason = $this->db->prepare('UPDATE vip_user_info '
                . 'SET email = :email '
                . 'WHERE username = :usr');

	    	$Reason->bindValue(':email', $email);
        	$Reason->bindValue(':usr', $usr);

        	if ($this->addActivity($usr, 4, "Actualización de E-Mail de ".$this->getUserEmail($usr)." a ".$email))
		    	if ($Reason->execute())
		    		return true;

		    return false;
	    }

	    public function updateUserPassword($usr, $current_pwd, $new_pwd){
	    	if ($this->VerifyUserPassword($usr, $current_pwd)){
	    		
	    		$Reason = $this->db->prepare('UPDATE vip_user '
                . 'SET password = :new_pwd '
                . 'WHERE username = :usr');

		    	$Reason->bindValue(':new_pwd', password_hash($new_pwd, PASSWORD_DEFAULT));
	        	$Reason->bindValue(':usr', $usr);

	        	if ($this->addActivity($usr, 3, "Actualización de contraseña"))
			    	if ($Reason->execute())
			    		return true;

			    return -2;

	    	} else {
	    		return -1;
	    	}

	    	return false;
	    }

	    public function VerifyUserPassword($usr, $current_pwd){	    	
	    	$stmt = $this->db->query("SELECT password FROM vip_user WHERE username='".$usr."';");
	    
	    	if ($stmt->rowCount() > 0)
	    		while ($r = $stmt->fetch(\PDO::FETCH_ASSOC))
	    			if (password_verify($current_pwd, $r['password']))
	    				return true;
	    	
	    	return false;
	    }

	    public function updateUserPathImg($new_usr, $usr){
	    	$Path = "users/".$this->CleanString($new_usr)."/img_perfil"."/";

	    	$Reason = $this->db->prepare('UPDATE vip_user_img_perfil '
                . 'SET folder = :path '
                . 'WHERE username = :usr');

	    	$Reason->bindValue(':path', $Path);
        	$Reason->bindValue(':usr', $new_usr);

	    	if ($Reason->execute())
	    		return true;

		    return false;
	    }

	    public function LoginUser($usr, $pwd){
	    	$usr = $this->CleanString($usr);
	    	$pwd = trim($pwd);

			if (!get_magic_quotes_gpc())
				$usr = addslashes($usr);

			$usr = pg_escape_string($usr);
	    	$stmt = $this->db->query("SELECT password FROM vip_user WHERE username='".$usr."';");

	    	if ($stmt->rowCount() > 0)
	    		while ($r = $stmt->fetch(\PDO::FETCH_ASSOC))
	    			if (password_verify($pwd, $r['password']))
	    				if ($this->addActivity($usr, 1, "Inicio de sesión"))
	    					if ($this->DirUser($usr))
	    						return true;

	    	return false;
	    }

	    public function DirUser($usr){
	    	$path = "../../private/desktop0/users/";
			if (!file_exists($path))
				@mkdir($path, 0777);

			$path .= $this->CleanString($usr)."/";
			if (!file_exists($path))
				@mkdir($path, 0777);

			$path .= "img_perfil/";
			if (!file_exists($path))
				@mkdir($path, 0777);

			return true;
	    }

	    public function getUserSession(){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE code=1");
	    	
	    	return $stmt->rowCount();
	    }

	    public function getUserCount(){
	    	$stmt = $this->db->query("SELECT * FROM vip_user");
	    	
	    	return $stmt->rowCount();
	    }

	    public function getUserRowCount($usr){
	    	$stmt = $this->db->query("SELECT * FROM vip_user WHERE username='".$usr."'");
	    	
	    	return $stmt->rowCount();
	    }

	    public function getUserPwd($usr){
	    	$stmt = $this->db->query("SELECT password FROM vip_user WHERE username='".$usr."';");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'password' 	=> $row['password']
	    			];
	    		}

	    		foreach ($UsersData as $value) {
	    			return $value['password'];
	    		}
	    	}

	    	return false;
	    }

	    public function getUsersAll(){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_info;");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'username' 		=> $row['username'],
	    				'email' 		=> $row['email'],
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		return $UsersData;
	    	}

	    	return false;
	    }

	    public function getEmailRowCount($email){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_info WHERE email='".$email."'");
	    	
	    	return $stmt->rowCount();
	    }

	    public function getUserEmail($usr){
	    	$stmt = $this->db->query("SELECT email FROM vip_user_info WHERE username='".$usr."'");

	    	if ($stmt->rowCount() > 0){
	    		$UserEmail = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UserEmail[] = [
	    				'email' => $row['email']
	    			];
	    		}

	    		foreach ($UserEmail as $value) {
	    			return $value['email'];
	    		}
	    	}

	    	return false;
	    }

	    public function getUserImgPerfil($usr, $Order, $Quantity){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_img_perfil WHERE username='".$usr."' ORDER BY id ".$Order." LIMIT ".$Quantity);

	    	if ($stmt->rowCount() > 0){
	    		$UserImgPerfil = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UserImgPerfil[] = [
	    				'id' 			=> $row['id'],
	    				'username' 		=> $row['username'],
	    				'folder'		=> $row['folder'],
	    				'src'			=> $row['src'],
	    				'date_log' 		=> $row['date_log'],
	    				'date_log_unix' => $row['date_log_unix'] 
	    			];
	    		}

	    		return $UserImgPerfil;
	    	}

	    	return false;
	    }

	    public function CleanString($str) {
 
		    $str = trim($str);
		 
		    $str = str_replace(
		        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		        $str
		    );
		 
		    $str = str_replace(
		        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		        $str
		    );
		 
		    $str = str_replace(
		        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		        $str
		    );
		 
		    $str = str_replace(
		        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		        $str
		    );
		 
		    $str = str_replace(
		        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		        $str
		    );
		 
		    $str = str_replace(
		        array('ñ', 'Ñ', 'ç', 'Ç'),
		        array('n', 'N', 'c', 'C',),
		        $str
		    );
		 
		    // //Esta parte se encarga de eliminar cualquier caracter extraño
		    // $str = str_replace(
		    //     array("\", "¨", "º", "-", "~",
		    //          "#", "@", "|", "!", """,
		    //          "·", "$", "%", "&", "/",
		    //          "(", ")", "?", "'", "¡",
		    //          "¿", "[", "^", "<code>", "]",
		    //          "+", "}", "{", "¨", "´",
		    //          ">", "< ", ";", ",", ":",
		    //          ".", " "),
		    //     '',
		    //     $str
		    // );
		 
		    return $str;
		}

	    public function getSessionUser($Limit, $Order){
	    	$stmt = $this->db->query("SELECT * FROM vip_info_user ORDER BY date_log_unix ".$Order." LIMIT ".$Limit);

	    	if ($stmt->rowCount() > 0){
	    		$dataProject = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$dataProject[] = [
	    				'username' 		=> $row['username'],
	    				'activity' 		=> $row['activity'],
	    				'date_log' 		=> $row['date_log'],
	    				'date_log_unix' => $row['date_log_unix'], 
	    				'email'			=> $row['email']
	    			];
	    		}

	    		return $dataProject;
	    	}

	    	return false;
	    }

	    public function getAllProject() {
	        $stmt = $this->db->query("SELECT * FROM vip_proyecto");

	        if ($stmt->rowCount() > 0){
		        $dataProject = [];
		        
		        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
		            $dataProject[] = [
		                'id_project' 					=> $row['id_project'],
		                'nombre' 						=> $row['nombre'],
		                'facultad_cur_escuela' 			=> $row['facultad_cur_escuela'],
		                'objetivo_general' 				=> $row['objetivo_general'],
		                'objetivo_especifico'			=> $row['objetivo_especifico'],
		                'resultados_esperados' 			=> $row['resultados_esperados'],
		                'fecha_aprobacion' 				=> $row['fecha_aprobacion'],
		                'cod_dictamen_economico' 		=> $row['cod_dictamen_economico'],
		                'nombre_instancia_aprobacion' 	=> $row['nombre_instancia_aprobacion']
		            ];
		        }

		        return $dataProject;
	        }
	        return false;
	    }

	    public function addProject($dataProject){
	        $sql = "INSERT INTO vip_proyecto(nombre, facultad_cur_escuela, objetivo_general, objetivo_especifico, resultados_esperados, fecha_aprobacion, cod_dictamen_economico, nombre_instancia_aprobacion) VALUES(:nombre,:facultad_cur_escuela,:objetivo_general,:objetivo_especifico,:resultados_esperados,:fecha_aprobacion,:cod_dictamen_economico,:nombre_instancia_aprobacion)";

	        $stmt = $this->db->prepare($sql);
	        
	        $stmt->bindValue(':nombre', 					$dataProject['nombre']);
	        $stmt->bindValue(':facultad_cur_escuela', 		$dataProject['facultad_cur_escuela']);
	        $stmt->bindValue(':objetivo_general', 			$dataProject['objetivo_general']);
	        $stmt->bindValue(':objetivo_especifico', 		$dataProject['objetivo_especifico']);
	        $stmt->bindValue(':resultados_esperados', 		$dataProject['resultados_esperados']);
	        $stmt->bindValue(':fecha_aprobacion', 			$dataProject['fecha_aprobacion']);
	        $stmt->bindValue(':cod_dictamen_economico', 	$dataProject['cod_dictamen_economico']);
	        $stmt->bindValue(':nombre_instancia_aprobacion',$dataProject['nombre_instancia_aprobacion']);
	        
	        if ($stmt->execute())
	        	return true;
	        
	        return false;
	    }

	    public function is_session_started(){
		    if ( php_sapi_name() !== 'cli' ) {
		        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
		            return session_status() === PHP_SESSION_ACTIVE ? true : false;
		        } else {
		            return session_id() === '' ? false : true;
		        }
		    }
		    return false;
		}

	    public function sessionDestroy(){
	    	if (!isset($_SESSION))
	    		@session_start();

	    	if ($this->addActivity($_SESSION['usr'], 0, "Cierre de sesión"))
				@session_destroy();
	    }
	}

	function SessionVerify(){
		if (!isset($_SESSION))
    		@session_start();

    	if (!isset($_SESSION['session']) || $_SESSION['session'] == "No")
    		return false;

    	return true;
	}

	function CDB($db){
		return new PostgreSQL("localhost", "5432", $db, "postgres", "Windows10");
	}

	//echo $ObjProject[0]['nombre'];

	//include ("ShowData.php");
	/*Datos del proyecto*/
	/*$dataProject = array('nombre'						=> "InterCloud", 
						'facultad_cur_escuela' 			=> "Ciencia y Tecnología", 
						'objetivo_general'				=> "Mejorar el registro académico", 
						'objetivo_especifico' 			=> "Establecer normas", 
						'resultados_esperados' 			=> "Producción del producto desarrollado", 
						'fecha_aprobacion' 				=> "09/02/2017", 
						'cod_dictamen_economico' 		=> "0001", 
						'nombre_instancia_aprobacion' 	=> "TheCodeBrain");
	*/
	/*Se registra un proyecto, retorna true o false*/
	// $id = $CN->addProject($dataProject);
?>