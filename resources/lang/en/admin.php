<?php

return [

    'index' => [
        'admin' => 'Admin',
        'message_donation' => 'Click a link below to manage donations.',
        'bundles' => 'Bundles',
        'products' => 'Products',
        'collection_rounds' => 'Collection rounds',
        'delivery_rounds' => 'Delivery Rounds',
        'delivery_requests' => 'Delivery Requests',
        'trucks' => 'Trucks',
        'warehouses' => 'Warehouses',
        'categories' => 'Categories',
        'users' => 'Users',
    ],
    'singular' => [
        'bundle' => 'Bundle',
        'product' => 'Product',
        'collection_round' => 'Collection round',
        'delivery_round' => 'Delivery Round',
        'delivery_request' => 'Delivery Request',
        'truck' => 'Truck',
        'warehouse' => 'Warehouse',
        'category' => 'Category',
        'user' => 'User',
        'donor' => 'Donor',
        'storekeeper' => 'Storekeeper',
        'needy_person' => 'Needy Person',
        'type' => 'Type',
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
            'action' => 'Action',
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
    'delivery_requests' => [
        'delivery_request' => "Delivery request",
        'donor' => 'Donor',
        'statuses' => [
            'rejected' => "rejected",
            'waiting_approval' => "Waiting approval",
            'approved' => "Approved",
            'being_delivered' => "Being delivered",
            'delivered' => "Delivered",
            'unknown' => "Unknown",
        ],
        'columns' => [
            'status' => "Status",
            'submission_date' => "Submission date",
            'number_of_products' => "Number of products",
            'weight' => "Weight",
            'requester' => "Requester",
            'city' => "City",
            'address' => "Address",
            'action' => 'Action',
        ],
        'add_message' => "Add delivery request to delivery round",
        'show_all_message' => "Show all available delivery requests",
        'show_closest_message' => "Show closest delivery requests",
        'no_delivery_request' => "You haven't made any delivery request yet.",
        'no_bundle_message' => "There is no bundle in the database.",
        'no_available' => "There is no available delivery request. \nEither there isn't any approved delivery request not assigned to a delivery round, or there isn't enough free weight left in this delivery round.",
        'delivery_request_detail' => "This delivery request contains :count products for a total of :weight kg.",
    ],
    'delivery_rounds' => [
        'delivery_round' => "Delivery round",
        'warehouse' => 'Warehouse',
        'select_warehouse' => 'Select a warehouse',
        'create_new_delivery_round' => "Create new delivery round",
        'new_delivery_round' => "New delivery round",
        'statuses' => [
            'not_ready' => "Not ready",
            'ready' => "Ready",
            'in_progress' => "In progress",
            'done' => "Done",
            'unknown' => "Unknown"
        ],
        'columns' => [
            'status' => 'Status',
            'warehouse' => "Warehouse",
            'submission_date' => "Submission date",
            'creation_date' => "Creation date",
            'number_of_delivery_requests' => "Number of delivery requests",
            'number_of_products' => "Number of products",
            'requester' => "Requester",
            'weight' => "Weight",
            'address' => "Address",
            'action' => "Action",
        ],
        'no_delivery_round_message' => "There is no delivery round in the database.",
        'no_delivery_request_message' => "There is no delivery request in this delivery round.",
        'delivery_round_detail' => "This delivery round contains :count delivery requests for a total of :weight It is attached to the :name warehouse.",
        'no_delivery_round_with_truck' => "The delivery round is currently ongoing with truck",
        'auto_add_delivery_requests' => "Automatically add delivery requests",
    ],
    'trucks' => [
        'create_new_truck' => 'Create new truck',
        'new_truck' => "New truck",
        'edit_truck' => "Edit truck",
        'columns' => [
            'warehouse' => 'Warehouse',
            'capacity' => 'Capacity',
            'status' => 'Status',
            'collection_round' => 'Collection Round',
            'action' => "Action",
        ],
        'statuses' => [
            'available' => 'Available',
            'ongoing' => 'Ongoing',
            'none' => 'None',
        ],
        'no_truck_message' => 'There is no truck in the database.',
    ],
    'warehouses' => [
        'edit_warehouse' => "Edit warehouse",
        'new_warehouse' => "New warehouse",
        'create_new_warehouse' => 'Create new warehouse',
        'new_warehouse_button' => "New warehouse",
        'columns' => [
            'name' => 'Name',
            'address' => 'Address',
            'number_of_shelves' => 'Number of shelves',
            'used_weight' => 'Used weight',
            'action' => "Action",
        ],
        'no_warehouse_message' => 'There is no warehouse registered in the database.',
    ],
    'categories' => [
        'no_category_message' => 'There is no category in the database.',
    ],
    'needy_people' => [
        'unapproved_needy_people' => "Unapproved needy people",
        'application_file' => "Application file",
        'no_needy_person_message' => "There is no needy person waiting for approval.",
    ]
];
