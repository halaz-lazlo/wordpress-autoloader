
# Global options

### Available menu pages

The menu items appearing on the left main menu
```
#!php

$parameters = [
    'available_menu_pages' => [
        'index.php',                 // dashboard
        'edit.php',                  // posts
        'upload.php',                // media
        'edit.php?post_type=page',   // pages
        'edit-comments.php',         // comments
        'themes.php',                // appearance
        'plugins.php',               // plugins
        'users.php',                 // users
        'tools.php',                 // tools
        'options-general.php'        // settings
    ]
]
```


### General theme options
```
#!php
$parameters = [
    'theme_settings' => [
        'menu_label' => __('Theme Settings', 'dc'),
        'form_fields' => [
            'address' => [
                'label'       => 'Address',
                'type'        => 'text',
                'placeholder' => '',
            ]
        ]
    ]
]
```

### Post type metaboxes ###

The metaboxes shown on post post type:
```
#!php
$parameters = [
    'screen_options' => [
        'page' => [
            'submitdiv', //– Date, status, and update/save metabox
            'title', // content title
            'editor', // content editor
            'pageparentdiv', //– Attributes metabox
            'page-attributes',
            'authordiv', //– Author metabox
            'author',
            'categorydiv', //– Categories metabox.
            'commentstatusdiv', //– Comments status metabox (discussion)
            'commentsdiv', //– Comments metabox
            'formatdiv', //– Formats metabox
            'postcustom', //– Custom fields metabox
            'postexcerpt', //– Excerpt metabox
            'postimagediv', //– Featured image metabox
            'revisionsdiv', //– Revisions metabox
            'slugdiv', //– Slug metabox
            'thumbnail',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'post-formats'
        ]
    ]
]
```


# Forms

## Declare form in app
```
#!php

<?php

// src/App.php

namespace Uniplus;

use DC\WPAutoloader\App as BaseApp;

use Uniplus\Forms\ContactForm;

class App extends BaseApp
{
    public function start()
    {
        $this->initForms();
    }

    public function initForms()
    {
        $this->forms['contact'] = new ContactForm();
        $this->forms['contact']->init();
    }
}

```


## Definig forms
The form must implement the iForm interface.
```
#!php
<?php

// src/Forms/ContactForm.php

namespace Uniplus\Forms;

use DC\WPAutoloader\Forms\AbstractForm;
use DC\WPAutoloader\Forms\iForm;

class ContactForm extends AbstractForm implements iForm
{
    public function __construct()
    {
        $emptyMsg = __("Can't be blank", 'dc');

        $this->options = [
            'menu_page' => [
                'label' => __('Contact messages', 'dc'),
                'icon' => 'dashicons-email-alt'
            ],
            'form' => [
                'id'     => 'contact_form',
                'method' => 'POST',
                'class'  => 'form--contact js-form',
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('Your name', 'dc').' *',
                        'validate' => [
                            'not_blank' => $emptyMsg
                        ]
                    ]
                ]
            ]
        ];
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
            //
        }

        echo json_encode($ret);
    }

    public function list_entries()
    {
        echo "list items";
    }
}

```


## Form input types, and available options
### Text
```
#!php

<?php

// src/Forms/ContactForm.php

'fields' => [
    'name' => [
        'type' => 'text',
        'label' => __('Your name', 'dc').' *',
        'validate' => [
            'not_blank' => $emptyMsg
        ]
    ]
]
```

### Email
```
#!php
<?php

// src/Forms/ContactForm.php

'fields' => [
    'email' => [
        'type' => 'email',
        'label' => __('Your Email', 'dc').' *',
        'validate' => [
            'not_blank' => __('Cant be blank'),
            'email' => __('Please provide a valid email address', 'dc')
        ]
    ],
]
```
### Phone
```
#!php
<?php

// src/Forms/ContactForm.php

'fields' => [
    'email' => [
        'type' => 'tel',
        'label' => __('Your Phone', 'dc').' *',
        'validate' => [
            'not_blank' => __('Cant be blank')
        ]
    ],
]
```

### Textarea
### Date
### Color
### Url
### Checkbox
### Radio
### Select
### Hidden

## Validation Example

```
#!php

<?php

// src/Forms/ContactForm.php

'fields' => [
    'name' => [
        'type' => 'text',
        'label' => __('Your name', 'dc').' *',
        'validate' => [
            'not_blank' => $emptyMsg,
            'email' => $emptyMsg
        ]
    ]
]
```


## Embeding the form in template

```
#!php

<?php
    // front-page.php

    global $app;

    $formUtil = $app->getUtil('form');
    $form = $app->getForm('contact');
?>

<?php $formUtil->start($form); ?>

<?php $formUtil->widget($form, 'name'); ?>

<button class="btn btn--std"><?php echo __('Send', 'dc'); ?></button>

<?php $formUtil->end($form); ?>
```

# Custom post types #

## Declare in app ##


```
#!php

<?php

// src/App.php

namespace Uniplus;

use DC\WPAutoloader\App as BaseApp;

class App extends BaseApp
{
    public function start()
    {
        $ArticlePostType = new PostTypes\ArticlePostType();
        $ArticlePostType->init();
    }
}

```

## Defining class ##


```
#!php

<?php

// src/PostTypes/ArticlePostType

namespace Uniplus\PostTypes;

use DC\WPAutoloader\PostTypes\AbstractPostType;

class ArticlePostType extends AbstractPostType
{
    public function __construct()
    {
        $this->options = [
            'post_type' => 'article',
            'post_type_features' => [
                'labels' => [
                    'name'          => __('Articles', 'dc'),
                    'singular_name' => __('Article', 'dc')
                ],
                'public'               => true,
                'has_archive'          => false,
                'supports' => [
                    'title',
                    'editor', // (content)
                    'author',
                    'thumbnail', // (featured image, current theme must also support post-thumbnails)
                    'excerpt',
                    'trackbacks',
                    'custom-fields',
                    'comments', // (also will see comment count balloon on edit screen)
                    'revisions', // (will store revisions)
                    'page-attributes', // (menu order, hierarchical must be true to show Parent option)
                    'post-formats' // add post formats
                ],
                'menu_icon' => 'dashicons-id-alt',
            ],
            'customs_box' => [
                'id'       => 'article_settings',
                'title'    => __('Article settings', 'dc'),
                'page'     => 'article'
            ],
            'customs_form' => [
                'id'     => 'article',
                'fields' => [
                    'city' => [
                        'type' => 'text',
                        'label' => __('City', 'dc')
                    ]
                ]
            ]
        ];
    }
}

```

# I18n #

To define a language textdomain, add a config param:


```
#!php
<?php

// src/Resources/config.php

$parameters = [
    'language_textdomain' => 'dc',
]
```

## .po example ##


```
#!po
# src/Resources/translations/en_EN.po

# I18N.
# Copyright (C) 2017 D12L
# This file is distributed under the same license as the PACKAGE package.
# D12L Crew <EMAIL@ADDRESS>, 2017.

msgid ""
msgstr ""
"Project-Id-Version: Societe 0.1.0\n"
"Report-Msgid-Bugs-To: \n"
"POT-Creation-Date: 2016-12-06 19:28+0100\n"
"PO-Revision-Date: 2016-12-07 12:53+0100\n"
"Language-Team: \n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"X-Generator: Poedit 1.8.7.1\n"
"Last-Translator: \n"
"Plural-Forms: nplurals=2; plural=(n != 1);\n"
"Language: en_US\n"

msgid "From"
msgstr "To"


```

## Usage ##

```
#!php

<?php

// front-page.php

echo __('From', 'dc');

// Result: To
```
