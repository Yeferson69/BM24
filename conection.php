<?php

// Conexión a la base de datos SQL Server
class Db 
    {
    private $host      = 'smc24.database.windows.net';
    private $user      = 'SMc2024';
    private $dbname    = 'Votos belleza marina 2024';
    private $pass      = 'BellMaInt2402';
    private $error     = '';
    private static $instance;

    public function __construct()
    {
        // DSN: cadena de conexión
        $dsn = 'sqlsrv:Server=' . $this->host . ';dbname=' . $this->dbname;

        /* Opciones
            * Muy importante, para tener una buena conexión PDO

        */    
        $options = array(
            PDO::ATTR_PERSISTENT    => true, //establecer a false si no se quieren conexiones persistentes
            PDO::ATTR_EMULATE_PREPARES => false, //no cambiar nunca
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION, //no cambiar nunca
            PDO::SQLSRV_ATTR_INIT_COMMAND => PDO::SQLSRV_ENCODING_UTF8, //juego de caracteres,
        );

        // Crea nueva instancia de PDO
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Captura los errores
        catch(PDOException $e){
            $this->error = $e->getMessage();
            throw new Exception("Error de conexión a la base de datos: " . $this->error);
        }
    }



    public static function getInstance()
    {
        if (self::$instance == null) 
        {
            $className = __CLASS__;
            self::$instance = new $className();
        }
        return self::$instance;
    }

    // Preparar la sentencia SQL para insertar datos en la tabla usuarios
    

    public function bind()
    {
        $nameCandidata = $_POST['nameSeleccionada'];
        $regionCandidata = $_POST['descripcionSeleccionada'];
        $categoriaCandidata = $_POST['categoria'];
        $nombreVotante = $_POST['user_name'];        
        $celularVotante = $_POST['user_phone'];
        $correoVotante = $_POST['user_correo'];

        if (!$this->dbh) {
            // Manejar el caso donde $this->dbh no está inicializado
            throw new Exception("La conexión a la base de datos no está inicializada.");

        }else{
            $stmt = $this->dbh->prepare("INSERT INTO votos (Nombre_Candidata, Region_Candidata, Categoria, Nombre_Votante, CelularVotante, Correo_Votante ) 
            VALUES (:nameCandidata, :regionCandidata, :categoriaCandidata, :nombreVotante, :celularVotante, :correoVotante )");

            $stmt->bindValue(':nameCandidata', $nameCandidata, PDO::PARAM_STR);
            $stmt->bindValue(':regionCandidata', $regionCandidata, PDO::PARAM_STR);
            $stmt->bindValue(':categoriaCandidata', $categoriaCandidata, PDO::PARAM_STR);
            $stmt->bindValue(':nombreVotante', $nombreVotante, PDO::PARAM_STR);
            $stmt->bindValue(':celularVotante', $celularVotante, PDO::PARAM_STR);
            $stmt->bindValue(':correoVotante', $correoVotante, PDO::PARAM_STR);

            $stmt->execute();
        } 
        

        // Mostrar los datos en la consola
        echo "Datos extraídos del método POST:\n";
        echo "Nombre Candidata: " . $nameCandidata . "\n";
        echo "Región Candidata: " . $regionCandidata . "\n";
        echo "Categoría Candidata: " . $categoriaCandidata . "\n";
        echo "Nombre Votante: " . $nombreVotante . "\n";
        echo "Celular Votante: " . $celularVotante . "\n";
        echo "Correo Votante: " . $correoVotante . "\n";

        echo "Datos insertados correctamente.";

    }
}

try {
    $db = Db::getInstance();
    $db->bind();

} catch (Exception $e) {
    echo $e->getMessage();

}

?>
