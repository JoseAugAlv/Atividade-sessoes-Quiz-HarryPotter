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
        if (!empty($_POST['pergunta7'])) {
            $escolha = $_POST['pergunta7'];

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
    <title>Pergunta 7</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/perguntas.css">
     <link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon">
</head>
<body>
    <div class="fundo-escuro"></div>
    <div class="campo_pergunta">
        <div class="pergunta">
            <center><h3>Pergunta 07/10</h3></center>
            <p>Quando você enfrenta um momento de crise pessoal, qual dessas atitudes melhor descreve sua forma de lidar com a situação?</p>
        </div>
        <div class="opcoes">
            <form action="" method="post">
                <label for="opcao1">
                    <input type="radio" name="pergunta7" id="opcao1" value="grifinoria"> Procuro expressar meus sentimentos e pedir ajuda para amigos ou familiares
                </label>
                <label for="opcao2">
                    <input type="radio" name="pergunta7" id="opcao2" value="sonserina"> Analiso friamente a situação para traçar um plano de ação, mesmo que isso me afaste emocionalmente
                </label>
                <label for="opcao3">
                    <input type="radio" name="pergunta7" id="opcao3" value="corvinal"> Reflito profundamente sozinho, buscando entender a raiz do problema e aprender com ele
                </label>
                <label for="opcao4">
                    <input type="radio" name="pergunta7" id="opcao4" value="lufa-lufa"> Tento manter a calma e apoiar os outros ao meu redor, mesmo que isso custe ignorar meus próprios sentimentos
                </label>
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
                    window.location.href = "pergunta8.php";
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
