<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	#Estableciendo la entrada de texto a UTF-8 desde la cabecera.
	header("Content-Type: text/html;charset=utf-8");

	#Modelo principal de conexión y métodos de acción.
	class PostgreSQL {
		var $db; #Variable que representa la conexión a la DB.

		#Método constructor que crea la conexión al servidor de base de datos.
		#Gestor utilizado: PostgreSQL.
		
		/**
			*@param: $host, $post, $dbase, $user, $pass.
			#Se puede conectar con múltiples base de datos.
		*/

		function __construct($host, $port, $dbase, $user, $pass){
			#Escribir una cadena con formato de secuencia.
			#fprintf(): http://php.net/manual/es/function.fprintf.php

			$cn = sprintf("host=%s;port=%s;dbname=%s;user=%s;password=%s", 
				$host, $port, $dbase, $user, $pass);

			#Asignando la conexión a la variable local de este modelo: db.
			if ($this->db = new PDO("pgsql:".$cn)){
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				#Se establecen atributos a la conexión.
				#Más información: http://php.net/manual/es/pdo.setattribute.php	
				
				#Consulta que establece las entradas de texto a UTF-8.
				if (@$this->db->query("SET NAMES 'utf8'"))
					return true;
			}

			#Si algún paso ha sido fallido o incorrecto, se retorna un booleano falso.
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
			|   9 	|	Señalar una actividad como favorito						|
			|   10	|	Respuesta a una actividad								|
			+-------+-----------------------------------------------------------+
		*/

		/**
			* Método que agrega una actividad de usuario.
			*@param: $usr (Nombre de usuario), $code (Tipo de actividad o evento), $description.
		*/
	    public function addActivity($usr, $code, $description){
	    	#CleanString es un método perteneciente a esta clase.
	    	$usr = $this->CleanString($usr); #Se limpia la cadena recibida, atendiendo al nombre de usuario.
	    	
	    	#Consulta preparada que inserta una actividad.
	    	#Nombre de tabla: vip_user_activity
	    	#Atributos: username, code, description, date_log, date_log_unix, favorite.

	    	$Reason = $this->db->prepare("INSERT INTO vip_user_activity (username, code, description, date_log, date_log_unix, favorite) VALUES (:username,:code,:description,:date_log,:date_log_unix,:favorite)");

	    	#Se agregan los valores.
	    	$Reason->bindValue(":username", $usr);				#Nombre de usuario.
	    	$Reason->bindValue(":code", $code);					#Tipo de actividad o evento.
	    	$Reason->bindValue(":description", $description);	#Descripción.
	    	$Reason->bindValue(":date_log", date('Y-n-j'));		#Fecha.
	    	$Reason->bindValue(":date_log_unix", time());		#Tiempo en decimal UNIX.
	    	$Reason->bindValue(":favorite", 0);					#Valor por defecto de favorito.

	    	#Ejecución de la consulta. Espera retornar un valor booleano.
	    	if ($Reason->execute())
	    		return true;

	    	#Si algo ha fallado, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que obtiene una actividad de usuario.
			*@param: $id_activity (ID de una actividad), $Quantity (Límite de resultados).
		*/
	    public function getActivity($id_activity, $Quantity){
	    	#Statement: Consulta directa sin preparación. 
	    	#Tabla: vip_user_activity.
	    	#Atributos: id_activity y cláusula LIMIT afectada.

	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE id_activity='".$id_activity."' LIMIT ".$Quantity.";");

	    	#Si tiene datos.
	    	if ($stmt->rowCount() > 0){
	    		$UsersData = []; #Definición de una array multidimensional.

	    		#Recorrido de las filas devueltas por la consulta anterior.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    			$UsersData[] = [
	    				'id_activity' 	=> $row['id_activity'], 
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix'],
	    				'favorite' 		=> $row['favorite']
	    			];
	    			#Se agregan toda la información devuelta, recordar el * de la consulta.
	    		}

	    		#Finalizado el recorrido, se devuelve el array que contiene toda la información.
	    		return $UsersData;
	    	}

	    	#Si algo ha fallado, se devuelve un booleano falso.
	    	return false;
	    }

	    /**
			* Método que obtiene una notificación o cambio ocurrido en una actividad.
			*@param: $usr (Nombre de usuario que realizó la actividad), $Quantity (Límite de resultados).
		*/
	    public function getActivityNotificationMessage($usr, $Quantity){
	    	#Statement: Consulta directa sin preparación. 
	    	#Tabla: vip_user_activity_message.
	    	#Atributos: username y cláusula LIMIT afectada.
	    	#Valores devueltos: id_activity (Este no debe tener redundancias), date_log_unix.

	    	$stmt = $this->db->query("SELECT distinct(id_activity), date_log_unix FROM vip_user_activity_message WHERE username!='".$usr."' ORDER BY date_log_unix DESC LIMIT ".$Quantity.";");

	    	#Si hay registros.
	    	if ($stmt->rowCount() > 0){
	    		#Definición de array multidimensional.
	    		$UsersData = [];

	    		#Se recorren los resultados y se almacenan en el array.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    			$UsersData[] = [
	    				'id_activity' 	=> $row['id_activity'], 
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		#Se retorna el array con la información almacenada.
	    		return $UsersData;
	    	}

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que obtiene una notificación de una actividad agregada a favoritos.
			*@param: $usr (Nombre de usuario que realizó la actividad), $Quantity (Límite de resultados).
		*/
	    public function getActivityNotificationFavorities($usr, $Quantity){
	    	#Statement: Consulta directa sin preparación. 
	    	#Tabla: vip_user_activity.
	    	#Atributos: username, favorite y cláusula LIMIT afectada.
	    	#Valores devueltos: todos los posibles (*).

	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username='".$usr."' AND favorite=1 ORDER BY date_log_unix DESC LIMIT ".$Quantity.";");

	    	#Si hay registros.
	    	if ($stmt->rowCount() > 0){
	    		#Definición de array multidimensional.
	    		$UsersData = [];

	    		#Se recorren los resultados y se almacenan en el array.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    			$UsersData[] = [
	    				'id_activity' 	=> $row['id_activity'], 
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix'], 
	    				'favorite' 		=> $row['favorite']
	    			];
	    		}

	    		#Se retorna el array con la información almacenada.
	    		return $UsersData;
	    	}

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que obtiene mis actividades, referidas al usuario de sesión actual.
			*@param: $Quantity (Límite de resultados).
		*/
	    public function getMyActivity($Quantity){
	    	#Se habilita el uso de sesiones.
	    	@session_start();

	    	#Statement: Consulta directa no preparada. 
	    	#Tabla: vip_user_activity.
	    	#Atributos: username y cláusula LIMIT afectada.
	    	#Valores devueltos: todos los posibles (*).

	    	#Se utiliza la variable de sesión $_SESSION['usr'] para comparar con posible nombre de usuario que se 
	    	#se encuentra registrado en la tabla: vip_user_activity.
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username='".@$_SESSION['usr']."' ORDER BY id_activity DESC LIMIT ".$Quantity.";");

	    	#Si existen registros.
	    	if ($stmt->rowCount() > 0){
	    		#Definición de array multidimensional.
	    		$UsersData = [];

	    		#Se recorren los resultados y se almacenan en el array.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    			$UsersData[] = [
	    				'id_activity' 	=> $row['id_activity'], 
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix'],
	    				'favorite' 		=> $row['favorite']
	    			];
	    		}

	    		#Se retorna el array con la información almacenada.
	    		return $UsersData;
	    	}

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }


	    /**
			* Método que obtiene las actividades de los demás usuarios, evitando el usuario de sesión actual.
			*@param: $Quantity (Límite de resultados).
		*/
	    public function getActivityWithOutMe($Quantity){
	    	#Se habilita el uso de sesiones.
	    	@session_start();

	    	#Statement: Consulta directa no preparada. 
	    	#Tabla: vip_user_activity.
	    	#Atributos: username y cláusula LIMIT afectada.
	    	#Valores devueltos: todos los posibles (*).

	    	#Se utiliza la variable de sesión $_SESSION['usr'] para operar en diferencia a él y mostrar los demás usuarios.
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username!='".@$_SESSION['usr']."' ORDER BY date_log_unix DESC LIMIT ".$Quantity.";");

	    	#Si existen registros.
	    	if ($stmt->rowCount() > 0){
	    		#Definición de array multidimensional.
	    		$UsersData = [];

	    		#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'id_activity' 	=> $row['id_activity'], 
	    				'username' 		=> $row['username'], 
	    				'code' 			=> $row['code'], 
	    				'description' 	=> $row['description'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix'], 
	    				'favorite' 		=> $row['favorite'] 
	    			];
	    		}

	    		#Se retorna el array con la información almacenada.
	    		return $UsersData;
	    	}

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que obtiene los mensajes que se han escrito en las actividades con identificador en específico.
			*@param: $id_activity (Identificador que apunta a una actividad).
		*/
	    public function getActivityMessage($id_activity){
	    	#Statement: Consulta directa no preparada. 
	    	#Tabla: vip_user_activity_message.
	    	#Atributos: id_activity.
	    	#Valores devueltos: todos los posibles (*).

	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity_message WHERE id_activity='".$id_activity."' ORDER BY id DESC;");

	    	#Si existen registros.
	    	if ($stmt->rowCount() > 0){
	    		#Definición de array multidimensional.
	    		$UsersData = [];

	    		#Agrega la información temporal de $row al array, dejando los índices como nombres de atributos.
	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'id' 			=> $row['id'], 
	    				'id_activity' 	=> $row['id_activity'], 
	    				'username' 		=> $row['username'], 
	    				'message' 		=> $row['message'], 
	    				'date_log' 		=> $row['date_log'], 
	    				'date_log_unix' => $row['date_log_unix'], 
	    			];
	    		}

				#Se retorna el array con la información almacenada.
	    		return $UsersData;
	    	}

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que agrega un nuevo usuario.
			*@param: $usr (Nombre de usuario a agregar), $pwd (Password), $email (Dirección de correo), $usr_author (¿Quién lo registra?).
		*/
	    public function addNewUser($usr, $pwd, $email, $usr_author){
	    	#Variable que almacena las instrucciones de la consulta.    	
	    	$q = "INSERT INTO vip_user (username, password) VALUES (:username,:password);";

	    	#Se limpia el nombre de usuario.
	    	$usr = $this->CleanString($usr);

	    	#Se crea la consulta preparada pasándole por parámetro las instrucciones.
	    	$stmt = $this->db->prepare($q);

	    	#Vincula un valor a un parámetro.
	    	#bindValue: http://php.net/manual/es/pdostatement.bindvalue.php

	    	$stmt->bindValue(":username", $usr);

	    	#Se cifra la contraseña con password_hash().
	    	#password_hash: http://php.net/manual/es/function.password-hash.php
	    	$stmt->bindValue(":password", password_hash($pwd, PASSWORD_DEFAULT));

	    	#Se ejecuta la consulta preparada.
	    	if ($stmt->execute())
	    		if ($this->addNewUserInfo($usr, $email))	#Agrega la información al nuevo usuario (usr, email).
	    			if ($this->DirUser($usr))				#Crea el árbol de directorios del nuevo usuario.
	    				if ($this->addActivity($usr_author, 7, "Agregando nuevo usuario: ".$usr)) #Agrega una actividad.
	    					return true;	#Si todo marcha bien hasta acá, se retorna un valor booleano exitoso.

	    	#Se algo falla, re retorna un valor booleano falso.
	    	return false;
	    }


	    /**
			* Método que agrega un mensaje a una actividad.
			*@param: $usr (Nombre de usuario que agrega), $id_activity (Identificador de la actividad), $message (Mensaje).
		*/
	    public function addActivityMessage($usr, $id_activity, $message){
	    	#Statement: Consulta preparada. 
	    	#Tabla: vip_user_activity_message.
	    	#Atributos: id_activity, username, message, date_log, date_log_unix.
	    	#Valores devueltos: Ninguno ya que se trata de insertar datos.

	    	#Se alamacenan las instrucciones en esta variable.
	    	$q = "INSERT INTO vip_user_activity_message (id_activity, username, message, date_log, date_log_unix) VALUES (:id_activity,:username,:message,:date_log,:date_log_unix);";
	    
	    	#Se prepara la consulta.
	    	$stmt = $this->db->prepare($q);

	    	#Se vincula un valor a un parámetro.
	    	$stmt->bindValue(":id_activity", 	$id_activity);
	    	$stmt->bindValue(":username", 		$usr);
	    	$stmt->bindValue(":message", 		$message);
	    	$stmt->bindValue(":date_log", 		date('Y-n-j'));
	    	$stmt->bindValue(":date_log_unix", 	time());

	    	#Se obtiene la actividad con el identificador, extrayendo sólo 1 resultado.
	    	$activity = $this->getActivity($id_activity, 1);

	    	#Definición de una variable a cadena vacía.
	    	$activity_username = "";

	    	#Se recorre el array multidimensional que devuelve el método getActivity y se asigna el valor del índice a $value.
	    	foreach ($activity as $value) {
	    		#Se asigna el nombre de usuario devuelto a la variable vacía.
	    		$activity_username = $value['username'];
	    	}

	    	#Se ejecuta la consulta preparada.
	    	#Seguidamente se agrega una actividad.
	    	if ($stmt->execute())
	    		if ($this->addActivity($usr, 10, "Respondiendo a la actividad ".$id_activity." del usuario ".$activity_username))
	    			return true; #Si ha llegado hasta acá, todo ha salido excelente.

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que agrega la información del nuevo usuario.
			*@param: $usr (Nombre de usuario), $email (Dirección de correo).
		*/
	    public function addNewUserInfo($usr, $email){
	    	#Statement: Consulta preparada. 
	    	#Tabla: vip_user_info.
	    	#Atributos: username, email, date_log, date_log_unix.
	    	#Valores devueltos: Ninguno ya que se trata de insertar datos.

	    	#Se alamacenan las instrucciones en esta variable.
	    	$q = "INSERT INTO vip_user_info (username, email, date_log, date_log_unix) VALUES (:username,:email,:date_log,:date_log_unix);";
	    
	    	#Se prepara la consulta.
	    	$stmt = $this->db->prepare($q);

	    	#Se vincula un valor a un parámetro.
	    	$stmt->bindValue(":username", 		$usr);
	    	$stmt->bindValue(":email", 			$email);
	    	$stmt->bindValue(":date_log", 		date('Y-n-j'));
	    	$stmt->bindValue(":date_log_unix", 	time());

	    	#Se ejecuta la consulta preparada.
	    	if ($stmt->execute())
	    		return true; #Si se ha llegado hasta acá, es un resultado correcto.

	    	#Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que agrega una imagen de perfil a un usuario.
			*@param: $usr (Nombre de usuario), $folder (Ruta de almacenamiento), $src (Nombre del recurso).
		*/
	    public function addUserImgPerfil($usr, $folder, $src){
	    	#Se limpia el nombre del recurso.
	    	$src = $this->CleanString($src);

	    	#Statement: Consulta preparada. 
	    	#Tabla: vip_user_img_perfil.
	    	#Atributos: username, folder, src, date_log, date_log_unix.
	    	#Valores devueltos: Ninguno ya que se trata de insertar datos.

	    	$QueryImgPerfil = $this->db->prepare("INSERT INTO vip_user_img_perfil (username, folder, src, date_log, date_log_unix) VALUES (:username,:folder,:src,:date_log,:date_log_unix)");

	    	#Se vinculan los valores con los parámetros.
	    	$QueryImgPerfil->bindValue(":username", $usr);
	    	$QueryImgPerfil->bindValue(":folder", $folder);
	    	$QueryImgPerfil->bindValue(":src", $src);
	    	$QueryImgPerfil->bindValue(":date_log", date('Y-n-j'));
	    	$QueryImgPerfil->bindValue(":date_log_unix", time());

	    	#Se agrega una nueva actividad sobre la acción.
	    	#Seguidamente se ejecuta la consulta preparada para agregar la información.
	    	if ($this->addActivity($usr, 5, "Agregando nueva imagen de perfil:  ".$src))
		    	if ($QueryImgPerfil->execute())
		    		return true; #Se retorna un valor booleano verdadero cuando ha salido todo bien.

		    #Si algo falla, se retorna un valor booleano falso.
	    	return false;
	    }

	    /**
			* Método que elimina un usuario.
			*@param: $usr (Nombre de usuario).
		*/
	    public function deleteUser($usr){
	    	#Statement: Consulta preparada. 
	    	#Tabla: vip_user.
	    	#Atributos: username.
	    	#Valores devueltos: Ninguno ya que se trata de eliminar datos.

	    	#Hay que tener en cuenta que también existen otras tablas relacionadas con esta, sin embargo
	    	#también son eliminadas ya que están escritas en cascada para actualizar y eliminar.
	    	$Reason = $this->db->prepare('DELETE FROM vip_user '
                . 'WHERE username = :usr');

	    	#Se vincula el valor con el parámetro.
        	$Reason->bindValue(':usr', $usr);

        	#Se habilitan las sesiones.
        	@session_start();

        	#Se añade una nueva actividad.
        	if ($this->addActivity(@$_SESSION['usr'], 6, "Eliminando al usuario: ".$usr))
	       		if ($Reason->execute())	#Se ejecuta la consulta preparada.
	       			return true;	#Retorno verdadero si todo ha marchado bien.

	       	#Si algo falla, se retorna un valor booleano falso.
        	return false;
	    }

	    /**
			* Método que actualiza el nombre de usuario de un usuario y el árbol de directorios.
			*@param: $new_usr (El nuevo nombre de usuario), $usr (Nombre de usuario al que hace referencia).
		*/
	    public function updateUser($new_usr, $usr){
	    	#Se limpia el contenido de la variable $new_user.
	    	$new_usr = $this->CleanString($new_usr);

	    	#Statement: Consulta preparada. 
	    	#Tabla: vip_user.
	    	#Atributos: username.
	    	#Valores devueltos: Ninguno ya que se trata de actualizar datos.

	    	#La actualización se hace en cascada con respecto a las demás tablas relacionadas a esta.
	    	$Reason = $this->db->prepare('UPDATE vip_user '
                . 'SET username = :new_usr '
                . 'WHERE username = :current_usr');

	    	#Se vincula el valor con el parámetro.
        	$Reason->bindValue(':new_usr', $new_usr);
        	$Reason->bindValue(':current_usr', $usr);

        	#Ruta del directorio |users|.
        	$path = "../../../../private/desktop0/users/";

        	#Se renombra el directorio del usuario $usr al nuevo que se le ha pasado como $new_usr.
        	rename($path.$usr."/", $path.$new_usr."/");

        	#Se habilitan las sesiones.
        	@session_start();

        	#Se le asigna el nuevo valor a la sesión de inicio que guarda el nombre de usuario.
        	@$_SESSION['usr'] = $new_usr;

        	#Se agrega una nueva actividad.
        	if ($this->addActivity($usr, 2, "Nombre de usuario modificado de ".$usr." a ".$new_usr))
		    	if ($Reason->execute())	#Se ejecuta la consulta preparada.
		    		if ($this->updateUserPathImg($new_usr, $usr))	#Se actualiza la ruta del directorio de imágenes.
		    			return true;	#Todo el proceso ha sido correcto.

		    #Si algo falla, se retorna un valor booleano falso.
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

	    public function updateActivityFavorite($usr, $id_activity, $favorite){
	    	$Reason = $this->db->prepare('UPDATE vip_user_activity '
                . 'SET favorite = :favorite '
                . 'WHERE id_activity = :id_activity');

	    	$Reason->bindValue(':favorite', 	$favorite);
        	$Reason->bindValue(':id_activity', 	$id_activity);

        	if ($favorite == 1){
        		$Message = "La actividad ".$id_activity.", se ha marcado como favorito.";
        	} else if ($favorite == 0) {
        		$Message = "La actividad ".$id_activity.", se ha desmarcado de los favoritos.";
        	}

        	if ($this->addActivity($usr, 9, $Message))
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

			$path_project = $path;

			$path .= "img_perfil/";
			if (!file_exists($path))
				@mkdir($path, 0777);

			$path_project .= "project_img/";
			if (!file_exists($path_project))
				@mkdir($path_project, 0777);

			return true;
	    }

	    public function getActivityNotificationFavoritiesCount($usr){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE username='".$usr."' AND favorite=1;");
	    	
	    	return $stmt->rowCount();
	    }

	    public function getActivityNotificationMessageCount($usr){
	    	$stmt = $this->db->query("SELECT distinct(id_activity), date_log_unix FROM vip_user_activity_message WHERE username!='".$usr."';");
	    	
	    	return $stmt->rowCount();
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

	    public function getActivityArgument($code){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity_argument WHERE code='".$code."';");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'activity' 	=> $row['activity']
	    			];
	    		}

	    		foreach ($UsersData as $value) {
	    			return $value['activity'];
	    		}
	    	}

	    	return false;
	    }

	    public function getActivityFavorite($id_activity){
	    	$stmt = $this->db->query("SELECT * FROM vip_user_activity WHERE id_activity='".$id_activity."';");

	    	if ($stmt->rowCount() > 0){
	    		$UsersData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'favorite' 	=> $row['favorite']
	    			];
	    		}

	    		foreach ($UsersData as $value) {
	    			return $value['favorite'];
	    		}
	    	}

	    	return false;
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

	    /*-------------------------------------------------*/

	    public function getProjectComunidad(){
	    	$stmt = $this->db->query("SELECT * FROM municipios;");

	    	if ($stmt->rowCount() > 0){
	    		$getData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$getData[] = [
	    				'cod_muni' 		=> $row['cod_muni'], 
	    				'nombre_muni' 	=> $row['nombre_muni'],
	    				'cod_dpto' 		=> $row['cod_dpto']
	    			];
	    		}

	    		return $getData;
	    	}

	    	return false;
	    }

	    public function getProjectFacCurEsc(){
	    	$stmt = $this->db->query("SELECT * FROM facultades;");

	    	if ($stmt->rowCount() > 0){
	    		$getData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$UsersData[] = [
	    				'codigo_facultad' 	=> $row['codigo_facultad'], 
	    				'nombrefac' 		=> $row['nombrefac']
	    			];
	    		}

	    		return $UsersData;
	    	}

	    	return false;
	    }

	    public function getTmpImg($usr){
	    	$stmt = $this->db->query("SELECT * FROM vip_tmp_img WHERE username='".$usr."';");

	    	if ($stmt->rowCount() > 0){
	    		$getData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$getData[] = [
	    				'id' 			=> $row['id'], 
	    				'username' 		=> $row['username'], 
	    				'folder' 		=> $row['folder'], 
	    				'src' 			=> $row['src'],
	    				'date_log' 		=> $row['date_log'],
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		return $getData;
	    	}

	    	return false;
	    }

	    public function deleteTmpImg($src){
	    	$Reason = $this->db->prepare('DELETE FROM vip_tmp_img '
                . 'WHERE src = :src');
        	$Reason->bindValue(':src', $src);

        	if ($Reason->execute())
	       		return true;

        	return false;
	    }

	    public function getTmpImgUnique($usr, $src){
	    	$stmt = $this->db->query("SELECT * FROM vip_tmp_img WHERE src='".$src."' AND username='".$usr."' LIMIT 1;");

	    	if ($stmt->rowCount() > 0){
	    		$getData = [];

	    		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
	    			$getData[] = [
	    				'id' 			=> $row['id'], 
	    				'folder' 		=> $row['folder'], 
	    				'src' 			=> $row['src'],
	    				'date_log' 		=> $row['date_log'],
	    				'date_log_unix' => $row['date_log_unix']
	    			];
	    		}

	    		return $getData;
	    	}

	    	return false;
	    }

		public function addTmpImg($usr, $folder, $src){
	    	$q = "INSERT INTO vip_tmp_img (username, folder, src, date_log, date_log_unix) VALUES (:username,:folder,:src,:date_log,:date_log_unix);";
	    
	    	$stmt = $this->db->prepare($q);

	    	$stmt->bindValue(":username", 		$usr);
	    	$stmt->bindValue(":folder", 		$folder);
	    	$stmt->bindValue(":src", 			$src);
	    	$stmt->bindValue(":date_log", 		date('Y-n-j'));
	    	$stmt->bindValue(":date_log_unix", 	time());

	    	if ($stmt->execute())
	    		return true;

	    	return false;
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