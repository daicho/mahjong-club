<?php
    session_start();

    // ログイン判定
    if (isset($_SESSION["LOGIN"])) {
        header("Location: /");
        exit();
    }

    $login_failed = (isset($_GET["failed"]) && $_GET["failed"] == "1");
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ログイン - 成績管理システム | 競技麻雀同好会</title>
        <link rel="stylesheet" href="/css/common.css">
        <link rel="stylesheet" href="/css/login.css">
        <script>
            (function(d) {
              var config = {
                kitId: 'evc7hwv',
                scriptTimeout: 3000,
                async: true
              },
              h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
            })(document);
        </script>
    </head>

    <body>
        <header class="header_block">
            <a href="/">
                <img class="logo" src="/svg/logo.svg" alt="競技麻雀同好会のロゴ">
            </a>
        </header>

        <section class="login_form">
            <img class="lock_img" src="/svg/lock.svg" alt="錠マーク">

            <?php if ($login_failed) { ?>
                <p class="error_msg">パスワードが間違っています</p>
            <?php } ?>

            <form name="forms" action="/auth.php" method="post">
                <input id="pass_form" type="password" name="password" placeholder="パスワード">
                <input id="login_btn" type="submit" name="login" value="ログイン">
            </form>
        </section>

        <footer>
            <p>&copy; 2020 長野高専競技麻雀同好会</p>
        </footer>

        <script type="text/javascript" src="/js/login.js"></script>
    </body>
</html>