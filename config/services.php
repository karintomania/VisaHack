<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'notion' => [
        'base_url' => env('NOTION_BASE_URL'),
        'api_key' => env('NOTION_API_KEY'),
        'api_version' => env('NOTION_API_VERSIOIN'),
        'database_id' => env('NOTION_DATABASE_ID'),
        'database_query_url' => sprintf(
            '%s/databases/%s/query',
            env('NOTION_BASE_URL'),
            env('NOTION_DATABASE_ID'),
        ),
        'get_page_url' => env('NOTION_BASE_URL').'/blocks/%s/children',
    ],

];
