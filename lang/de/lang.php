<?php

return [
    'plugin' => [
        'name' => 'Service Manager',
        'description' => 'Verwalte Kategorien und Services.'
    ],
    'navigation' => [
        'main' => 'Service-Verwaltung',
        'services' => 'Services',
        'categories' => 'Kategorien',
        'create_category' => 'Kategorie anlegen',
        'edit_category' => 'Kategorie bearbeiten',
        'create_service' => 'Service anlegen',
        'edit_service' => 'Service bearbeiten'
    ],
    'category' => [
        'field_name' => 'Bezeichnung',
        'field_description' => 'Beschreibung',
        'field_is_active' => 'Aktiv',
        'field_published_at' => 'Veröffentlichen am',
        'field_sort_order' => 'Reihenfolge',
        'field_services' => 'Services',
        'field_banner' => 'Bannerbild',
        'field_slug' => 'Slug',

        'placeholder_name' => 'Neue Kategorie',
        'placeholder_slug' => 'neue-kategorie',
        'placeholder_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',

        'comment_slug' => 'Der Slug wird auf Basis des Kategorie-Namens automatisch generiert und wird beispielsweise in der URL zur Zuordnung der Kategorie verwendet.',
        'comment_banner' => 'Das Bannerbild wird neben der Kategorie-Seite auch in Slidern und anderen Components verwendet, in denen die Kategorie eingebunden wird.',

        'tab_general' => 'Informationen',
        'tab_services' => 'Service-Zuweisung',
        'tab_visibility' => 'Sichtbarkeit',

        'filter_active' => 'Aktiv',
        'filter_published' => 'Veröffentlicht'
    ],
    'service' => [
        'field_name' => 'Bezeichnung',
        'field_description' => 'Beschreibung',
        'field_price' => 'Preis (€)',
        'field_time' => 'Dauer (Minuten)',
        'field_category' => 'Kategorie',
        'field_is_active' => 'Aktiv',
        'field_published_at' => 'Veröffentlichen am',
        'field_sort_order' => 'Reihenfolge',
        'field_is_special' => 'Special',
        'field_is_highlight' => 'Highlight',

        'placeholder_name' => 'Neuer Service',
        'placeholder_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
        'placeholder_price' => '50',
        'placeholder_time' => '120',

        'comment_is_special' => 'Specials werden separat zu anderen Services der Kategorie dargestellt.',
        'comment_is_highlight' => 'Highlights werden in Slidern und zufällig in anderen Components dargestellt.',
        'comment_attributes' => 'Einstellungen zur erweiterten Sichtbarkeit.',

        'tab_general' => 'Informationen',
        'tab_category' => 'Kategorie-Zuweisung',
        'tab_visibility' => 'Sichtbarkeit',
        'tab_attributes' => 'Attribute',

        'option_no_category' => 'Keine Kategorie',

        'filter_category' => 'Kategorien',
        'filter_active' => 'Aktiv',
        'filter_published' => 'Veröffentlicht'
    ],
    'flash' => [
        'created_category' => 'Kategorie angelegt',
        'saved_category' => 'Kategorie gespeichert',
        'deleted_category' => 'Kategorie gelöscht',
        'created_service' => 'Service angelegt',
        'saved_service' => 'Service gespeichert',
        'deleted_service' => 'Service gelöscht'
    ],
    'error' => [
        'permission_denied' => 'Zugriff verweigert'
    ],
    'component' => [
        'categories' => [
            'name' => 'Kategorien',
            'description' => 'Liste aller Service-Kategorien.',

            'group_links' => 'Verknüpfungen',

            'property_inactive' => 'Inaktive Kategorien anzeigen',
            'property_inactive_description' => 'Ist diese Option gewählt, werden auch nicht aktive Kategorien zurückgegeben.',
            'property_page' => 'Kategorie-Seite',
            'property_page_description' => 'Seite auf die die einzelnen Kategorien zeigen.'
        ],
        'category' => [
            'name' => 'Kategorie',
            'description' => 'Datein einer Kategorie',

            'property_slug' => 'Slug Parametername',
            'property_slug_description' => 'Der URL-Parameter welcher verwendet wird um die Kategorie zu bestimmen.'
        ],
        'services' => [
            'name' => 'Services',
            'description' => 'Liste aller Services',

            'property_category' => 'Kategorie-Slug',
            'property_category_description' => 'Slug der Kategorie für die Services geladen werden sollen. Wird im Normalfall mit dem an die Seite übergebenen Slug-Parameter gefüllt.',
            'property_inactive' => 'Inaktive Services anzeigen',
            'property_inactive_description' => 'Ist diese Option gewählt, werden auch nicht aktive Services zurückgegeben.',
            'property_special' => 'Nur Specials anzeigen',
            'property_special_description' => 'Ist diese Option gewählt, werden nur Services zurückgegeben welche als "Special" deklariert sind.'
        ]
    ],
    'menu_item' => [
        'service-categories' => 'Service Manager Kategorien'
    ],
    'permissions' => [
        'edit' => 'Kategorien & Services bearbeiten'
    ]
];
