<?php

class Review
{

    private $max_cash_out_fields = array(
        array(
            'label' => 'День',
            'id'    => 'max_cash_out_per_day',
            'type'  => 'number',
        ),

        array(
            'label' => 'Неделя',
            'id'    => 'max_cash_out_per_week',
            'type'  => 'number',
        ),

        array(
            'label' => 'Месяц',
            'id'    => 'max_cash_out_per_month',
            'type'  => 'number',
        )
    );

    private $min_cash_out_fields = array(
        array(
            'label' => '',
            'id'    => 'min_cash_out',
            'type'  => 'number',
        ),
    );

    private $currency = array(
        'usd' => 'USD',
        'eur' => 'EUR',
        'rub' => 'RUB',
    );

    public function __construct()
    {
        add_action('init', array($this, 'register_review_post_type'));
        add_action('init', array($this, 'register_lang_taxonomy'));
        add_action('init', array($this, 'register_version_taxonomy'));
        add_action('init', array($this, 'register_payment_method_taxonomy'));

        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_fields'));
    }

    public function register_review_post_type()
    {
        register_post_type('review', [
            'label'         => null,
            'labels'        => [
                'name'               => 'Обзор',
                'singular_name'      => 'Обзор',
                'add_new'            => 'Добавить обзор',
                'add_new_item'       => 'Добавление обзора',
                'edit_item'          => 'Редактирование обзора',
                'new_item'           => 'Новый обзор',
                'view_item'          => 'Смотреть обзор',
                'search_items'       => 'Искать обзор',
                'not_found'          => 'Не найдено',
                'not_found_in_trash' => 'Не найдено в корзине',
                'parent_item_colon'  => '',
                'menu_name'          => 'Обзоры',
            ],
            'description'   => '',
            'public'        => true,
            'show_in_menu'  => null,
            'show_in_rest'  => null,
            'rest_base'     => null,
            'menu_position' => null,
            'menu_icon'     => null,
            'hierarchical'  => false,
            'supports'      => ['title', 'editor'],
            'taxonomies'    => [],
            'has_archive'   => false,
            'rewrite'       => true,
            'query_var'     => true,
        ]);
    }

    public function register_lang_taxonomy()
    {
        register_taxonomy('lang', ['review'], [
            'label'             => '',
            'labels'            => [
                'name'          => 'Языки сайта',
                'singular_name' => 'Языки сайта',
                'search_items'  => 'Найти язык',
                'all_items'     => 'Все языки',
                'view_item '    => 'Просмотр языка',
                'edit_item'     => 'Изменить язык',
                'update_item'   => 'Обновить язык',
                'add_new_item'  => 'Добавение языка',
                'new_item_name' => 'Название нового языка',
                'menu_name'     => 'Языки сайта',
                'back_to_items' => '← Вернуться к списку языков',
            ],
            'description'       => '',
            'public'            => true,
            'hierarchical'      => false,
            'rewrite'           => true,
            'capabilities'      => array(),
            'meta_box_cb'       => null,
            'show_admin_column' => false,
            'show_in_rest'      => null,
            'rest_base'         => null,
        ]);
    }

    public function register_version_taxonomy()
    {
        register_taxonomy('version', ['review'], [
            'label'             => '',
            'labels'            => [
                'name'          => 'Версии сайта',
                'singular_name' => 'Версии сайта',
                'search_items'  => 'Найти версию',
                'all_items'     => 'Все версии',
                'view_item '    => 'Просмотр версий',
                'edit_item'     => 'Изменить версию',
                'update_item'   => 'Обновить версию',
                'add_new_item'  => 'Добавение версии',
                'new_item_name' => 'Название новой версии',
                'menu_name'     => 'Версии сайта',
                'back_to_items' => '← Вернуться к списку версии',
            ],
            'description'       => '',
            'public'            => true,
            'hierarchical'      => false,
            'rewrite'           => true,
            'capabilities'      => array(),
            'meta_box_cb'       => null,
            'show_admin_column' => false,
            'show_in_rest'      => null,
            'rest_base'         => null,
        ]);
    }

