<?php
    global $app;
    $templateUtil = $app->getUtil('template');

    $input        = $form['fields'][$input_name];
    $includePath  = 'form/components';

    $groupClass = (isset($input['group_class'])) ? $input['group_class'] : null;
?>

<?php if ($input['type'] != 'hidden'): ?>
    <div class="form__group<?php echo ' '.$groupClass; ?>">

        <!-- label -->
        <?php
            $templateUtil->render($includePath.'/label.php', [
                'input'    => $input,
                'input_id' => $input_id
            ]);
        ?>

        <!-- input -->
        <?php
            $templateUtil->render($includePath.'/input-'. $input['type'] .'.php', [
                'input'     => $input,
                'input_id'  => $input_id,
                'input_name' => $input_name,
            ]);
        ?>

        <!-- error -->
        <?php
            $templateUtil->render($includePath.'/error.php', [
                'input'    => $input
            ]);
        ?>
    </div>
<?php else: ?>
    <?php
        $templateUtil->render($includePath.'/input-'. $input['type'] .'.php', [
            'input'     => $input,
            'input_id'  => $input_id,
            'input_name' => $input_name,
        ]);
    ?>
<?php endif ?>
