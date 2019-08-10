<?php
    use HL\WPAutoloader\Util\View;
    // global $app;
    // $formUtil = $app->getUtil('form');

    // $formUtil->start($form);

    // foreach ($form['fields'] as $key => $input) {
    //     $formUtil->widget($form, $key);
    // }

    // $formUtil->end($form);

    View::Render('form/layout/start.php', ['form' => $form]);

    foreach ($form->getFields() as $field) {
        $field->renderWidget($field);
    }

    View::Render('form/layout/end.php', ['form' => $form]);
?>
