<?php
    global $app;
    $formUtil = $app->getUtil('form');

    $formUtil->start($form);

    foreach ($form['fields'] as $key => $input) {
        $formUtil->widget($form, $key);
    }

    $formUtil->end($form);
?>
