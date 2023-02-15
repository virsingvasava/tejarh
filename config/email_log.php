<?php

return [
    'disk' => env('EMAIL_LOG_ATTACHMENT_DISK','email_log_attachments'),
    'access_middleware' => env('EMAIL_LOG_ACCESS_MIDDLEWARE',null),
    'routes_prefix' => env('EMAIL_LOG_ROUTES_PREFIX',''),
    'routes_webhook_prefix' => env('EMAIL_LOG_ROUTES_WEBHOOK_PREFIX', env('EMAIL_LOG_ROUTES_PREFIX','')),
    'mailgun' => [
        'secret' => env('MAILGUN_SECRET', null),
        'filter_unknown_emails' => env('EMAIL_LOG_MAILGUN_FILTER_UNKNOWN_EMAILS', true),
    ],
];
