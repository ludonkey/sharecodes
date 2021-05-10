<?php

require "../vendor/autoload.php";

use Entity\Code;
use Entity\User;
use Entity\Language;

$userToto = new User();
$userToto->id = 1;
$userToto->nickname = "toto";
$userToto->password = "pwd1";

$langPHP = new Language();
$langPHP->id = 1;
$langPHP->code = "PHP";

$code1 = new Code();
$code1->id = 1;
$code1->desc = "Helloword in PHP";
$code1->content = 'echo "Hello"';
$code1->created_at = "2021-05-10 14:49:00";
$code1->user = $userToto;
$code1->language = $langPHP;

$code2 = new Code();
$code2->id = 2;
$code2->desc = "Goodbye in PHP";
$code2->content = 'echo "Bye"';
$code2->created_at = "2021-05-10 14:49:00";
$code2->user = $userToto;
$code2->language = $langPHP;

$code3 = new Code();
$code3->id = 3;
$code3->desc = "What in PHP";
$code3->content = 'echo "What";';
$code3->created_at = "2021-05-10 14:49:00";
$code3->user = $userToto;
$code3->language = $langPHP;

$items = [$code1, $code2, $code3, $code1, $code2, $code3, $code1, $code2, $code3, $code1, $code2, $code3];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareCode</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles/dracula.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class=" container">
            <a class="navbar-brand" href="#">[[ ShareCode ]]</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav mr-auto">

                </ul>
                <form class="form-inline my-2 my-md-0" action="/search" id="search-form">
                    <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search">
                </form>
                <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" id="login-btn">Log in</a>
                <a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" id="signup-btn">Sign up</a>
            </div>
        </div>
    </nav>
    <div class="container">

        <div class="row masonry-grid">
            <div class="col-md-6 col-lg-4 masonry-column">
                <?php
                foreach ($items as $oneItem) {
                ?>
                    <div class="card card-block">
                        <div class="card-body">
                            <h5 class="card-title"><svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 6.675l-1.8-.6c-.2-.1-.3-.3-.2-.4l.9-1.7c.6-1.2-.7-2.5-1.9-1.9l-1.7.9c-.1.1-.3 0-.4-.2l-.6-1.8c-.4-1.3-2.2-1.3-2.6 0l-.6 1.8c-.1.2-.3.3-.4.2l-1.7-.9c-1.2-.6-2.5.7-1.9 1.9l.9 1.7c.1.1 0 .3-.2.4l-1.8.6c-1.3.4-1.3 2.3 0 2.7l1.8.6c.2 0 .3.2.2.3l-.9 1.7c-.6 1.2.7 2.5 1.9 1.9l1.7-.9c.2-.1.4 0 .4.2l.6 1.8c.4 1.3 2.3 1.3 2.7 0l.6-1.8c.1-.2.3-.3.4-.2l1.7.9c1.2.6 2.5-.7 1.9-1.9l-1-1.7c-.1-.2 0-.4.2-.4l1.8-.6c1.3-.4 1.3-2.2 0-2.6zm-7 3.7c-1.3 0-2.4-1.1-2.4-2.4 0-1.3 1.1-2.4 2.4-2.4 1.3 0 2.4 1.1 2.4 2.4 0 1.3-1.1 2.4-2.4 2.4z" fill="#CCC"></path>
                                </svg><span class="badge badge-secondary lg-cpp"><?= $oneItem->language->code ?></span></h5>
                            <pre><code class="cpp"><?= $oneItem->content ?></code></pre>
                            <hr />
                            <p class="card-text">
                                <?= $oneItem->desc ?>
                            <footer class="blockquote-footer"><a href=# class="text-decoration-none">@<?= $oneItem->user->nickname ?></a></footer>
                            </p>
                            <a href="#" class="btn btn-primary btn-cpy">Copy</a>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="js/highlight.pack.js"></script>
    <script src="js/script.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
</body>

</html>