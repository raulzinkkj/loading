<?php
include 'conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_tarefa = $_POST['nome_tarefa'] ?? null;
    $data_tarefa = $_POST['data_tarefa'] ?? null;
    $estatus_tarefa = 'Pendente';

    $sql = "INSERT INTO tarefas (nome_tarefa, data_tarefa, estatus_tarefa)
            VALUES (:nome_tarefa, :data_tarefa, :estatus_tarefa)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':nome_tarefa', $nome_tarefa);
    $stmt->bindParam(':data_tarefa', $data_tarefa);
    $stmt->bindParam(':estatus_tarefa', $estatus_tarefa);
    $stmt->execute();
}

$pagina = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limite = 4;
$offset = ($pagina - 1) * $limite;

$sqlTotal = "SELECT COUNT(*) as total FROM tarefas";
$stmtTotal = $conexao->prepare($sqlTotal);
$stmtTotal->execute();

$totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalRegistros / $limite);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
    <title>Agenda</title>
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

        .cabecalho {
            margin-top: 30px;
            border-bottom: solid 1px lightgray;
            width: 100%;
            height: 40px;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
        }

        .bolinha {
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .titulo {
            width: 420px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .data {
            width: 150px;
            display: flex;
            align-items: center;
        }

        .importancia {
            width: 100px;
            display: flex;
            align-items: center;
        }

        .linha {
            width: 100%;
            height: 40px;
            border-radius: 0 0 8px 8px;
            display: flex;
            align-items: center;
            background: #FAF9F8;
            gap: 15px;
        }

        input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 15px;
            height: 15px;
            border: 2px solid #2564CF;
            border-radius: 50%;
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background: #00c853;
            border-color: #00c853;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }


        input[type="checkbox"]:checked::after {
            content: '✓';
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }


        .cel_linha form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .concluido {
            text-decoration: line-through;
        }

        .menu {
            list-style: none;
            display: flex;
            gap: 20px;
        }


        .menu li {
            position: relative;
        }

        .submenu {
            list-style: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 180px;
            background: white;
            border: 1px solid #ddd;
            display: none;
            text-decoration: none;
            z-index: 9999;
            border-radius: 10px;
        }

        .mostra_menu li:hover .submenu {
            display: block;
        }

        .submenu li {
            padding: 12px;
            border-radius: 10px;
        }

        .submenu li:hover {
            background: #f5f5f5;
        }

        a {
            text-decoration: none;
            cursor: pointer;
            color: black;
        }

        .paginacao {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .btn-pag {
            width: 35px;
            height: 35px;
            padding: 0 10px;
            border-radius: 8px;
            background: white;
            border: 1px solid #dcdfe4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #333;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-pag:hover {
            background: #185FA5;
            color: white;
            border-color: #185FA5;
        }

        .btn-pag.ativo {
            background: #185FA5;
            color: white;
            border-color: #185FA5;
            font-weight: bold;
        }

        .proxima {
            width: auto;
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
                            <input type="date" name="data_tarefa" id="calendario" required>
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

                $sql_mostra = "SELECT * FROM tarefas LIMIT :limite OFFSET :offset";
                $stmt_mostra = $conexao->prepare($sql_mostra);
                $stmt_mostra->bindValue(':limite', $limite, PDO::PARAM_INT);
                $stmt_mostra->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt_mostra->execute();

                if ($stmt_mostra->rowCount() > 0) {
                    echo "<div class='cabecalho'>";
                    echo "<div class='cel_cabecalho bolinha'></div>";
                    echo "<div class='cel_cabecalho titulo'>Título</div>";
                    echo "<div class='cel_cabecalho data'>Data de Vencimento</div>";
                    echo "<div class='cel_cabecalho importancia'>Importância</div>";
                    echo "</div>"; //Fechamento da div cabeçalho
                }

                while ($linha = $stmt_mostra->fetch(PDO::FETCH_ASSOC)) {

                    $classe = '';

                    if ($linha['estatus_tarefa'] === 'Concluido') {
                        $classe = 'concluido';
                    }

                    echo "<div class='linha '>";
                    echo "<div class='cel_linha bolinha'>";
                    echo "<form action='api/mudar_estatus.php' method='get'>
                            <input type='hidden' value='{$linha['id_tarefa']}' name='id_tarefa' onchange='this.form.submit()'>
                            <input type='checkbox'" .  (($linha['estatus_tarefa'] == 'Concluido') ? 'checked' : '') . "  name='estatus_tarefa' value='Concluido' onchange='this.form.submit()'>
                          </form>";
                    echo "</div>"; //fechamento da div cel_linha do formulario
                    echo "<div class='cel_linha titulo $classe'>{$linha['nome_tarefa']}
                            <form action='api/excluir_tarefa.php' method='get'>
                                <input type='hidden' value='{$linha['id_tarefa']}' name='id_tarefa'>
                                    <div class='mostra_menu'>
                                        <nav>
                                            <ul class='menu'>
                                                <li>
                                                    <img src='img/info_blue.svg' style='width: 18px; margin-left: 5px;'>
                                                    <ul class='submenu'>
                                                        <li><a href='api/excluir_tarefa.php?id_tarefa={$linha['id_tarefa']}'>🗑️ Excluir</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                            </form>
                         </div>";
                    echo "<div class='cel_linha data $classe'>" . date('d/m/Y', strtotime($linha['data_tarefa'])) . "</div>";
                    echo "<div class='cel_linha importancia $classe'></div>";
                    echo "</div>"; //fechamento da div linha
                }
                ?>
            </div>
            <div class="paginacao">
                <?php if ($pagina > 1): ?>
                    <a href="?page=<?php echo $pagina - 1; ?>" class="btn-pag proxima">◀️ Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a class="btn-pag" href="?page=<?php echo $i; ?>"
                        style="margin: 0 5px; <?php echo ($i == $pagina) ? 'ativo' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina < $totalPaginas): ?>
                    <a class="btn-pag proxima" href="?page=<?php echo $pagina + 1; ?>">Próxima ▶️</a>
                <?php endif; ?>
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