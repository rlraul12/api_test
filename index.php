<?php

declare(strict_types=1);

const API_URL = "https://whenisthenextmcufilm.com/api";

// inicializa la peticion
//$ch = curl_init(API_URL);

// indica que devuelva pero que no muestre en pantalla
//curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

// ejecutar y guardar la peticion
//$resultado = curl_exec($ch);



//curl_close($ch);


function get_data(string $url): array
{   
    $resultado = file_get_contents($url);
    $data = json_decode($resultado, true);
    return $data;
}

$data = get_data(API_URL);

function get_until_message(int $days): string
{
    return match (true) {
        $days == 0  => "Hoy se estrena",
        $days == 2  => "Faltan dos dias para el estreno, preparaos!!!!!",
        $days < 7   => "Esta semana va el estreno",
        $days < 30  => "Este mes se estrenara",
        default     => "Tardara en estrenarse $days dias",
    };
}



$untilMessage = get_until_message($data["days_until"]);

?>

<head>
    <title>La proxima pelicula de Marve</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    />
</head>

<main>
    
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="<?= $data["title"] ?>" style="border-radius: 16px;" />
    </section>

    <hgroup>
        <h3><?= $data["title"] ?>  <br> <?= $untilMessage ?></h3>
        <p>Fecha de estreno <?= $data["release_date"] ?></p>
        <p>La siguiente es <?= $data["following_production"]["title"] ?> </p>
    </hgroup>
</main>

<style>
    :root {
        color-scheme: light dark;
    }

    body{
        display: grid;
        place-content: center;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img{
        margin: 0 auto;
    }
</style>