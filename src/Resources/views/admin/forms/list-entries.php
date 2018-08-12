<h1>
    <?php echo __($title, get_template()); ?>
</h1><br>

<table class="wp-list-table widefat fixed striped pages">
    <thead>
        <tr>
            <?php foreach ($form['fields'] as $key => $field): ?>
                <?php
                    $label = $key;
                    if (isset($field['label'])) {
                        $label = $field['label'];
                    } elseif (isset($field['placeholder'])) {
                        $label = $field['placeholder'];
                    }
                ?>

                <td class="manage-column column-name column-primary">
                    <?php echo $label; ?>
                </td>
            <?php endforeach ?>
        </tr>
    </thead>

    <tbody id="the-list">
        <?php foreach($results as $result) : ?>
        <tr class="iedit author-self level-0 post-150 type-page status-publish hentry">
            <?php foreach ($form['fields'] as $key => $field): ?>
                <td class="manage-column column-name column-primary">
                    <?php echo $result[$key]; ?>
                </td>
            <?php endforeach ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($paginations) && $paginations) : ?>
    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <?php echo $paginations; ?>
        </div>
    </div>
<?php endif; ?>
