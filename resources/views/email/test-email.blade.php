<style>
    body {
        background-color: #F2EADE;
    }
    .container{
        max-width: 1000px;
        display: flex;
        justify-content: center;
        background-color: #F2EADE;
    }
    h1{
        text-align: center;
        letter-spacing: 1rem;
        font-size: 1.5rem;
        color: rgb(93, 93, 93);
    }
    .name{
       text-align: center;
        letter-spacing: .4rem;
        font-size: 1rem;
        font-weight: 500;
        color: rgb(79, 79, 79); 
    }
    img{
        width: 100%;
        height: auto;
    }
    .p-anchor{
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
    }
     .a-btn{
        text-decoration: none;
        color: rgb(81, 81, 81);
        font-size: 1rem;
        margin-top: 2rem;
        background-color: #F2EADE;
        border: 1px solid #F2EADE;
        padding: 1rem;
        -webkit-transition: .3s;
        -o-transition: .3s;
        transition: .3s;
        text-transform: capitalize;
    }
    .a-btn:hover{
        background-color: #f5f5f5;
        color: black;
        border: solid 1px grey;
        border-radius: 4px;
    }
    .confirmed{
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
    }
    
</style>
<div class="container" style="padding: 1rem; background: #f5f5f5;">
    <div>
        <h1>INVITACIÓN</h1>
        @if ($guest->status == 1)
            <p class="confirmed">Gracias Allan por confirmar!</p>
        @else
            <p class="name">{{$guest->first_name}}</p>
            <p class="p-anchor"><a class="a-btn" href="https://lopezchavezwedding.website/confirm_invitation/{{ base64_encode($guest->id) }}">Confirmar invitación</a> </p>
            <br>
        @endif
        <img src="https://lopezchavezwedding.website/storage/svg/invitation.jpg" alt="lopezchavez invitation" srcset="">
    </div>
</div>