<?php

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
        }

        .header_menu_lateral {
            display: flex;
            justify-content: space-between;
        }

        .principal {
            background: #f3f2f1;
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

        </div>
    </section>
</body>

</html>