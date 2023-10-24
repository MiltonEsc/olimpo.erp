<?php 

class Capturadora extends Conectar{
	
	public function subir_imagen_cumpleanios($img, $nombre) {
		$conectar= parent::conexion();
		parent::set_names();

		$carpetaDestino = "../public/cumpleanios/";
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $carpetaDestino . $nombre . '.png';

		$sql="UPDATE tm_usuario set ruta_cumple = ? WHERE usu_id = ?  AND est=1;";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $file);
		$sql->bindValue(2, $nombre);
		$sql->execute();
		
		$success = file_put_contents($file, $data);


		return $success;
	}

	public function subir_imagen_bienvenida($img, $nombre) {
		$conectar= parent::conexion();
		parent::set_names();

		$carpetaDestino = "../public/bienvenida/";
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $carpetaDestino . $nombre . '.png';

		$sql="UPDATE tm_usuario set ruta_bienvenida = ? WHERE usu_id = ?  AND est=1;";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $file);
		$sql->bindValue(2, $nombre);
		$sql->execute();
		
		$success = file_put_contents($file, $data);


		return $success;
	}

	public function subir_imagen_despedida($img, $nombre) {
		$conectar= parent::conexion();
		parent::set_names();

		$carpetaDestino = "../public/despedida/";
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $carpetaDestino . $nombre . '.png';

		$sql="UPDATE tm_usuario set ruta_despedida = ? WHERE usu_id = ?  AND est=1;";
		$sql=$conectar->prepare($sql);
		$sql->bindValue(1, $file);
		$sql->bindValue(2, $nombre);
		$sql->execute();
		
		$success = file_put_contents($file, $data);


		return $success;
	}
	
	
}


?>