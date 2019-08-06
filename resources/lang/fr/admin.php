<?php

return [

    'index' => [
        'admin' => 'Admin',
        'message_donation' => 'Click a link below to manage donations.',
        'bundles' => 'Bundles',
        'products' => 'Products',
        'collection_rounds' => 'Collection rounds',
        'delivery_rounds' => 'Delivery Rounds',
        'trucks' => 'Trucks',
        'warehouses' => 'Warehouses',
        'categories' => 'Categories',
        'users' => 'Users',
    ],
    'bundles' => [
        'columns' => [
            'status' => 'Status',
            'submission_date' => 'Submission date',
            'number_of_products' => 'Number of products',
            'weight' => 'Weight',
            'donor' => 'Donor',
            'address' => 'Address',
            'action' => 'Action',
        ],
        'no_bundle_message' => 'There is no bundle in the database.',
    ],
    'products' => [
        'bundle' => 'Bundle',
        'bundle_detail' => 'This bundle contains :count products for a total of :weight kg.',
        'columns' => [
            'barcode' => 'Barcode',
            'name' => 'Name',
            'expiration_date' => 'Expiration Date',
            'quantity' => 'Quantity',
            'weight' => 'Weight',
            'shelf' => 'Shelf',
            'remove' => 'Remove',
        ],
        'no_product_message' => 'There is no product in this bundle.',
    ],
    'collection_rounds' => [
        'collection_round' => 'Collection round',
        'warehouse' => 'Warehouse',
        'create_new_collection_round' => 'Create new collection round',
        'select_warehouse' => 'Select a warehouse',
        'new_collection_round_button' => 'New collection round',
        'columns' => [
            'status' => 'Status',
            'warehouse' => 'Warehouse',
            'creation_date' => 'Creation Date',
            'number_of_bundles' => 'Number of bundles',
            'weight' => 'Weight',
            'action' => 'Action',
        ],
        'no_collection_round_message' => 'There is no collection round in the database.',
        'collection_round_detail' => 'This collection round contains :count bundles for a total of :weight kg. It is attached to the :name warehouse.',
        'on_going_truck' => 'The collection round is currently ongoing with truck #:truck.',
        'auto_add_bundles' => 'Automatically add bundles',
        'actions' => [
            'close' => 'Close',
            'start_collect' => 'Start collect',
            'reopen' => 'Reopen',
            'terminate_collect' => 'Terminate collect (store products)',
        ],
        'map' => 'Map',
        'no_bundle_message' => 'There is no bundle in this collection round.',
    ],
    'trucks' => [
        'columns' => [
            'warehouse' => 'Warehouse',
            'capacity' => 'Capacity',
            'status' => 'Status',
            'collection_round' => 'Collection Round',
        ],
        'statuses' => [
            'available' => 'Available',
            'ongoing' => 'Ongoing',
            'none' => 'None',
        ],
        'no_truck_message' => 'There is no truck in the database.',
    ],
    'warehouses' => [
        'columns' => [
            'name' => 'Name',
            'address' => 'Address',
            'number_of_shelves' => 'Number of shelves',
            'used_weight' => 'Used weight',
        ],
        'no_warehouse_message' => 'There is no warehouse registered in the database.',
    ],
    'categories' => [
        'no_category_message' => 'There is no category in the database.',
    ],
];
