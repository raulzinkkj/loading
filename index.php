<?php
include 'conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_tarefa = $_POST['nome_tarefa'];
    $data_tarefa = $_POST['data_tarefa'];
    $estatus_tarefa = 'Pendente';

    $sql = "INSERT INTO tarefas (nome_tarefa, data_tarefa, estatus_tarefa)
            VALUES (:nome_tarefa, :data_tarefa, :estatus_tarefa)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':nome_tarefa', $nome_tarefa);
    $stmt->bindParam(':data_tarefa', $data_tarefa);
    $stmt->bindParam(':estatus_tarefa', $estatus_tarefa);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            width: 100%;
            height: 48px;
            background: #1a2143;
            display: flex;
            justify-content: space-around;
            color: white;
            align-items: center;
        }

        header input {
            width: 452px;
            height: 32px;
            border-radius: 4px;
            padding: 10px;
            border: none;
        }

        header label {
            margin-right: 20px;
            font-weight: 700;
        }

        .outlook {
            display: flex;
            align-items: center;

        }

        .quadrados {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 4px;
            justify-content: center;
            align-content: center;
        }

        .bolinhas {
            background: white;
            border-radius: 50%;
            width: 4px;
            height: 4px;
        }

        .icones {
            width: 200px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .icones img {
            width: 24px;
        }

        section {
            display: grid;
            grid-template-columns: 42px 290px 1fr;
            height: calc(100vh - 50px);
            margin-top: 2px;
        }

        .icones_laterais {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: #f3f2f1;
        }

        .icones_laterais img {
            width: 32px;
            padding: 5px;
        }

        .menu_lateral {
            display: flex;
            flex-direction: column;
            border-right: solid 1px #f3f2f15b;
        }

        .menu_lateral img {
            width: 24px;
            margin-right: 20px;
        }

        .celulas {
            display: flex;
            width: 100%;
            height: 50px;
            align-items: center;
            padding: 20px;
        }

        .celulas:hover {
            background: #f3f2f1;
            border-left: solid 1px #499eff;
            cursor: pointer;
        }

        .header_menu_lateral {
            display: flex;
            justify-content: space-between;
        }

        .principal {
            background: #f3f2f1;
            padding: 20px;
        }

        .header_principal {
            width: 100%;
            height: 48px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px 0 20px;
            align-items: center;
        }

        .header_principal img {
            height: 30px;
        }

        .icons {
            display: flex;
            align-items: center;
            color: #2564CF;
            gap: 15px;
        }

        .dots {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2px;
            height: 45px;
            align-content: center;
            justify-content: center;
        }

        .dotzinhos {
            width: 6px;
            height: 6px;
            border-radius: 2px;
            border: none;
            background: #2564CF;
        }

        .iconezinhos {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        input[type="date"] {
            width: 17px;
            background: none;
            border: none;
        }

        .group_input {
            width: 100%;
            height: 96px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .form img {
            width: 23px;
            margin-left: 10px;
        }

        .form {
            background: white;
            border-bottom: solid 1px lightgray;
            width: 100%;
            height: 52px;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
        }

        .form input {
            background: none;
            border: none;
            margin-left: 10px;
            color: #2564CF;
        }

        .form input:focus {
            border: none;
            outline: none;
        }

        .form input::placeholder {
            color: #2564CF;
        }

        .form input:focus::placeholder {
            color: gray;
        }


        .info {
            background: #FAF9F8;
            width: 100%;
            height: 44px;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .group_icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .group_icons img {
            width: 17px;
        }

        button {
            padding: 5px;
            border: solid 1px lightgray;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="quadrados">
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
            <div class="bolinhas"></div>
        </div>

        <img src="img/WhatsApp Image 2026-06-10 at 21.02.49.jpeg" style="height: 24px;">

        <div class="outlook">
            <label for="">Outlook</label>
            <input type="text" placeholder="Pesquisar To Do">
        </div>

        <div class="icones">
            <img src="img/users-solid-full.svg" alt="">
            <img src="img/calendar-check-regular-full.svg" alt="">
            <img src="img/bell-regular-full.svg" alt="">
            <img src="img/gear-solid-full.svg" alt="">
            <img src="img/WhatsApp Image 2026-06-10 at 20.56.42.jpeg" style="border-radius: 50%; width: 32px;" alt="">
        </div>
    </header>

    <section id="tarefas">
        <div class="icones_laterais">
            <img src="img/icons8-email-aberto-100.png" style="margin-top: 10px;">
            <img src="img/icons8-hoje-100.png" alt="">
            <img src="img/icons8-copiloto-da-microsoft-100.png" alt="">
            <img src="img/icons8-user-groups-100.png" alt="">
            <img src="img/icons8-microsoft-tudo-2019-100.png" alt="">
            <img src="img/icons8-notícias-100.png" alt="">
            <img src="img/icons8-fluxograma-100.png" alt="">
            <img src="img/icons8-microsoft-onedrive-2019-100.png" alt="">
            <img src="img/icons8-aplicativos-100.png" alt="">
        </div>
        <div class="menu_lateral">
            <div class="celulas header_menu_lateral">
                <img src="img/bars-solid-full.svg" alt="">
                <img src="img/gear-solid-full (1).svg" alt="">
            </div>
            <div class="celulas">
                <img src="img/sun-regular-full.svg" alt="">
                <span>Meu Dia</span>
            </div>
            <div class="celulas">
                <img src="img/star-regular-full.svg" alt="">
                <span>Importante</span>
            </div>
            <div class="celulas">
                <img src="img/calendar-days-regular-full.svg" alt="">
                <span>Planejado</span>
            </div>
            <div class="celulas">
                <img src="img/user-regular-full.svg" alt="">
                <span>Atribuido a mim</span>
            </div>
            <div class="celulas">
                <img src="img/font-awesome-regular-full.svg" alt="">
                <span>Email Sinalizado</span>
            </div>
            <div class="celulas">
                <img src="img/house-regular-full.svg" alt="">
                <span>Tarefas</span>
            </div>
            <div class="borda" style="border-top: 1px solid #afaead; margin: 10px 20px 10px 20px;"></div>
        </div>
        <div class="principal">
            <div class="header_principal">
                <div class="icons">
                    <img src="img/casa.svg" alt="">
                    <h1 style="font-size: 1.2rem; font-weight: 600;">Tarefas</h1>
                    <img src="img/ellipsis-solid-full.svg" alt="">
                    <div class="dots">
                        <div class="dotzinhos"></div>
                        <div class="dotzinhos"></div>
                        <div class="dotzinhos"></div>
                        <div class="dotzinhos"></div>
                    </div>
                    <img src="img/bars-staggered-solid-full.svg" alt="">
                </div>
                <div class="iconezinhos">
                    <img src="img/arrow-right-arrow-left-solid-full.svg" style="transform:rotate(90deg);" alt="">
                    <img src="img/square-minus-regular-full.svg" style="transform:rotate(90deg);" alt="">
                </div>

            </div>
            <div class="group_input">
                <form action="" method="post">
                    <div class="form">
                        <img src="img/circle-regular-full.svg" alt="">
                        <input type="text" name="nome_tarefa" placeholder="Adicionar uma tarefa">
                    </div>
                    <div class="info">
                        <div class="group_icons">
                            <input type="date" name="data_tarefa" id="calendario">
                            <span id="mostra"></span>
                            <img src="img/bell.svg" alt="">
                            <img src="img/rotate-solid-full.svg" alt="">
                        </div>
                        <button type="submit">Adicionar</button>
                    </div>

                </form>



            </div>
            <div class="resultados">
                <?php
                include 'conexao/conexao.php';

                $sql_mostra = "SELECT * FROM tarefas";
                $stmt_mostra = $conexao->prepare($sql_mostra);
                //$stmt_mostra->bindParam(':id_tarefa', $id_tarefa);
                $stmt_mostra->execute();

                if ($stmt_mostra->rowCount() > 0) {
                    echo "<div class='cabecalho'>";
                    echo "<div class='cel_cabecalho'></div>";
                    echo "<div class='cel_cabecalho'>Título</div>";
                    echo "<div class='cel_cabecalho'>Data de Vencimento</div>";
                    echo "<div class='cel_cabecalho'>Importância</div>";
                    echo "</div>"; //Fechamento da div cabeçalho
                }

                while ($linha = $stmt_mostra->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='linha'>";
                    echo "<div class='cel_linha>";
                    echo "<form action='mudar_estatus.php' method='get'>
                            <input type='text' value='{$linha['id_tarefa']}' name='id_tarefa'>
                            <input type='checkbox' name='estatus_tarefa' value='1' onchange='this.form.submit()'>
                          </form>";
                    echo "</div>"; //fechamento da div cel_linha do formulario
                    echo "<div class='cel_linha'>{$linha['nome_tarefa']}</div>";
                    echo "<div class='cel_linha'>{$linha['data_tarefa']}</div>";
                    echo "</div>"; //fechamento da div linha
                }
                ?>
            </div>
        </div>
    </section>
    <script>
        const data = document.getElementById("calendario");
        const span = document.getElementById("mostra");

        data.addEventListener('change', () => {
            if (data.value) {
                const [ano, mes, dia] = data.value.split('-');
                span.textContent = `${dia}/${mes}/${ano}`;
            } else {
                span.textContent = '';
            }
        });
    </script>
</body>

</html>