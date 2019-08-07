<?php

return [

    'index' => [
        'admin' => 'Admin',
        'message_donation' => "Cliquez sur un des liens pour gérer les dons.",
        'bundles' => 'Lots',
        'products' => 'Produits',
        'collection_rounds' => 'Collectes',
        'delivery_rounds' => 'Distributions',
        'trucks' => 'Camions',
        'warehouses' => 'Entrepôts',
        'categories' => 'Catégories',
        'users' => 'Utilisateurs',
    ],
    'bundles' => [
        'columns' => [
            'status' => 'Status',
            'submission_date' => 'Date de soumission',
            'number_of_products' => 'Nombre de produits',
            'weight' => 'Poids',
            'donor' => 'Donateur',
            'address' => 'Adresse',
            'action' => 'Action',
        ],
        'no_bundle_message' => "Il n'y a pas de lot dans la base de données.",
    ],
    'products' => [
        'bundle' => 'Lots',
        'bundle_detail' => 'Ce lot contient :count produits pour un total de :weight kg.',
        'columns' => [
            'barcode' => 'Code barre',
            'name' => 'Nom',
            'expiration_date' => "Date d'expiration",
            'quantity' => 'Quantité',
            'weight' => 'Poids',
            'shelf' => 'Étagère',
            'remove' => 'Supprimer',
        ],
        'no_product_message' => "Ce lot ne contient aucun produit.",
    ],
    'collection_rounds' => [
        'collection_round' => 'Collecte',
        'warehouse' => 'Entrepôt',
        'create_new_collection_round' => 'Créer un nouvelle une nouvelle collecte',
        'select_warehouse' => 'Séléctionner un entrepôt',
        'new_collection_round_button' => 'Nouvelle collecte',
        'columns' => [
            'status' => 'Status',
            'warehouse' => 'Entrepôt',
            'creation_date' => 'Date de création',
            'number_of_bundles' => 'Nombre de lots',
            'weight' => 'Poids',
            'action' => 'Action',
        ],
        'no_collection_round_message' => "Il n'y a aucune collecte dans la base de données.",
        'collection_round_detail' => 'Cette collecte contient :count lots pour un total de :weight kg. Elle est rattachée à l\'entreprôt de :name.',
        'on_going_truck' => 'La collecte est en cours avec le camion #:truck.',
        'auto_add_bundles' => 'Ajouter automatiquement des bundles',
        'actions' => [
            'close' => 'Fermer',
            'start_collect' => 'Lancer la collecte',
            'reopen' => 'Rouvrir',
            'terminate_collect' => 'Terminer la collecte (stock les produits)',
        ],
        'map' => 'Plan',
        'no_bundle_message' => "Cette collecte ne contient aucun lot.",
    ],
    'trucks' => [
        'columns' => [
            'warehouse' => 'Entrepôt',
            'capacity' => 'Capacité',
            'status' => 'Status',
            'collection_round' => 'Collecte',
        ],
        'statuses' => [
            'available' => 'Disponible',
            'ongoing' => 'En cours',
            'none' => 'Aucun',
        ],
        'no_truck_message' => "Il n'y a aucun camion dans la base de données.",
    ],
    'warehouses' => [
        'columns' => [
            'name' => 'Nom',
            'address' => 'Adresse',
            'number_of_shelves' => 'Nombre d\'étagères.',
            'used_weight' => 'Poids occupé',
        ],
        'no_warehouse_message' => "Aucun entrepôt enregistré dans la base de données.",
    ],
    'categories' => [
        'no_category_message' => "Aucune catégorie dans la base de données.",
    ],
];
