<?php

    require VIEWS . '/incs/header.php';
    require VIEWS . '/chat/index.css.php';
?>

<main class="main py-3">
    <div class="container">
        <?php if (count($users) > 0): ?>
        <div class="chatbox">
            <div class="top-bar">
                <div class="avatar"><p>V</p></div>
                <div class="name"><?=$users[0]['name'] ?></div>
                <div class="icons">
                    <i class="fas fa-phone"></i>
                    <i class="fas fa-video"></i>
                </div>
                <div class="menu">
                    <div class="dots"></div>
                </div>
            </div>
            <div class="middle">
                <div class="voldemort">
                    <div class="incoming">
                        <div class="bubble">Hey, Father's Day is coming up..</div>
                        <div class="bubble">What are you getting.. Oh, oops sorry dude.</div>
                    </div>
                    <div class="outgoing">
                        <div class="bubble lower">Nah, it's cool.</div>
                        <div class="bubble">Well you should get your Dad a cologne. Here smell it. Oh wait! ...</div>
                    </div>
                    <div class="typing">
                        <div class="bubble">
                            <div class="ellipsis one"></div>
                            <div class="ellipsis two"></div>
                            <div class="ellipsis three"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-bar">
                <div class="chat">
                    <input type="text" placeholder="Type a message..." />
                    <button type="submit"><i class="fas fa-paper-plane"></i>send</button>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="messages"></div>
        <div class="profile">
            <div class="avatar"><p>H</p></div>
            <div class="name2">Harry<p class="email">Harry@potter.com</p></div>
        </div>
        <ul class="people">
            <?php foreach ($users as $user) : ?>
            <li class="person focus">
                <span class="title"><?=$user['name'] ?> </span>
                <span class="time">2:50pm</span><br>
                <span class="preview">What are you getting... Oh, oops...</span>
            </li>
            <?php endforeach; ?>
            <li class="person">
                <span class="title">Ron</span>
                <span class="time">2:25pm</span><br>
                <span class="preview">Meet me at Hogsmeade and bring...</span>
            </li>
            <li class="person">
                <span class="title">Hermione</span>
                <span class="time">2:12pm</span><br>
                <span class="preview">Have you and Ron done your hom...</span>
            </li>
        </ul>
    </div>
</main>

<?php require VIEWS . '/incs/footer.php' ?>

<!--$(".person").on('click', function(){-->
<!--    $(this).toggleClass('focus').siblings().removeClass('focus');-->
<!--})-->
