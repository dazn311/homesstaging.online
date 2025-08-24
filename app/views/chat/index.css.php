<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,700');
    /*$font: 'Lato', sans-serif;
    */
    :root {
        --font: 'Lato', sans-serif;
        --primary-color: #79c7c5;
        --secondary-color: #a1e2d9;
        --white-color: #f9fbff;
        --dark-color: #777;
    }
    html {
        display: grid;
        min-height: 100%;
    }
    body {
        display: grid;
        background: linear-gradient(to bottom left, var(--primary-color) 40%, var(--white-color) 100%);
        font-family: 'Lato', sans-serif;
    }
    .container {
        position: relative;
        margin: 12% auto;
        width: 620px;
        height: 450px;
    }
    .messages {
        position: absolute;
        background: var(--white-color);
        opacity: 0.5;
        width: 30%;
        height: 70%;
        top: 2.5%;
        left: 5%;
        border-radius: 10px 0 0 10px;
        box-shadow: -5px 5px 10px rgba(0, 1, 0, );
    }
    /*chat messages */
    .people {
        position: absolute;
        list-style-type: none;
        width: 30.2%;
        left: -10px;
        top: 24.7%;
        line-height: 0.7em;
    }
    .people .title {
        text-transform: uppercase;
        font-size: 0.7em;
        margin-left: 14px;
        letter-spacing: 1px;
        color: var(--dark-color);
    }
    .people .time {
        font-size: 0.3em;
        color: var(--dark-color);
        position: absolute;
        right: 10px;
        margin-top: 2px;
    }
    .people .preview {
        color: var(--primary-color);
        margin-left: 14px;
        font-size: 0.5em;
    }
    .person {
        padding: 12px 0 12px 12px;
        border-bottom: 1px solid var(--primary-color);
        cursor: pointer;
    }
    .person:hover {
        background: var(--white-color);
        transition: all 0.3s ease-in-out;
    }
    .focus {
        background: var(--white-color);
        margin-left: 1px;
    }
    .profile {
        position: absolute;
        left: 16%;
        top: 7%;
    }
    .name2 {
        position: absolute;
        top: 50px;
        left: 2px;
        text-transform: uppercase;
        color: var(--primary-color);
        font-size: 0.8em;
        letter-spacing: 2px;
        font-weight: 500;
    }
    .email {
        color: var(--white-color);
        font-size: 0.5em;
        margin-left: -30px;
        margin-top: 2px;
    }
    .chatbox {
        position: absolute;
        left: 35%;
        height: 75%;
        width: 60%;
        border-radius: 10px;
        box-shadow: 5px 5px 15px rgba(0, 1, 0, );
    }
    .top-bar {
        width: 100%;
        height: 60px;
        background: var(--white-color);
        border-radius: 10px 10px 0 0;
    }
    .avatar {
        width: 35px;
        height: 35px;
        background: linear-gradient(to bottom left, var(--primary-color) 20%, var(--secondary-color) 100%);
        border-radius: 50%;
        position: absolute;
        top: 11px;
        left: 15px;
    }
    .avatar p {
        color: var(--white-color);
        margin: 7px 12px;
    }
    .name {
        position: absolute;
        top: 22px;
        text-transform: uppercase;
        color: var(--dark-color);
        font-size: 0.8em;
        letter-spacing: 2px;
        font-weight: 500;
        left: 60px;
    }
    .menu {
        position: absolute;
        right: 10px;
        top: 20px;
        width: 10px;
        height: 20px;
        cursor: pointer;
    }
    .menu:hover {
        transform: scale(1.1);
        transition: all 0.3s ease-in;
    }
    .icons {
        position: absolute;
        color: var(--secondary-color);
        padding: 10px;
        top: 5px;
        right: 21px;
        cursor: pointer;
    }
    .icons .fas {
        padding: 5px;
        opacity: 0.8;
    }
    .icons .fas:hover {
        transform: scale(1.1);
        transition: all 0.3s ease-in;
    }
    .dots {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background-color: var(--primary-color);
        box-shadow: 0px 7px 0px var(--primary-color), 0px 14px 0px var(--primary-color);
    }
    .middle {
        position: absolute;
        background: var(--white-color);
        width: 100%;
        opacity: 0.85;
        top: 60px;
        height: 80%;
    }
    .incoming {
        position: absolute;
        width: 50%;
        height: 100%;
        padding: 20px;
        /*background: lighten(var(--dark-color), 23%);*/
    }
    .incoming .bubble {
        background: var(--dark-color);
    }
    .typing {
        position: absolute;
        top: 67%;
        left: 20px;
    }
    .typing .bubble {
        background: var(--dark-color);
        /*background: lighten(var(--dark-color), 45%);*/
        padding: 8px 13px 9px 13px;
    }
    .ellipsis {
        width: 5px;
        height: 5px;
        display: inline-block;
        background: var(--dark-color);
        /*background: lighten(var(--dark-color), 25%);*/
        border-radius: 50%;
        animation: bounce 1.3s linear infinite;
    }
    .one {
        animation-delay: 0.6s;
    }
    .two {
        animation-delay: 0.5s;
    }
    .three {
        animation-delay: 0.8s;
    }
    .bubble {
        position: relative;
        display: inline-block;
        margin-bottom: 5px;
        color: var(--white-color);
        font-size: 0.7em;
        padding: 10px 10px 10px 12px;
        border-radius: 20px;
    }
    .lower {
        margin-top: 45px;
    }
    .outgoing {
        position: absolute;
        padding: 20px;
        right: 0;
        top: 15%;
        width: 50%;
        height: 100%;
    }
    .outgoing .bubble {
        background: var(--primary-color);
        float: right;
    }
    .bottom-bar {
        position: absolute;
        width: 100%;
        height: 55px;
        bottom: 0;
        background: var(--white-color);
        border-radius: 0 0 10px 10px;
    }
    .left {
        left: 0px;
    }
    input {
        padding: 7px;
        width: 74%;
        left: 5%;
        position: absolute;
        border: 0;
        top: 13px;
        background: var(--white-color);
        color: var(--primary-color);
    }
    input::placeholder {
        color: var(--secondary-color);
    }
    input:focus {
        color: var(--dark-color);
        outline: 0;
    }
    button {
        position: absolute;
        border: 0;
        font-size: 1em;
        color: var(--secondary-color);
        top: 19px;
        opacity: 0.8;
        right: 17px;
        cursor: pointer;
        outline: 0;
    }
    button:hover {
        transform: scale(1.1);
        transition: all 0.3s ease-in-out;
        color: var(--primary-color);
    }
    footer {
        position: absolute;
        bottom: 0;
        right: 0;
        text-align: center;
        font-size: 0.7em;
        padding: 10px;
    }
    footer p {
        color: var(--primary-color);
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    footer a {
        color: var(--white-color);
        text-decoration: none;
    }
    footer a:hover {
        color: var(--secondary-color);
    }
    @keyframes bounce {
        30% {
            transform: translateY(-2px);
        }
        60% {
            transform: translateY(0px);
        }
        80% {
            transform: translateY(2px);
        }
        100% {
            transform: translateY(0px);
            opacity: 0.5;
        }
    }

</style>
