<?php
    $props = ['action', 'method'];
?>

<form <?php
    foreach ($props as $prop) {
        if (isset($form[$prop]) && isset($form[$prop])) {
            echo $prop.'="'.$form[$prop].'" ';
        }
    }

    $class = (isset($form['class'])) ? 'form '.$form['class'] : 'form';
    if (sizeof($classes) > 0) {
        $class .= ' '.implode($classes, ' ');
    }

    echo 'class="'.$class.'"';
    ?>
>
<input type="hidden" name="form_id" value="<?php echo $form['id']; ?>">
