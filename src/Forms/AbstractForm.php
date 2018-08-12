<?php

namespace HL\WPAutoloader\Forms;

use HL\WPAutoloader\Forms\iForm;

abstract class AbstractForm implements iForm
{
    protected $options;

    public function getForm()
    {
        return $this->options['form'];
    }

    public function init()
    {
        $this->options['form']['action'] = admin_url('admin-ajax.php?action='. $this->options['form']['id'] .'_submit');

        // insert
        add_action('wp_ajax_'.$this->options['form']['id'].'_submit', array($this, 'submit'));
        add_action('wp_ajax_nopriv_'.$this->options['form']['id'].'_submit', array($this, 'submit'));

        // admin
        add_action('admin_menu', [$this, 'init_menu_page']);
    }

    /**
     * create a menu on admin sidebar
     */
    public function init_menu_page()
    {
        add_menu_page(
            $this->options['menu_page']['label'],
            $this->options['menu_page']['label'],
            'manage_options',
            'wpa_'.$this->options['form']['id'],
            array(&$this, 'list_entries'),
            $this->options['menu_page']['icon'],
            39
        );
    }

    public function submit()
    {
        global $app;
        $formUtil = $app->getUtil('form');

        $ret = [
            'success' => true,
            'errors' => [],
        ];

        // fill form with values
        $formUtil->handleForm($this->options['form']);

        // validate
        $ret['errors'] = $formUtil->validate($this->options['form']);

        if (sizeof($ret['errors']) > 0) {
            $ret['success'] = false;
        } else {
            $result = $formUtil->getEntityToSave($this->options['form']);

            // send mail
            $email = [
                'title' => $this->options['menu_page']['label'],
                'result' => $result,
                'form' => $this->options['form'],
            ];

            $message = $app->render('emails/form-entries.php', $email, true);
            $email = WP_DEBUG ? 'halaz.lazlo@gmail.com' : get_option('email');

            wp_mail($email, __('New contact email', get_template()), $message);

            // save message to db
            global $wpdb, $app;

            $wpdb->insert($this->options['form']['id'], $result);
        }

        echo json_encode($ret);
        exit;
    }

    public function list_entries()
    {
        global $app, $wpdb;

        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
        $limit   = 20;
        $offset  = ($pagenum - 1) * $limit;

        $results = $wpdb->get_results(
            "SELECT * FROM {$this->options['form']['id']} ORDER BY id DESC LIMIT $offset, $limit",
            ARRAY_A
        );

        $resultTotalCount = $wpdb->get_var("SELECT COUNT(`id`) FROM {$this->options['form']['id']}");
        $total = ceil( $resultTotalCount / $limit );

        $pagination = paginate_links( array(
            'base' => add_query_arg( 'pagenum', '%#%' ),
            'format' => '',
            'prev_text' => __('&laquo;', get_template()),
            'next_text' => __('&raquo;', get_template()),
            'total' => $total,
            'current' => $pagenum
        ) );

        $app->render('admin/forms/list-entries.php', [
            'title' => $this->options['menu_page']['label'],
            'form'      => $this->options['form'],
            'results'   => $results,
            'pagination'=> $pagination
        ]);
    }
}
