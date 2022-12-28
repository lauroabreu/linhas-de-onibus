<?php 

Class Linhas{

    private $pdo;
    public $msg_erro;

    public function __construct(){
        $nome = 'dbtotem';
        $user = 'root';
        $senha = '';
        $host = 'localhost';

        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$user, $senha);
        } catch (Exception $e) {
            $this->msg_erro = $e->getMessage;
        }
    }

    public function listar(){
        $sql = $this->pdo->query("SELECT codigo, nome, caracteristica FROM linhas_de_onibus"); 

        if($sql->rowCount() > 0){
            $var = $sql->fetchAll();
        }
        else{
            $var = array();
        }
        return $var;
    }

    public function verificarCodigo($codigo){
        $sql = $this->pdo->prepare("SELECT codigo FROM linhas_de_onibus WHERE codigo = :c"); 

        $sql->bindValue(":c", $codigo);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function cadastrar_linhas_de_onibus($codigo, $nome, $car){
        $sql = $this->pdo->prepare("SELECT idlinhas FROM linhas_de_onibus WHERE codigo = :c");

        $sql->bindValue(":c", $codigo);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;
        }
        else{
            $sql = $this->pdo->prepare("INSERT INTO linhas_de_onibus (codigo, nome, caracteristica) VALUES (:c, :n, :ct)");

            $sql->bindValue(":c", $codigo);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":ct", $car);
            $sql->execute();
            return true;
        }
    }

    public function procurar_id_linhas($codigo){
        
        $sql = $this->pdo->prepare("SELECT idlinhas FROM linhas_de_onibus WHERE codigo = :c");

        $sql->bindValue(":c", $codigo);
        $sql->execute();

        if($sql->rowCount() > 0){
            $var = $sql->fetch();
            $id = $var['idlinhas'];
        }
        else{
            $id = -1;
        }
        return $id;
        
    }

    private function procurar_id_terminal($origem){
        if(!empty($origem)){
            $sql = $this->pdo->prepare("SELECT idterminal FROM terminal WHERE terminal_origem = :o ORDER BY idterminal desc limit 1");

            $sql->bindValue(":o", $origem);
            $sql->execute();

            if($sql->rowCount() > 0){
                $var = $sql->fetch();
                $id = $var['idterminal'];
            }
            else{
                $id = -1;
            }

            return $id;
        }
        else{
            return -1;
        }
    }

    private function procurar_id_sentido($descricao){
        
        $sql = $this->pdo->prepare("SELECT idtipo_sentido FROM tipo_sentido WHERE descricao = :d ORDER BY idtipo_sentido desc limit 1");

        $sql->bindValue(":d", $descricao);
        $sql->execute();

        if($sql->rowCount() > 0){
            $var = $sql->fetch();
            $id = $var['idtipo_sentido'];
        }
        else{
            $id = -1;
        }

        return $id;
        
        
    }

    public function cadastrar_terminal($t_origem, $t_destino){
        if(!empty($t_origem) && !empty($t_destino)){
            $sql = $this->pdo->prepare("INSERT INTO terminal(terminal_origem, terminal_destino) VALUES (:o, :d)");

            $sql->bindValue(":o", $t_origem);
            $sql->bindValue(":d", $t_destino);
            $sql->execute();

            $id = $this->procurar_id_terminal($t_origem);

            return $id;

        }
        else{
            return 0;
        }
    }

    public function cadastrar_terminal_linhas($plataforma, $idterminal, $idlinhas, $sentido){

        if(!empty($plataforma) && !empty($idterminal) && !empty($idlinhas) && !empty($sentido)){
            $sql = $this->pdo->prepare("INSERT INTO terminal_linhas (plataforma, idterminal, idlinhas, idtipo_sentido) VALUES (:p, :it, :il, :s)");

            $sql->bindValue(":p", $plataforma);
            $sql->bindValue(":it", $idterminal);
            $sql->bindValue(":il", $idlinhas);
            $sql->bindValue(":s", $sentido);
            $sql->execute();

            return true;
        }
        else{
            return false;
        }
       

        
    }

    
    public function cadastrar_tipo_sentido($descricao){
        $sql = $this->pdo->prepare("INSERT INTO tipo_sentido (descricao) VALUES (:d)");

        $sql->bindValue(":d", $descricao);
        $sql->execute();

        $id = $this->procurar_id_sentido($descricao);

        return $id;
    }

}


?>