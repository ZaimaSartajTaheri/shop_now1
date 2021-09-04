<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    footer {
        background: #111;
        color: #d9d9d9;
        margin-bottom: -10%;
    }

    .main-content {
        display: flex;

    }

    .main-content .box {
        flex-basis: 50%;
        padding: 10px 20px;
    }

    .box h2 {
        font-size: 1.125rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .box .content {
        margin: 20px 0 0 0;
        position: relative;
    }

    .box .content:before {
        position: absolute;
        content: '';
        top: -10px;
        height: 2px;
        width: 100%;
        background: #1a1a1a;
    }

    .box .content:after {
        position: absolute;
        content: '';
        height: 2px;
        width: 15%;
        background: #f12020;
        top: -10px;
    }

    .left .content p {
        text-align: justify;
    }

    .left .content .social {
        margin: 20px 0 0 0;
    }

    .left .content .social a {
        padding: 0 2px;
    }

    .left .content .social a span {
        height: 40px;
        width: 40px;
        background: #1a1a1a;
        line-height: 40px;
        text-align: center;
        font-size: 18px;
        border-radius: 5px;
        transition: 0.3s;
        color: #d9d9d9;
    }

    .left .content .social a span:hover {
        background: #f12020;
    }

    .center .content .fas {
        font-size: 1.4375rem;
        background: #1a1a1a;
        height: 45px;
        width: 45px;
        line-height: 45px;
        text-align: center;
        border-radius: 50%;
        transition: 0.3s;
        cursor: pointer;
    }

    .center .content .fas:hover {
        background: #f12020;
    }

    .center .content .text {
        font-size: 1.0625rem;
        font-weight: 500;
        padding-left: 10px;
    }

    .center .content .phone {
        margin: 15px 0;
    }

    .right form .footer-text {
        font-size: 1.0625rem;
        margin-bottom: 2px;
        color: #d9d9d9;
    }

    .right form .msg {
        margin-top: 10px;
    }

    .right form input,
    .right form #msgForm {
        width: 100%;
        font-size: 1.0625rem;
        background: #151515;
        padding-left: 10px;
        border: 1px solid #222222;
        border-radius: 5px;
        color: #d9d9d9;
    }

    .right form input {
        height: 35px;
    }

    .btn {
        margin-top: 10px;
    }

    .btn button {
        height: 40px;
        width: 15vw;
        border: none;
        outline: none;
        background: #cc0000;
        font-size: 1.0625rem;
        font-weight: 500;
        cursor: pointer;
        border-radius: 5px;
        color: #d9d9d9;
        transition: .3s;
    }

    .btn button:hover {
        background: #e60000;
    }

    @media screen and (max-width: 900px) {
        footer {
            position: relative;
            bottom: 0px;
        }

        .main-content {
            flex-wrap: wrap;
            flex-direction: column;
        }

        .main-content .box {
            margin: 5px 0;
        }
    }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="main-content">
        <div class="left box">
            <h2>About us</h2>
            <div class="content">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam minus corporis totam accusamus
                    nostrum debitis hic, sed cumque impedit ex neque illo eaque sunt illum voluptas id animi qui
                    corrupti?</p>
                <div class="social">
                    <a href="#"><span class="fab fa-facebook-f"></span></a>
                    <a href="#"><span class="fab fa-twitter"></span></a>
                    <a href="#"><span class="fab fa-instagram"></span></a>
                    <a href="#"><span class="fab fa-youtube"></span></a>
                </div>
            </div>
        </div>
        <div class="center box">
            <h2>Address</h2>
            <div class="content">
                <div class="place">
                    <span class="fas fa-map-marker-alt"></span>
                    <span class="footer-text">Bashundhara,Dhaka</span>
                </div>
                <div class="phone">
                    <span class="fas fa-phone-alt"></span>
                    <span class="footer-text">+880-1552356034</span>
                </div>
                <div class="email">
                    <span class="fas fa-envelope"></span>
                    <span class="footer-text">shop.now@yahoo.com</span>
                </div>
            </div>
        </div>
        <div class="right box">
            <h2>Contact us</h2>
            <div class="content">
                <form action="#">
                    <div class="email">
                        <div class="text">Email *</div>
                        <input type="email" required>
                    </div>
                    <div class="msg">
                        <div class="text">Message *</div>
                        <textarea id="msgForm" rows="2" cols="25" required></textarea>
                    </div>
                    <div class="btn">
                        <button type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="bottom text-center">
        <span class="far fa-copyright"></span>
        <small>2020 All rights reserved.</small>
    </div>
</body>

</html>