    public function register_payment_method_taxonomy()
    {
        register_taxonomy('payment_method', ['review'], [
            'label'             => '',
            'labels'            => [
                'name'          => 'Платежные системы',
                'singular_name' => 'Платежные системы',
                'search_items'  => 'Найти платежную систему',
                'all_items'     => 'Все платежные системы',
                'view_item '    => 'Просмотр платежных систем',
                'edit_item'     => 'Изменить платежную систему',
                'update_item'   => 'Обновить платежную систему',
                'add_new_item'  => 'Добавение платежной системы',
                'new_item_name' => 'Название платежной системы',
                'menu_name'     => 'Платежные системы',
                'back_to_items' => '← Вернуться к списку платежных систем',
            ],
            'description'       => '',
            'public'            => true,
            'hierarchical'      => false,
            'rewrite'           => true,
            'capabilities'      => array(),
            'meta_box_cb'       => null,
            'show_admin_column' => false,
            'show_in_rest'      => null,
            'rest_base'         => null,
        ]);
    }

    public function add_meta_boxes()
    {
        add_meta_box(
            'MaxCashOutLimit',
            __('Макс. лимит на вывод средств', ''),
            array($this, 'max_cash_out_box_callback'),
            'review',
            'normal',
            'core'
        );

        add_meta_box(
            'MinCashOut',
            __('Минимальная сумма вывода', ''),
            array($this, 'min_cash_out_box_callback'),
            'review',
            'normal',
            'core'
        );
    }

    public function max_cash_out_box_callback($post)
    {
        wp_nonce_field('MaxCashOutLimit_data', 'MaxCashOutLimit_nonce');
        $this->field_generator($post, $this->max_cash_out_fields);
    }

    public function min_cash_out_box_callback($post)
    {
        wp_nonce_field('MinCashOut_data', 'MinCashOut_nonce');
        $this->field_generator($post, $this->min_cash_out_fields);
    }

    public function field_generator($post, $meta_fields)
    {
        $output = '';
        foreach ($meta_fields as $meta_field) {
            $label      = '<label for="' . $meta_field['id'] . '" style="display:block;margin-bottom:5px">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta($post->ID, $meta_field['id'], true);
            if (empty($meta_value)) {
                if (isset($meta_field['default'])) {
                    $meta_value = $meta_field['default'];
                }
            }
            switch ($meta_field['type']) {
                default:
                    $input = sprintf(
                        '<input id="%s" name="%s" type="%s" value="%s">',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_field['type'],
                        $meta_value
                    );
            }
            $input  = $this->add_currency_select($input);
            $output .= $this->format_rows($label, $input);
        }
        echo '<div style="display: flex;flex-wrap: wrap;gap: 10px 30px;">' . $output . '</div>';
    }

    public function add_currency_select($input)
    {
        $select = '<select>';

        foreach ($this->currency as $key => $currency) {
            $select .= sprintf('<option value="%s">%s</option>', $key, $currency);
        }

        $select .= '</select>';

        return $input . $select;
    }

    public function format_rows($label, $input)
    {
        return '<div>' . $label . $input . '</div>';
    }

    public function save_fields($post_id)
    {
        if ( ! isset($_POST['MaxCashOutLimit_nonce'])) {
            return $post_id;
        }
        $nonce = $_POST['MaxCashOutLimit_nonce'];
        if ( ! wp_verify_nonce($nonce, 'MaxCashOutLimit_data')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        $meta_fields = array_merge($this->max_cash_out_fields, $this->min_cash_out_fields);

        foreach ($meta_fields as $meta_field) {
            if (isset($_POST[$meta_field['id']])) {
                switch ($meta_field['type']) {
                    case 'email':
                        $_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
                        break;
                    case 'text':
                        $_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
                        break;
                }
                update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
            } else {
                if ($meta_field['type'] === 'checkbox') {
                    update_post_meta($post_id, $meta_field['id'], '0');
                }
            }
        }
    }

    public function get_review($id)
    {
        $review          = get_posts([
            'include'   => $id,
            'post_type' => 'review',
        ]);
        $review['_meta'] = get_post_meta($id);

        return $review;
    }
}

if (class_exists('Review')) {
    new Review;
}
