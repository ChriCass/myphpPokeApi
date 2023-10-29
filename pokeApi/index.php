<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>PokeApi</title>
</head>

<body>
    <main class="container text-align-center">
        <div class="d-flex justify-content-center">
            <img src="./img/logo.png" alt="logo">
        </div>
        <form method="post" action="">
            <div class="mt-3">
                <label for="name" class="form-label">Busquemos a tu Pokémon!</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
            </div>
            <button type="submit" class="mt-3 w-100 btn-primary">Enviar</button>
        </form>
    </main>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $pokemon_name = $_POST['name'];


        $api_url = 'https://pokeapi.co/api/v2/pokemon/' . $pokemon_name;


        $response = file_get_contents($api_url);

        if ($response !== false) {

            $data = json_decode($response);

            if ($data !== null) {
                echo '<article class="card">';
                echo '<img src="./img/bg-pattern-card.svg" alt="imagen header card" class="card-header">';
                echo '<div class="card-body">';
                echo '<img src="' . $data->sprites->other->{'dream_world'}->front_default . '" alt="imagen del Pokémon" class="card-body-img">';
                echo '<h1 class="card-body-title">' . $data->name . ' <span>' . $data->stats[0]->base_stat . 'hp</span></h1>';
                echo '<p class="card-body-text">' . $data->base_experience . ' exp</p>';
                echo '</div>';
                echo '<div class="card-footer">';
                echo '<div class="card-footer-social">';
                echo '<h3>' . $data->stats[1]->base_stat . 'K</h3>';
                echo '<p>Ataque</p>';
                echo '</div>';
                echo '<div class="card-footer-social">';
                echo '<h3>' . $data->stats[3]->base_stat . 'K</h3>';
                echo '<p>Ataque Especial</p>';
                echo '</div>';
                echo '<div class="card-footer-social">';
                echo '<h3>' . $data->stats[2]->base_stat . 'K</h3>';
                echo '<p>Defensa</p>';
                echo '</div>';
                echo '</div>';
                echo '</article>';
            } else {
                echo 'Error al decodificar la respuesta JSON de la API.';
            }
        } else {
            echo 'Error al realizar la solicitud a la API.';
        }
    }
    ?>

</body>

</html>