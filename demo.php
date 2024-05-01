<?php

const API_URL = "https://whenisthenextmcufilm.com/api";

// inicializa la peticion
$ch = curl_init(API_URL);

// indica que devuelva pero que no muestre en pantalla
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

// ejecutar y guardar la peticion
$resultado = curl_exec($ch);

$data = json_decode($resultado, true);

curl_close($ch);



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
        <h3><?= $data["title"] ?>  se estrena <?= $data["days_until"] ?> dias</h3>
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