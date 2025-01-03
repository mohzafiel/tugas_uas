<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Loading...</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        scroll-behavior: smooth;
        }
        .home{
        height: 100vh;
        width: 100%;
        background: url('{{asset('asset/img/img.png')}}') no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Ubuntu', sans-serif;
        }
        .home .home-content{
        width: 90%;
        height: 100%;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        }
        .home .text-one{
        font-size: 25px;
        color: #0E2431;
        }
        .home .text-two{
        color: #0E2431;
        font-size: 75px;
        font-weight: 600;
        margin-left: -3px;
        }
        .home .text-three{
        font-size: 40px;
        margin: 5px 0;
        color: #4070f4;
        }
        .home .text-four{
        font-size: 23px;
        margin: 5px 0;
        color: #0E2431;
        }
        .home .button{
        margin: 14px 0;
        }
        .home .button a{
        outline: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 25px;
        font-weight: 400;
        background: #4070f4;
        color: #fff;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.4s ease;
        }
        .home .button a:hover{
        border-color: #4070f4;
        background-color: #fff;
        color: #4070f4;
        }
        section{
        padding-top: 40px;
        }
        section .content{
        width: 80%;
        margin: 40px auto;
        font-family: 'Poppins', sans-serif;
        }
        .about .about-details{
        display: flex;
        justify-content: space-between;
        align-items: center;
        }
        section .title{
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        }
        section .title span{
        color: #0E2431;
        font-size: 30px;
        font-weight: 600;
        position: relative;
        padding-bottom: 8px;
        }
        section .title span::before,
        section .title span::after{
        content: '';
        position: absolute;
        height: 3px;
        width: 100%;
        background: #4070f4;
        left: 0;
        bottom: 0;
        }
        section .title span::after{
        bottom: -7px;
        width: 70%;
        left: 50%;
        transform: translateX(-50%);
        }
        .about .about-details .left{
        width: 45%;
        }
        .about .left img{
        height: 400px;
        width: 400px;
        object-fit: cover;
        border-radius: 12px;
        }
        .about-details .right{
        width: 55%;
        }
        section  .topic{
        color: #0E2431;
        font-size: 25px;
        font-weight: 500;
        margin-bottom: 10px;
        }
        .about-details .right p{
        text-align: justify;
        color: #0E2431;
        }
        section .button{
        margin: 16px 0;
        }
        section .button a{
        outline: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 25px;
        font-weight: 400;
        background: #4070f4;
        color: #fff;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.4s ease;
        }
        section .button a:hover{
        border-color: #4070f4;
        background-color: #fff;
        color: #4070f4;
        }
    </style>
</head>
<body>
<section class="home" id="home">
    <div class="home-content">
    <div class="text">
        <div class="text-one">Hello,</div>
        <div class="text-two">I'm Moh. Zafil Nachkal</div>
        <div class="text-three">Kelas Ti-A</div>
        <div class="text-four">Orang Keren</div>
    </div>
    <div class="button">
        <a href="{{ route('hutang.index') }}">Selanjutnya..</a>
    </div>
    </div>
</section>
</body>
</html>