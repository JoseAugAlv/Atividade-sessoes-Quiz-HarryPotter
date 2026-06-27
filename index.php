<?php
    //Iniciar a  sessão
    session_start();

    if (!isset($_SESSION['pontuacao_grifinoria'])) $_SESSION['pontuacao_grifinoria'] = 0;
    if (!isset($_SESSION['pontuacao_sonserina'])) $_SESSION['pontuacao_sonserina'] = 0;
    if (!isset($_SESSION['pontuacao_corvinal'])) $_SESSION['pontuacao_corvinal'] = 0;
    if (!isset($_SESSION['pontuacao_lufa_lufa'])) $_SESSION['pontuacao_lufa_lufa'] = 0;


    //verificar se o formulario foi enviado
    $mostrar_sweetAlert1 = false;
    $mostrar_sweetAlert2 = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //VERIFICAR SE O CAMPO DE NOME FOI PREENCHIDO
        if(!empty($_POST['nome'])){
            //armazenar o nome na variavel de sessão
            $_SESSION['user'] = $_POST['nome'];
            $mostrar_sweetAlert1 = true;
        }
        else{
            $mostrar_sweetAlert2 = true;
        }
        
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Incial Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon">
</head>
<body>
    <div class="apresentacao">
        <h2>Bem-vindo(a) ao teste de Harry Potter</h2>
        <p>Descubra aqui sua casa de Hogwarts</p>
        <h5>Desenvolvido por: Jose Augusto Alves</h5>
    </div>
    <div class="fundo-escuro"></div>
    <div class="campo_form">
        <form action="" method="post">
            <label for="nome">Nome: </label><br/>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome"><br/>
            <center><input id="enviar" type="submit" value="Enviar"><br/></center>
        </form>
    </div>
    <div class="descricao">
        <h3>Nesse teste você descobrira a qual casa de hogwarts você se enquadra melhor!</h3><br/>
    </div>
    <div class="campo_casas">
        
        <div id="grifinoria" class="casas">
            <img class="img_casas" src="imagens/grifinoria.png" alt="Grifinória">
            <p id="casa_titulo">Grifinória</p>
            <ul>
                <li>Coragem</li>
                <li>Determinação</li>
                <li>Nobreza</li>
                <li>Bravura</li>
            </ul>
        </div>

        <div id="sonserina" class="casas">
            <img class="img_casas" src="imagens/sonserina.png" alt="Sonserina">
            <p id="casa_titulo">Sonserina</p>
            <ul>
                <li>Ambição</li>
                <li>Astúcia</li>
                <li>Determinação</li>
                <li>Autopreservação</li>
            </ul>
        </div>

        <div id="corvinal" class="casas">
            <img class="img_casas" src="imagens/corvinal.png" alt="Corvinal">
            <p id="casa_titulo">Corvinal</p>
            <ul>
                <li>Sabedoria</li>
                <li>Inteligência</li>
                <li>Criatividade</li>
                <li>Originalidade</li>
            </ul>
        </div>

        <div id="lufa-lufa" class="casas">
            <img class="img_casas" src="imagens/lufa-lufa.png" alt="Lufa-Lufa">
            <p id="casa_titulo">Lufa-Lufa</p>
            <ul>
                <li>Lealdade</li>
                <li>Trabalho duro</li>
                <li>Justiça</li>
                <li>Paciência</li>
            </ul>
        </div>

    </div>
     <?php
        if ($mostrar_sweetAlert1) {
            echo '<script>
                Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "Seu nome foi enviado!",
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    let timerInterval;
                    Swal.fire({
                        title: "Preparar-se!",
                        html: "Vai começar em <b>5</b> segundos.",
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const b = Swal.getHtmlContainer().querySelector("b");
                            let segundos = 5;
                            timerInterval = setInterval(() => {
                                segundos--;
                                b.textContent = segundos;
                            }, 1000);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then(() => {
                        // Redireciona após o alerta fechar
                        window.location.href = "pergunta1.php";
                    });
                });
            </script>';

        }
        if ($mostrar_sweetAlert2){
            echo '<script>
            Swal.fire({
            icon: "error",
            title: "Erro!",
            text: "Você não preencheu seu nome!",
            });
            </script>';
        }

        ?>
        <script>
            function comecar(){

            var nome = document.getElementById('nome').value;

            if(nome === "") {
                Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Você não preencheu seu nome!",
                });
                return;
            }



            let timerInterval;
            Swal.fire({
                title: "Preparar-se!",
                html: "Vai começar em <b>5</b> segundos.",
                timer: 5000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector('b');
                    let segundos = 5;
                    timerInterval = setInterval(() => {
                        segundos--;
                        b.textContent = segundos;
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then(() => {
                // Redireciona após o alerta fechar
                window.location.href = "pergunta1.php";
            });

                    }
        </script>

    
</body>
</html>