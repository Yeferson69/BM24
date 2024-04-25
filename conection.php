<?php
// Conexión a la base de datos SQL Server
class Db {
    private $host      = 'smc24.database.windows.net';
    private $user      = 'SMc2024';
    private $dbname    = 'Votos belleza marina 2024';
    private $pass      = 'BellMaInt2402';
    private $error     = '';
    private static $instance;
    private $dbh;

    public function __construct(){
        // DSN: cadena de conexión
        $dsn = 'sqlsrv:server=' . $this->host . ';Database=' . $this->dbname;

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass);
    }
        // Captura los errores
        catch(PDOException $e){
            $this->error = $e->getMessage();
            throw new Exception("Error de conexión a la base de datos: " . $this->error);
    }
}

public static function getInstance(){
    if (self::$instance == null){
        $className = __CLASS__;
        self::$instance = new $className();
    }
    return self::$instance;
}

// Preparar la sentencia SQL para insertar datos en la tabla usuarios
    
public function bind(){
    $nameCandidata = $_POST['nameSeleccionada'];
    $regionCandidata = $_POST['descripcionSeleccionada'];
    $categoriaCandidata = $_POST['categoria'];
    $nombreVotante = $_POST['user_name'];
    $correoVotante = $_POST['user_correo'];     
    $celularVotante = $_POST['user_phone'];    

    if (!$this->dbh){
        // Manejar el caso donde $this->dbh no está inicializado
        throw new Exception("La conexión a la base de datos no está inicializada.");

    }else{
        $stmt = $this->dbh->prepare("INSERT INTO votos (Nombre_Candidata, Region_Candidata, Categoria, Nombre_Votante, Celular_Votante, Correo_Votante ) 
        VALUES (:nameCandidata, :regionCandidata, :categoriaCandidata, :nombreVotante, :celularVotante, :correoVotante )");

        $stmt->bindValue(':nameCandidata', "'$nameCandidata'", PDO::PARAM_STR);
        $stmt->bindValue(':regionCandidata', "'$regionCandidata'", PDO::PARAM_STR);
        $stmt->bindValue(':categoriaCandidata', "'$categoriaCandidata'", PDO::PARAM_STR);
        $stmt->bindValue(':nombreVotante', "'$nombreVotante'", PDO::PARAM_STR);
        $stmt->bindValue(':celularVotante', "'$celularVotante'", PDO::PARAM_STR);
        $stmt->bindValue(':correoVotante', "'$correoVotante'", PDO::PARAM_STR);

        $stmt->execute();
    }     
    }
}

try {
    $db = Db::getInstance();
    $db->bind();

} catch (Exception $e) {
    echo $e->getMessage();

}
?>
