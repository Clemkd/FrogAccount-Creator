<?php
include 'id-res.php';
/**********************************/
/*  PHP - COMMUNICATION SERVEUR   */
/**********************************/

	/******************************/
	/******     VARIABLES     *****/
	/******************************/
	$ACC  = $_POST["acc"];
	$PSW  = $_POST["psw"];
	
	$RESULT = "Votre compte a été créé.";
	$F_RES = "g"; $SEP_CHAR = "\0"; 
	$END_CHAR = hex2str("ED"); 
	
	error_reporting(0); 
	
	if($ACC == '' or $PSW == ''){
		$RESULT = "Une erreur est survenue lors de l'éxecution.";
		$F_RES = "b";
	} else {
			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // Création du socket
			socket_set_option($sock,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>2, "usec"=>0)); //Limitation du poll socket
			
			if(!socket_connect($sock, $IP, $PORT)) {
				$RESULT = "Une erreur est survenue lors de l'éxecution.";
				$F_RES = "b";
				echo "<link rel='stylesheet' href='../styles/fstyles.css' />
				<body class='bodyresult'><div class='".$F_RES."result'>
				".$RESULT."</div></body>";
				exit();
			} //Connection au serveur en prenant en compte une éventuelle erreur de connection
			
			$buffer = "newfaccountied".$SEP_CHAR.$ACC.$SEP_CHAR.$PSW.$END_CHAR; //Packet de création de compte FrogCreator
			
			socket_write($sock, $buffer, strlen($buffer));
			$RESULT = utf8_encode(substr(socket_read($sock,512), 8,-2)); 
			if(stristr($RESULT, 'votre') == false) { $F_RES = "b";}
			socket_close($sock);
	}
	
	echo "<link rel='stylesheet' href='../styles/fstyles.css' />
		<body class='bodyresult'><div class='".$F_RES."result'>
		".$RESULT."</div></body>";
		
	/******************************/
	/******     FUNCTIONS     *****/
	/******************************/
	function hex2str($hex) { // Source : WebbyBoy
		for($i=0;$i<strlen($hex);$i+=2) $str .= chr(hexdec(substr($hex,$i,2)));
		return $str;
	}
	
?>