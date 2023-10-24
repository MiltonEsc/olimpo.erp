<?php 

class Galeria extends Conectar{
	public function subeimagen64temp($img, $nombre) {

		$carpetaDestino = "../public/cumple/";
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);

		$file = $carpetaDestino . $nombre . '.png';
		$success = file_put_contents($file, $data);
		return $success;
	}
	
    public function get_gallery_perfi(){
        $conectar= parent::conexion();
        /* consulta sql */
        $sql="SELECT usu_id, usu_foto, usu_nom, usu_ape, usu_dpto, usu_correo FROM tm_usuario WHERE est='1'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
    }	
}


?>