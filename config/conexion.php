<?php
$cfg['PersistentConnections'] = TRUE;
    $Config = parse_ini_file('configurar.ini', true);
    date_default_timezone_set('America/Bogota');
    setlocale(LC_TIME, "spanish");
    //ruta de la aplicaccion
    define('RUTA_APP', dirname(dirname(__FILE__)));


    define('RUTA_URL', $Config['application']['route']);

    define('CDA', 'CARTELERA DE NOVEDADES | SuperBrix');
    error_reporting(1);
    session_start();

    class Conectar{
        protected $dbh;

        public function Conexion(){
            try {
                //Local
				$conectar = $this->dbh = new PDO("mysql:host=intrabrix;dbname=cmwhcnhg_novedades","root","RootContra5en420");

				return $conectar;
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();
			}
        }

        public function set_names(){
			return $this->dbh->query("SET NAMES 'utf8'");
        }

        public static function ruta(){
            //Local
			return "http://intrabrix.sbi.local:81/novedades/";
            //Produccion
            return "http://helpdesk.anderson-bastidas.com/";
		}

        public function get_setting(){
            $conectar = $this->Conexion();
            $sql="SELECT * FROM sb_setting";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            $resultado=$sql->fetchAll();
            if(is_array($resultado)==true and count($resultado)>0){
                foreach($resultado as $resultados){
                    define('NOM_APP', $resultados["nom_app"]);
                    define('SLOGAN', $resultados["slogan_app"]);
                    define('MISION', $resultados["mision_app"]);
                    define('VISION', $resultados["vision_app"]);
                    define('CITY', $resultados["city_app"]);
                    define('DEPARTMENT', $resultados["dpto_app"]);
                    define('DIRECTION', $resultados["direccion_app"]);
                    define('SUPERSITE', $resultados["supersite_app"]);
                    define('WEB', $resultados["web_app"]);
                    define('USER_NEW_TITLE', $resultados["usu_new_title"]);
                    define('USER_NEW_DESCRIPTION', $resultados["usu_new_des"]);
                    define('USER_EDIT_TITLE', $resultados["usu_edit_title"]);
                    define('DEPTO_DESCRIPTION', $resultados["dpto_des"]);
                }
                
            }
        }

    }

    function connect(){
        $database="DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=172.16.2.16;PORT=50000;DATABASE=SBRDB091;PROTOCOL=TCPIP";
        $user="ibes";
        $pass="sbrxibeslsv";
        $conn=odbc_connect($database,$user,$pass);
        if($conn==0){
        echo "<h1>Error de conexi&oacute;n</h1>";
            return null;
        }else
        return $conn;//odbc_close($conn);
    }
    function exec_select($conn,$stm){
        if($conn==0){
            echo "<h1>La conexion ha caducado</h1>";
            return null;
        }
        $result=odbc_exec($conn, $stm);
        if($result==0){
            echo "<h3>Error en la sentencia</h3>";
            $sqlerror = odbc_errormsg($conn);
            $e = odbc_errormsg();
            echo($sqlerror);
            echo($stm);
            return null;
        }else{
            return $result;
        }
    }
    $conexion = new Conectar();
    $conexion->get_setting();
    
?>