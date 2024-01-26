<?php

declare(strict_types=1);

return [
    'actions' => [
        'show'      => 'show',
        'edit'      => 'edit',
        'save'      => 'save',
        'delete'    => 'delete',
        'create'    => 'create',
        'duplicate' => 'duplicate',
    ],

    'actions_model' => [
        'show'      => 'Show this :model',
        'edit'      => 'Edit this :model',
        'save'      => 'Save this :model',
        'delete'    => 'Delete this :model',
        'create'    => 'Create a new :model',
        'duplicate' => 'Duplicate this :model',
        'list_all'  => 'List all :model',
    ],

    'messages'   => [
        'has_been_created'                => ':model has been created',
        'cannot_be_created'               => ':model cannot be created',
        'has_been_updated'                => ':model has been updated',
        'cannot_be_updated'               => ':model cannot be updated',
        'has_been_deleted'                => ':model has been deleted',
        'cannot_be_deleted_with_children' => ':model cannot be deleted with children',
        'cannot_event_on_model'           => 'Impossible to :event a new :model|Impossible to :event a new :model',
        'order_changed'                   => 'The order has been changed !',
        'order_not_changed'               => 'The order hasn\'t been changed !',
        'publish_status_saved'            => 'Change of publication status successful !',
        'right'                           => 'You don\'t have the rights to access this part !',
        'theme_updated'                   => 'The theme has been updated !',
        'lang_updated'                    => 'The lang has been updated !',
    ],

    'search' => [
        'keywords'      => 'Your keywords here...',
        'apply_search'  => 'Apply a search',
        'remove_search' => 'Remove the search'
    ],

    'filter' => [
        'sort_ascending'  => 'Sort :name in ascending order',
        'sort_descending' => 'Sort :name in descending order',
        'sort_delete'     => 'Delete sorting',
        'sort_arrow'      => 'Here, the arrows are used to sort and not to filter',
    ],

    'sweetalert' => [
        'confirm'      => 'Confirm',
        'cancel'       => 'Cancel',
        'are_you_sure' => 'Are you sure ?',
        'data_lost'    => 'All data will be lost.',
    ],

    'meta' => [
        'all_models'          => 'All :model',
        'all_models_list'     => 'Listing of all :model.',
        'creation_model'      => 'Creating a :model',
        'creation_model_desc' => 'Form for entering information to create a new :model',
        'edition_model'       => 'Editing a :model',
        'edition_model_desc'  => 'Editing information of a previously saved :model',
    ],

    'other' => [
        'no_model_found'  => 'No :model found',
        'up'              => 'Change the order of appearance upwards',
        'down'            => 'Change the order of appearance downwards',
        'user-right'      => 'You do not have the rights',
        'publish'         => 'Publish',
        'unpublish'       => 'Unpublish',
        'required_fields' => '* Required fields',
    ],
];
