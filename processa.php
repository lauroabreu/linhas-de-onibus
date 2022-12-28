<?php 
    require_once 'classes/linhas.php';
    $d = new Linhas();
    $recebe = $d->listar();

?>

<?php

if(isset($_POST['onibus'])){

    $onibus = addslashes($_POST['onibus']);
    $codigo = addslashes($_POST['codigo']);
    $cor = addslashes($_POST['cor']);
    $origem = addslashes($_POST['origem']);
    $destino = addslashes($_POST['destino']);
    $plataforma1 = addslashes($_POST['plataforma1']);
    $plataforma2 = addslashes($_POST['plataforma2']);
    $sentido = addslashes($_POST['sentido']);

    if(!empty($onibus) && !empty($codigo) && !empty($cor) && !empty($origem) && !empty($destino) && !empty($plataforma1) && !empty($plataforma2) && !empty($sentido)){
        if($d->verificarCodigo($codigo)){
            ?>
                <script>
                    window.alert('Onibus ja está cadastrado, insira outro onibus');
                    window.location.href='index.html';
                </script> 
                <?php
        }
        else{
            if($d->cadastrar_linhas_de_onibus($codigo, $onibus, $cor)){
                $linhas = $d->procurar_id_linhas($codigo);
                $terminal = $d->cadastrar_terminal($origem, $destino);
                $tipo_sentido = $d->cadastrar_tipo_sentido($sentido);
    
                if(($d->cadastrar_terminal_linhas($plataforma1, $terminal, $linhas, $tipo_sentido) == true) && ($d->cadastrar_terminal_linhas($plataforma2, $terminal, $linhas, $tipo_sentido)) == true){
                    ?>
                    <script>
                        window.alert('cadastrado com sucesso');
                        window.location.href='index.html';
                    </script> 
                    <?php
                }
                else{
                    ?>
                        <script>
                        window.alert('Erro ao cadastrar');
                        window.location.href='index.html';
                        </script> 
                    <?php
                }
    
            }
        }
        
    }
    else{
        ?>
            <script>
                window.alert('Preencha todos os campos');
                window.location.href='index.html';
            </script> 
        <?php
    }

}