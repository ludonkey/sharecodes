<?php
include __DIR__ . "/header.php";
?>
<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <form class="form-signin" method="POST" action="/new">
            <h2 class="form-signin-heading" style="color: black;">New Source Code</h2>
            <?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-warning' role='alert'>$errorMsg</div>";
            }
            ?>
            <input type="text" class="form-control" name="title" placeholder="Title (>= 2 characters)" required="" autofocus="" />
            <input type="text" class="form-control" name="desc" placeholder="Description (>= 2 characters)" required="" />
            <textarea class="form-control" id="content" name="content" rows="6"></textarea>
            <select class="form-control" id="languageId" name="languageId">
                <option value="0">---CHOOSE A LANGUAGE---</option>
                <?php
                foreach ($languages as $oneLanguage) {
                ?>
                    <option value="<?= $oneLanguage->id ?>"><?= $oneLanguage->code ?></option>
                <?php
                }
                ?>
            </select>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create</button>
        </form>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>