<?php

return [
    'admin' => [
        'admin_controller' => [],
        'bundle_controller' => [
            'approve_success' => 'Le lot :bundle a été approuvé.',
            'reject_success' => 'Le lot :bundle a été rejeté.',
            'reject_product_error' => "Le produit n'a pas pu être supprimé.",
            'reject_product_success' => 'Le produit a bien été supprimé du lot.',
        ],
        'category_controller' => [],
        'collection_round_controller' => [
            'store_success' => 'Une nouvelle collecte a été créée.',
            'update_truck_error' => 'Aucun camion disponible pour le moment.',
            'update_status_error' => "Aucun espace disponible dans l'entrepôt !",
            'update_success' => "La collecte a bien été mise à jour.",
            'remove_bundle_success' => "Le lot a bien été retiré de la collecte.",
            'remove_bundle_error' => "Cette collecte ne peut plus être modifiée.",
            'destroy_error' => "Une erreur s'est produite lors de la suppression de la collecte.",
            'destroy_success' => "La collecte a bien été supprimée.",
            'modify_error' => "Cette collecte ne peut plus être modifiée.",
            'add_bundle_success' => "Le lot a bien été ajouté à la collecte.",
            'auto_add_bundles_success' => ":count lot(s) ont été ajoutés à la collecte.",
            'auto_add_bundles_error' => "Aucun lot n'a été trouvé...",
        ],
        'products_controller' => [],
        'truck_controller' => [],
        'user_controller' => [
            'approve_success' => "L'utilisateur :user a bien approuvé.",
            'reject_success' => "L'utilisateur :user a bien rejeté.",
        ],
        'warehouse_controller' => [],
    ],
    'login_controller' => [
        'logout_success' => "Déconnexion faite avec succès.",
    ],
    'register_controller' => [
        'address_not_real' => "L'adresse entrée ne semble être réelle.",
        'register_success' => "Inscription réussie !",
    ],
    'bundle_controller' => [
        'access_forbidden' => "Accès refusé : vous n'êtes autorisé à voir ce lot.",
        'destroy_error' => "Une erreur s'est produite lors de la suppression de ce lot.",
        'destroy_success' => "Le lot a bien été supprimé.",
    ],
    'delivery_request_controller' => [
        'access_forbidden' => "Accès refusé : vous n'êtes autorisé à voir cette demande de distribution.",
        'store_success' => "La demande de distribution a bien été créée !",
        'store_error' => "La demande de distribution a déjà été ouverte.",
        'destroy_success' => "La demande de distribution a bien été annulée.",
        'destroy_error' => "La demande de distribution ne peut pas être annulée.",
    ],
    'product_controller' => [
        'destroy_success' => "Le produit a bien été supprimé.",
        'destroy_error' => "Le produit n'a pas pu être supprimé.",
        'add_to_delivery_request_success' => "Le produit a bien été ajouté à la demande de distribution.",
        'remove_from_delivery_request_success' => "Le produit a bien été été supprimé de la demande de distribution.",
    ],
];
