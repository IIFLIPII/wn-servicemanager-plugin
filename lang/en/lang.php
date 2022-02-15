<?php

return [
    'plugin' => [
        'name' => 'Service Manager',
        'description' => 'Manage categories and services.'
    ],
    'navigation' => [
        'main' => 'Service Manager',
        'services' => 'Services',
        'categories' => 'Categories',
        'create_category' => 'Create category',
        'edit_category' => 'Edit category',
        'create_service' => 'Create Service',
        'edit_service' => 'Edit service'
    ],
    'category' => [
        'field_name' => 'Name',
        'field_description' => 'Description',
        'field_is_active' => 'Active',
        'field_published_at' => 'Publish on',
        'field_sort_order' => 'Sort order',
        'field_services' => 'Services',
        'field_banner' => 'Banner image',
        'field_slug' => 'Slug',

        'placeholder_name' => 'New Category',
        'placeholder_slug' => 'new-category',
        'placeholder_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',

        'comment_slug' => 'The slug will be generated automatically, based on the given category name. It\'s used in URLs for assignment of the requested category.',
        'comment_banner' => 'The banner image will also be used in slides or other components displaying the category.',

        'tab_general' => 'General information',
        'tab_services' => 'Assign services',
        'tab_visibility' => 'Visibility',

        'filter_active' => 'Active',
        'filter_published' => 'Published'
    ],
    'service' => [
        'field_name' => 'Name',
        'field_description' => 'Description',
        'field_price' => 'Price (€)',
        'field_time' => 'Duration (minutes)',
        'field_category' => 'Category',
        'field_is_active' => 'Active',
        'field_published_at' => 'Published on',
        'field_sort_order' => 'Sort order',
        'field_is_special' => 'Special',
        'field_is_highlight' => 'Highlight',

        'placeholder_name' => 'New Service',
        'placeholder_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
        'placeholder_price' => '50',
        'placeholder_time' => '120',

        'comment_is_special' => 'Specials will be listed separately to other services of the category.',
        'comment_is_highlight' => 'Highlights can be displayed in slides or other components.',
        'comment_attributes' => 'Settings for advanced visibility.',

        'tab_general' => 'General information',
        'tab_category' => 'Assign category',
        'tab_visibility' => 'Visibility',
        'tab_attributes' => 'Attributes',

        'option_no_category' => 'No category',

        'filter_category' => 'Categories',
        'filter_active' => 'Active',
        'filter_published' => 'Published'
    ],
    'flash' => [
        'created_category' => 'Category created',
        'saved_category' => 'Category saved',
        'deleted_category' => 'Category deleted',
        'created_service' => 'Service created',
        'saved_service' => 'Service saved',
        'deleted_service' => 'Service deleted'
    ],
    'error' => [
        'permission_denied' => 'Permission denied'
    ],
    'component' => [
        'categories' => [
            'name' => 'Categories',
            'description' => 'List of service categories',

            'group_links' => 'Links',

            'property_inactive' => 'Display inactive categories',
            'property_inactive_description' => 'When selected, inactive categories will also be returned.',
            'property_page' => 'Category page',
            'property_page_description' => 'Page for displaying a category.'
        ],
        'services' => [
            'name' => 'Services',
            'description' => 'List of services',

            'property_category' => 'Category slug',
            'property_category_description' => 'Category slug for which the services will be returned. Is usually filled by the slug parameter given to the page.',
            'property_inactive' => 'Show inactive services',
            'property_inactive_description' => 'When selected, inactive services will also be returned.',
            'property_special' => 'Show only specials',
            'property_special_description' => 'When selected, only services declared as "specials" will be returned.'
        ]
    ]
];
