<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Email title or subject</title>
</head>

<body style="width:100%; margin:0; padding:0; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">
    <table>
        <tr>
            <td>
                <h1><?php echo __($title, get_template()); ?></h1>
            </td>
        </tr>

        <?php foreach ($form['fields'] as $key => $field): ?>
            <tr>
                <td>
                    <?php
                        $label = $key;
                        if (isset($field['label'])) {
                            $label = $field['label'];
                        } elseif (isset($field['placeholder'])) {
                            $label = $field['placeholder'];
                        }

                        echo __($label, get_template());
                    ?>
                </td>

                <td>
                    <?php echo $result[$key] ?: '-'; ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>
