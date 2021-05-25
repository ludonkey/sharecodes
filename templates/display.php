{% include "/header.php" %}
<div class="row masonry-grid">
    <div class="col-md-6 col-lg-4 masonry-column">
        <?php
        $nbElementByLine = ceil(count($codes) / 3);
        for ($i = 0; $i < count($codes);) {
            $oneItem = $codes[$i];
        ?>
            <div class="card card-block">
                <div class="card-body">
                    <h5 class="card-title"><svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 6.675l-1.8-.6c-.2-.1-.3-.3-.2-.4l.9-1.7c.6-1.2-.7-2.5-1.9-1.9l-1.7.9c-.1.1-.3 0-.4-.2l-.6-1.8c-.4-1.3-2.2-1.3-2.6 0l-.6 1.8c-.1.2-.3.3-.4.2l-1.7-.9c-1.2-.6-2.5.7-1.9 1.9l.9 1.7c.1.1 0 .3-.2.4l-1.8.6c-1.3.4-1.3 2.3 0 2.7l1.8.6c.2 0 .3.2.2.3l-.9 1.7c-.6 1.2.7 2.5 1.9 1.9l1.7-.9c.2-.1.4 0 .4.2l.6 1.8c.4 1.3 2.3 1.3 2.7 0l.6-1.8c.1-.2.3-.3.4-.2l1.7.9c1.2.6 2.5-.7 1.9-1.9l-1-1.7c-.1-.2 0-.4.2-.4l1.8-.6c1.3-.4 1.3-2.2 0-2.6zm-7 3.7c-1.3 0-2.4-1.1-2.4-2.4 0-1.3 1.1-2.4 2.4-2.4 1.3 0 2.4 1.1 2.4 2.4 0 1.3-1.1 2.4-2.4 2.4z" fill="#CCC"></path>
                        </svg>
                        <?= htmlentities($oneItem->title) ?>
                        <span class="badge badge-secondary lg-cpp"><?= strtoupper(htmlentities($oneItem->language->code)) ?></span>
                    </h5>
                    <pre><code class="cpp"><?= htmlentities($oneItem->content) ?></code></pre>
                    <hr />
                    <p class="card-text">
                        <?= htmlentities($oneItem->desc) ?>
                    <footer class="blockquote-footer">
                        <a href="?search=@<?= htmlentities($oneItem->user->nickname) ?>" class="text-decoration-none">@<?= htmlentities($oneItem->user->nickname) ?></a>
                    </footer>
                    </p>
                    <a href="#" class="btn btn-primary btn-cpy">Copy</a>
                </div>
            </div>
        <?php
            $i++;
            if ($nbElementByLine > 0 && $i % $nbElementByLine == 0) {
                echo '</div><div class="col-md-6 col-lg-4 masonry-column">';
            }
        }
        ?>
    </div>
</div>
{% include "/footer.php" %}