<?php
    session_start();

    $user = $_SESSION['user'] ?? 'Usuário';

    $p_grifinoria = $_SESSION['pontuacao_grifinoria'] ?? 0;
    $p_sonserina = $_SESSION['pontuacao_sonserina'] ?? 0;
    $p_corvinal = $_SESSION['pontuacao_corvinal'] ?? 0;
    $p_lufa_lufa = $_SESSION['pontuacao_lufa_lufa'] ?? 0;

    $maiorPontuacao = max($p_grifinoria, $p_sonserina, $p_corvinal, $p_lufa_lufa);

    if ($maiorPontuacao == $p_grifinoria) {
        $casa_final = "Grifinória";
        $imagem_casa = "imagens/fundo_grifinoria.jpg";
        $descricao_casa = "Valentes e destemidos, os membros da Grifinória prezam a coragem acima de tudo.";
    } elseif ($maiorPontuacao == $p_sonserina) {
        $casa_final = "Sonserina";
        $imagem_casa = "imagens/fundo_sonserina.jpg";
        $descricao_casa = "Ambiciosos e astutos, os sonserinos usam sua inteligência para alcançar seus objetivos.";
    } elseif ($maiorPontuacao == $p_corvinal) {
        $casa_final = "Corvinal";
        $imagem_casa = "imagens/fundo_corvinal.jpg";
        $descricao_casa = "Brilhantes e criativos, os corvinais valorizam o conhecimento e a sabedoria.";
    } else {
        $casa_final = "Lufa-Lufa";
        $imagem_casa = "imagens/fundo_lufa-lufa.jpg";
        $descricao_casa = "Justos e leais, os lufanos são conhecidos por sua paciência e dedicação.";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Teste</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/pontuacao.css">
     <link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon">


</head>
<body style="background-image: url('<?php echo $imagem_casa; ?>');">
    <div class="fundo-escuro"></div>
    <div class="campo_saudacao">
        <center><p><?php echo "Olá, $user!"; ?></p></center>
        <p>Sua pontuação final foi:</p>
        <ul>
            <li>Grifinória: <?php echo $p_grifinoria; ?></li>
            <li>Sonserina: <?php echo $p_sonserina; ?></li>
            <li>Corvinal: <?php echo $p_corvinal; ?></li>
            <li>Lufa-Lufa: <?php echo $p_lufa_lufa; ?></li>
        </ul>

    </div>
    <div class="casa_definida">
        <h2><strong><?php echo $casa_final; ?></strong></h2>
        <p><?php echo $descricao_casa; ?></p>
    </div>


    <div class="botoes">
            <center> <button id="btn_voltar" type="button" onclick="voltar()">Voltar para o inicio</button></center>
    </div>

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
