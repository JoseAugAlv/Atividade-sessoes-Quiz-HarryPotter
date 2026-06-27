<?php
    session_start();

    // Inicializar variáveis de pontuação caso não existam
    if (!isset($_SESSION['pontuacao_grifinoria'])) $_SESSION['pontuacao_grifinoria'] = 0;
    if (!isset($_SESSION['pontuacao_sonserina'])) $_SESSION['pontuacao_sonserina'] = 0;
    if (!isset($_SESSION['pontuacao_corvinal'])) $_SESSION['pontuacao_corvinal'] = 0;
    if (!isset($_SESSION['pontuacao_lufa_lufa'])) $_SESSION['pontuacao_lufa_lufa'] = 0;

    $mostrar_sweetAlert1 = false;
    $mostrar_sweetAlert2 = false;

    if (isset($_SESSION['user'])) {
        $usuario = $_SESSION['user'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['pergunta2'])) {
            $escolha = $_POST['pergunta2'];

            if ($escolha == 'corvinal') {
                $_SESSION['pontuacao_corvinal'] += 10;
            } elseif ($escolha == 'sonserina') {
                $_SESSION['pontuacao_sonserina'] += 10;
            } elseif ($escolha == 'lufa-lufa') {
                $_SESSION['pontuacao_lufa_lufa'] += 10;
            } elseif ($escolha == 'grifinoria') {
                $_SESSION['pontuacao_grifinoria'] += 10;
            }

            $mostrar_sweetAlert1 = true;
        } else {
            $mostrar_sweetAlert2 = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pergunta 2</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/perguntas.css">
     <link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon">
</head>
<body>
    <div class="fundo-escuro"></div>
    <div class="campo_pergunta">
        <div class="pergunta">
            <center><h3>Pergunta 02/10</h3></center>
            <p>Qual bicho você levaria para Hogwarts?</p>
        </div>
        <div class="opcoes">
            <form action="" method="post">
                <label for="opcao1"><input type="radio" name="pergunta2" id="opcao1" value="corvinal"> Coruja</label>
                <label for="opcao2"><input type="radio" name="pergunta2" id="opcao2" value="sonserina"> Gato</label>
                <label for="opcao3"><input type="radio" name="pergunta2" id="opcao3" value="lufa-lufa"> Sapo</label>
                <label for="opcao4"><input type="radio" name="pergunta2" id="opcao4" value="grifinoria"> Nenhum, não preciso</label>
                <center><input type="submit" value="Próxima"></center>
            </form>
        </div>

        <div class="botoes">
            <center><button id="btn_voltar" type="button" onclick="voltar()">Voltar para o início</button></center>
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
                    html: "Próxima pergunta em <b>3</b> segundos.",
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
                    window.location.href = "pergunta3.php";
                });
            });
            </script>';
        }

        if ($mostrar_sweetAlert2) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro!",
                    text: "Escolha uma opção antes de continuar."
                });
            </script>';
        }
    ?>

    <script>
        function voltar() {
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
