<?php global $app; ?>

<div class="row">
    <?php
        $app->render('form/layout.php', ['form' => $form]);
    ?>
</div>
