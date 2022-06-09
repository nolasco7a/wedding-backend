<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Invitation</title>
    <style>
        body{
            background-color: #F2EADE;
            display: flex;
            justify-content: center;
            background-color: #F2EADE;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        .container{
            max-width: 500px;
            height: auto;
        }
        h1{
            color: rgb(93, 93, 93);
        }
        a{
            text-decoration: none;
            color: rgb(81, 81, 81);
            font-size: 1rem;
            margin-top: 2rem;
            background-color: #F2EADE;
            border: 1px solid #F2EADE;
            width: 100%;
            text-align: center;
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    @if (!$invitation)
        <div class="container">
            <h1>Gracias por confirmar!</h1>
            <p>Estamos muy alegres que puedas compartir este momento con nosotros {{ $guest->first_name }},  Te esperamos en nuestra boda!</p>
            <a href="https://page.lopezchavezwedding.website/">Llevame a la pagina de boda!</a>
        </div> 
    @else
        <div class="container">
            <h1>Este usuario ya ha sido confirmado!</h1>
            <p>{{ $guest->first_name }} si no eres tu..., por favor ponte en contacto con los novios para que ayuden con tu confirmación o dejamos un comentario en la siguiente pagina en la seccion de comentarios!</p>
            <a href="https://page.lopezchavezwedding.website/">Llevame a la pagina de boda!</a>
        </div> 
    @endif
</body>
</html>