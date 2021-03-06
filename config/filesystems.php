<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            // 'root' => storage_path('app/public'),
            // 'url' => env('APP_URL').'/storage',
            // 'root'   => public_path() . '/uploads',
            'root'   => '../httpdocs/uploads',
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
        ],

    	 'articles' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/articles',
            'url' => env('APP_URL').'/public/articles',
            'visibility' => 'public',
        ],


        'photos' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/photos',
            'url' => env('APP_URL').'/public/photos',
            'visibility' => 'public',
        ],

        'photos_compressed' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/photos/compressed',
            'url' => env('APP_URL').'/public/photos/compressed',
            'visibility' => 'public',
        ],


    	 'videos' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/videos',
            'url' => env('APP_URL').'/public/videos',
            'visibility' => 'public',
        ],

    	'previews' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/videos/previews',
            'url' => env('APP_URL').'/public/videos/previews',
            'visibility' => 'public',
        ],

   		 'thumbs' => [
            'driver' => 'local',
            'root'   => '../httpdocs/uploads/videos/thumbs',
            'url' => env('APP_URL').'/public/videos/thumbs',
            'visibility' => 'public',
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
