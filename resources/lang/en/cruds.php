<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'brand' => [
        'title'          => 'Brand',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'medicinesCategory' => [
        'title'          => 'Medicines Categories',
        'title_singular' => 'Medicines Category',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'image'                  => 'Image',
            'image_helper'           => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'parent_category'        => 'Parent Category',
            'parent_category_helper' => ' ',
        ],
    ],
    'medicine' => [
        'title'          => 'Medicines',
        'title_singular' => 'Medicine',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'in_stock'           => 'In Stock',
            'in_stock_helper'    => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'expiry_date'        => 'Expiry Date',
            'expiry_date_helper' => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'pharmacy'           => 'Pharmacy',
            'pharmacy_helper'    => ' ',
            'brand'              => 'Brand',
            'brand_helper'       => ' ',
        ],
    ],
    'customerDetail' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'city'              => 'City',
            'city_helper'       => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'customer'          => 'Customer',
            'customer_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'province'          => 'Province',
            'province_helper'   => ' ',
        ],
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'customer'          => 'Customer',
            'customer_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'pharmacy'          => 'Pharmacy',
            'pharmacy_helper'   => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'pharmacy' => [
        'title'          => 'Pharmacies',
        'title_singular' => 'Pharmacy',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'address'             => 'Address',
            'address_helper'      => ' ',
            'phone'               => 'Phone',
            'phone_helper'        => ' ',
            'opening_time'        => 'Opening Time',
            'opening_time_helper' => ' ',
            'closing_time'        => 'Closing Time',
            'closing_time_helper' => ' ',
            'owner'               => 'Owner',
            'owner_helper'        => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'longitude'           => 'Longitude',
            'longitude_helper'    => ' ',
            'latitude'            => 'Latitude',
            'latitude_helper'     => ' ',
        ],
    ],
    'covidPost' => [
        'title'          => 'Covid Post',
        'title_singular' => 'Covid Post',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'excerpt'           => 'Excerpt',
            'excerpt_helper'    => ' ',
            'detail'            => 'Detail',
            'detail_helper'     => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'pharmacyMedicine' => [
        'title'          => 'Medicines',
        'title_singular' => 'Medicine',
    ],
    'pharmacyCustomer' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
    ],
    'pharmacyOrder' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
    ],
];
