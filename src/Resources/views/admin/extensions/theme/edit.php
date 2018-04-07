<div class="wrap">
    <h1>
        Theme settings
    </h1>

    <form method="post" action="options.php">
        <?php settings_fields('wpa_theme_settings'); ?>
        <?php do_settings_sections('wpa_theme_settings'); ?>

        <?php foreach ($settings as $key => $input): ?>
            <?php register_setting('wpa_settings', $key); ?>

            <p>
                <label for="<?php echo $key; ?>">
                    <?php echo $input['label']; ?>
                </label><br>
                <input type="text"
                        id="<?php echo $key; ?>"
                        name="<?php echo $key; ?>" size="45"
                        value="<?php echo esc_attr(get_option($key)); ?>"
                        <?php if ( !empty($input['placeholder']) ): ?> placeholder="<?php echo $input['placeholder'] ?>" <?php endif; ?>/>
            </p>
        <?php endforeach ?>

        <?php submit_button(); ?>
    </form>
</div>
