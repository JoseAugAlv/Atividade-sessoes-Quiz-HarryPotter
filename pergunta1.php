<?php
    //iniciar sessão
    session_start();

    //verifica se a variavel pontuação foi criada
    if(!isset($_SESSION['pontuacao'])){
        $_SESSION['pontuacao'] = 0;
    }
    $mostrar_sweetAlert1 = false;
    $mostrar_sweetAlert2 = false;

    //verificar se a variavel está sendo difinida
    if(isset($_SESSION['user'])){
        // a variavel usuario vai receber a variavel da sessão
        $usuario = $_SESSION['user'];
    } 
    else{
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!empty($_POST['pergunta1'])){
                $escolha = $_POST['pergunta1'];
                
                if ($escolha == 'grifinoria') {
                    $_SESSION['pontuacao_grifinoria'] += 10;
                } elseif ($escolha == 'sonserina') {
                    $_SESSION['pontuacao_sonserina'] += 10;
                } elseif ($escolha == 'corvinal') {
                    $_SESSION['pontuacao_corvinal'] += 10;
                } elseif ($escolha == 'lufa-lufa') {
                    $_SESSION['pontuacao_lufa_lufa'] += 10;
                }
                $mostrar_sweetAlert1 = true;;
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
    <title>Pergunta 1</title>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <link rel="stylesheet" href="styles/perguntas.css">
      <link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon">
</head>
<body>
    <div class="fundo-escuro"></div>
    <div class="campo_pergunta">
        <div class="pergunta">
            <center><h3>Pergunta 01/10</h3></center>
            <p>Qual dessas qualidades você mais valoriza?</p>
        </div>
        <div class="opcoes">
            <form action="" method="post">
            <label for="opcao1"><input type="radio" name="pergunta1" id="opcao1" value="grifinoria"> Coragem</label>
            <label for="opcao2"><input type="radio" name="pergunta1" id="opcao2" value="sonserina"> Ambição</label>
            <label for="opcao3"><input type="radio" name="pergunta1" id="opcao3" value="corvinal"> Sabedoria</label>
            <label for="opcao4"><input type="radio" name="pergunta1" id="opcao4" value="lufa-lufa"> Lealdade</label>
            <center><input type="submit" value="Proxima"></center>
        </form>

        </div>

        <div class="botoes">
            <center> <button id="btn_voltar" type="button" onclick="voltar()">Voltar para o inicio</button></center>
        </div>
    </div>

        <?php
            if ($mostrar_sweetAlert1) {
                echo '<script>
                Swal.fire({
                position: "top",
                icon: "success",
                title: "Resposta enviada!",
                showConfirmButton: false,
                timer: 1000
                }).then(() => {
                        let timerInterval;
                        Swal.fire({
                            title: "Preparar-se!",
                            html: "Proxima pergunta em <b>3</b> segundos.",
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const b = Swal.getHtmlContainer().querySelector("b");
                                let segundos = 3;
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
                            window.location.href = "pergunta2.php";
                        });
                    });
                </script>';
            }
            if ($mostrar_sweetAlert2){
                echo '<script>
                Swal.fire({
                icon: "error",
                title: "Erro!",
                text: "Escolha um opçao!",
                });
                </script>';
            }
        ?>

    <script>
        function voltar() {

            /*costumizar para os botões serem editaveis com css, 
            perdão professor tive que usar IA pra essa, não achei 
            outro jeito e  tbm para fechar a sessão quando fosse cancelado*/
            const swalWithCustomButtons = Swal.mixin({
                customClass: {
                    confirmButton: "botao_confirmar",
                    cancelButton: "botao_cancelar"
                },
                buttonsStyling: false
            });

            swalWithCustomButtons.fire({
                title: "Você tem certeza?",
                text: "Toda sua pontuação será perdida!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, sair!",
                cancelButtonText: "Não, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithCustomButtons.fire({
                        title: "Você escolheu sair!",
                        text: "Sua pontuação foi perdida!",
                        icon: "success"
                    }).then(() => {
                        // Redireciona para a página que destrói a sessão
                        window.location.href = "fechar_sessao.php";
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithCustomButtons.fire({
                        title: "Cancelada!",
                        text: "Sua pontuação continua salva!",
                        icon: "error"
                    });
                }
            });
        }
    </script>
    
</body>
</html>