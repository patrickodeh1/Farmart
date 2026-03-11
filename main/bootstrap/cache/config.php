<?php return array (
  0 => 'concurrency',
  3 => 'cors',
  10 => 'view',
  12 => 'broadcasting',
  14 => 'hashing',
  'app' => 
  array (
    'name' => 'Your App',
    'env' => 'production',
    'debug' => true,
    'url' => 'http://localhost',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:aupx1RSuyw8STqR4i3nxG5Xks5OGwbZN5xelUG0NVPE=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Concurrency\\ConcurrencyServiceProvider',
      6 => 'Illuminate\\Cookie\\CookieServiceProvider',
      7 => 'Illuminate\\Database\\DatabaseServiceProvider',
      8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      10 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      11 => 'Illuminate\\Hashing\\HashServiceProvider',
      12 => 'Illuminate\\Mail\\MailServiceProvider',
      13 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      14 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      15 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      16 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      17 => 'Illuminate\\Queue\\QueueServiceProvider',
      18 => 'Illuminate\\Redis\\RedisServiceProvider',
      19 => 'Illuminate\\Session\\SessionServiceProvider',
      20 => 'Illuminate\\Translation\\TranslationServiceProvider',
      21 => 'Illuminate\\Validation\\ValidationServiceProvider',
      22 => 'Illuminate\\View\\ViewServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Concurrency' => 'Illuminate\\Support\\Facades\\Concurrency',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Uri' => 'Illuminate\\Support\\Uri',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'ADMIN_DIR',
        2 => 'DB_DATABASE',
        3 => 'DB_USERNAME',
        4 => 'DB_PASSWORD',
        5 => 'REDIS_PASSWORD',
        6 => 'MAIL_PASSWORD',
        7 => 'PUSHER_APP_KEY',
        8 => 'PUSHER_APP_SECRET',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'ADMIN_DIR',
        2 => 'DB_DATABASE',
        3 => 'DB_USERNAME',
        4 => 'DB_PASSWORD',
        5 => 'REDIS_PASSWORD',
        6 => 'MAIL_PASSWORD',
        7 => 'PUSHER_APP_KEY',
        8 => 'PUSHER_APP_SECRET',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
      'customer' => 
      array (
        'driver' => 'session',
        'provider' => 'customers',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Botble\\ACL\\Models\\User',
      ),
      'customers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Botble\\Ecommerce\\Models\\Customer',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
      'customers' => 
      array (
        'provider' => 'customers',
        'table' => 'ec_customer_password_resets',
        'expire' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'cache',
        'lock_connection' => NULL,
        'lock_table' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/html/storage/framework/cache/data',
        'lock_path' => '/var/www/html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'your_app_cache_',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'farmart',
        'prefix' => '',
        'foreign_key_constraints' => true,
        'busy_timeout' => NULL,
        'journal_mode' => NULL,
        'synchronous' => NULL,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'mysql',
        'port' => '3306',
        'database' => 'farmart',
        'username' => 'root',
        'password' => 'root',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => 'mysql',
        'port' => '3306',
        'database' => 'farmart',
        'username' => 'root',
        'password' => 'root',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'mysql',
        'port' => '3306',
        'database' => 'farmart',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'mysql',
        'port' => '3306',
        'database' => 'farmart',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'your_app_database_',
        'persistent' => false,
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/app',
        'serve' => true,
        'throw' => false,
        'report' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/public/storage',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
        'throw' => true,
        'report' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
        'report' => false,
      ),
      'fcache' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/html/storage/framework/cache/data',
      ),
    ),
    'links' => 
    array (
      '/var/www/html/public/storage' => '/var/www/html/storage/app/public',
    ),
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'deprecations' => 
    array (
      'channel' => 'null',
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/html/storage/logs/laravel.log',
      ),
      'shippo' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/html/storage/logs/shippo.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'log',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'scheme' => NULL,
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => 2525,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'local_domain' => 'localhost',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/html/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => NULL,
        'secret' => NULL,
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'batching' => 
    array (
      'database' => 'mysql',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'botble_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
  ),
  'concurrency' => 
  array (
    'default' => 'process',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/html/resources/views',
    ),
    'compiled' => '/var/www/html/storage/framework/views',
  ),
  'broadcasting' => 
  array (
    'default' => 'null',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'host' => 'api-mt1.pusher.com',
          'port' => 443,
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 12,
      'verify' => true,
      'limit' => NULL,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => '/var/www/html/public',
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => '/var/www/html/storage/fonts',
      'font_cache' => '/var/www/html/storage/fonts',
      'temp_dir' => '/tmp',
      'chroot' => '/var/www/html',
      'allowed_protocols' => 
      array (
        'data://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'artifactPathValidation' => NULL,
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => false,
      'allowed_remote_hosts' => NULL,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'scribe' => 
  array (
    'routes' => 
    array (
      0 => 
      array (
        'match' => 
        array (
          'prefixes' => 
          array (
            0 => 'api/*',
          ),
          'domains' => 
          array (
            0 => '*',
          ),
        ),
        'include' => 
        array (
        ),
        'exclude' => 
        array (
        ),
      ),
    ),
    'type' => 'static',
    'assets_directory' => 'vendor/core/packages/api',
  ),
  'laravel-form-builder' => 
  array (
    'defaults' => 
    array (
      'wrapper_class' => 'form-group',
      'wrapper_error_class' => 'has-error',
      'label_class' => 'control-label',
      'field_class' => 'form-control',
      'field_error_class' => '',
      'help_block_class' => 'help-block',
      'error_class' => 'text-danger',
      'required_class' => 'required',
      'help_block_tag' => 'p',
    ),
    'form' => 'laravel-form-builder::form',
    'text' => 'laravel-form-builder::text',
    'textarea' => 'laravel-form-builder::textarea',
    'button' => 'laravel-form-builder::button',
    'buttongroup' => 'laravel-form-builder::buttongroup',
    'radio' => 'laravel-form-builder::radio',
    'checkbox' => 'laravel-form-builder::checkbox',
    'select' => 'laravel-form-builder::select',
    'choice' => 'laravel-form-builder::choice',
    'repeated' => 'laravel-form-builder::repeated',
    'child_form' => 'laravel-form-builder::child_form',
    'collection' => 'laravel-form-builder::collection',
    'static' => 'laravel-form-builder::static',
    'template_prefix' => '',
    'default_namespace' => '',
    'custom_fields' => 
    array (
    ),
    'plain_form_class' => 'Botble\\Base\\Forms\\Form',
    'form_builder_class' => 'Botble\\Base\\Forms\\FormBuilder',
    'form_helper_class' => 'Botble\\Base\\Forms\\FormHelper',
    'defaults.wrapper_class' => 'mb-3 position-relative',
    'defaults.label_class' => 'form-label',
    'defaults.field_error_class' => 'is-invalid',
    'defaults.help_block_class' => 'form-hint',
    'defaults.error_class' => 'invalid-feedback',
    'defaults.help_block_tag' => 'small',
    'defaults.select' => 
    array (
      'field_class' => 'form-select',
    ),
  ),
  'core' => 
  array (
    'base' => 
    array (
      'general' => 
      array (
        'admin_dir' => 'admin',
        'base_name' => 'Your App',
        'logo' => '/vendor/core/core/base/images/logo.png',
        'favicon' => '/vendor/core/core/base/images/favicon.png',
        'editor' => 
        array (
          'ckeditor' => 
          array (
            'js' => 
            array (
              0 => '/vendor/core/core/base/libraries/ckeditor/ckeditor.js',
            ),
          ),
          'tinymce' => 
          array (
            'js' => 
            array (
              0 => '/vendor/core/core/base/libraries/tinymce/tinymce.min.js',
            ),
          ),
          'primary' => 'ckeditor',
        ),
        'error_reporting' => 
        array (
          'to' => NULL,
          'via_slack' => false,
          'ignored_bots' => 
          array (
            0 => 'googlebot',
            1 => 'bingbot',
            2 => 'slurp',
            3 => 'ia_archiver',
          ),
        ),
        'enable_https_support' => false,
        'force_root_url' => NULL,
        'force_schema' => NULL,
        'max_execution_time' => 300,
        'memory_limit' => NULL,
        'date_format' => 
        array (
          'date' => 'Y-m-d',
          'date_time' => 'Y-m-d H:i:s',
          'js' => 
          array (
            'date' => 'yyyy-mm-dd',
            'date_time' => 'yyyy-mm-dd H:i:s',
          ),
        ),
        'locale' => 'en',
        'demo' => 
        array (
          'account' => 
          array (
            'username' => 'admin',
            'password' => '12345678',
          ),
        ),
        'google_fonts' => 
        array (
          0 => '42dot Sans',
          1 => 'ABeeZee',
          2 => 'ADLaM Display',
          3 => 'AR One Sans',
          4 => 'Abel',
          5 => 'Abhaya Libre',
          6 => 'Aboreto',
          7 => 'Abril Fatface',
          8 => 'Abyssinica SIL',
          9 => 'Aclonica',
          10 => 'Acme',
          11 => 'Actor',
          12 => 'Adamina',
          13 => 'Advent Pro',
          14 => 'Afacad',
          15 => 'Afacad Flux',
          16 => 'Agbalumo',
          17 => 'Agdasima',
          18 => 'Agu Display',
          19 => 'Aguafina Script',
          20 => 'Akatab',
          21 => 'Akaya Kanadaka',
          22 => 'Akaya Telivigala',
          23 => 'Akronim',
          24 => 'Akshar',
          25 => 'Aladin',
          26 => 'Alata',
          27 => 'Alatsi',
          28 => 'Albert Sans',
          29 => 'Aldrich',
          30 => 'Alef',
          31 => 'Alegreya',
          32 => 'Alegreya SC',
          33 => 'Alegreya Sans',
          34 => 'Alegreya Sans SC',
          35 => 'Aleo',
          36 => 'Alex Brush',
          37 => 'Alexandria',
          38 => 'Alfa Slab One',
          39 => 'Alice',
          40 => 'Alike',
          41 => 'Alike Angular',
          42 => 'Alkalami',
          43 => 'Alkatra',
          44 => 'Allan',
          45 => 'Allerta',
          46 => 'Allerta Stencil',
          47 => 'Allison',
          48 => 'Allura',
          49 => 'Almarai',
          50 => 'Almendra',
          51 => 'Almendra Display',
          52 => 'Almendra SC',
          53 => 'Alumni Sans',
          54 => 'Alumni Sans Collegiate One',
          55 => 'Alumni Sans Inline One',
          56 => 'Alumni Sans Pinstripe',
          57 => 'Amarante',
          58 => 'Amaranth',
          59 => 'Amatic SC',
          60 => 'Amethysta',
          61 => 'Amiko',
          62 => 'Amiri',
          63 => 'Amiri Quran',
          64 => 'Amita',
          65 => 'Anaheim',
          66 => 'Andada Pro',
          67 => 'Andika',
          68 => 'Anek Bangla',
          69 => 'Anek Devanagari',
          70 => 'Anek Gujarati',
          71 => 'Anek Gurmukhi',
          72 => 'Anek Kannada',
          73 => 'Anek Latin',
          74 => 'Anek Malayalam',
          75 => 'Anek Odia',
          76 => 'Anek Tamil',
          77 => 'Anek Telugu',
          78 => 'Angkor',
          79 => 'Annapurna SIL',
          80 => 'Annie Use Your Telescope',
          81 => 'Anonymous Pro',
          82 => 'Anta',
          83 => 'Antic',
          84 => 'Antic Didone',
          85 => 'Antic Slab',
          86 => 'Anton',
          87 => 'Anton SC',
          88 => 'Antonio',
          89 => 'Anuphan',
          90 => 'Anybody',
          91 => 'Aoboshi One',
          92 => 'Arapey',
          93 => 'Arbutus',
          94 => 'Arbutus Slab',
          95 => 'Architects Daughter',
          96 => 'Archivo',
          97 => 'Archivo Black',
          98 => 'Archivo Narrow',
          99 => 'Are You Serious',
          100 => 'Aref Ruqaa',
          101 => 'Aref Ruqaa Ink',
          102 => 'Arima',
          103 => 'Arimo',
          104 => 'Arizonia',
          105 => 'Armata',
          106 => 'Arsenal',
          107 => 'Arsenal SC',
          108 => 'Artifika',
          109 => 'Arvo',
          110 => 'Arya',
          111 => 'Asap',
          112 => 'Asap Condensed',
          113 => 'Asar',
          114 => 'Asset',
          115 => 'Assistant',
          116 => 'Astloch',
          117 => 'Asul',
          118 => 'Athiti',
          119 => 'Atkinson Hyperlegible',
          120 => 'Atkinson Hyperlegible Mono',
          121 => 'Atkinson Hyperlegible Next',
          122 => 'Atma',
          123 => 'Atomic Age',
          124 => 'Aubrey',
          125 => 'Audiowide',
          126 => 'Autour One',
          127 => 'Average',
          128 => 'Average Sans',
          129 => 'Averia Gruesa Libre',
          130 => 'Averia Libre',
          131 => 'Averia Sans Libre',
          132 => 'Averia Serif Libre',
          133 => 'Azeret Mono',
          134 => 'B612',
          135 => 'B612 Mono',
          136 => 'BIZ UDGothic',
          137 => 'BIZ UDMincho',
          138 => 'BIZ UDPGothic',
          139 => 'BIZ UDPMincho',
          140 => 'Babylonica',
          141 => 'Bacasime Antique',
          142 => 'Bad Script',
          143 => 'Badeen Display',
          144 => 'Bagel Fat One',
          145 => 'Bahiana',
          146 => 'Bahianita',
          147 => 'Bai Jamjuree',
          148 => 'Bakbak One',
          149 => 'Ballet',
          150 => 'Baloo 2',
          151 => 'Baloo Bhai 2',
          152 => 'Baloo Bhaijaan 2',
          153 => 'Baloo Bhaina 2',
          154 => 'Baloo Chettan 2',
          155 => 'Baloo Da 2',
          156 => 'Baloo Paaji 2',
          157 => 'Baloo Tamma 2',
          158 => 'Baloo Tammudu 2',
          159 => 'Baloo Thambi 2',
          160 => 'Balsamiq Sans',
          161 => 'Balthazar',
          162 => 'Bangers',
          163 => 'Barlow',
          164 => 'Barlow Condensed',
          165 => 'Barlow Semi Condensed',
          166 => 'Barriecito',
          167 => 'Barrio',
          168 => 'Basic',
          169 => 'Baskervville',
          170 => 'Baskervville SC',
          171 => 'Battambang',
          172 => 'Baumans',
          173 => 'Bayon',
          174 => 'Be Vietnam Pro',
          175 => 'Beau Rivage',
          176 => 'Bebas Neue',
          177 => 'Beiruti',
          178 => 'Belanosima',
          179 => 'Belgrano',
          180 => 'Bellefair',
          181 => 'Belleza',
          182 => 'Bellota',
          183 => 'Bellota Text',
          184 => 'BenchNine',
          185 => 'Benne',
          186 => 'Bentham',
          187 => 'Berkshire Swash',
          188 => 'Besley',
          189 => 'Beth Ellen',
          190 => 'Bevan',
          191 => 'BhuTuka Expanded One',
          192 => 'Big Shoulders',
          193 => 'Big Shoulders Inline',
          194 => 'Big Shoulders Stencil',
          195 => 'Bigelow Rules',
          196 => 'Bigshot One',
          197 => 'Bilbo',
          198 => 'Bilbo Swash Caps',
          199 => 'BioRhyme',
          200 => 'BioRhyme Expanded',
          201 => 'Birthstone',
          202 => 'Birthstone Bounce',
          203 => 'Biryani',
          204 => 'Bitter',
          205 => 'Black And White Picture',
          206 => 'Black Han Sans',
          207 => 'Black Ops One',
          208 => 'Blaka',
          209 => 'Blaka Hollow',
          210 => 'Blaka Ink',
          211 => 'Blinker',
          212 => 'Bodoni Moda',
          213 => 'Bodoni Moda SC',
          214 => 'Bokor',
          215 => 'Boldonse',
          216 => 'Bona Nova',
          217 => 'Bona Nova SC',
          218 => 'Bonbon',
          219 => 'Bonheur Royale',
          220 => 'Boogaloo',
          221 => 'Borel',
          222 => 'Bowlby One',
          223 => 'Bowlby One SC',
          224 => 'Braah One',
          225 => 'Brawler',
          226 => 'Bree Serif',
          227 => 'Bricolage Grotesque',
          228 => 'Bruno Ace',
          229 => 'Bruno Ace SC',
          230 => 'Brygada 1918',
          231 => 'Bubblegum Sans',
          232 => 'Bubbler One',
          233 => 'Buda',
          234 => 'Buenard',
          235 => 'Bungee',
          236 => 'Bungee Hairline',
          237 => 'Bungee Inline',
          238 => 'Bungee Outline',
          239 => 'Bungee Shade',
          240 => 'Bungee Spice',
          241 => 'Bungee Tint',
          242 => 'Butcherman',
          243 => 'Butterfly Kids',
          244 => 'Bytesized',
          245 => 'Cabin',
          246 => 'Cabin Condensed',
          247 => 'Cabin Sketch',
          248 => 'Cactus Classical Serif',
          249 => 'Caesar Dressing',
          250 => 'Cagliostro',
          251 => 'Cairo',
          252 => 'Cairo Play',
          253 => 'Caladea',
          254 => 'Calistoga',
          255 => 'Calligraffitti',
          256 => 'Cambay',
          257 => 'Cambo',
          258 => 'Candal',
          259 => 'Cantarell',
          260 => 'Cantata One',
          261 => 'Cantora One',
          262 => 'Caprasimo',
          263 => 'Capriola',
          264 => 'Caramel',
          265 => 'Carattere',
          266 => 'Cardo',
          267 => 'Carlito',
          268 => 'Carme',
          269 => 'Carrois Gothic',
          270 => 'Carrois Gothic SC',
          271 => 'Carter One',
          272 => 'Castoro',
          273 => 'Castoro Titling',
          274 => 'Catamaran',
          275 => 'Caudex',
          276 => 'Caveat',
          277 => 'Caveat Brush',
          278 => 'Cedarville Cursive',
          279 => 'Ceviche One',
          280 => 'Chakra Petch',
          281 => 'Changa',
          282 => 'Changa One',
          283 => 'Chango',
          284 => 'Charis SIL',
          285 => 'Charm',
          286 => 'Charmonman',
          287 => 'Chathura',
          288 => 'Chau Philomene One',
          289 => 'Chela One',
          290 => 'Chelsea Market',
          291 => 'Chenla',
          292 => 'Cherish',
          293 => 'Cherry Bomb One',
          294 => 'Cherry Cream Soda',
          295 => 'Cherry Swash',
          296 => 'Chewy',
          297 => 'Chicle',
          298 => 'Chilanka',
          299 => 'Chivo',
          300 => 'Chivo Mono',
          301 => 'Chocolate Classical Sans',
          302 => 'Chokokutai',
          303 => 'Chonburi',
          304 => 'Cinzel',
          305 => 'Cinzel Decorative',
          306 => 'Clicker Script',
          307 => 'Climate Crisis',
          308 => 'Coda',
          309 => 'Codystar',
          310 => 'Coiny',
          311 => 'Combo',
          312 => 'Comfortaa',
          313 => 'Comforter',
          314 => 'Comforter Brush',
          315 => 'Comic Neue',
          316 => 'Coming Soon',
          317 => 'Comme',
          318 => 'Commissioner',
          319 => 'Concert One',
          320 => 'Condiment',
          321 => 'Content',
          322 => 'Contrail One',
          323 => 'Convergence',
          324 => 'Cookie',
          325 => 'Copse',
          326 => 'Corben',
          327 => 'Corinthia',
          328 => 'Cormorant',
          329 => 'Cormorant Garamond',
          330 => 'Cormorant Infant',
          331 => 'Cormorant SC',
          332 => 'Cormorant Unicase',
          333 => 'Cormorant Upright',
          334 => 'Courgette',
          335 => 'Courier Prime',
          336 => 'Cousine',
          337 => 'Coustard',
          338 => 'Covered By Your Grace',
          339 => 'Crafty Girls',
          340 => 'Creepster',
          341 => 'Crete Round',
          342 => 'Crimson Pro',
          343 => 'Crimson Text',
          344 => 'Croissant One',
          345 => 'Crushed',
          346 => 'Cuprum',
          347 => 'Cute Font',
          348 => 'Cutive',
          349 => 'Cutive Mono',
          350 => 'DM Mono',
          351 => 'DM Sans',
          352 => 'DM Serif Display',
          353 => 'DM Serif Text',
          354 => 'Dai Banna SIL',
          355 => 'Damion',
          356 => 'Dancing Script',
          357 => 'Danfo',
          358 => 'Dangrek',
          359 => 'Darker Grotesque',
          360 => 'Darumadrop One',
          361 => 'David Libre',
          362 => 'Dawning of a New Day',
          363 => 'Days One',
          364 => 'Dekko',
          365 => 'Dela Gothic One',
          366 => 'Delicious Handrawn',
          367 => 'Delius',
          368 => 'Delius Swash Caps',
          369 => 'Delius Unicase',
          370 => 'Della Respira',
          371 => 'Denk One',
          372 => 'Devonshire',
          373 => 'Dhurjati',
          374 => 'Didact Gothic',
          375 => 'Diphylleia',
          376 => 'Diplomata',
          377 => 'Diplomata SC',
          378 => 'Do Hyeon',
          379 => 'Dokdo',
          380 => 'Domine',
          381 => 'Donegal One',
          382 => 'Dongle',
          383 => 'Doppio One',
          384 => 'Dorsa',
          385 => 'Dosis',
          386 => 'DotGothic16',
          387 => 'Doto',
          388 => 'Dr Sugiyama',
          389 => 'Duru Sans',
          390 => 'DynaPuff',
          391 => 'Dynalight',
          392 => 'EB Garamond',
          393 => 'Eagle Lake',
          394 => 'East Sea Dokdo',
          395 => 'Eater',
          396 => 'Economica',
          397 => 'Eczar',
          398 => 'Edu AU VIC WA NT Arrows',
          399 => 'Edu AU VIC WA NT Dots',
          400 => 'Edu AU VIC WA NT Guides',
          401 => 'Edu AU VIC WA NT Hand',
          402 => 'Edu AU VIC WA NT Pre',
          403 => 'Edu NSW ACT Foundation',
          404 => 'Edu QLD Beginner',
          405 => 'Edu SA Beginner',
          406 => 'Edu TAS Beginner',
          407 => 'Edu VIC WA NT Beginner',
          408 => 'El Messiri',
          409 => 'Electrolize',
          410 => 'Elsie',
          411 => 'Elsie Swash Caps',
          412 => 'Emblema One',
          413 => 'Emilys Candy',
          414 => 'Encode Sans',
          415 => 'Encode Sans Condensed',
          416 => 'Encode Sans Expanded',
          417 => 'Encode Sans SC',
          418 => 'Encode Sans Semi Condensed',
          419 => 'Encode Sans Semi Expanded',
          420 => 'Engagement',
          421 => 'Englebert',
          422 => 'Enriqueta',
          423 => 'Ephesis',
          424 => 'Epilogue',
          425 => 'Erica One',
          426 => 'Esteban',
          427 => 'Estonia',
          428 => 'Euphoria Script',
          429 => 'Ewert',
          430 => 'Exo',
          431 => 'Exo 2',
          432 => 'Expletus Sans',
          433 => 'Explora',
          434 => 'Faculty Glyphic',
          435 => 'Fahkwang',
          436 => 'Familjen Grotesk',
          437 => 'Fanwood Text',
          438 => 'Farro',
          439 => 'Farsan',
          440 => 'Fascinate',
          441 => 'Fascinate Inline',
          442 => 'Faster One',
          443 => 'Fasthand',
          444 => 'Fauna One',
          445 => 'Faustina',
          446 => 'Federant',
          447 => 'Federo',
          448 => 'Felipa',
          449 => 'Fenix',
          450 => 'Festive',
          451 => 'Figtree',
          452 => 'Finger Paint',
          453 => 'Finlandica',
          454 => 'Fira Code',
          455 => 'Fira Mono',
          456 => 'Fira Sans',
          457 => 'Fira Sans Condensed',
          458 => 'Fira Sans Extra Condensed',
          459 => 'Fjalla One',
          460 => 'Fjord One',
          461 => 'Flamenco',
          462 => 'Flavors',
          463 => 'Fleur De Leah',
          464 => 'Flow Block',
          465 => 'Flow Circular',
          466 => 'Flow Rounded',
          467 => 'Foldit',
          468 => 'Fondamento',
          469 => 'Fontdiner Swanky',
          470 => 'Forum',
          471 => 'Fragment Mono',
          472 => 'Francois One',
          473 => 'Frank Ruhl Libre',
          474 => 'Fraunces',
          475 => 'Freckle Face',
          476 => 'Fredericka the Great',
          477 => 'Fredoka',
          478 => 'Freehand',
          479 => 'Freeman',
          480 => 'Fresca',
          481 => 'Frijole',
          482 => 'Fruktur',
          483 => 'Fugaz One',
          484 => 'Fuggles',
          485 => 'Funnel Display',
          486 => 'Funnel Sans',
          487 => 'Fustat',
          488 => 'Fuzzy Bubbles',
          489 => 'GFS Didot',
          490 => 'GFS Neohellenic',
          491 => 'Ga Maamli',
          492 => 'Gabarito',
          493 => 'Gabriela',
          494 => 'Gaegu',
          495 => 'Gafata',
          496 => 'Gajraj One',
          497 => 'Galada',
          498 => 'Galdeano',
          499 => 'Galindo',
          500 => 'Gamja Flower',
          501 => 'Gantari',
          502 => 'Gasoek One',
          503 => 'Gayathri',
          504 => 'Geist',
          505 => 'Geist Mono',
          506 => 'Gelasio',
          507 => 'Gemunu Libre',
          508 => 'Genos',
          509 => 'Gentium Book Plus',
          510 => 'Gentium Plus',
          511 => 'Geo',
          512 => 'Geologica',
          513 => 'Georama',
          514 => 'Geostar',
          515 => 'Geostar Fill',
          516 => 'Germania One',
          517 => 'Gideon Roman',
          518 => 'Gidole',
          519 => 'Gidugu',
          520 => 'Gilda Display',
          521 => 'Girassol',
          522 => 'Give You Glory',
          523 => 'Glass Antiqua',
          524 => 'Glegoo',
          525 => 'Gloock',
          526 => 'Gloria Hallelujah',
          527 => 'Glory',
          528 => 'Gluten',
          529 => 'Goblin One',
          530 => 'Gochi Hand',
          531 => 'Goldman',
          532 => 'Golos Text',
          533 => 'Gorditas',
          534 => 'Gothic A1',
          535 => 'Gotu',
          536 => 'Goudy Bookletter 1911',
          537 => 'Gowun Batang',
          538 => 'Gowun Dodum',
          539 => 'Graduate',
          540 => 'Grand Hotel',
          541 => 'Grandiflora One',
          542 => 'Grandstander',
          543 => 'Grape Nuts',
          544 => 'Gravitas One',
          545 => 'Great Vibes',
          546 => 'Grechen Fuemen',
          547 => 'Grenze',
          548 => 'Grenze Gotisch',
          549 => 'Grey Qo',
          550 => 'Griffy',
          551 => 'Gruppo',
          552 => 'Gudea',
          553 => 'Gugi',
          554 => 'Gulzar',
          555 => 'Gupter',
          556 => 'Gurajada',
          557 => 'Gwendolyn',
          558 => 'Habibi',
          559 => 'Hachi Maru Pop',
          560 => 'Hahmlet',
          561 => 'Halant',
          562 => 'Hammersmith One',
          563 => 'Hanalei',
          564 => 'Hanalei Fill',
          565 => 'Handjet',
          566 => 'Handlee',
          567 => 'Hanken Grotesk',
          568 => 'Hanuman',
          569 => 'Happy Monkey',
          570 => 'Harmattan',
          571 => 'Headland One',
          572 => 'Hedvig Letters Sans',
          573 => 'Hedvig Letters Serif',
          574 => 'Heebo',
          575 => 'Henny Penny',
          576 => 'Hepta Slab',
          577 => 'Herr Von Muellerhoff',
          578 => 'Hi Melody',
          579 => 'Hina Mincho',
          580 => 'Hind',
          581 => 'Hind Guntur',
          582 => 'Hind Madurai',
          583 => 'Hind Mysuru',
          584 => 'Hind Siliguri',
          585 => 'Hind Vadodara',
          586 => 'Holtwood One SC',
          587 => 'Homemade Apple',
          588 => 'Homenaje',
          589 => 'Honk',
          590 => 'Host Grotesk',
          591 => 'Hubballi',
          592 => 'Hubot Sans',
          593 => 'Hurricane',
          594 => 'IBM Plex Mono',
          595 => 'IBM Plex Sans',
          596 => 'IBM Plex Sans Arabic',
          597 => 'IBM Plex Sans Condensed',
          598 => 'IBM Plex Sans Devanagari',
          599 => 'IBM Plex Sans Hebrew',
          600 => 'IBM Plex Sans JP',
          601 => 'IBM Plex Sans KR',
          602 => 'IBM Plex Sans Thai',
          603 => 'IBM Plex Sans Thai Looped',
          604 => 'IBM Plex Serif',
          605 => 'IM Fell DW Pica',
          606 => 'IM Fell DW Pica SC',
          607 => 'IM Fell Double Pica',
          608 => 'IM Fell Double Pica SC',
          609 => 'IM Fell English',
          610 => 'IM Fell English SC',
          611 => 'IM Fell French Canon',
          612 => 'IM Fell French Canon SC',
          613 => 'IM Fell Great Primer',
          614 => 'IM Fell Great Primer SC',
          615 => 'Iansui',
          616 => 'Ibarra Real Nova',
          617 => 'Iceberg',
          618 => 'Iceland',
          619 => 'Imbue',
          620 => 'Imperial Script',
          621 => 'Imprima',
          622 => 'Inclusive Sans',
          623 => 'Inconsolata',
          624 => 'Inder',
          625 => 'Indie Flower',
          626 => 'Ingrid Darling',
          627 => 'Inika',
          628 => 'Inknut Antiqua',
          629 => 'Inria Sans',
          630 => 'Inria Serif',
          631 => 'Inspiration',
          632 => 'Instrument Sans',
          633 => 'Instrument Serif',
          634 => 'Inter',
          635 => 'Inter Tight',
          636 => 'Irish Grover',
          637 => 'Island Moments',
          638 => 'Istok Web',
          639 => 'Italiana',
          640 => 'Italianno',
          641 => 'Itim',
          642 => 'Jacquard 12',
          643 => 'Jacquard 12 Charted',
          644 => 'Jacquard 24',
          645 => 'Jacquard 24 Charted',
          646 => 'Jacquarda Bastarda 9',
          647 => 'Jacquarda Bastarda 9 Charted',
          648 => 'Jacques Francois',
          649 => 'Jacques Francois Shadow',
          650 => 'Jaini',
          651 => 'Jaini Purva',
          652 => 'Jaldi',
          653 => 'Jaro',
          654 => 'Jersey 10',
          655 => 'Jersey 10 Charted',
          656 => 'Jersey 15',
          657 => 'Jersey 15 Charted',
          658 => 'Jersey 20',
          659 => 'Jersey 20 Charted',
          660 => 'Jersey 25',
          661 => 'Jersey 25 Charted',
          662 => 'JetBrains Mono',
          663 => 'Jim Nightshade',
          664 => 'Joan',
          665 => 'Jockey One',
          666 => 'Jolly Lodger',
          667 => 'Jomhuria',
          668 => 'Jomolhari',
          669 => 'Josefin Sans',
          670 => 'Josefin Slab',
          671 => 'Jost',
          672 => 'Joti One',
          673 => 'Jua',
          674 => 'Judson',
          675 => 'Julee',
          676 => 'Julius Sans One',
          677 => 'Junge',
          678 => 'Jura',
          679 => 'Just Another Hand',
          680 => 'Just Me Again Down Here',
          681 => 'K2D',
          682 => 'Kablammo',
          683 => 'Kadwa',
          684 => 'Kaisei Decol',
          685 => 'Kaisei HarunoUmi',
          686 => 'Kaisei Opti',
          687 => 'Kaisei Tokumin',
          688 => 'Kalam',
          689 => 'Kalnia',
          690 => 'Kalnia Glaze',
          691 => 'Kameron',
          692 => 'Kanit',
          693 => 'Kantumruy Pro',
          694 => 'Karantina',
          695 => 'Karla',
          696 => 'Karla Tamil Inclined',
          697 => 'Karla Tamil Upright',
          698 => 'Karma',
          699 => 'Katibeh',
          700 => 'Kaushan Script',
          701 => 'Kavivanar',
          702 => 'Kavoon',
          703 => 'Kay Pho Du',
          704 => 'Kdam Thmor Pro',
          705 => 'Keania One',
          706 => 'Kelly Slab',
          707 => 'Kenia',
          708 => 'Khand',
          709 => 'Khmer',
          710 => 'Khula',
          711 => 'Kings',
          712 => 'Kirang Haerang',
          713 => 'Kite One',
          714 => 'Kiwi Maru',
          715 => 'Klee One',
          716 => 'Knewave',
          717 => 'KoHo',
          718 => 'Kodchasan',
          719 => 'Kode Mono',
          720 => 'Koh Santepheap',
          721 => 'Kolker Brush',
          722 => 'Konkhmer Sleokchher',
          723 => 'Kosugi',
          724 => 'Kosugi Maru',
          725 => 'Kotta One',
          726 => 'Koulen',
          727 => 'Kranky',
          728 => 'Kreon',
          729 => 'Kristi',
          730 => 'Krona One',
          731 => 'Krub',
          732 => 'Kufam',
          733 => 'Kulim Park',
          734 => 'Kumar One',
          735 => 'Kumar One Outline',
          736 => 'Kumbh Sans',
          737 => 'Kurale',
          738 => 'LXGW WenKai Mono TC',
          739 => 'LXGW WenKai TC',
          740 => 'La Belle Aurore',
          741 => 'Labrada',
          742 => 'Lacquer',
          743 => 'Laila',
          744 => 'Lakki Reddy',
          745 => 'Lalezar',
          746 => 'Lancelot',
          747 => 'Langar',
          748 => 'Lateef',
          749 => 'Lato',
          750 => 'Lavishly Yours',
          751 => 'League Gothic',
          752 => 'League Script',
          753 => 'League Spartan',
          754 => 'Leckerli One',
          755 => 'Ledger',
          756 => 'Lekton',
          757 => 'Lemon',
          758 => 'Lemonada',
          759 => 'Lexend',
          760 => 'Lexend Deca',
          761 => 'Lexend Exa',
          762 => 'Lexend Giga',
          763 => 'Lexend Mega',
          764 => 'Lexend Peta',
          765 => 'Lexend Tera',
          766 => 'Lexend Zetta',
          767 => 'Libre Barcode 128',
          768 => 'Libre Barcode 128 Text',
          769 => 'Libre Barcode 39',
          770 => 'Libre Barcode 39 Extended',
          771 => 'Libre Barcode 39 Extended Text',
          772 => 'Libre Barcode 39 Text',
          773 => 'Libre Barcode EAN13 Text',
          774 => 'Libre Baskerville',
          775 => 'Libre Bodoni',
          776 => 'Libre Caslon Display',
          777 => 'Libre Caslon Text',
          778 => 'Libre Franklin',
          779 => 'Licorice',
          780 => 'Life Savers',
          781 => 'Lilita One',
          782 => 'Lily Script One',
          783 => 'Limelight',
          784 => 'Linden Hill',
          785 => 'Linefont',
          786 => 'Lisu Bosa',
          787 => 'Liter',
          788 => 'Literata',
          789 => 'Liu Jian Mao Cao',
          790 => 'Livvic',
          791 => 'Lobster',
          792 => 'Lobster Two',
          793 => 'Londrina Outline',
          794 => 'Londrina Shadow',
          795 => 'Londrina Sketch',
          796 => 'Londrina Solid',
          797 => 'Long Cang',
          798 => 'Lora',
          799 => 'Love Light',
          800 => 'Love Ya Like A Sister',
          801 => 'Loved by the King',
          802 => 'Lovers Quarrel',
          803 => 'Luckiest Guy',
          804 => 'Lugrasimo',
          805 => 'Lumanosimo',
          806 => 'Lunasima',
          807 => 'Lusitana',
          808 => 'Lustria',
          809 => 'Luxurious Roman',
          810 => 'Luxurious Script',
          811 => 'M PLUS 1',
          812 => 'M PLUS 1 Code',
          813 => 'M PLUS 1p',
          814 => 'M PLUS 2',
          815 => 'M PLUS Code Latin',
          816 => 'M PLUS Rounded 1c',
          817 => 'Ma Shan Zheng',
          818 => 'Macondo',
          819 => 'Macondo Swash Caps',
          820 => 'Mada',
          821 => 'Madimi One',
          822 => 'Magra',
          823 => 'Maiden Orange',
          824 => 'Maitree',
          825 => 'Major Mono Display',
          826 => 'Mako',
          827 => 'Mali',
          828 => 'Mallanna',
          829 => 'Maname',
          830 => 'Mandali',
          831 => 'Manjari',
          832 => 'Manrope',
          833 => 'Mansalva',
          834 => 'Manuale',
          835 => 'Marcellus',
          836 => 'Marcellus SC',
          837 => 'Marck Script',
          838 => 'Margarine',
          839 => 'Marhey',
          840 => 'Markazi Text',
          841 => 'Marko One',
          842 => 'Marmelad',
          843 => 'Martel',
          844 => 'Martel Sans',
          845 => 'Martian Mono',
          846 => 'Marvel',
          847 => 'Mate',
          848 => 'Mate SC',
          849 => 'Matemasie',
          850 => 'Material Icons',
          851 => 'Material Icons Outlined',
          852 => 'Material Icons Round',
          853 => 'Material Icons Sharp',
          854 => 'Material Icons Two Tone',
          855 => 'Material Symbols',
          856 => 'Material Symbols Outlined',
          857 => 'Material Symbols Rounded',
          858 => 'Material Symbols Sharp',
          859 => 'Maven Pro',
          860 => 'McLaren',
          861 => 'Mea Culpa',
          862 => 'Meddon',
          863 => 'MedievalSharp',
          864 => 'Medula One',
          865 => 'Meera Inimai',
          866 => 'Megrim',
          867 => 'Meie Script',
          868 => 'Meow Script',
          869 => 'Merienda',
          870 => 'Merriweather',
          871 => 'Merriweather Sans',
          872 => 'Metal',
          873 => 'Metal Mania',
          874 => 'Metamorphous',
          875 => 'Metrophobic',
          876 => 'Michroma',
          877 => 'Micro 5',
          878 => 'Micro 5 Charted',
          879 => 'Milonga',
          880 => 'Miltonian',
          881 => 'Miltonian Tattoo',
          882 => 'Mina',
          883 => 'Mingzat',
          884 => 'Miniver',
          885 => 'Miriam Libre',
          886 => 'Mirza',
          887 => 'Miss Fajardose',
          888 => 'Mitr',
          889 => 'Mochiy Pop One',
          890 => 'Mochiy Pop P One',
          891 => 'Modak',
          892 => 'Modern Antiqua',
          893 => 'Moderustic',
          894 => 'Mogra',
          895 => 'Mohave',
          896 => 'Moirai One',
          897 => 'Molengo',
          898 => 'Molle',
          899 => 'Mona Sans',
          900 => 'Monda',
          901 => 'Monofett',
          902 => 'Monomakh',
          903 => 'Monomaniac One',
          904 => 'Monoton',
          905 => 'Monsieur La Doulaise',
          906 => 'Montaga',
          907 => 'Montagu Slab',
          908 => 'MonteCarlo',
          909 => 'Montez',
          910 => 'Montserrat',
          911 => 'Montserrat Alternates',
          912 => 'Montserrat Underline',
          913 => 'Moo Lah Lah',
          914 => 'Mooli',
          915 => 'Moon Dance',
          916 => 'Moul',
          917 => 'Moulpali',
          918 => 'Mountains of Christmas',
          919 => 'Mouse Memoirs',
          920 => 'Mr Bedfort',
          921 => 'Mr Dafoe',
          922 => 'Mr De Haviland',
          923 => 'Mrs Saint Delafield',
          924 => 'Mrs Sheppards',
          925 => 'Ms Madi',
          926 => 'Mukta',
          927 => 'Mukta Mahee',
          928 => 'Mukta Malar',
          929 => 'Mukta Vaani',
          930 => 'Mulish',
          931 => 'Murecho',
          932 => 'MuseoModerno',
          933 => 'My Soul',
          934 => 'Mynerve',
          935 => 'Mystery Quest',
          936 => 'NTR',
          937 => 'Nabla',
          938 => 'Namdhinggo',
          939 => 'Nanum Brush Script',
          940 => 'Nanum Gothic',
          941 => 'Nanum Gothic Coding',
          942 => 'Nanum Myeongjo',
          943 => 'Nanum Pen Script',
          944 => 'Narnoor',
          945 => 'Neonderthaw',
          946 => 'Nerko One',
          947 => 'Neucha',
          948 => 'Neuton',
          949 => 'New Amsterdam',
          950 => 'New Rocker',
          951 => 'New Tegomin',
          952 => 'News Cycle',
          953 => 'Newsreader',
          954 => 'Niconne',
          955 => 'Niramit',
          956 => 'Nixie One',
          957 => 'Nobile',
          958 => 'Nokora',
          959 => 'Norican',
          960 => 'Nosifer',
          961 => 'Notable',
          962 => 'Nothing You Could Do',
          963 => 'Noticia Text',
          964 => 'Noto Color Emoji',
          965 => 'Noto Emoji',
          966 => 'Noto Kufi Arabic',
          967 => 'Noto Music',
          968 => 'Noto Naskh Arabic',
          969 => 'Noto Nastaliq Urdu',
          970 => 'Noto Rashi Hebrew',
          971 => 'Noto Sans',
          972 => 'Noto Sans Adlam',
          973 => 'Noto Sans Adlam Unjoined',
          974 => 'Noto Sans Anatolian Hieroglyphs',
          975 => 'Noto Sans Arabic',
          976 => 'Noto Sans Armenian',
          977 => 'Noto Sans Avestan',
          978 => 'Noto Sans Balinese',
          979 => 'Noto Sans Bamum',
          980 => 'Noto Sans Bassa Vah',
          981 => 'Noto Sans Batak',
          982 => 'Noto Sans Bengali',
          983 => 'Noto Sans Bhaiksuki',
          984 => 'Noto Sans Brahmi',
          985 => 'Noto Sans Buginese',
          986 => 'Noto Sans Buhid',
          987 => 'Noto Sans Canadian Aboriginal',
          988 => 'Noto Sans Carian',
          989 => 'Noto Sans Caucasian Albanian',
          990 => 'Noto Sans Chakma',
          991 => 'Noto Sans Cham',
          992 => 'Noto Sans Cherokee',
          993 => 'Noto Sans Chorasmian',
          994 => 'Noto Sans Coptic',
          995 => 'Noto Sans Cuneiform',
          996 => 'Noto Sans Cypriot',
          997 => 'Noto Sans Cypro Minoan',
          998 => 'Noto Sans Deseret',
          999 => 'Noto Sans Devanagari',
          1000 => 'Noto Sans Display',
          1001 => 'Noto Sans Duployan',
          1002 => 'Noto Sans Egyptian Hieroglyphs',
          1003 => 'Noto Sans Elbasan',
          1004 => 'Noto Sans Elymaic',
          1005 => 'Noto Sans Ethiopic',
          1006 => 'Noto Sans Georgian',
          1007 => 'Noto Sans Glagolitic',
          1008 => 'Noto Sans Gothic',
          1009 => 'Noto Sans Grantha',
          1010 => 'Noto Sans Gujarati',
          1011 => 'Noto Sans Gunjala Gondi',
          1012 => 'Noto Sans Gurmukhi',
          1013 => 'Noto Sans HK',
          1014 => 'Noto Sans Hanifi Rohingya',
          1015 => 'Noto Sans Hanunoo',
          1016 => 'Noto Sans Hatran',
          1017 => 'Noto Sans Hebrew',
          1018 => 'Noto Sans Imperial Aramaic',
          1019 => 'Noto Sans Indic Siyaq Numbers',
          1020 => 'Noto Sans Inscriptional Pahlavi',
          1021 => 'Noto Sans Inscriptional Parthian',
          1022 => 'Noto Sans JP',
          1023 => 'Noto Sans Javanese',
          1024 => 'Noto Sans KR',
          1025 => 'Noto Sans Kaithi',
          1026 => 'Noto Sans Kannada',
          1027 => 'Noto Sans Kawi',
          1028 => 'Noto Sans Kayah Li',
          1029 => 'Noto Sans Kharoshthi',
          1030 => 'Noto Sans Khmer',
          1031 => 'Noto Sans Khojki',
          1032 => 'Noto Sans Khudawadi',
          1033 => 'Noto Sans Lao',
          1034 => 'Noto Sans Lao Looped',
          1035 => 'Noto Sans Lepcha',
          1036 => 'Noto Sans Limbu',
          1037 => 'Noto Sans Linear A',
          1038 => 'Noto Sans Linear B',
          1039 => 'Noto Sans Lisu',
          1040 => 'Noto Sans Lycian',
          1041 => 'Noto Sans Lydian',
          1042 => 'Noto Sans Mahajani',
          1043 => 'Noto Sans Malayalam',
          1044 => 'Noto Sans Mandaic',
          1045 => 'Noto Sans Manichaean',
          1046 => 'Noto Sans Marchen',
          1047 => 'Noto Sans Masaram Gondi',
          1048 => 'Noto Sans Math',
          1049 => 'Noto Sans Mayan Numerals',
          1050 => 'Noto Sans Medefaidrin',
          1051 => 'Noto Sans Meetei Mayek',
          1052 => 'Noto Sans Mende Kikakui',
          1053 => 'Noto Sans Meroitic',
          1054 => 'Noto Sans Miao',
          1055 => 'Noto Sans Modi',
          1056 => 'Noto Sans Mongolian',
          1057 => 'Noto Sans Mono',
          1058 => 'Noto Sans Mro',
          1059 => 'Noto Sans Multani',
          1060 => 'Noto Sans Myanmar',
          1061 => 'Noto Sans NKo',
          1062 => 'Noto Sans NKo Unjoined',
          1063 => 'Noto Sans Nabataean',
          1064 => 'Noto Sans Nag Mundari',
          1065 => 'Noto Sans Nandinagari',
          1066 => 'Noto Sans New Tai Lue',
          1067 => 'Noto Sans Newa',
          1068 => 'Noto Sans Nushu',
          1069 => 'Noto Sans Ogham',
          1070 => 'Noto Sans Ol Chiki',
          1071 => 'Noto Sans Old Hungarian',
          1072 => 'Noto Sans Old Italic',
          1073 => 'Noto Sans Old North Arabian',
          1074 => 'Noto Sans Old Permic',
          1075 => 'Noto Sans Old Persian',
          1076 => 'Noto Sans Old Sogdian',
          1077 => 'Noto Sans Old South Arabian',
          1078 => 'Noto Sans Old Turkic',
          1079 => 'Noto Sans Oriya',
          1080 => 'Noto Sans Osage',
          1081 => 'Noto Sans Osmanya',
          1082 => 'Noto Sans Pahawh Hmong',
          1083 => 'Noto Sans Palmyrene',
          1084 => 'Noto Sans Pau Cin Hau',
          1085 => 'Noto Sans PhagsPa',
          1086 => 'Noto Sans Phoenician',
          1087 => 'Noto Sans Psalter Pahlavi',
          1088 => 'Noto Sans Rejang',
          1089 => 'Noto Sans Runic',
          1090 => 'Noto Sans SC',
          1091 => 'Noto Sans Samaritan',
          1092 => 'Noto Sans Saurashtra',
          1093 => 'Noto Sans Sharada',
          1094 => 'Noto Sans Shavian',
          1095 => 'Noto Sans Siddham',
          1096 => 'Noto Sans SignWriting',
          1097 => 'Noto Sans Sinhala',
          1098 => 'Noto Sans Sogdian',
          1099 => 'Noto Sans Sora Sompeng',
          1100 => 'Noto Sans Soyombo',
          1101 => 'Noto Sans Sundanese',
          1102 => 'Noto Sans Syloti Nagri',
          1103 => 'Noto Sans Symbols',
          1104 => 'Noto Sans Symbols 2',
          1105 => 'Noto Sans Syriac',
          1106 => 'Noto Sans Syriac Eastern',
          1107 => 'Noto Sans TC',
          1108 => 'Noto Sans Tagalog',
          1109 => 'Noto Sans Tagbanwa',
          1110 => 'Noto Sans Tai Le',
          1111 => 'Noto Sans Tai Tham',
          1112 => 'Noto Sans Tai Viet',
          1113 => 'Noto Sans Takri',
          1114 => 'Noto Sans Tamil',
          1115 => 'Noto Sans Tamil Supplement',
          1116 => 'Noto Sans Tangsa',
          1117 => 'Noto Sans Telugu',
          1118 => 'Noto Sans Thaana',
          1119 => 'Noto Sans Thai',
          1120 => 'Noto Sans Thai Looped',
          1121 => 'Noto Sans Tifinagh',
          1122 => 'Noto Sans Tirhuta',
          1123 => 'Noto Sans Ugaritic',
          1124 => 'Noto Sans Vai',
          1125 => 'Noto Sans Vithkuqi',
          1126 => 'Noto Sans Wancho',
          1127 => 'Noto Sans Warang Citi',
          1128 => 'Noto Sans Yi',
          1129 => 'Noto Sans Zanabazar Square',
          1130 => 'Noto Serif',
          1131 => 'Noto Serif Ahom',
          1132 => 'Noto Serif Armenian',
          1133 => 'Noto Serif Balinese',
          1134 => 'Noto Serif Bengali',
          1135 => 'Noto Serif Devanagari',
          1136 => 'Noto Serif Display',
          1137 => 'Noto Serif Dogra',
          1138 => 'Noto Serif Ethiopic',
          1139 => 'Noto Serif Georgian',
          1140 => 'Noto Serif Grantha',
          1141 => 'Noto Serif Gujarati',
          1142 => 'Noto Serif Gurmukhi',
          1143 => 'Noto Serif HK',
          1144 => 'Noto Serif Hebrew',
          1145 => 'Noto Serif Hentaigana',
          1146 => 'Noto Serif JP',
          1147 => 'Noto Serif KR',
          1148 => 'Noto Serif Kannada',
          1149 => 'Noto Serif Khitan Small Script',
          1150 => 'Noto Serif Khmer',
          1151 => 'Noto Serif Khojki',
          1152 => 'Noto Serif Lao',
          1153 => 'Noto Serif Makasar',
          1154 => 'Noto Serif Malayalam',
          1155 => 'Noto Serif Myanmar',
          1156 => 'Noto Serif NP Hmong',
          1157 => 'Noto Serif Old Uyghur',
          1158 => 'Noto Serif Oriya',
          1159 => 'Noto Serif Ottoman Siyaq',
          1160 => 'Noto Serif SC',
          1161 => 'Noto Serif Sinhala',
          1162 => 'Noto Serif TC',
          1163 => 'Noto Serif Tamil',
          1164 => 'Noto Serif Tangut',
          1165 => 'Noto Serif Telugu',
          1166 => 'Noto Serif Thai',
          1167 => 'Noto Serif Tibetan',
          1168 => 'Noto Serif Todhri',
          1169 => 'Noto Serif Toto',
          1170 => 'Noto Serif Vithkuqi',
          1171 => 'Noto Serif Yezidi',
          1172 => 'Noto Traditional Nushu',
          1173 => 'Noto Znamenny Musical Notation',
          1174 => 'Nova Cut',
          1175 => 'Nova Flat',
          1176 => 'Nova Mono',
          1177 => 'Nova Oval',
          1178 => 'Nova Round',
          1179 => 'Nova Script',
          1180 => 'Nova Slim',
          1181 => 'Nova Square',
          1182 => 'Numans',
          1183 => 'Nunito',
          1184 => 'Nunito Sans',
          1185 => 'Nuosu SIL',
          1186 => 'Odibee Sans',
          1187 => 'Odor Mean Chey',
          1188 => 'Offside',
          1189 => 'Oi',
          1190 => 'Ojuju',
          1191 => 'Old Standard TT',
          1192 => 'Oldenburg',
          1193 => 'Ole',
          1194 => 'Oleo Script',
          1195 => 'Oleo Script Swash Caps',
          1196 => 'Onest',
          1197 => 'Oooh Baby',
          1198 => 'Open Sans',
          1199 => 'Oranienbaum',
          1200 => 'Orbit',
          1201 => 'Orbitron',
          1202 => 'Oregano',
          1203 => 'Orelega One',
          1204 => 'Orienta',
          1205 => 'Original Surfer',
          1206 => 'Oswald',
          1207 => 'Outfit',
          1208 => 'Over the Rainbow',
          1209 => 'Overlock',
          1210 => 'Overlock SC',
          1211 => 'Overpass',
          1212 => 'Overpass Mono',
          1213 => 'Ovo',
          1214 => 'Oxanium',
          1215 => 'Oxygen',
          1216 => 'Oxygen Mono',
          1217 => 'PT Mono',
          1218 => 'PT Sans',
          1219 => 'PT Sans Caption',
          1220 => 'PT Sans Narrow',
          1221 => 'PT Serif',
          1222 => 'PT Serif Caption',
          1223 => 'Pacifico',
          1224 => 'Padauk',
          1225 => 'Padyakke Expanded One',
          1226 => 'Palanquin',
          1227 => 'Palanquin Dark',
          1228 => 'Palette Mosaic',
          1229 => 'Pangolin',
          1230 => 'Paprika',
          1231 => 'Parisienne',
          1232 => 'Parkinsans',
          1233 => 'Passero One',
          1234 => 'Passion One',
          1235 => 'Passions Conflict',
          1236 => 'Pathway Extreme',
          1237 => 'Pathway Gothic One',
          1238 => 'Patrick Hand',
          1239 => 'Patrick Hand SC',
          1240 => 'Pattaya',
          1241 => 'Patua One',
          1242 => 'Pavanam',
          1243 => 'Paytone One',
          1244 => 'Peddana',
          1245 => 'Peralta',
          1246 => 'Permanent Marker',
          1247 => 'Petemoss',
          1248 => 'Petit Formal Script',
          1249 => 'Petrona',
          1250 => 'Phetsarath',
          1251 => 'Philosopher',
          1252 => 'Phudu',
          1253 => 'Piazzolla',
          1254 => 'Piedra',
          1255 => 'Pinyon Script',
          1256 => 'Pirata One',
          1257 => 'Pixelify Sans',
          1258 => 'Plaster',
          1259 => 'Platypi',
          1260 => 'Play',
          1261 => 'Playball',
          1262 => 'Playfair',
          1263 => 'Playfair Display',
          1264 => 'Playfair Display SC',
          1265 => 'Playpen Sans',
          1266 => 'Playwrite AR',
          1267 => 'Playwrite AR Guides',
          1268 => 'Playwrite AT',
          1269 => 'Playwrite AT Guides',
          1270 => 'Playwrite AU NSW',
          1271 => 'Playwrite AU NSW Guides',
          1272 => 'Playwrite AU QLD',
          1273 => 'Playwrite AU QLD Guides',
          1274 => 'Playwrite AU SA',
          1275 => 'Playwrite AU SA Guides',
          1276 => 'Playwrite AU TAS',
          1277 => 'Playwrite AU TAS Guides',
          1278 => 'Playwrite AU VIC',
          1279 => 'Playwrite AU VIC Guides',
          1280 => 'Playwrite BE VLG',
          1281 => 'Playwrite BE VLG Guides',
          1282 => 'Playwrite BE WAL',
          1283 => 'Playwrite BE WAL Guides',
          1284 => 'Playwrite BR',
          1285 => 'Playwrite BR Guides',
          1286 => 'Playwrite CA',
          1287 => 'Playwrite CA Guides',
          1288 => 'Playwrite CL',
          1289 => 'Playwrite CL Guides',
          1290 => 'Playwrite CO',
          1291 => 'Playwrite CO Guides',
          1292 => 'Playwrite CU',
          1293 => 'Playwrite CU Guides',
          1294 => 'Playwrite CZ',
          1295 => 'Playwrite CZ Guides',
          1296 => 'Playwrite DE Grund',
          1297 => 'Playwrite DE Grund Guides',
          1298 => 'Playwrite DE LA',
          1299 => 'Playwrite DE LA Guides',
          1300 => 'Playwrite DE SAS',
          1301 => 'Playwrite DE SAS Guides',
          1302 => 'Playwrite DE VA',
          1303 => 'Playwrite DE VA Guides',
          1304 => 'Playwrite DK Loopet',
          1305 => 'Playwrite DK Loopet Guides',
          1306 => 'Playwrite DK Uloopet',
          1307 => 'Playwrite DK Uloopet Guides',
          1308 => 'Playwrite ES',
          1309 => 'Playwrite ES Deco',
          1310 => 'Playwrite ES Deco Guides',
          1311 => 'Playwrite ES Guides',
          1312 => 'Playwrite FR Moderne',
          1313 => 'Playwrite FR Moderne Guides',
          1314 => 'Playwrite FR Trad',
          1315 => 'Playwrite FR Trad Guides',
          1316 => 'Playwrite GB J',
          1317 => 'Playwrite GB J Guides',
          1318 => 'Playwrite GB S',
          1319 => 'Playwrite GB S Guides',
          1320 => 'Playwrite HR',
          1321 => 'Playwrite HR Guides',
          1322 => 'Playwrite HR Lijeva',
          1323 => 'Playwrite HR Lijeva Guides',
          1324 => 'Playwrite HU',
          1325 => 'Playwrite HU Guides',
          1326 => 'Playwrite ID',
          1327 => 'Playwrite ID Guides',
          1328 => 'Playwrite IE',
          1329 => 'Playwrite IE Guides',
          1330 => 'Playwrite IN',
          1331 => 'Playwrite IN Guides',
          1332 => 'Playwrite IS',
          1333 => 'Playwrite IS Guides',
          1334 => 'Playwrite IT Moderna',
          1335 => 'Playwrite IT Moderna Guides',
          1336 => 'Playwrite IT Trad',
          1337 => 'Playwrite IT Trad Guides',
          1338 => 'Playwrite MX',
          1339 => 'Playwrite MX Guides',
          1340 => 'Playwrite NG Modern',
          1341 => 'Playwrite NG Modern Guides',
          1342 => 'Playwrite NL',
          1343 => 'Playwrite NL Guides',
          1344 => 'Playwrite NO',
          1345 => 'Playwrite NO Guides',
          1346 => 'Playwrite NZ',
          1347 => 'Playwrite NZ Guides',
          1348 => 'Playwrite PE',
          1349 => 'Playwrite PE Guides',
          1350 => 'Playwrite PL',
          1351 => 'Playwrite PL Guides',
          1352 => 'Playwrite PT',
          1353 => 'Playwrite PT Guides',
          1354 => 'Playwrite RO',
          1355 => 'Playwrite RO Guides',
          1356 => 'Playwrite SK',
          1357 => 'Playwrite SK Guides',
          1358 => 'Playwrite TZ',
          1359 => 'Playwrite TZ Guides',
          1360 => 'Playwrite US Modern',
          1361 => 'Playwrite US Modern Guides',
          1362 => 'Playwrite US Trad',
          1363 => 'Playwrite US Trad Guides',
          1364 => 'Playwrite VN',
          1365 => 'Playwrite VN Guides',
          1366 => 'Playwrite ZA',
          1367 => 'Playwrite ZA Guides',
          1368 => 'Plus Jakarta Sans',
          1369 => 'Pochaevsk',
          1370 => 'Podkova',
          1371 => 'Poetsen One',
          1372 => 'Poiret One',
          1373 => 'Poller One',
          1374 => 'Poltawski Nowy',
          1375 => 'Poly',
          1376 => 'Pompiere',
          1377 => 'Ponnala',
          1378 => 'Ponomar',
          1379 => 'Pontano Sans',
          1380 => 'Poor Story',
          1381 => 'Poppins',
          1382 => 'Port Lligat Sans',
          1383 => 'Port Lligat Slab',
          1384 => 'Potta One',
          1385 => 'Pragati Narrow',
          1386 => 'Praise',
          1387 => 'Prata',
          1388 => 'Preahvihear',
          1389 => 'Press Start 2P',
          1390 => 'Pridi',
          1391 => 'Princess Sofia',
          1392 => 'Prociono',
          1393 => 'Prompt',
          1394 => 'Prosto One',
          1395 => 'Protest Guerrilla',
          1396 => 'Protest Revolution',
          1397 => 'Protest Riot',
          1398 => 'Protest Strike',
          1399 => 'Proza Libre',
          1400 => 'Public Sans',
          1401 => 'Puppies Play',
          1402 => 'Puritan',
          1403 => 'Purple Purse',
          1404 => 'Qahiri',
          1405 => 'Quando',
          1406 => 'Quantico',
          1407 => 'Quattrocento',
          1408 => 'Quattrocento Sans',
          1409 => 'Questrial',
          1410 => 'Quicksand',
          1411 => 'Quintessential',
          1412 => 'Qwigley',
          1413 => 'Qwitcher Grypen',
          1414 => 'REM',
          1415 => 'Racing Sans One',
          1416 => 'Radio Canada',
          1417 => 'Radio Canada Big',
          1418 => 'Radley',
          1419 => 'Rajdhani',
          1420 => 'Rakkas',
          1421 => 'Raleway',
          1422 => 'Raleway Dots',
          1423 => 'Ramabhadra',
          1424 => 'Ramaraja',
          1425 => 'Rambla',
          1426 => 'Rammetto One',
          1427 => 'Rampart One',
          1428 => 'Ranchers',
          1429 => 'Rancho',
          1430 => 'Ranga',
          1431 => 'Rasa',
          1432 => 'Rationale',
          1433 => 'Ravi Prakash',
          1434 => 'Readex Pro',
          1435 => 'Recursive',
          1436 => 'Red Hat Display',
          1437 => 'Red Hat Mono',
          1438 => 'Red Hat Text',
          1439 => 'Red Rose',
          1440 => 'Redacted',
          1441 => 'Redacted Script',
          1442 => 'Reddit Mono',
          1443 => 'Reddit Sans',
          1444 => 'Reddit Sans Condensed',
          1445 => 'Redressed',
          1446 => 'Reem Kufi',
          1447 => 'Reem Kufi Fun',
          1448 => 'Reem Kufi Ink',
          1449 => 'Reenie Beanie',
          1450 => 'Reggae One',
          1451 => 'Rethink Sans',
          1452 => 'Revalia',
          1453 => 'Rhodium Libre',
          1454 => 'Ribeye',
          1455 => 'Ribeye Marrow',
          1456 => 'Righteous',
          1457 => 'Risque',
          1458 => 'Road Rage',
          1459 => 'Roboto',
          1460 => 'Roboto Condensed',
          1461 => 'Roboto Flex',
          1462 => 'Roboto Mono',
          1463 => 'Roboto Serif',
          1464 => 'Roboto Slab',
          1465 => 'Rochester',
          1466 => 'Rock 3D',
          1467 => 'Rock Salt',
          1468 => 'RocknRoll One',
          1469 => 'Rokkitt',
          1470 => 'Romanesco',
          1471 => 'Ropa Sans',
          1472 => 'Rosario',
          1473 => 'Rosarivo',
          1474 => 'Rouge Script',
          1475 => 'Rowdies',
          1476 => 'Rozha One',
          1477 => 'Rubik',
          1478 => 'Rubik 80s Fade',
          1479 => 'Rubik Beastly',
          1480 => 'Rubik Broken Fax',
          1481 => 'Rubik Bubbles',
          1482 => 'Rubik Burned',
          1483 => 'Rubik Dirt',
          1484 => 'Rubik Distressed',
          1485 => 'Rubik Doodle Shadow',
          1486 => 'Rubik Doodle Triangles',
          1487 => 'Rubik Gemstones',
          1488 => 'Rubik Glitch',
          1489 => 'Rubik Glitch Pop',
          1490 => 'Rubik Iso',
          1491 => 'Rubik Lines',
          1492 => 'Rubik Maps',
          1493 => 'Rubik Marker Hatch',
          1494 => 'Rubik Maze',
          1495 => 'Rubik Microbe',
          1496 => 'Rubik Mono One',
          1497 => 'Rubik Moonrocks',
          1498 => 'Rubik Pixels',
          1499 => 'Rubik Puddles',
          1500 => 'Rubik Scribble',
          1501 => 'Rubik Spray Paint',
          1502 => 'Rubik Storm',
          1503 => 'Rubik Vinyl',
          1504 => 'Rubik Wet Paint',
          1505 => 'Ruda',
          1506 => 'Rufina',
          1507 => 'Ruge Boogie',
          1508 => 'Ruluko',
          1509 => 'Rum Raisin',
          1510 => 'Ruslan Display',
          1511 => 'Russo One',
          1512 => 'Ruthie',
          1513 => 'Ruwudu',
          1514 => 'Rye',
          1515 => 'STIX Two Text',
          1516 => 'SUSE',
          1517 => 'Sacramento',
          1518 => 'Sahitya',
          1519 => 'Sail',
          1520 => 'Saira',
          1521 => 'Saira Condensed',
          1522 => 'Saira Extra Condensed',
          1523 => 'Saira Semi Condensed',
          1524 => 'Saira Stencil One',
          1525 => 'Salsa',
          1526 => 'Sanchez',
          1527 => 'Sancreek',
          1528 => 'Sankofa Display',
          1529 => 'Sansita',
          1530 => 'Sansita Swashed',
          1531 => 'Sarabun',
          1532 => 'Sarala',
          1533 => 'Sarina',
          1534 => 'Sarpanch',
          1535 => 'Sassy Frass',
          1536 => 'Satisfy',
          1537 => 'Sawarabi Gothic',
          1538 => 'Sawarabi Mincho',
          1539 => 'Scada',
          1540 => 'Scheherazade New',
          1541 => 'Schibsted Grotesk',
          1542 => 'Schoolbell',
          1543 => 'Scope One',
          1544 => 'Seaweed Script',
          1545 => 'Secular One',
          1546 => 'Sedan',
          1547 => 'Sedan SC',
          1548 => 'Sedgwick Ave',
          1549 => 'Sedgwick Ave Display',
          1550 => 'Sen',
          1551 => 'Send Flowers',
          1552 => 'Sevillana',
          1553 => 'Seymour One',
          1554 => 'Shadows Into Light',
          1555 => 'Shadows Into Light Two',
          1556 => 'Shafarik',
          1557 => 'Shalimar',
          1558 => 'Shantell Sans',
          1559 => 'Shanti',
          1560 => 'Share',
          1561 => 'Share Tech',
          1562 => 'Share Tech Mono',
          1563 => 'Shippori Antique',
          1564 => 'Shippori Antique B1',
          1565 => 'Shippori Mincho',
          1566 => 'Shippori Mincho B1',
          1567 => 'Shizuru',
          1568 => 'Shojumaru',
          1569 => 'Short Stack',
          1570 => 'Shrikhand',
          1571 => 'Siemreap',
          1572 => 'Sigmar',
          1573 => 'Sigmar One',
          1574 => 'Signika',
          1575 => 'Signika Negative',
          1576 => 'Silkscreen',
          1577 => 'Simonetta',
          1578 => 'Single Day',
          1579 => 'Sintony',
          1580 => 'Sirin Stencil',
          1581 => 'Six Caps',
          1582 => 'Sixtyfour',
          1583 => 'Sixtyfour Convergence',
          1584 => 'Skranji',
          1585 => 'Slabo 13px',
          1586 => 'Slabo 27px',
          1587 => 'Slackey',
          1588 => 'Slackside One',
          1589 => 'Smokum',
          1590 => 'Smooch',
          1591 => 'Smooch Sans',
          1592 => 'Smythe',
          1593 => 'Sniglet',
          1594 => 'Snippet',
          1595 => 'Snowburst One',
          1596 => 'Sofadi One',
          1597 => 'Sofia',
          1598 => 'Sofia Sans',
          1599 => 'Sofia Sans Condensed',
          1600 => 'Sofia Sans Extra Condensed',
          1601 => 'Sofia Sans Semi Condensed',
          1602 => 'Solitreo',
          1603 => 'Solway',
          1604 => 'Sometype Mono',
          1605 => 'Song Myung',
          1606 => 'Sono',
          1607 => 'Sonsie One',
          1608 => 'Sora',
          1609 => 'Sorts Mill Goudy',
          1610 => 'Sour Gummy',
          1611 => 'Source Code Pro',
          1612 => 'Source Sans 3',
          1613 => 'Source Serif 4',
          1614 => 'Space Grotesk',
          1615 => 'Space Mono',
          1616 => 'Special Elite',
          1617 => 'Spectral',
          1618 => 'Spectral SC',
          1619 => 'Spicy Rice',
          1620 => 'Spinnaker',
          1621 => 'Spirax',
          1622 => 'Splash',
          1623 => 'Spline Sans',
          1624 => 'Spline Sans Mono',
          1625 => 'Squada One',
          1626 => 'Square Peg',
          1627 => 'Sree Krushnadevaraya',
          1628 => 'Sriracha',
          1629 => 'Srisakdi',
          1630 => 'Staatliches',
          1631 => 'Stalemate',
          1632 => 'Stalinist One',
          1633 => 'Stardos Stencil',
          1634 => 'Stick',
          1635 => 'Stick No Bills',
          1636 => 'Stint Ultra Condensed',
          1637 => 'Stint Ultra Expanded',
          1638 => 'Stoke',
          1639 => 'Strait',
          1640 => 'Style Script',
          1641 => 'Stylish',
          1642 => 'Sue Ellen Francisco',
          1643 => 'Suez One',
          1644 => 'Sulphur Point',
          1645 => 'Sumana',
          1646 => 'Sunflower',
          1647 => 'Sunshiney',
          1648 => 'Supermercado One',
          1649 => 'Sura',
          1650 => 'Suranna',
          1651 => 'Suravaram',
          1652 => 'Suwannaphum',
          1653 => 'Swanky and Moo Moo',
          1654 => 'Syncopate',
          1655 => 'Syne',
          1656 => 'Syne Mono',
          1657 => 'Syne Tactile',
          1658 => 'Tac One',
          1659 => 'Tai Heritage Pro',
          1660 => 'Tajawal',
          1661 => 'Tangerine',
          1662 => 'Tapestry',
          1663 => 'Taprom',
          1664 => 'Tauri',
          1665 => 'Taviraj',
          1666 => 'Teachers',
          1667 => 'Teko',
          1668 => 'Tektur',
          1669 => 'Telex',
          1670 => 'Tenali Ramakrishna',
          1671 => 'Tenor Sans',
          1672 => 'Text Me One',
          1673 => 'Texturina',
          1674 => 'Thasadith',
          1675 => 'The Girl Next Door',
          1676 => 'The Nautigal',
          1677 => 'Tienne',
          1678 => 'Tillana',
          1679 => 'Tilt Neon',
          1680 => 'Tilt Prism',
          1681 => 'Tilt Warp',
          1682 => 'Timmana',
          1683 => 'Tinos',
          1684 => 'Tiny5',
          1685 => 'Tiro Bangla',
          1686 => 'Tiro Devanagari Hindi',
          1687 => 'Tiro Devanagari Marathi',
          1688 => 'Tiro Devanagari Sanskrit',
          1689 => 'Tiro Gurmukhi',
          1690 => 'Tiro Kannada',
          1691 => 'Tiro Tamil',
          1692 => 'Tiro Telugu',
          1693 => 'Titan One',
          1694 => 'Titillium Web',
          1695 => 'Tomorrow',
          1696 => 'Tourney',
          1697 => 'Trade Winds',
          1698 => 'Train One',
          1699 => 'Triodion',
          1700 => 'Trirong',
          1701 => 'Trispace',
          1702 => 'Trocchi',
          1703 => 'Trochut',
          1704 => 'Truculenta',
          1705 => 'Trykker',
          1706 => 'Tsukimi Rounded',
          1707 => 'Tulpen One',
          1708 => 'Turret Road',
          1709 => 'Twinkle Star',
          1710 => 'Ubuntu',
          1711 => 'Ubuntu Condensed',
          1712 => 'Ubuntu Mono',
          1713 => 'Ubuntu Sans',
          1714 => 'Ubuntu Sans Mono',
          1715 => 'Uchen',
          1716 => 'Ultra',
          1717 => 'Unbounded',
          1718 => 'Uncial Antiqua',
          1719 => 'Underdog',
          1720 => 'Unica One',
          1721 => 'UnifrakturCook',
          1722 => 'UnifrakturMaguntia',
          1723 => 'Unkempt',
          1724 => 'Unlock',
          1725 => 'Unna',
          1726 => 'Updock',
          1727 => 'Urbanist',
          1728 => 'VT323',
          1729 => 'Vampiro One',
          1730 => 'Varela',
          1731 => 'Varela Round',
          1732 => 'Varta',
          1733 => 'Vast Shadow',
          1734 => 'Vazirmatn',
          1735 => 'Vesper Libre',
          1736 => 'Viaoda Libre',
          1737 => 'Vibes',
          1738 => 'Vibur',
          1739 => 'Victor Mono',
          1740 => 'Vidaloka',
          1741 => 'Viga',
          1742 => 'Vina Sans',
          1743 => 'Voces',
          1744 => 'Volkhov',
          1745 => 'Vollkorn',
          1746 => 'Vollkorn SC',
          1747 => 'Voltaire',
          1748 => 'Vujahday Script',
          1749 => 'Waiting for the Sunrise',
          1750 => 'Wallpoet',
          1751 => 'Walter Turncoat',
          1752 => 'Warnes',
          1753 => 'Water Brush',
          1754 => 'Waterfall',
          1755 => 'Wavefont',
          1756 => 'Wellfleet',
          1757 => 'Wendy One',
          1758 => 'Whisper',
          1759 => 'WindSong',
          1760 => 'Winky Sans',
          1761 => 'Wire One',
          1762 => 'Wittgenstein',
          1763 => 'Wix Madefor Display',
          1764 => 'Wix Madefor Text',
          1765 => 'Work Sans',
          1766 => 'Workbench',
          1767 => 'Xanh Mono',
          1768 => 'Yaldevi',
          1769 => 'Yanone Kaffeesatz',
          1770 => 'Yantramanav',
          1771 => 'Yarndings 12',
          1772 => 'Yarndings 12 Charted',
          1773 => 'Yarndings 20',
          1774 => 'Yarndings 20 Charted',
          1775 => 'Yatra One',
          1776 => 'Yellowtail',
          1777 => 'Yeon Sung',
          1778 => 'Yeseva One',
          1779 => 'Yesteryear',
          1780 => 'Yomogi',
          1781 => 'Young Serif',
          1782 => 'Yrsa',
          1783 => 'Ysabeau',
          1784 => 'Ysabeau Infant',
          1785 => 'Ysabeau Office',
          1786 => 'Ysabeau SC',
          1787 => 'Yuji Boku',
          1788 => 'Yuji Hentaigana Akari',
          1789 => 'Yuji Hentaigana Akebono',
          1790 => 'Yuji Mai',
          1791 => 'Yuji Syuku',
          1792 => 'Yusei Magic',
          1793 => 'ZCOOL KuaiLe',
          1794 => 'ZCOOL QingKe HuangYou',
          1795 => 'ZCOOL XiaoWei',
          1796 => 'Zain',
          1797 => 'Zen Antique',
          1798 => 'Zen Antique Soft',
          1799 => 'Zen Dots',
          1800 => 'Zen Kaku Gothic Antique',
          1801 => 'Zen Kaku Gothic New',
          1802 => 'Zen Kurenaido',
          1803 => 'Zen Loop',
          1804 => 'Zen Maru Gothic',
          1805 => 'Zen Old Mincho',
          1806 => 'Zen Tokyo Zoo',
          1807 => 'Zeyada',
          1808 => 'Zhi Mang Xing',
          1809 => 'Zilla Slab',
          1810 => 'Zilla Slab Highlight',
        ),
        'custom_google_fonts' => '',
        'custom_fonts' => '',
        'countries' => 
        array (
          'AF' => 'Afghanistan',
          'AX' => 'Åland Islands',
          'AL' => 'Albania',
          'DZ' => 'Algeria',
          'AS' => 'American Samoa',
          'AD' => 'Andorra',
          'AO' => 'Angola',
          'AI' => 'Anguilla',
          'AQ' => 'Antarctica',
          'AG' => 'Antigua and Barbuda',
          'AR' => 'Argentina',
          'AM' => 'Armenia',
          'AW' => 'Aruba',
          'AU' => 'Australia',
          'AT' => 'Austria',
          'AZ' => 'Azerbaijan',
          'BS' => 'Bahamas',
          'BH' => 'Bahrain',
          'BD' => 'Bangladesh',
          'BB' => 'Barbados',
          'BY' => 'Belarus',
          'BE' => 'Belgium',
          'PW' => 'Belau',
          'BZ' => 'Belize',
          'BJ' => 'Benin',
          'BM' => 'Bermuda',
          'BT' => 'Bhutan',
          'BO' => 'Bolivia',
          'BQ' => 'Bonaire, Saint Eustatius and Saba',
          'BA' => 'Bosnia and Herzegovina',
          'BW' => 'Botswana',
          'BV' => 'Bouvet Island',
          'BR' => 'Brazil',
          'IO' => 'British Indian Ocean Territory',
          'BN' => 'Brunei',
          'BG' => 'Bulgaria',
          'BF' => 'Burkina Faso',
          'BI' => 'Burundi',
          'KH' => 'Cambodia',
          'CM' => 'Cameroon',
          'CA' => 'Canada',
          'CV' => 'Cape Verde',
          'KY' => 'Cayman Islands',
          'CF' => 'Central African Republic',
          'TD' => 'Chad',
          'CL' => 'Chile',
          'CN' => 'China',
          'CX' => 'Christmas Island',
          'CC' => 'Cocos (Keeling) Islands',
          'CO' => 'Colombia',
          'KM' => 'Comoros',
          'CG' => 'Congo (Brazzaville)',
          'CD' => 'Congo (Kinshasa)',
          'CK' => 'Cook Islands',
          'CR' => 'Costa Rica',
          'HR' => 'Croatia',
          'CU' => 'Cuba',
          'CW' => 'Cura&ccedil;ao',
          'CY' => 'Cyprus',
          'CZ' => 'Czech Republic',
          'DK' => 'Denmark',
          'DJ' => 'Djibouti',
          'DM' => 'Dominica',
          'DO' => 'Dominican Republic',
          'EC' => 'Ecuador',
          'EG' => 'Egypt',
          'SV' => 'El Salvador',
          'GQ' => 'Equatorial Guinea',
          'ER' => 'Eritrea',
          'EE' => 'Estonia',
          'ET' => 'Ethiopia',
          'FK' => 'Falkland Islands',
          'FO' => 'Faroe Islands',
          'FJ' => 'Fiji',
          'FI' => 'Finland',
          'FR' => 'France',
          'GF' => 'French Guiana',
          'PF' => 'French Polynesia',
          'TF' => 'French Southern Territories',
          'GA' => 'Gabon',
          'GM' => 'Gambia',
          'GE' => 'Georgia',
          'DE' => 'Germany',
          'GH' => 'Ghana',
          'GI' => 'Gibraltar',
          'GR' => 'Greece',
          'GL' => 'Greenland',
          'GD' => 'Grenada',
          'GP' => 'Guadeloupe',
          'GU' => 'Guam',
          'GT' => 'Guatemala',
          'GG' => 'Guernsey',
          'GN' => 'Guinea',
          'GW' => 'Guinea-Bissau',
          'GY' => 'Guyana',
          'HT' => 'Haiti',
          'HM' => 'Heard Island and McDonald Islands',
          'HN' => 'Honduras',
          'HK' => 'Hong Kong',
          'HU' => 'Hungary',
          'IS' => 'Iceland',
          'IN' => 'India',
          'ID' => 'Indonesia',
          'IR' => 'Iran',
          'IQ' => 'Iraq',
          'IE' => 'Ireland',
          'IM' => 'Isle of Man',
          'IL' => 'Israel',
          'IT' => 'Italy',
          'CI' => 'Ivory Coast',
          'JM' => 'Jamaica',
          'JP' => 'Japan',
          'JE' => 'Jersey',
          'JO' => 'Jordan',
          'KZ' => 'Kazakhstan',
          'KE' => 'Kenya',
          'KI' => 'Kiribati',
          'KW' => 'Kuwait',
          'XK' => 'Kosovo',
          'KG' => 'Kyrgyzstan',
          'LA' => 'Laos',
          'LV' => 'Latvia',
          'LB' => 'Lebanon',
          'LS' => 'Lesotho',
          'LR' => 'Liberia',
          'LY' => 'Libya',
          'LI' => 'Liechtenstein',
          'LT' => 'Lithuania',
          'LU' => 'Luxembourg',
          'MO' => 'Macao',
          'MK' => 'North Macedonia',
          'MG' => 'Madagascar',
          'MW' => 'Malawi',
          'MY' => 'Malaysia',
          'MV' => 'Maldives',
          'ML' => 'Mali',
          'MT' => 'Malta',
          'MH' => 'Marshall Islands',
          'MQ' => 'Martinique',
          'MR' => 'Mauritania',
          'MU' => 'Mauritius',
          'YT' => 'Mayotte',
          'MX' => 'Mexico',
          'FM' => 'Micronesia',
          'MD' => 'Moldova',
          'MC' => 'Monaco',
          'MN' => 'Mongolia',
          'ME' => 'Montenegro',
          'MS' => 'Montserrat',
          'MA' => 'Morocco',
          'MZ' => 'Mozambique',
          'MM' => 'Myanmar',
          'NA' => 'Namibia',
          'NR' => 'Nauru',
          'NP' => 'Nepal',
          'NL' => 'Netherlands',
          'NC' => 'New Caledonia',
          'NZ' => 'New Zealand',
          'NI' => 'Nicaragua',
          'NE' => 'Niger',
          'NG' => 'Nigeria',
          'NU' => 'Niue',
          'NF' => 'Norfolk Island',
          'MP' => 'Northern Mariana Islands',
          'KP' => 'North Korea',
          'NO' => 'Norway',
          'OM' => 'Oman',
          'PK' => 'Pakistan',
          'PS' => 'Palestinian Territory',
          'PA' => 'Panama',
          'PG' => 'Papua New Guinea',
          'PY' => 'Paraguay',
          'PE' => 'Peru',
          'PH' => 'Philippines',
          'PN' => 'Pitcairn',
          'PL' => 'Poland',
          'PT' => 'Portugal',
          'PR' => 'Puerto Rico',
          'QA' => 'Qatar',
          'RE' => 'Reunion',
          'RO' => 'Romania',
          'RU' => 'Russia',
          'RW' => 'Rwanda',
          'BL' => 'Saint Barth&eacute;lemy',
          'SH' => 'Saint Helena',
          'KN' => 'Saint Kitts and Nevis',
          'LC' => 'Saint Lucia',
          'MF' => 'Saint Martin (French part)',
          'SX' => 'Saint Martin (Dutch part)',
          'PM' => 'Saint Pierre and Miquelon',
          'VC' => 'Saint Vincent and the Grenadines',
          'SM' => 'San Marino',
          'ST' => 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe',
          'SA' => 'Saudi Arabia',
          'SN' => 'Senegal',
          'RS' => 'Serbia',
          'SC' => 'Seychelles',
          'SL' => 'Sierra Leone',
          'SG' => 'Singapore',
          'SK' => 'Slovakia',
          'SI' => 'Slovenia',
          'SB' => 'Solomon Islands',
          'SO' => 'Somalia',
          'ZA' => 'South Africa',
          'GS' => 'South Georgia/Sandwich Islands',
          'KR' => 'South Korea',
          'SS' => 'South Sudan',
          'ES' => 'Spain',
          'LK' => 'Sri Lanka',
          'SD' => 'Sudan',
          'SR' => 'Suriname',
          'SJ' => 'Svalbard and Jan Mayen',
          'SZ' => 'Swaziland',
          'SE' => 'Sweden',
          'CH' => 'Switzerland',
          'SY' => 'Syria',
          'TW' => 'Taiwan',
          'TJ' => 'Tajikistan',
          'TZ' => 'Tanzania',
          'TH' => 'Thailand',
          'TL' => 'Timor-Leste',
          'TG' => 'Togo',
          'TK' => 'Tokelau',
          'TO' => 'Tonga',
          'TT' => 'Trinidad and Tobago',
          'TN' => 'Tunisia',
          'TR' => 'Turkey',
          'TM' => 'Turkmenistan',
          'TC' => 'Turks and Caicos Islands',
          'TV' => 'Tuvalu',
          'UG' => 'Uganda',
          'UA' => 'Ukraine',
          'AE' => 'United Arab Emirates',
          'GB' => 'United Kingdom (UK)',
          'US' => 'United States (US)',
          'UM' => 'United States (US) Minor Outlying Islands',
          'UY' => 'Uruguay',
          'UZ' => 'Uzbekistan',
          'VU' => 'Vanuatu',
          'VA' => 'Vatican',
          'VE' => 'Venezuela',
          'VN' => 'Vietnam',
          'VG' => 'Virgin Islands (British)',
          'VI' => 'Virgin Islands (US)',
          'WF' => 'Wallis and Futuna',
          'EH' => 'Western Sahara',
          'WS' => 'Samoa',
          'YE' => 'Yemen',
          'ZM' => 'Zambia',
          'ZW' => 'Zimbabwe',
        ),
        'purifier' => 
        array (
          'default' => 
          array (
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title|rel|style|target|dofollow|nofollow],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style|loading],button,ins[style|data-ad-client|data-ad-slot|data-ad-format|data-full-width-responsive],video[src|type|width|height|preload|controls|autoplay|autostart|poster|id|class,muted,loop],meta[name|content|property],link[media|type|rel|href]',
            'HTML.AllowedElements' => 
            array (
              0 => 'a',
              1 => 'b',
              2 => 'blockquote',
              3 => 'br',
              4 => 'code',
              5 => 'em',
              6 => 'h1',
              7 => 'h2',
              8 => 'h3',
              9 => 'h4',
              10 => 'h5',
              11 => 'h6',
              12 => 'hr',
              13 => 'i',
              14 => 'img',
              15 => 'li',
              16 => 'ol',
              17 => 'p',
              18 => 'pre',
              19 => 's',
              20 => 'span',
              21 => 'strong',
              22 => 'sub',
              23 => 'sup',
              24 => 'table',
              25 => 'tbody',
              26 => 'td',
              27 => 'dl',
              28 => 'dt',
              29 => 'dd',
              30 => 'th',
              31 => 'thead',
              32 => 'tr',
              33 => 'u',
              34 => 'ul',
              35 => 'pre',
              36 => 'abbr',
              37 => 'kbd',
              38 => 'var',
              39 => 'samp',
              40 => 'hr',
              41 => 'iframe',
              42 => 'figure',
              43 => 'figcaption',
              44 => 'section',
              45 => 'article',
              46 => 'aside',
              47 => 'blockquote',
              48 => 'caption',
              49 => 'del',
              50 => 'div',
              51 => 'button',
              52 => 'ins',
              53 => 'video',
              54 => 'source',
              55 => 'meta',
              56 => 'link',
              57 => 'audio',
            ),
            'HTML.SafeIframe' => 'true',
            'Attr.AllowedFrameTargets' => 
            array (
              0 => '_blank',
            ),
            'CSS.AllowedProperties' => 
            array (
              0 => 'font',
              1 => 'font-size',
              2 => 'font-weight',
              3 => 'font-style',
              4 => 'font-family',
              5 => 'text-decoration',
              6 => 'padding-left',
              7 => 'color',
              8 => 'background-color',
              9 => 'text-align',
              10 => 'max-width',
              11 => 'border',
              12 => 'width',
              13 => 'line-height',
              14 => 'word-spacing',
              15 => 'border-style',
              16 => 'list-style-type',
              17 => 'border-color',
              18 => 'height',
              19 => 'min-width',
              20 => 'min-height',
              21 => 'max-height',
              22 => 'list-style',
              23 => 'margin',
              24 => 'margin-bottom',
              25 => 'margin-left',
              26 => 'margin-right',
              27 => 'margin-top',
              28 => 'padding',
              29 => 'height',
              30 => 'line-height',
              31 => 'border-collapse',
            ),
            'CSS.MaxImgLength' => NULL,
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => false,
            'Attr.EnableID' => true,
          ),
          'custom_elements' => 
          array (
            0 => 
            array (
              0 => 'u',
              1 => 'Inline',
              2 => 'Inline',
              3 => 'Common',
            ),
            1 => 
            array (
              0 => 'button',
              1 => 'Inline',
              2 => 'Inline',
              3 => 'Common',
            ),
            2 => 
            array (
              0 => 'ins',
              1 => 'Inline',
              2 => 'Inline',
              3 => 'Common',
            ),
            3 => 
            array (
              0 => 'meta',
              1 => 'Inline',
              2 => 'Empty',
              3 => 'Common',
            ),
            4 => 
            array (
              0 => 'link',
              1 => 'Inline',
              2 => 'Empty',
              3 => 'Common',
            ),
            5 => 
            array (
              0 => 'audio',
              1 => 'Block',
              2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
              3 => 'Common',
            ),
          ),
          'custom_attributes' => 
          array (
            0 => 
            array (
              0 => 'a',
              1 => 'rel',
              2 => 'Text',
            ),
            1 => 
            array (
              0 => 'a',
              1 => 'dofollow',
              2 => 'Bool',
            ),
            2 => 
            array (
              0 => 'a',
              1 => 'nofollow',
              2 => 'Bool',
            ),
            3 => 
            array (
              0 => 'span',
              1 => 'data-period',
              2 => 'Text',
            ),
            4 => 
            array (
              0 => 'span',
              1 => 'data-type',
              2 => 'Text',
            ),
            5 => 
            array (
              0 => 'ins',
              1 => 'data-ad-client',
              2 => 'Text',
            ),
            6 => 
            array (
              0 => 'ins',
              1 => 'data-ad-slot',
              2 => 'Text',
            ),
            7 => 
            array (
              0 => 'ins',
              1 => 'data-ad-format',
              2 => 'Text',
            ),
            8 => 
            array (
              0 => 'ins',
              1 => 'data-ad-full-width-responsive',
              2 => 'Text',
            ),
            9 => 
            array (
              0 => 'img',
              1 => 'data-src',
              2 => 'Text',
            ),
            10 => 
            array (
              0 => 'img',
              1 => 'loading',
              2 => 'Text',
            ),
            11 => 
            array (
              0 => 'video',
              1 => 'autoplay',
              2 => 'Bool',
            ),
            12 => 
            array (
              0 => 'video',
              1 => 'muted',
              2 => 'Bool',
            ),
            13 => 
            array (
              0 => 'video',
              1 => 'loop',
              2 => 'Bool',
            ),
            14 => 
            array (
              0 => 'meta',
              1 => 'name',
              2 => 'Text',
            ),
            15 => 
            array (
              0 => 'meta',
              1 => 'content',
              2 => 'Text',
            ),
            16 => 
            array (
              0 => 'meta',
              1 => 'property',
              2 => 'Text',
            ),
            17 => 
            array (
              0 => 'link',
              1 => 'media',
              2 => 'Text',
            ),
            18 => 
            array (
              0 => 'link',
              1 => 'type',
              2 => 'Text',
            ),
            19 => 
            array (
              0 => 'link',
              1 => 'rel',
              2 => 'Text',
            ),
            20 => 
            array (
              0 => 'link',
              1 => 'href',
              2 => 'Text',
            ),
            21 => 
            array (
              0 => 'link',
              1 => 'color',
              2 => 'Text',
            ),
            22 => 
            array (
              0 => 'audio',
              1 => 'controls',
              2 => 'Bool',
            ),
            23 => 
            array (
              0 => 'div',
              1 => 'data-bs-theme',
              2 => 'Text',
            ),
            24 => 
            array (
              0 => 'div',
              1 => 'data-url',
              2 => 'Text',
            ),
            25 => 
            array (
              0 => 'button',
              1 => 'data-bb-toggle',
              2 => 'Text',
            ),
            26 => 
            array (
              0 => 'button',
              1 => 'data-value',
              2 => 'Text',
            ),
          ),
        ),
        'enable_system_updater' => true,
        'phone_validation_rule' => 'min:8|max:15|regex:/^([0-9\\s\\-\\+\\(\\)]*)$/',
        'zipcode_validation_rule' => 'string|min:4|max:9',
        'disable_verify_csrf_token' => false,
        'enable_less_secure_web' => false,
        'db_strict_mode' => false,
        'db_prefix' => '',
        'enable_ini_set' => true,
        'upgrade_php_require_disabled' => false,
        'enabled_cleanup_database' => false,
        'hide_cleanup_system_menu' => false,
        'hide_activated_license_info' => false,
        'google_fonts_url' => 'https://fonts.bunny.net',
        'google_fonts_enabled' => true,
        'google_fonts_enabled_cache' => true,
        'using_uuids_for_id' => false,
        'using_ulids_for_id' => false,
        'type_id' => 'BIGINT',
        'csv_import_input_encoding' => 'UTF-8',
        'google_fonts_key' => NULL,
        'demo_mode_enabled' => false,
        'enable_email_configuration_from_admin_panel' => true,
        'session_cookie' => 'botble_session',
        'allowed_iframe_urls' => '',
        'iframe_regex' => '',
        'plugin_namespaces' => 
        array (
          'base' => 'core/base',
          'setting' => 'core/setting',
          'icon' => 'core/icon',
          '' => 
          array (
            '' => 
            array (
              '' => 'packages/data-synchronize',
            ),
          ),
          'get-started' => 'packages/get-started',
          'installer' => 'packages/installer',
          'menu' => 'packages/menu',
          'optimize' => 'packages/optimize',
          'page' => 'packages/page',
          'table' => 'core/table',
          'acl' => 'core/acl',
          'dashboard' => 'core/dashboard',
          'media' => 'core/media',
          'js-validation' => 'core/js-validation',
          'chart' => 'core/chart',
          'plugin-management' => 'packages/plugin-management',
          'ecommerce' => 'plugins/ecommerce',
          'payment' => 'plugins/payment',
          'shippo' => 'plugins/shippo',
          'revision' => 'packages/revision',
          'seo-helper' => 'packages/seo-helper',
          'shortcode' => 'packages/shortcode',
          'sitemap' => 'packages/sitemap',
          'slug' => 'packages/slug',
          'theme' => 'packages/theme',
          'widget' => 'packages/widget',
          'language' => 'plugins/language',
          'language-advanced' => 'plugins/language-advanced',
          'ads' => 'plugins/ads',
          'analytics' => 'plugins/analytics',
          'audit-log' => 'plugins/audit-log',
          'backup' => 'plugins/backup',
          'blog' => 'plugins/blog',
          'captcha' => 'plugins/captcha',
          'contact' => 'plugins/contact',
          'cookie-consent' => 'plugins/cookie-consent',
          'faq' => 'plugins/faq',
          'location' => 'plugins/location',
          'marketplace' => 'plugins/marketplace',
          'mollie' => 'plugins/mollie',
          'newsletter' => 'plugins/newsletter',
          'paypal' => 'plugins/paypal',
          'paypal-payout' => 'plugins/paypal-payout',
          'paystack' => 'plugins/paystack',
          'razorpay' => 'plugins/razorpay',
          'simple-slider' => 'plugins/simple-slider',
          'social-login' => 'plugins/social-login',
          'sslcommerz' => 'plugins/sslcommerz',
          'stripe' => 'plugins/stripe',
          'stripe-connect' => 'plugins/stripe-connect',
          'translation' => 'plugins/translation',
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'System',
          'flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'CMS',
          'flag' => 'core.cms',
        ),
        2 => 
        array (
          'name' => 'Manage license',
          'flag' => 'core.manage.license',
          'parent_flag' => 'core.system',
        ),
        3 => 
        array (
          'name' => 'Cronjob',
          'flag' => 'systems.cronjob',
          'parent_flag' => 'core.system',
        ),
        4 => 
        array (
          'name' => 'Tools',
          'flag' => 'core.tools',
        ),
        5 => 
        array (
          'name' => 'Import/Export Data',
          'flag' => 'tools.data-synchronize',
          'parent_flag' => 'core.tools',
        ),
      ),
      'assets' => 
      array (
        'offline' => true,
        'enable_version' => true,
        'version' => NULL,
        'scripts' => 
        array (
          0 => 'core-ui',
          1 => 'excanvas',
          2 => 'ie8-fix',
          3 => 'modernizr',
          4 => 'select2',
          5 => 'datepicker',
          6 => 'cookie',
          7 => 'core',
          8 => 'app',
          9 => 'toastr',
          10 => 'custom-scrollbar',
          11 => 'stickytableheaders',
          12 => 'jquery-waypoints',
          13 => 'spectrum',
          14 => 'fancybox',
          15 => 'fslightbox',
        ),
        'styles' => 
        array (
          0 => 'fontawesome',
          1 => 'select2',
          2 => 'toastr',
          3 => 'custom-scrollbar',
          4 => 'datepicker',
          5 => 'spectrum',
          6 => 'fancybox',
        ),
        'resources' => 
        array (
          'scripts' => 
          array (
            'core-ui' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/js/core-ui.js',
              ),
            ),
            'core' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/js/core.js',
              ),
            ),
            'app' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/jquery.min.js',
                  1 => '/vendor/core/core/base/js/app.js',
                ),
              ),
            ),
            'vue' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/vue.global.min.js',
                ),
              ),
            ),
            'vue-app' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/js/vue-app.js',
              ),
            ),
            'bootstrap' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/bootstrap.bundle.min.js',
                ),
              ),
            ),
            'modernizr' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/modernizr/modernizr.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',
              ),
            ),
            'excanvas' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/excanvas.min.js',
              ),
            ),
            'ie8-fix' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/ie8.fix.min.js',
              ),
            ),
            'counterup' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/counterup/jquery.counterup.min.js',
                ),
              ),
            ),
            'blockui' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery.blockui.min.js',
              ),
            ),
            'jquery-ui' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-ui/jquery-ui.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js',
              ),
            ),
            'cookie' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-cookie/jquery.cookie.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
              ),
            ),
            'dropzone' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/dropzone/dropzone.js',
              ),
            ),
            'jqueryTree' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'include_style' => true,
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-tree/jquery.tree.min.js',
              ),
            ),
            'jqueryTreeView' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'include_style' => true,
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-treeview/jquery.treeview.min.js',
              ),
            ),
            'bootstrap-editable' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap3-editable/js/bootstrap-editable.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js',
              ),
            ),
            'toastr' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/toastr/toastr.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js',
              ),
            ),
            'fancybox' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.js',
                'cdn' => '//fastly.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js',
              ),
            ),
            'fslightbox' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/fslightbox.js',
                'cdn' => '//fastly.jsdelivr.net/npm/fslightbox@3.4.1/index.min.js',
              ),
            ),
            'datatables' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/datatables/media/js/jquery.dataTables.min.js',
                  1 => '/vendor/core/core/base/libraries/datatables/media/js/dataTables.bootstrap.min.js',
                  2 => '/vendor/core/core/base/libraries/datatables/extensions/Buttons/js/dataTables.buttons.min.js',
                  3 => '/vendor/core/core/base/libraries/datatables/extensions/Buttons/js/buttons.bootstrap.min.js',
                  4 => '/vendor/core/core/base/libraries/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
                ),
              ),
            ),
            'raphael' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/raphael-min.js',
                ),
              ),
            ),
            'morris' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/morris/morris.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
              ),
            ),
            'select2' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/select2/js/select2.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
              ),
            ),
            'cropper' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/cropper/cropper.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js',
              ),
            ),
            'datepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/flatpickr/flatpickr.min.js',
                'cdn' => '//fastly.jsdelivr.net/npm/flatpickr',
              ),
            ),
            'sortable' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/sortable/sortable.min.js',
              ),
            ),
            'jquery-nestable' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-nestable/jquery.nestable.min.js',
              ),
            ),
            'custom-scrollbar' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js',
              ),
            ),
            'stickytableheaders' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/stickytableheaders/jquery.stickytableheaders.js',
              ),
            ),
            'are-you-sure' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery.are-you-sure/jquery.are-you-sure.js',
              ),
            ),
            'moment' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/moment-with-locales.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js',
              ),
            ),
            'datetimepicker' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
              ),
            ),
            'jquery-waypoints' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.min.js',
              ),
            ),
            'colorpicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
              ),
            ),
            'timepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
              ),
            ),
            'spectrum' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/spectrum/spectrum.js',
              ),
            ),
            'input-mask' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-inputmask/jquery.inputmask.bundle.min.js',
              ),
            ),
            'form-validation' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/js-validation/js/js-validation.js',
              ),
            ),
            'apexchart' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/apexchart/apexcharts.min.js',
              ),
            ),
            'coloris' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/coloris/coloris.min.js',
                'cdn' => '//fastly.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js',
              ),
            ),
            'tagify' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/tagify/tagify.js',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/tagify/4.16.4/tagify.min.js',
              ),
            ),
          ),
          'styles' => 
          array (
            'core' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/css/core.css',
              ),
            ),
            'fontawesome' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/font-awesome/css/fontawesome.min.css',
                'cdn' => '//use.fontawesome.com/releases/v6.1.1/css/all.css',
              ),
            ),
            'dropzone' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/dropzone/dropzone.css',
              ),
            ),
            'jqueryTree' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-tree/jquery.tree.min.css',
              ),
            ),
            'jqueryTreeView' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-treeview/jquery.treeview.min.css',
              ),
            ),
            'jquery-ui' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-ui/jquery-ui.min.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css',
              ),
            ),
            'toastr' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/toastr/toastr.min.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.css',
              ),
            ),
            'kendo' => 
            array (
              'use_cdn' => false,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/kendo/kendo.min.css',
              ),
            ),
            'datatables' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/datatables/media/css/dataTables.bootstrap.min.css',
                  1 => '/vendor/core/core/base/libraries/datatables/extensions/Buttons/css/buttons.bootstrap.min.css',
                  2 => '/vendor/core/core/base/libraries/datatables/extensions/Responsive/css/responsive.bootstrap.min.css',
                ),
              ),
            ),
            'bootstrap-editable' => 
            array (
              'use_cdn' => true,
              'location' => 'footer',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap3-editable/css/bootstrap-editable.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css',
              ),
            ),
            'morris' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/morris/morris.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css',
              ),
            ),
            'cropper' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/cropper/cropper.min.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css',
              ),
            ),
            'datepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/flatpickr/flatpickr.min.css',
                'cdn' => '//fastly.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
              ),
            ),
            'jquery-nestable' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/jquery-nestable/jquery.nestable.min.css',
              ),
            ),
            'select2' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => 
                array (
                  0 => '/vendor/core/core/base/libraries/select2/css/select2.min.css',
                  1 => '/vendor/core/core/base/css/libraries/select2.css',
                ),
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',
              ),
            ),
            'fancybox' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.css',
                'cdn' => '//fastly.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css',
              ),
            ),
            'custom-scrollbar' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.css',
              ),
            ),
            'datetimepicker' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
              ),
            ),
            'colorpicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
              ),
            ),
            'timepicker' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
              ),
            ),
            'spectrum' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/spectrum/spectrum.css',
              ),
            ),
            'apexchart' => 
            array (
              'use_cdn' => false,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/apexchart/apexcharts.css',
              ),
            ),
            'coloris' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/coloris/coloris.min.css',
                'cdn' => '//fastly.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css',
              ),
            ),
            'tagify' => 
            array (
              'use_cdn' => true,
              'location' => 'header',
              'src' => 
              array (
                'local' => '/vendor/core/core/base/libraries/tagify/tagify.css',
                'cdn' => '//cdnjs.cloudflare.com/ajax/libs/tagify/4.16.4/tagify.css',
              ),
            ),
          ),
        ),
      ),
    ),
    'setting' => 
    array (
      'general' => 
      array (
        'driver' => 'database',
        'enable_email_smtp_settings' => true,
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Settings',
          'flag' => 'settings.index',
        ),
        1 => 
        array (
          'name' => 'Common',
          'flag' => 'settings.common',
          'parent_flag' => 'settings.index',
        ),
        2 => 
        array (
          'name' => 'General',
          'flag' => 'settings.options',
          'parent_flag' => 'settings.common',
        ),
        3 => 
        array (
          'name' => 'Email',
          'flag' => 'settings.email',
          'parent_flag' => 'settings.common',
        ),
        4 => 
        array (
          'name' => 'Media',
          'flag' => 'settings.media',
          'parent_flag' => 'settings.common',
        ),
        5 => 
        array (
          'name' => 'Admin Appearance',
          'flag' => 'settings.admin-appearance',
          'parent_flag' => 'settings.common',
        ),
        6 => 
        array (
          'name' => 'Cache',
          'flag' => 'settings.cache',
          'parent_flag' => 'settings.common',
        ),
        7 => 
        array (
          'name' => 'Datatables',
          'flag' => 'settings.datatables',
          'parent_flag' => 'settings.common',
        ),
        8 => 
        array (
          'name' => 'Email Rules',
          'flag' => 'settings.email.rules',
          'parent_flag' => 'settings.common',
        ),
        9 => 
        array (
          'name' => 'Others',
          'flag' => 'settings.others',
          'parent_flag' => 'settings.index',
        ),
      ),
      'email' => 
      array (
        'name' => 'core/setting::setting.email.base_template',
        'description' => 'core/setting::setting.email.base_template_description',
        'templates' => 
        array (
          'header' => 
          array (
            'title' => 'core/setting::setting.email.template_header',
            'description' => 'core/setting::setting.email.template_header_description',
          ),
          'footer' => 
          array (
            'title' => 'core/setting::setting.email.template_footer',
            'description' => 'core/setting::setting.email.template_footer_description',
          ),
        ),
      ),
    ),
    'icon' => 
    array (
      'icon' => 
      array (
        'className' => 'icon',
        'attributes' => 
        array (
        ),
      ),
    ),
    'acl' => 
    array (
      'general' => 
      array (
        'activations' => 
        array (
          'expires' => 259200,
          'lottery' => 
          array (
            0 => 2,
            1 => 100,
          ),
        ),
        'backgrounds' => 
        array (
          0 => 'vendor/core/core/acl/images/backgrounds/1.jpg',
          1 => 'vendor/core/core/acl/images/backgrounds/2.jpg',
          2 => 'vendor/core/core/acl/images/backgrounds/3.jpg',
          3 => 'vendor/core/core/acl/images/backgrounds/4.jpg',
          4 => 'vendor/core/core/acl/images/backgrounds/5.jpg',
          5 => 'vendor/core/core/acl/images/backgrounds/6.jpg',
          6 => 'vendor/core/core/acl/images/backgrounds/7.jpg',
          7 => 'vendor/core/core/acl/images/backgrounds/8.jpg',
          8 => 'vendor/core/core/acl/images/backgrounds/9.jpg',
          9 => 'vendor/core/core/acl/images/backgrounds/10.jpg',
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Users',
          'flag' => 'users.index',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'users.create',
          'parent_flag' => 'users.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'users.edit',
          'parent_flag' => 'users.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'users.destroy',
          'parent_flag' => 'users.index',
        ),
        4 => 
        array (
          'name' => 'Roles',
          'flag' => 'roles.index',
          'parent_flag' => 'core.system',
        ),
        5 => 
        array (
          'name' => 'Create',
          'flag' => 'roles.create',
          'parent_flag' => 'roles.index',
        ),
        6 => 
        array (
          'name' => 'Edit',
          'flag' => 'roles.edit',
          'parent_flag' => 'roles.index',
        ),
        7 => 
        array (
          'name' => 'Delete',
          'flag' => 'roles.destroy',
          'parent_flag' => 'roles.index',
        ),
      ),
      'email' => 
      array (
        'name' => 'core/acl::auth.settings.email.title',
        'description' => 'core/acl::auth.settings.email.description',
        'templates' => 
        array (
          'password-reminder' => 
          array (
            'title' => 'core/acl::auth.settings.email.templates.password_reminder.title',
            'description' => 'core/acl::auth.settings.email.templates.password_reminder.description',
            'subject' => 'core/acl::auth.settings.email.templates.password_reminder.subject',
            'can_off' => false,
            'variables' => 
            array (
              'reset_link' => 'core/acl::auth.settings.email.templates.password_reminder.reset_link',
            ),
          ),
        ),
      ),
    ),
    'media' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Media',
          'flag' => 'media.index',
          'parent_flag' => 'core.cms',
        ),
        1 => 
        array (
          'name' => 'File',
          'flag' => 'files.index',
          'parent_flag' => 'media.index',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'files.create',
          'parent_flag' => 'files.index',
        ),
        3 => 
        array (
          'name' => 'Edit',
          'flag' => 'files.edit',
          'parent_flag' => 'files.index',
        ),
        4 => 
        array (
          'name' => 'Trash',
          'flag' => 'files.trash',
          'parent_flag' => 'files.index',
        ),
        5 => 
        array (
          'name' => 'Delete',
          'flag' => 'files.destroy',
          'parent_flag' => 'files.index',
        ),
        6 => 
        array (
          'name' => 'Folder',
          'flag' => 'folders.index',
          'parent_flag' => 'media.index',
        ),
        7 => 
        array (
          'name' => 'Create',
          'flag' => 'folders.create',
          'parent_flag' => 'folders.index',
        ),
        8 => 
        array (
          'name' => 'Edit',
          'flag' => 'folders.edit',
          'parent_flag' => 'folders.index',
        ),
        9 => 
        array (
          'name' => 'Trash',
          'flag' => 'folders.trash',
          'parent_flag' => 'folders.index',
        ),
        10 => 
        array (
          'name' => 'Delete',
          'flag' => 'folders.destroy',
          'parent_flag' => 'folders.index',
        ),
      ),
      'media' => 
      array (
        'sizes' => 
        array (
          'thumb' => '150x150',
        ),
        'permissions' => 
        array (
          0 => 'folders.create',
          1 => 'folders.edit',
          2 => 'folders.trash',
          3 => 'folders.destroy',
          4 => 'files.create',
          5 => 'files.edit',
          6 => 'files.trash',
          7 => 'files.destroy',
          8 => 'files.favorite',
          9 => 'folders.favorite',
        ),
        'libraries' => 
        array (
          'stylesheets' => 
          array (
            0 => 'vendor/core/core/media/libraries/jquery-context-menu/jquery.contextMenu.min.css',
            1 => 'vendor/core/core/media/css/media.css',
          ),
          'javascript' => 
          array (
            0 => 'vendor/core/core/media/libraries/lodash/lodash.min.js',
            1 => 'vendor/core/core/base/libraries/dropzone/dropzone.js',
            2 => 'vendor/core/core/media/libraries/jquery-context-menu/jquery.ui.position.min.js',
            3 => 'vendor/core/core/media/libraries/jquery-context-menu/jquery.contextMenu.min.js',
            4 => 'vendor/core/core/media/js/media.js',
          ),
        ),
        'allowed_mime_types' => 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,xls,xlsx,ppt,pptx,pdf,mp4,m4v,doc,mpga,wav,webp,webm,mov,jfif,avif,rar,x-rar',
        'allowed_admin_to_upload_any_file_types' => false,
        'mime_types' => 
        array (
          'image' => 
          array (
            0 => 'image/png',
            1 => 'image/jpeg',
            2 => 'image/gif',
            3 => 'image/bmp',
            4 => 'image/svg+xml',
            5 => 'image/webp',
            6 => 'image/avif',
          ),
          'video' => 
          array (
            0 => 'video/mp4',
            1 => 'video/m4v',
            2 => 'video/mov',
            3 => 'video/quicktime',
          ),
          'document' => 
          array (
            0 => 'application/pdf',
            1 => 'application/vnd.ms-excel',
            2 => 'application/excel',
            3 => 'application/x-excel',
            4 => 'application/x-msexcel',
            5 => 'text/plain',
            6 => 'application/msword',
            7 => 'text/csv',
            8 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            9 => 'application/vnd.ms-powerpoint',
            10 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
          ),
          'zip' => 
          array (
            0 => 'application/zip',
            1 => 'application/x-zip-compressed',
            2 => 'application/x-compressed',
            3 => 'multipart/x-zip',
            4 => 'multipart/x-rar',
          ),
          'audio' => 
          array (
            0 => 'audio/mpeg',
            1 => 'audio/mp3',
            2 => 'audio/wav',
          ),
        ),
        'default_image' => '/vendor/core/core/base/images/placeholder.png',
        'sidebar_display' => 'horizontal',
        'watermark' => 
        array (
          'enabled' => 0,
          'source' => NULL,
          'size' => 10,
          'opacity' => 70,
          'position' => 'bottom-right',
          'x' => 10,
          'y' => 10,
        ),
        'chunk' => 
        array (
          'enabled' => false,
          'chunk_size' => 1048576,
          'max_file_size' => 1048576,
          'storage' => 
          array (
            'chunks' => 'chunks',
            'disk' => 'local',
          ),
          'clear' => 
          array (
            'timestamp' => '-3 HOURS',
            'schedule' => 
            array (
              'enabled' => true,
              'cron' => '25 * * * *',
            ),
          ),
          'chunk' => 
          array (
            'name' => 
            array (
              'use' => 
              array (
                'session' => true,
                'browser' => false,
              ),
            ),
          ),
        ),
        'preview' => 
        array (
          'document' => 
          array (
            'enabled' => true,
            'providers' => 
            array (
              'google' => 'https://docs.google.com/gview?embedded=true&url={url}',
              'microsoft' => 'https://view.officeapps.live.com/op/view.aspx?src={url}',
            ),
            'default' => 'microsoft',
            'type' => 'iframe',
            'mime_types' => 
            array (
              0 => 'application/pdf',
              1 => 'application/vnd.ms-excel',
              2 => 'application/excel',
              3 => 'application/x-excel',
              4 => 'application/x-msexcel',
              5 => 'application/msword',
              6 => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
              7 => 'application/vnd.ms-powerpoint',
              8 => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
              9 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ),
          ),
        ),
        'default_upload_folder' => NULL,
        'default_upload_url' => NULL,
        'generate_thumbnails_enabled' => true,
        'generate_thumbnails_chunk_limit' => 50,
        'folder_colors' => 
        array (
          0 => '#3498db',
          1 => '#2ecc71',
          2 => '#e74c3c',
          3 => '#f39c12',
          4 => '#9b59b6',
          5 => '#1abc9c',
          6 => '#34495e',
          7 => '#e67e22',
          8 => '#27ae60',
          9 => '#c0392b',
        ),
        'use_storage_symlink' => false,
      ),
    ),
    'js-validation' => 
    array (
      'js-validation' => 
      array (
        'view' => 'core/js-validation::bootstrap',
        'form_selector' => 'form',
        'focus_on_error' => false,
        'duration_animate' => 1000,
        'disable_remote_validation' => false,
        'remote_validation_field' => '_js_validation',
        'escape' => false,
        'ignore' => '',
      ),
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'capture_ajax' => false,
    'remote_sites_path' => '',
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'localhost',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'token_prefix' => '',
    'middleware' => 
    array (
      'authenticate_session' => 'Laravel\\Sanctum\\Http\\Middleware\\AuthenticateSession',
      'encrypt_cookies' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
      'validate_csrf_token' => 'Illuminate\\Foundation\\Http\\Middleware\\ValidateCsrfToken',
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => true,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
      'cells' => 
      array (
        'middleware' => 
        array (
        ),
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
      'default_ttl' => 10800,
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => '/var/www/html/storage/framework/cache/laravel-excel',
      'local_permissions' => 
      array (
      ),
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'purifier' => 
  array (
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => '/var/www/html/storage/app/purifier',
    'cacheFileMode' => 493,
    'settings' => 
    array (
      'default' => 
      array (
        'HTML.Doctype' => 'HTML 4.01 Transitional',
        'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title|rel|style|target|dofollow|nofollow],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style|loading],button,ins[style|data-ad-client|data-ad-slot|data-ad-format|data-full-width-responsive],video[src|type|width|height|preload|controls|autoplay|autostart|poster|id|class,muted,loop],meta[name|content|property],link[media|type|rel|href]',
        'HTML.AllowedElements' => 
        array (
          0 => 'a',
          1 => 'b',
          2 => 'blockquote',
          3 => 'br',
          4 => 'code',
          5 => 'em',
          6 => 'h1',
          7 => 'h2',
          8 => 'h3',
          9 => 'h4',
          10 => 'h5',
          11 => 'h6',
          12 => 'hr',
          13 => 'i',
          14 => 'img',
          15 => 'li',
          16 => 'ol',
          17 => 'p',
          18 => 'pre',
          19 => 's',
          20 => 'span',
          21 => 'strong',
          22 => 'sub',
          23 => 'sup',
          24 => 'table',
          25 => 'tbody',
          26 => 'td',
          27 => 'dl',
          28 => 'dt',
          29 => 'dd',
          30 => 'th',
          31 => 'thead',
          32 => 'tr',
          33 => 'u',
          34 => 'ul',
          35 => 'pre',
          36 => 'abbr',
          37 => 'kbd',
          38 => 'var',
          39 => 'samp',
          40 => 'hr',
          41 => 'iframe',
          42 => 'figure',
          43 => 'figcaption',
          44 => 'section',
          45 => 'article',
          46 => 'aside',
          47 => 'blockquote',
          48 => 'caption',
          49 => 'del',
          50 => 'div',
          51 => 'button',
          52 => 'ins',
          53 => 'video',
          54 => 'source',
          55 => 'meta',
          56 => 'link',
          57 => 'audio',
        ),
        'HTML.SafeIframe' => 'true',
        'Attr.AllowedFrameTargets' => 
        array (
          0 => '_blank',
        ),
        'CSS.AllowedProperties' => 
        array (
          0 => 'font',
          1 => 'font-size',
          2 => 'font-weight',
          3 => 'font-style',
          4 => 'font-family',
          5 => 'text-decoration',
          6 => 'padding-left',
          7 => 'color',
          8 => 'background-color',
          9 => 'text-align',
          10 => 'max-width',
          11 => 'border',
          12 => 'width',
          13 => 'line-height',
          14 => 'word-spacing',
          15 => 'border-style',
          16 => 'list-style-type',
          17 => 'border-color',
          18 => 'height',
          19 => 'min-width',
          20 => 'min-height',
          21 => 'max-height',
          22 => 'list-style',
          23 => 'margin',
          24 => 'margin-bottom',
          25 => 'margin-left',
          26 => 'margin-right',
          27 => 'margin-top',
          28 => 'padding',
          29 => 'height',
          30 => 'line-height',
          31 => 'border-collapse',
        ),
        'CSS.MaxImgLength' => NULL,
        'AutoFormat.AutoParagraph' => false,
        'AutoFormat.RemoveEmpty' => false,
        'Attr.EnableID' => true,
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/|maps.google.com/maps|www.google.com/maps|docs.google.com/|drive.google.com/|view.officeapps.live.com/op/embed.aspx|onedrive.live.com/embed|open.spotify.com/embed|localhost)%',
      ),
      'test' => 
      array (
        'Attr.EnableID' => 'true',
      ),
      'youtube' => 
      array (
        'HTML.SafeIframe' => 'true',
        'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
      ),
      'custom_definition' => 
      array (
        'id' => 'html5-definitions',
        'rev' => 1,
        'debug' => false,
        'elements' => 
        array (
          0 => 
          array (
            0 => 'section',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          1 => 
          array (
            0 => 'nav',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          2 => 
          array (
            0 => 'article',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          3 => 
          array (
            0 => 'aside',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          4 => 
          array (
            0 => 'header',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          5 => 
          array (
            0 => 'footer',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          6 => 
          array (
            0 => 'address',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
          ),
          7 => 
          array (
            0 => 'hgroup',
            1 => 'Block',
            2 => 'Required: h1 | h2 | h3 | h4 | h5 | h6',
            3 => 'Common',
          ),
          8 => 
          array (
            0 => 'figure',
            1 => 'Block',
            2 => 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
            3 => 'Common',
          ),
          9 => 
          array (
            0 => 'figcaption',
            1 => 'Inline',
            2 => 'Flow',
            3 => 'Common',
          ),
          10 => 
          array (
            0 => 'video',
            1 => 'Block',
            2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
              'width' => 'Length',
              'height' => 'Length',
              'poster' => 'URI',
              'preload' => 'Enum#auto,metadata,none',
              'controls' => 'Bool',
            ),
          ),
          11 => 
          array (
            0 => 'source',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'src' => 'URI',
              'type' => 'Text',
            ),
          ),
          12 => 
          array (
            0 => 's',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          13 => 
          array (
            0 => 'var',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          14 => 
          array (
            0 => 'sub',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          15 => 
          array (
            0 => 'sup',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          16 => 
          array (
            0 => 'mark',
            1 => 'Inline',
            2 => 'Inline',
            3 => 'Common',
          ),
          17 => 
          array (
            0 => 'wbr',
            1 => 'Inline',
            2 => 'Empty',
            3 => 'Core',
          ),
          18 => 
          array (
            0 => 'ins',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
          19 => 
          array (
            0 => 'del',
            1 => 'Block',
            2 => 'Flow',
            3 => 'Common',
            4 => 
            array (
              'cite' => 'URI',
              'datetime' => 'CDATA',
            ),
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            0 => 'iframe',
            1 => 'allowfullscreen',
            2 => 'Bool',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'height',
            2 => 'Text',
          ),
          2 => 
          array (
            0 => 'td',
            1 => 'border',
            2 => 'Text',
          ),
          3 => 
          array (
            0 => 'th',
            1 => 'border',
            2 => 'Text',
          ),
          4 => 
          array (
            0 => 'tr',
            1 => 'width',
            2 => 'Text',
          ),
          5 => 
          array (
            0 => 'tr',
            1 => 'height',
            2 => 'Text',
          ),
          6 => 
          array (
            0 => 'tr',
            1 => 'border',
            2 => 'Text',
          ),
        ),
      ),
      'custom_attributes' => 
      array (
        0 => 
        array (
          0 => 'a',
          1 => 'rel',
          2 => 'Text',
        ),
        1 => 
        array (
          0 => 'a',
          1 => 'dofollow',
          2 => 'Bool',
        ),
        2 => 
        array (
          0 => 'a',
          1 => 'nofollow',
          2 => 'Bool',
        ),
        3 => 
        array (
          0 => 'span',
          1 => 'data-period',
          2 => 'Text',
        ),
        4 => 
        array (
          0 => 'span',
          1 => 'data-type',
          2 => 'Text',
        ),
        5 => 
        array (
          0 => 'ins',
          1 => 'data-ad-client',
          2 => 'Text',
        ),
        6 => 
        array (
          0 => 'ins',
          1 => 'data-ad-slot',
          2 => 'Text',
        ),
        7 => 
        array (
          0 => 'ins',
          1 => 'data-ad-format',
          2 => 'Text',
        ),
        8 => 
        array (
          0 => 'ins',
          1 => 'data-ad-full-width-responsive',
          2 => 'Text',
        ),
        9 => 
        array (
          0 => 'img',
          1 => 'data-src',
          2 => 'Text',
        ),
        10 => 
        array (
          0 => 'img',
          1 => 'loading',
          2 => 'Text',
        ),
        11 => 
        array (
          0 => 'video',
          1 => 'autoplay',
          2 => 'Bool',
        ),
        12 => 
        array (
          0 => 'video',
          1 => 'muted',
          2 => 'Bool',
        ),
        13 => 
        array (
          0 => 'video',
          1 => 'loop',
          2 => 'Bool',
        ),
        14 => 
        array (
          0 => 'meta',
          1 => 'name',
          2 => 'Text',
        ),
        15 => 
        array (
          0 => 'meta',
          1 => 'content',
          2 => 'Text',
        ),
        16 => 
        array (
          0 => 'meta',
          1 => 'property',
          2 => 'Text',
        ),
        17 => 
        array (
          0 => 'link',
          1 => 'media',
          2 => 'Text',
        ),
        18 => 
        array (
          0 => 'link',
          1 => 'type',
          2 => 'Text',
        ),
        19 => 
        array (
          0 => 'link',
          1 => 'rel',
          2 => 'Text',
        ),
        20 => 
        array (
          0 => 'link',
          1 => 'href',
          2 => 'Text',
        ),
        21 => 
        array (
          0 => 'link',
          1 => 'color',
          2 => 'Text',
        ),
        22 => 
        array (
          0 => 'audio',
          1 => 'controls',
          2 => 'Bool',
        ),
        23 => 
        array (
          0 => 'div',
          1 => 'data-bs-theme',
          2 => 'Text',
        ),
        24 => 
        array (
          0 => 'div',
          1 => 'data-url',
          2 => 'Text',
        ),
        25 => 
        array (
          0 => 'button',
          1 => 'data-bb-toggle',
          2 => 'Text',
        ),
        26 => 
        array (
          0 => 'button',
          1 => 'data-value',
          2 => 'Text',
        ),
      ),
      'custom_elements' => 
      array (
        0 => 
        array (
          0 => 'u',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        1 => 
        array (
          0 => 'button',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        2 => 
        array (
          0 => 'ins',
          1 => 'Inline',
          2 => 'Inline',
          3 => 'Common',
        ),
        3 => 
        array (
          0 => 'meta',
          1 => 'Inline',
          2 => 'Empty',
          3 => 'Common',
        ),
        4 => 
        array (
          0 => 'link',
          1 => 'Inline',
          2 => 'Empty',
          3 => 'Common',
        ),
        5 => 
        array (
          0 => 'audio',
          1 => 'Block',
          2 => 'Optional: (source, Flow) | (Flow, source) | Flow',
          3 => 'Common',
        ),
      ),
    ),
  ),
  'mollie' => 
  array (
    'key' => NULL,
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => 'App\\Models',
    ),
    'pdf_generator' => 'excel',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'excel',
        1 => 'csv',
        2 => 'pdf',
        3 => 'print',
        4 => 'reset',
        5 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'excel,csv,pdf,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Botble\\Table\\EloquentDataTable',
      'query' => 'Botble\\Table\\QueryDataTable',
      'collection' => 'Botble\\Table\\CollectionDataTable',
      'resource' => 'Botble\\Table\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
  ),
  'packages' => 
  array (
    'api' => 
    array (
      'api' => 
      array (
        'provider' => 
        array (
          'model' => 'Botble\\ACL\\Models\\User',
          'guard' => 'web',
          'password_broker' => 'users',
          'verify_email' => false,
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'API',
          'flag' => 'api.settings',
          'parent_flag' => 'settings.index',
        ),
        1 => 
        array (
          'name' => 'Sanctum Token',
          'flag' => 'api.sanctum-token.index',
          'parent_flag' => 'api.settings',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'api.sanctum-token.create',
          'parent_flag' => 'api.sanctum-token.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'api.sanctum-token.destroy',
          'parent_flag' => 'api.sanctum-token.index',
        ),
      ),
    ),
    'data-synchronize' => 
    array (
      'data-synchronize' => 
      array (
        'mime_types' => 
        array (
          0 => 'application/vnd.ms-excel',
          1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
          2 => 'text/csv',
          3 => 'application/csv',
          4 => 'text/plain',
        ),
        'extensions' => 
        array (
          0 => 'csv',
          1 => 'xls',
          2 => 'xlsx',
        ),
        'storage' => 
        array (
          'disk' => 'local',
          'path' => 'data-synchronize',
        ),
      ),
    ),
    'installer' => 
    array (
      'installer' => 
      array (
        'enabled' => true,
        'requirements' => 
        array (
          'php' => 
          array (
            0 => 'openssl',
            1 => 'pdo',
            2 => 'mbstring',
            3 => 'tokenizer',
            4 => 'JSON',
            5 => 'cURL',
            6 => 'gd',
            7 => 'fileinfo',
            8 => 'xml',
            9 => 'ctype',
          ),
          'apache' => 
          array (
            0 => 'mod_rewrite',
          ),
          'permissions' => 
          array (
            0 => '.env',
            1 => 'storage/framework/',
            2 => 'storage/logs/',
            3 => 'bootstrap/cache/',
          ),
        ),
      ),
    ),
    'menu' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Menu',
          'flag' => 'menus.index',
          'parent_flag' => 'core.appearance',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'menus.create',
          'parent_flag' => 'menus.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'menus.edit',
          'parent_flag' => 'menus.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'menus.destroy',
          'parent_flag' => 'menus.index',
        ),
      ),
      'general' => 
      array (
        'locations' => 
        array (
          'main-menu' => 'Main Navigation',
        ),
        'cache' => 
        array (
          'enabled' => false,
        ),
      ),
    ),
    'optimize' => 
    array (
      'general' => 
      array (
        'skip' => 
        array (
          0 => '*.xml',
          1 => '*.less',
          2 => '*.pdf',
          3 => '*.doc',
          4 => '*.txt',
          5 => '*.ico',
          6 => '*.rss',
          7 => '*.zip',
          8 => '*.mp3',
          9 => '*.rar',
          10 => '*.exe',
          11 => '*.wmv',
          12 => '*.doc',
          13 => '*.avi',
          14 => '*.ppt',
          15 => '*.mpg',
          16 => '*.mpeg',
          17 => '*.tif',
          18 => '*.wav',
          19 => '*.mov',
          20 => '*.psd',
          21 => '*.ai',
          22 => '*.xls',
          23 => '*.mp4',
          24 => '*.m4a',
          25 => '*.swf',
          26 => '*.dat',
          27 => '*.dmg',
          28 => '*.iso',
          29 => '*.flv',
          30 => '*.m4v',
          31 => '*.torrent',
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Optimize',
          'flag' => 'optimize.settings',
          'parent_flag' => 'settings.common',
        ),
      ),
    ),
    'page' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Pages',
          'flag' => 'pages.index',
          'parent_flag' => 'core.cms',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'pages.create',
          'parent_flag' => 'pages.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'pages.edit',
          'parent_flag' => 'pages.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'pages.destroy',
          'parent_flag' => 'pages.index',
        ),
      ),
      'general' => 
      array (
        'templates' => 
        array (
          'default' => 'Default',
        ),
      ),
    ),
    'plugin-management' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Plugins',
          'flag' => 'plugins.index',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Activate/Deactivate',
          'flag' => 'plugins.edit',
          'parent_flag' => 'plugins.index',
        ),
        2 => 
        array (
          'name' => 'Remove',
          'flag' => 'plugins.remove',
          'parent_flag' => 'plugins.index',
        ),
        3 => 
        array (
          'name' => 'Add New Plugins',
          'flag' => 'plugins.marketplace',
          'parent_flag' => 'plugins.index',
        ),
      ),
      'general' => 
      array (
        'enable_plugin_manager' => true,
        'hide_plugin_author' => false,
        'enable_plugin_list_cache' => false,
        'enable_marketplace_feature' => true,
      ),
    ),
    'revision' => 
    array (
      'general' => 
      array (
        'supported' => 
        array (
          0 => 'Botble\\Page\\Models\\Page',
          1 => 'Botble\\Blog\\Models\\Post',
        ),
      ),
    ),
    'seo-helper' => 
    array (
      'general' => 
      array (
        'title' => 
        array (
          'separator' => '-',
          'first' => true,
          'max' => 120,
        ),
        'description' => 
        array (
          'max' => 386,
        ),
        'misc' => 
        array (
          'canonical' => true,
          'robots' => false,
          'default' => 
          array (
            'author' => '',
            'publisher' => '',
          ),
        ),
        'webmasters' => 
        array (
          'google' => '',
          'bing' => '',
          'alexa' => '',
          'pinterest' => '',
          'yandex' => '',
        ),
        'open-graph' => 
        array (
          'prefix' => 'og:',
          'type' => 'website',
          'properties' => 
          array (
          ),
        ),
        'twitter' => 
        array (
          'prefix' => 'twitter:',
          'card' => 'summary',
          'metas' => 
          array (
          ),
        ),
        'analytics' => 
        array (
          'google' => '',
        ),
        'supported' => 
        array (
          0 => 'Botble\\Page\\Models\\Page',
          1 => 'Botble\\Marketplace\\Models\\Store',
          2 => 'Botble\\Blog\\Models\\Post',
          3 => 'Botble\\Blog\\Models\\Category',
          4 => 'Botble\\Blog\\Models\\Tag',
          5 => 'Botble\\Ecommerce\\Models\\Product',
          6 => 'Botble\\Ecommerce\\Models\\Brand',
          7 => 'Botble\\Ecommerce\\Models\\ProductCategory',
          8 => 'Botble\\Ecommerce\\Models\\ProductTag',
        ),
      ),
    ),
    'sitemap' => 
    array (
      'config' => 
      array (
        'use_cache' => false,
        'cache_key' => 'cms-sitemap.',
        'cache_duration' => 3600,
        'escaping' => true,
        'use_limit_size' => false,
        'max_size' => NULL,
        'use_styles' => true,
        'styles_location' => '/vendor/core/packages/sitemap/styles/',
        'use_gzip' => false,
      ),
    ),
    'slug' => 
    array (
      'general' => 
      array (
        'pattern' => '--slug--',
        'supported' => 
        array (
          'Botble\\Page\\Models\\Page' => 'Pages',
        ),
        'prefixes' => 
        array (
        ),
        'disable_preview' => 
        array (
        ),
        'slug_generated_columns' => 
        array (
        ),
        'enable_slug_translator' => false,
      ),
    ),
    'theme' => 
    array (
      'general' => 
      array (
        'themeDefault' => 'default',
        'layoutDefault' => 'default',
        'themeDir' => 'themes',
        'containerDir' => 
        array (
          'layout' => 'layouts',
          'asset' => '',
          'partial' => 'partials',
          'view' => 'views',
        ),
        'events' => 
        array (
        ),
        'enable_custom_js' => true,
        'enable_custom_html' => true,
        'enable_custom_html_shortcode' => true,
        'enable_robots_txt_editor' => true,
        'public_theme_name' => NULL,
        'display_theme_manager_in_admin_panel' => true,
        'public_single_ending_url' => NULL,
        'extra_date_format' => NULL,
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Appearance',
          'flag' => 'core.appearance',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Theme',
          'flag' => 'theme.index',
          'parent_flag' => 'core.appearance',
        ),
        2 => 
        array (
          'name' => 'Activate',
          'flag' => 'theme.activate',
          'parent_flag' => 'theme.index',
        ),
        3 => 
        array (
          'name' => 'Remove',
          'flag' => 'theme.remove',
          'parent_flag' => 'theme.index',
        ),
        4 => 
        array (
          'name' => 'Theme options',
          'flag' => 'theme.options',
          'parent_flag' => 'core.appearance',
        ),
        5 => 
        array (
          'name' => 'Custom CSS',
          'flag' => 'theme.custom-css',
          'parent_flag' => 'core.appearance',
        ),
        6 => 
        array (
          'name' => 'Custom JS',
          'flag' => 'theme.custom-js',
          'parent_flag' => 'core.appearance',
        ),
        7 => 
        array (
          'name' => 'Custom HTML',
          'flag' => 'theme.custom-html',
          'parent_flag' => 'core.appearance',
        ),
        8 => 
        array (
          'name' => 'Robots.txt Editor',
          'flag' => 'theme.robots-txt',
          'parent_flag' => 'core.appearance',
        ),
        9 => 
        array (
          'name' => 'Website Tracking',
          'flag' => 'settings.website-tracking',
          'parent_flag' => 'settings.common',
        ),
      ),
    ),
    'widget' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Widgets',
          'flag' => 'widgets.index',
          'parent_flag' => 'core.appearance',
        ),
      ),
    ),
  ),
  'assets' => 
  array (
    'offline' => true,
    'enable_version' => false,
    'version' => 1773226626,
    'scripts' => 
    array (
      0 => 'modernizr',
      1 => 'app',
    ),
    'styles' => 
    array (
      0 => 'bootstrap',
    ),
    'resources' => 
    array (
      'scripts' => 
      array (
        'app' => 
        array (
          'use_cdn' => false,
          'location' => 'footer',
          'src' => 
          array (
            'local' => '/js/app.js',
          ),
        ),
        'modernizr' => 
        array (
          'use_cdn' => true,
          'location' => 'header',
          'src' => 
          array (
            'local' => '/vendor/core/packages/modernizr/modernizr.min.js',
            'cdn' => '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',
          ),
        ),
      ),
      'styles' => 
      array (
        'bootstrap' => 
        array (
          'use_cdn' => true,
          'location' => 'header',
          'src' => 
          array (
            'local' => '/packages/bootstrap/css/bootstrap.min.css',
            'cdn' => '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css',
          ),
          'attributes' => 
          array (
            'integrity' => 'sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB',
            'crossorigin' => 'anonymous',
          ),
        ),
      ),
    ),
  ),
  'ziggy' => 
  array (
    'except' => 
    array (
      0 => 'debugbar.*',
    ),
  ),
  'plugins' => 
  array (
    'language' => 
    array (
      'general' => 
      array (
        'supported' => 
        array (
          0 => 'Botble\\Menu\\Models\\Menu',
          1 => 'Botble\\Menu\\Models\\MenuNode',
          2 => 'Botble\\SimpleSlider\\Models\\SimpleSlider',
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Languages',
          'flag' => 'languages.index',
          'parent_flag' => 'settings.common',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'languages.create',
          'parent_flag' => 'languages.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'languages.edit',
          'parent_flag' => 'languages.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'languages.destroy',
          'parent_flag' => 'languages.index',
        ),
      ),
    ),
    'language-advanced' => 
    array (
      'general' => 
      array (
        'supported' => 
        array (
          'Botble\\Page\\Models\\Page' => 
          array (
            0 => 'name',
            1 => 'description',
            2 => 'content',
            3 => 'faq_schema_config',
            4 => 'faq_ids',
          ),
          'Botble\\Slug\\Models\\Slug' => 
          array (
            0 => 'key',
            1 => 'prefix',
          ),
          'Botble\\Ads\\Models\\Ads' => 
          array (
            0 => 'name',
            1 => 'image',
            2 => 'url',
          ),
          'Botble\\Blog\\Models\\Post' => 
          array (
            0 => 'name',
            1 => 'description',
            2 => 'content',
            3 => 'faq_schema_config',
            4 => 'faq_ids',
          ),
          'Botble\\Blog\\Models\\Category' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Blog\\Models\\Tag' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Contact\\Models\\CustomField' => 
          array (
            0 => 'name',
            1 => 'placeholder',
          ),
          'Botble\\Contact\\Models\\CustomFieldOption' => 
          array (
            0 => 'label',
          ),
          'Botble\\Ecommerce\\Models\\Product' => 
          array (
            0 => 'name',
            1 => 'description',
            2 => 'content',
            3 => 'faq_schema_config',
          ),
          'Botble\\Ecommerce\\Models\\SpecificationAttribute' => 
          array (
            0 => 'name',
            1 => 'options',
            2 => 'default_value',
          ),
          'Botble\\Ecommerce\\Models\\ProductCategory' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Ecommerce\\Models\\ProductAttribute' => 
          array (
            0 => 'title',
            1 => 'attributes',
          ),
          'Botble\\Ecommerce\\Models\\ProductAttributeSet' => 
          array (
            0 => 'title',
          ),
          'Botble\\Ecommerce\\Models\\Brand' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Ecommerce\\Models\\ProductCollection' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Ecommerce\\Models\\ProductLabel' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Ecommerce\\Models\\FlashSale' => 
          array (
            0 => 'name',
            1 => 'description',
          ),
          'Botble\\Ecommerce\\Models\\ProductTag' => 
          array (
            0 => 'name',
          ),
          'Botble\\Ecommerce\\Models\\Tax' => 
          array (
            0 => 'title',
          ),
          'Botble\\Ecommerce\\Models\\GlobalOption' => 
          array (
            0 => 'name',
          ),
          'Botble\\Ecommerce\\Models\\Option' => 
          array (
            0 => 'name',
          ),
          'Botble\\Ecommerce\\Models\\GlobalOptionValue' => 
          array (
            0 => 'option_value',
          ),
          'Botble\\Ecommerce\\Models\\OptionValue' => 
          array (
            0 => 'option_value',
          ),
          'Botble\\Faq\\Models\\Faq' => 
          array (
            0 => 'question',
            1 => 'answer',
          ),
          'Botble\\Faq\\Models\\FaqCategory' => 
          array (
            0 => 'name',
          ),
          'Botble\\Location\\Models\\Country' => 
          array (
            0 => 'name',
            1 => 'nationality',
          ),
          'Botble\\Location\\Models\\State' => 
          array (
            0 => 'name',
          ),
          'Botble\\Location\\Models\\City' => 
          array (
            0 => 'name',
          ),
          'Botble\\Marketplace\\Models\\Store' => 
          array (
            0 => 'name',
            1 => 'description',
            2 => 'content',
            3 => 'address',
            4 => 'company',
            5 => 'cover_image',
          ),
        ),
        'translatable_meta_boxes' => 
        array (
          0 => 'language_advanced_wrap',
          1 => 'seo_wrap',
          2 => 'contact-custom-field-options',
          3 => 'specification-attribute-options',
          4 => 'faq_schema_config_wrapper',
          5 => 'attributes_list',
          6 => 'product_options_box',
          7 => 'faq_schema_config_wrapper',
        ),
        'page_use_language_v2' => true,
      ),
    ),
    'ads' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Ads',
          'flag' => 'ads.index',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'ads.create',
          'parent_flag' => 'ads.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'ads.edit',
          'parent_flag' => 'ads.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'ads.destroy',
          'parent_flag' => 'ads.index',
        ),
        4 => 
        array (
          'name' => 'Ads',
          'flag' => 'ads.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
      'general' => 
      array (
        'use_real_image_url' => true,
      ),
    ),
    'analytics' => 
    array (
      'general' => 
      array (
        'cache_lifetime_in_minutes' => 1440,
        'cache' => 
        array (
          'store' => 'file',
        ),
        'enabled_dashboard_widgets' => true,
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Analytics',
          'flag' => 'analytics.general',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Top Page',
          'flag' => 'analytics.page',
          'parent_flag' => 'analytics.general',
        ),
        2 => 
        array (
          'name' => 'Top Browser',
          'flag' => 'analytics.browser',
          'parent_flag' => 'analytics.general',
        ),
        3 => 
        array (
          'name' => 'Top Referrer',
          'flag' => 'analytics.referrer',
          'parent_flag' => 'analytics.general',
        ),
        4 => 
        array (
          'name' => 'Analytics',
          'flag' => 'analytics.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
    ),
    'audit-log' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Activity Logs',
          'flag' => 'audit-log.index',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Delete',
          'flag' => 'audit-log.destroy',
          'parent_flag' => 'audit-log.index',
        ),
      ),
    ),
    'backup' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Backup',
          'flag' => 'backups.index',
          'parent_flag' => 'core.system',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'backups.create',
          'parent_flag' => 'backups.index',
        ),
        2 => 
        array (
          'name' => 'Restore',
          'flag' => 'backups.restore',
          'parent_flag' => 'backups.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'backups.destroy',
          'parent_flag' => 'backups.index',
        ),
      ),
      'general' => 
      array (
        'mysql' => 
        array (
          'execute_path' => '',
        ),
        'pgsql' => 
        array (
          'execute_path' => '',
        ),
      ),
    ),
    'blog' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Blog',
          'flag' => 'plugins.blog',
          'parent_flag' => 'core.cms',
        ),
        1 => 
        array (
          'name' => 'Posts',
          'flag' => 'posts.index',
          'parent_flag' => 'plugins.blog',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'posts.create',
          'parent_flag' => 'posts.index',
        ),
        3 => 
        array (
          'name' => 'Edit',
          'flag' => 'posts.edit',
          'parent_flag' => 'posts.index',
        ),
        4 => 
        array (
          'name' => 'Delete',
          'flag' => 'posts.destroy',
          'parent_flag' => 'posts.index',
        ),
        5 => 
        array (
          'name' => 'Categories',
          'flag' => 'categories.index',
          'parent_flag' => 'plugins.blog',
        ),
        6 => 
        array (
          'name' => 'Create',
          'flag' => 'categories.create',
          'parent_flag' => 'categories.index',
        ),
        7 => 
        array (
          'name' => 'Edit',
          'flag' => 'categories.edit',
          'parent_flag' => 'categories.index',
        ),
        8 => 
        array (
          'name' => 'Delete',
          'flag' => 'categories.destroy',
          'parent_flag' => 'categories.index',
        ),
        9 => 
        array (
          'name' => 'Tags',
          'flag' => 'tags.index',
          'parent_flag' => 'plugins.blog',
        ),
        10 => 
        array (
          'name' => 'Create',
          'flag' => 'tags.create',
          'parent_flag' => 'tags.index',
        ),
        11 => 
        array (
          'name' => 'Edit',
          'flag' => 'tags.edit',
          'parent_flag' => 'tags.index',
        ),
        12 => 
        array (
          'name' => 'Delete',
          'flag' => 'tags.destroy',
          'parent_flag' => 'tags.index',
        ),
        13 => 
        array (
          'name' => 'Blog',
          'flag' => 'blog.settings',
          'parent_flag' => 'settings.others',
        ),
        14 => 
        array (
          'name' => 'Export Posts',
          'flag' => 'posts.export',
          'parent_flag' => 'tools.data-synchronize',
        ),
        15 => 
        array (
          'name' => 'Import Posts',
          'flag' => 'posts.import',
          'parent_flag' => 'tools.data-synchronize',
        ),
      ),
      'general' => 
      array (
        'use_language_v2' => true,
      ),
    ),
    'captcha' => 
    array (
      'general' => 
      array (
        'math-captcha' => 
        array (
          'operands' => 
          array (
            0 => '+',
            1 => '-',
            2 => '*',
          ),
          'rand-min' => 2,
          'rand-max' => 5,
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Captcha',
          'flag' => 'captcha.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
    ),
    'contact' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Contact',
          'flag' => 'contacts.index',
          'parent_flag' => 'core.cms',
        ),
        1 => 
        array (
          'name' => 'Edit',
          'flag' => 'contacts.edit',
          'parent_flag' => 'contacts.index',
        ),
        2 => 
        array (
          'name' => 'Delete',
          'flag' => 'contacts.destroy',
          'parent_flag' => 'contacts.index',
        ),
        3 => 
        array (
          'name' => 'Custom Fields',
          'flag' => 'contact.custom-fields',
          'parent_flag' => 'contacts.index',
        ),
        4 => 
        array (
          'name' => 'Contact',
          'flag' => 'contact.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
      'email' => 
      array (
        'name' => 'plugins/contact::contact.settings.email.title',
        'description' => 'plugins/contact::contact.settings.email.description',
        'templates' => 
        array (
          'notice' => 
          array (
            'title' => 'plugins/contact::contact.settings.email.templates.notice_title',
            'description' => 'plugins/contact::contact.settings.email.templates.notice_description',
            'subject' => 'plugins/contact::contact.settings.email.templates.subject',
            'can_off' => true,
            'variables' => 
            array (
              'contact_name' => 'plugins/contact::contact.settings.email.templates.contact_name',
              'contact_subject' => 'plugins/contact::contact.settings.email.templates.contact_subject',
              'contact_email' => 'plugins/contact::contact.settings.email.templates.contact_email',
              'contact_phone' => 'plugins/contact::contact.settings.email.templates.contact_phone',
              'contact_address' => 'plugins/contact::contact.settings.email.templates.contact_address',
              'contact_content' => 'plugins/contact::contact.settings.email.templates.contact_content',
              'contact_custom_fields' => 'plugins/contact::contact.settings.email.templates.contact_custom_fields',
            ),
          ),
          'sender-confirmation' => 
          array (
            'title' => 'plugins/contact::contact.settings.email.templates.sender_confirmation_title',
            'description' => 'plugins/contact::contact.settings.email.templates.sender_confirmation_description',
            'subject' => 'plugins/contact::contact.settings.email.templates.sender_confirmation_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'contact_name' => 'plugins/contact::contact.settings.email.templates.contact_name',
              'contact_subject' => 'plugins/contact::contact.settings.email.templates.contact_subject',
              'contact_email' => 'plugins/contact::contact.settings.email.templates.contact_email',
              'contact_phone' => 'plugins/contact::contact.settings.email.templates.contact_phone',
              'contact_address' => 'plugins/contact::contact.settings.email.templates.contact_address',
              'contact_content' => 'plugins/contact::contact.settings.email.templates.contact_content',
              'contact_custom_fields' => 'plugins/contact::contact.settings.email.templates.contact_custom_fields',
            ),
          ),
        ),
      ),
    ),
    'cookie-consent' => 
    array (
      'general' => 
      array (
        'cookie_name' => 'cookie_for_consent',
        'cookie_lifetime' => 7300,
      ),
    ),
    'ecommerce' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'E-commerce',
          'flag' => 'plugins.ecommerce',
        ),
        1 => 
        array (
          'name' => 'Reports',
          'flag' => 'ecommerce.report.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        2 => 
        array (
          'name' => 'Products',
          'flag' => 'products.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        3 => 
        array (
          'name' => 'Create',
          'flag' => 'products.create',
          'parent_flag' => 'products.index',
        ),
        4 => 
        array (
          'name' => 'Edit',
          'flag' => 'products.edit',
          'parent_flag' => 'products.index',
        ),
        5 => 
        array (
          'name' => 'Delete',
          'flag' => 'products.destroy',
          'parent_flag' => 'products.index',
        ),
        6 => 
        array (
          'name' => 'Duplicate',
          'flag' => 'products.duplicate',
          'parent_flag' => 'products.index',
        ),
        7 => 
        array (
          'name' => 'Product Prices',
          'flag' => 'ecommerce.product-prices.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        8 => 
        array (
          'name' => 'Update',
          'flag' => 'ecommerce.product-prices.edit',
          'parent_flag' => 'ecommerce.product-prices.index',
        ),
        9 => 
        array (
          'name' => 'Product Inventory',
          'flag' => 'ecommerce.product-inventory.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        10 => 
        array (
          'name' => 'Update',
          'flag' => 'ecommerce.product-inventory.edit',
          'parent_flag' => 'ecommerce.product-inventory.index',
        ),
        11 => 
        array (
          'name' => 'Product categories',
          'flag' => 'product-categories.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        12 => 
        array (
          'name' => 'Create',
          'flag' => 'product-categories.create',
          'parent_flag' => 'product-categories.index',
        ),
        13 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-categories.edit',
          'parent_flag' => 'product-categories.index',
        ),
        14 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-categories.destroy',
          'parent_flag' => 'product-categories.index',
        ),
        15 => 
        array (
          'name' => 'Product tags',
          'flag' => 'product-tag.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        16 => 
        array (
          'name' => 'Create',
          'flag' => 'product-tag.create',
          'parent_flag' => 'product-tag.index',
        ),
        17 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-tag.edit',
          'parent_flag' => 'product-tag.index',
        ),
        18 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-tag.destroy',
          'parent_flag' => 'product-tag.index',
        ),
        19 => 
        array (
          'name' => 'Brands',
          'flag' => 'brands.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        20 => 
        array (
          'name' => 'Create',
          'flag' => 'brands.create',
          'parent_flag' => 'brands.index',
        ),
        21 => 
        array (
          'name' => 'Edit',
          'flag' => 'brands.edit',
          'parent_flag' => 'brands.index',
        ),
        22 => 
        array (
          'name' => 'Delete',
          'flag' => 'brands.destroy',
          'parent_flag' => 'brands.index',
        ),
        23 => 
        array (
          'name' => 'Product collections',
          'flag' => 'product-collections.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        24 => 
        array (
          'name' => 'Create',
          'flag' => 'product-collections.create',
          'parent_flag' => 'product-collections.index',
        ),
        25 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-collections.edit',
          'parent_flag' => 'product-collections.index',
        ),
        26 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-collections.destroy',
          'parent_flag' => 'product-collections.index',
        ),
        27 => 
        array (
          'name' => 'Product Attributes Sets',
          'flag' => 'product-attribute-sets.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        28 => 
        array (
          'name' => 'Create',
          'flag' => 'product-attribute-sets.create',
          'parent_flag' => 'product-attribute-sets.index',
        ),
        29 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-attribute-sets.edit',
          'parent_flag' => 'product-attribute-sets.index',
        ),
        30 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-attribute-sets.destroy',
          'parent_flag' => 'product-attribute-sets.index',
        ),
        31 => 
        array (
          'name' => 'Product Attributes',
          'flag' => 'product-attributes.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        32 => 
        array (
          'name' => 'Create',
          'flag' => 'product-attributes.create',
          'parent_flag' => 'product-attributes.index',
        ),
        33 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-attributes.edit',
          'parent_flag' => 'product-attributes.index',
        ),
        34 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-attributes.destroy',
          'parent_flag' => 'product-attributes.index',
        ),
        35 => 
        array (
          'name' => 'Taxes',
          'flag' => 'tax.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        36 => 
        array (
          'name' => 'Create',
          'flag' => 'tax.create',
          'parent_flag' => 'tax.index',
        ),
        37 => 
        array (
          'name' => 'Edit',
          'flag' => 'tax.edit',
          'parent_flag' => 'tax.index',
        ),
        38 => 
        array (
          'name' => 'Delete',
          'flag' => 'tax.destroy',
          'parent_flag' => 'tax.index',
        ),
        39 => 
        array (
          'name' => 'Reviews',
          'flag' => 'reviews.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        40 => 
        array (
          'name' => 'Create',
          'flag' => 'reviews.create',
          'parent_flag' => 'reviews.index',
        ),
        41 => 
        array (
          'name' => 'Delete',
          'flag' => 'reviews.destroy',
          'parent_flag' => 'reviews.index',
        ),
        42 => 
        array (
          'name' => 'Publish/Unpublish Review',
          'flag' => 'reviews.publish',
          'parent_flag' => 'reviews.index',
        ),
        43 => 
        array (
          'name' => 'Reply Review',
          'flag' => 'reviews.reply',
          'parent_flag' => 'reviews.index',
        ),
        44 => 
        array (
          'name' => 'Shipments',
          'flag' => 'ecommerce.shipments.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        45 => 
        array (
          'name' => 'Create',
          'flag' => 'ecommerce.shipments.create',
          'parent_flag' => 'ecommerce.shipments.index',
        ),
        46 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.shipments.edit',
          'parent_flag' => 'ecommerce.shipments.index',
        ),
        47 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.shipments.destroy',
          'parent_flag' => 'ecommerce.shipments.index',
        ),
        48 => 
        array (
          'name' => 'Orders',
          'flag' => 'orders.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        49 => 
        array (
          'name' => 'Create',
          'flag' => 'orders.create',
          'parent_flag' => 'orders.index',
        ),
        50 => 
        array (
          'name' => 'Edit',
          'flag' => 'orders.edit',
          'parent_flag' => 'orders.index',
        ),
        51 => 
        array (
          'name' => 'Delete',
          'flag' => 'orders.destroy',
          'parent_flag' => 'orders.index',
        ),
        52 => 
        array (
          'name' => 'Discounts',
          'flag' => 'discounts.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        53 => 
        array (
          'name' => 'Create',
          'flag' => 'discounts.create',
          'parent_flag' => 'discounts.index',
        ),
        54 => 
        array (
          'name' => 'Edit',
          'flag' => 'discounts.edit',
          'parent_flag' => 'discounts.index',
        ),
        55 => 
        array (
          'name' => 'Delete',
          'flag' => 'discounts.destroy',
          'parent_flag' => 'discounts.index',
        ),
        56 => 
        array (
          'name' => 'Customers',
          'flag' => 'customers.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        57 => 
        array (
          'name' => 'Create',
          'flag' => 'customers.create',
          'parent_flag' => 'customers.index',
        ),
        58 => 
        array (
          'name' => 'Edit',
          'flag' => 'customers.edit',
          'parent_flag' => 'customers.index',
        ),
        59 => 
        array (
          'name' => 'Delete',
          'flag' => 'customers.destroy',
          'parent_flag' => 'customers.index',
        ),
        60 => 
        array (
          'name' => 'Flash sales',
          'flag' => 'flash-sale.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        61 => 
        array (
          'name' => 'Create',
          'flag' => 'flash-sale.create',
          'parent_flag' => 'flash-sale.index',
        ),
        62 => 
        array (
          'name' => 'Edit',
          'flag' => 'flash-sale.edit',
          'parent_flag' => 'flash-sale.index',
        ),
        63 => 
        array (
          'name' => 'Delete',
          'flag' => 'flash-sale.destroy',
          'parent_flag' => 'flash-sale.index',
        ),
        64 => 
        array (
          'name' => 'Product labels',
          'flag' => 'product-label.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        65 => 
        array (
          'name' => 'Create',
          'flag' => 'product-label.create',
          'parent_flag' => 'product-label.index',
        ),
        66 => 
        array (
          'name' => 'Edit',
          'flag' => 'product-label.edit',
          'parent_flag' => 'product-label.index',
        ),
        67 => 
        array (
          'name' => 'Delete',
          'flag' => 'product-label.destroy',
          'parent_flag' => 'product-label.index',
        ),
        68 => 
        array (
          'name' => 'Import Products',
          'flag' => 'ecommerce.import.products.index',
          'parent_flag' => 'tools.data-synchronize',
        ),
        69 => 
        array (
          'name' => 'Export Products',
          'flag' => 'ecommerce.export.products.index',
          'parent_flag' => 'tools.data-synchronize',
        ),
        70 => 
        array (
          'name' => 'Order Returns',
          'flag' => 'order_returns.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        71 => 
        array (
          'name' => 'Edit',
          'flag' => 'order_returns.edit',
          'parent_flag' => 'order_returns.index',
        ),
        72 => 
        array (
          'name' => 'Delete',
          'flag' => 'order_returns.destroy',
          'parent_flag' => 'order_returns.index',
        ),
        73 => 
        array (
          'name' => 'Product Options',
          'flag' => 'global-option.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        74 => 
        array (
          'name' => 'Create',
          'flag' => 'global-option.create',
          'parent_flag' => 'global-option.index',
        ),
        75 => 
        array (
          'name' => 'Edit',
          'flag' => 'global-option.edit',
          'parent_flag' => 'global-option.index',
        ),
        76 => 
        array (
          'name' => 'Delete',
          'flag' => 'global-option.destroy',
          'parent_flag' => 'global-option.index',
        ),
        77 => 
        array (
          'name' => 'Invoices',
          'flag' => 'ecommerce.invoice.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        78 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.invoice.edit',
          'parent_flag' => 'ecommerce.invoice.index',
        ),
        79 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.invoice.destroy',
          'parent_flag' => 'ecommerce.invoice.index',
        ),
        80 => 
        array (
          'name' => 'Ecommerce',
          'flag' => 'ecommerce.settings',
          'parent_flag' => 'settings.index',
        ),
        81 => 
        array (
          'name' => 'General',
          'flag' => 'ecommerce.settings.general',
          'parent_flag' => 'ecommerce.settings',
        ),
        82 => 
        array (
          'name' => 'Invoice Template',
          'flag' => 'ecommerce.invoice-template.index',
          'parent_flag' => 'ecommerce.settings',
        ),
        83 => 
        array (
          'name' => 'Currencies',
          'flag' => 'ecommerce.settings.currencies',
          'parent_flag' => 'ecommerce.settings',
        ),
        84 => 
        array (
          'name' => 'Product',
          'flag' => 'ecommerce.settings.products',
          'parent_flag' => 'ecommerce.settings',
        ),
        85 => 
        array (
          'name' => 'Product Search',
          'flag' => 'ecommerce.settings.product-search',
          'parent_flag' => 'ecommerce.settings',
        ),
        86 => 
        array (
          'name' => 'Digital Product',
          'flag' => 'ecommerce.settings.digital-products',
          'parent_flag' => 'ecommerce.settings',
        ),
        87 => 
        array (
          'name' => 'Store Locators',
          'flag' => 'ecommerce.settings.store-locators',
          'parent_flag' => 'ecommerce.settings',
        ),
        88 => 
        array (
          'name' => 'Invoice',
          'flag' => 'ecommerce.settings.invoices',
          'parent_flag' => 'ecommerce.settings',
        ),
        89 => 
        array (
          'name' => 'Product Review',
          'flag' => 'ecommerce.settings.product-reviews',
          'parent_flag' => 'ecommerce.settings',
        ),
        90 => 
        array (
          'name' => 'Customer',
          'flag' => 'ecommerce.settings.customers',
          'parent_flag' => 'ecommerce.settings',
        ),
        91 => 
        array (
          'name' => 'Shopping',
          'flag' => 'ecommerce.settings.shopping',
          'parent_flag' => 'ecommerce.settings',
        ),
        92 => 
        array (
          'name' => 'Tax',
          'flag' => 'ecommerce.settings.taxes',
          'parent_flag' => 'ecommerce.settings',
        ),
        93 => 
        array (
          'name' => 'Shipping',
          'flag' => 'ecommerce.settings.shipping',
          'parent_flag' => 'ecommerce.settings',
        ),
        94 => 
        array (
          'name' => 'Shipping Rules',
          'flag' => 'ecommerce.shipping-rule-items.index',
          'parent_flag' => 'ecommerce.settings',
        ),
        95 => 
        array (
          'name' => 'Create',
          'flag' => 'ecommerce.shipping-rule-items.create',
          'parent_flag' => 'ecommerce.shipping-rule-items.index',
        ),
        96 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.shipping-rule-items.edit',
          'parent_flag' => 'ecommerce.shipping-rule-items.index',
        ),
        97 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.shipping-rule-items.destroy',
          'parent_flag' => 'ecommerce.shipping-rule-items.index',
        ),
        98 => 
        array (
          'name' => 'Bulk Import',
          'flag' => 'ecommerce.shipping-rule-items.bulk-import',
          'parent_flag' => 'ecommerce.shipping-rule-items.index',
        ),
        99 => 
        array (
          'name' => 'Tracking',
          'flag' => 'ecommerce.settings.tracking',
          'parent_flag' => 'ecommerce.settings',
        ),
        100 => 
        array (
          'name' => 'Standard and Format',
          'flag' => 'ecommerce.settings.standard-and-format',
          'parent_flag' => 'ecommerce.settings',
        ),
        101 => 
        array (
          'name' => 'Checkout',
          'flag' => 'ecommerce.settings.checkout',
          'parent_flag' => 'ecommerce.settings',
        ),
        102 => 
        array (
          'name' => 'Return',
          'flag' => 'ecommerce.settings.return',
          'parent_flag' => 'ecommerce.settings',
        ),
        103 => 
        array (
          'name' => 'Flash Sale',
          'flag' => 'ecommerce.settings.flash-sale',
          'parent_flag' => 'ecommerce.settings',
        ),
        104 => 
        array (
          'name' => 'Product Specification',
          'flag' => 'ecommerce.settings.product-specification',
          'parent_flag' => 'ecommerce.settings',
        ),
        105 => 
        array (
          'name' => 'Export Product Categories',
          'flag' => 'product-categories.export',
          'parent_flag' => 'tools.data-synchronize',
        ),
        106 => 
        array (
          'name' => 'Import Product Categories',
          'flag' => 'product-categories.import',
          'parent_flag' => 'tools.data-synchronize',
        ),
        107 => 
        array (
          'name' => 'Export Orders',
          'flag' => 'orders.export',
          'parent_flag' => 'tools.data-synchronize',
        ),
        108 => 
        array (
          'name' => 'Product Specification',
          'flag' => 'ecommerce.product-specification.index',
          'parent_flag' => 'plugins.ecommerce',
        ),
        109 => 
        array (
          'name' => 'Specification Groups',
          'flag' => 'ecommerce.specification-groups.index',
          'parent_flag' => 'ecommerce.product-specification.index',
        ),
        110 => 
        array (
          'name' => 'Create',
          'flag' => 'ecommerce.specification-groups.create',
          'parent_flag' => 'ecommerce.specification-groups.index',
        ),
        111 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.specification-groups.edit',
          'parent_flag' => 'ecommerce.specification-groups.index',
        ),
        112 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.specification-groups.destroy',
          'parent_flag' => 'ecommerce.specification-groups.index',
        ),
        113 => 
        array (
          'name' => 'Specification Attributes',
          'flag' => 'ecommerce.specification-attributes.index',
          'parent_flag' => 'ecommerce.product-specification.index',
        ),
        114 => 
        array (
          'name' => 'Create',
          'flag' => 'ecommerce.specification-attributes.create',
          'parent_flag' => 'ecommerce.specification-attributes.index',
        ),
        115 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.specification-attributes.edit',
          'parent_flag' => 'ecommerce.specification-attributes.index',
        ),
        116 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.specification-attributes.destroy',
          'parent_flag' => 'ecommerce.specification-attributes.index',
        ),
        117 => 
        array (
          'name' => 'Specification Tables',
          'flag' => 'ecommerce.specification-tables.index',
          'parent_flag' => 'ecommerce.product-specification.index',
        ),
        118 => 
        array (
          'name' => 'Create',
          'flag' => 'ecommerce.specification-tables.create',
          'parent_flag' => 'ecommerce.specification-tables.index',
        ),
        119 => 
        array (
          'name' => 'Edit',
          'flag' => 'ecommerce.specification-tables.edit',
          'parent_flag' => 'ecommerce.specification-tables.index',
        ),
        120 => 
        array (
          'name' => 'Delete',
          'flag' => 'ecommerce.specification-tables.destroy',
          'parent_flag' => 'ecommerce.specification-tables.index',
        ),
      ),
      'general' => 
      array (
        'prefix' => 'ecommerce_',
        'display_big_money_in_million_billion' => false,
        'bulk-import' => 
        array (
          'mime_types' => 
          array (
            0 => 'application/vnd.ms-excel',
            1 => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            2 => 'text/csv',
            3 => 'application/csv',
            4 => 'text/plain',
          ),
          'mimes' => 
          array (
            0 => 'xls',
            1 => 'xlsx',
            2 => 'csv',
          ),
        ),
        'enable_faq_in_product_details' => true,
        'digital_products' => 
        array (
          'allowed_mime_types' => 
          array (
          ),
        ),
      ),
      'shipping' => 
      array (
        'settings' => 
        array (
          'prefix' => 'ecommerce_shipping_',
        ),
      ),
      'order' => 
      array (
        'default_order_start_number' => 10000000,
        'default_order_weight' => 0.01,
      ),
      'cart' => 
      array (
        'database' => 
        array (
          'connection' => 'mysql',
          'table' => 'ec_cart',
        ),
      ),
      'email' => 
      array (
        'name' => 'plugins/ecommerce::email.name',
        'description' => 'plugins/ecommerce::email.description',
        'templates' => 
        array (
          'welcome' => 
          array (
            'title' => 'plugins/ecommerce::email.welcome_title',
            'description' => 'plugins/ecommerce::email.welcome_description',
            'subject' => 'plugins/ecommerce::email.welcome_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
            ),
          ),
          'confirm-email' => 
          array (
            'title' => 'plugins/ecommerce::email.confirm_email_title',
            'description' => 'plugins/ecommerce::email.confirm_email_description',
            'subject' => 'plugins/ecommerce::email.confirm_email_subject',
            'can_off' => false,
            'variables' => 
            array (
              'verify_link' => 'plugins/ecommerce::email.verify_link',
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
            ),
          ),
          'password-reminder' => 
          array (
            'title' => 'plugins/ecommerce::email.password_reminder_title',
            'description' => 'plugins/ecommerce::email.password_reminder_description',
            'subject' => 'plugins/ecommerce::email.password_reminder_subject',
            'can_off' => false,
            'variables' => 
            array (
              'reset_link' => 'plugins/ecommerce::email.reset_link',
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
            ),
          ),
          'customer_new_order' => 
          array (
            'title' => 'plugins/ecommerce::email.customer_new_order_title',
            'description' => 'plugins/ecommerce::email.customer_new_order_description',
            'subject' => 'plugins/ecommerce::email.customer_new_order_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'customer_cancel_order' => 
          array (
            'title' => 'plugins/ecommerce::email.order_cancellation_title',
            'description' => 'plugins/ecommerce::email.customer_order_cancellation_description',
            'subject' => 'plugins/ecommerce::email.customer_order_cancellation_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'cancellation_reason' => 'plugins/ecommerce::order.order_cancellation_reason',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'admin_cancel_order' => 
          array (
            'title' => 'plugins/ecommerce::email.admin_order_cancellation_title',
            'description' => 'plugins/ecommerce::email.admin_order_cancellation_description',
            'subject' => 'plugins/ecommerce::email.admin_order_cancellation_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'cancellation_reason' => 'plugins/ecommerce::order.order_cancellation_reason',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
            ),
          ),
          'order_cancellation_to_admin' => 
          array (
            'title' => 'plugins/ecommerce::email.order_cancellation_to_admin_title',
            'description' => 'plugins/ecommerce::email.order_cancellation_to_admin_description',
            'subject' => 'plugins/ecommerce::email.order_cancellation_to_admin_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'cancellation_reason' => 'plugins/ecommerce::order.order_cancellation_reason',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
            ),
          ),
          'customer_delivery_order' => 
          array (
            'title' => 'plugins/ecommerce::email.delivery_confirmation_title',
            'description' => 'plugins/ecommerce::email.delivery_confirmation_description',
            'subject' => 'plugins/ecommerce::email.delivery_confirmation_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'order_delivery_notes' => 'plugins/ecommerce::email.order_delivery_notes',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'customer_order_delivered' => 
          array (
            'title' => 'plugins/ecommerce::email.order_delivered_title',
            'description' => 'plugins/ecommerce::email.order_delivered_description',
            'subject' => 'plugins/ecommerce::email.order_delivered_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'order_delivery_notes' => 'plugins/ecommerce::email.order_delivery_notes',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'admin_new_order' => 
          array (
            'title' => 'plugins/ecommerce::email.admin_new_order_title',
            'description' => 'plugins/ecommerce::email.admin_new_order_description',
            'subject' => 'plugins/ecommerce::email.admin_new_order_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'order_confirm' => 
          array (
            'title' => 'plugins/ecommerce::email.order_confirmation_title',
            'description' => 'plugins/ecommerce::email.order_confirmation_description',
            'subject' => 'plugins/ecommerce::email.order_confirmation_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'order_confirm_payment' => 
          array (
            'title' => 'plugins/ecommerce::email.payment_confirmation_title',
            'description' => 'plugins/ecommerce::email.payment_confirmation_description',
            'subject' => 'plugins/ecommerce::email.payment_confirmation_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'order_recover' => 
          array (
            'title' => 'plugins/ecommerce::email.order_recover_title',
            'description' => 'plugins/ecommerce::email.order_recover_description',
            'subject' => 'plugins/ecommerce::email.order_recover_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'order_token' => 'plugins/ecommerce::ecommerce.order_token',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'order-return-request' => 
          array (
            'title' => 'plugins/ecommerce::email.order_return_request_title',
            'description' => 'plugins/ecommerce::email.order_return_request_description',
            'subject' => 'plugins/ecommerce::email.order_return_request_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'list_order_products' => 'plugins/ecommerce::email.list_order_products',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'return_reason' => 'plugins/ecommerce::order.order_return_reason',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'invoice-payment-created' => 
          array (
            'title' => 'plugins/ecommerce::email.invoice_payment_created_title',
            'description' => 'plugins/ecommerce::email.invoice_payment_created_description',
            'subject' => 'plugins/ecommerce::email.invoice_payment_created_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'invoice_code' => 'plugins/ecommerce::email.invoice_code',
              'invoice_link' => 'plugins/ecommerce::email.invoice_link',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'review_products' => 
          array (
            'title' => 'plugins/ecommerce::email.review_products_title',
            'description' => 'plugins/ecommerce::email.review_products_description',
            'subject' => 'plugins/ecommerce::email.review_products_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'product_review_list' => 'plugins/ecommerce::ecommerce.product_review_list',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'download_digital_products' => 
          array (
            'title' => 'plugins/ecommerce::email.download_digital_products_title',
            'description' => 'plugins/ecommerce::email.download_digital_products_description',
            'subject' => 'plugins/ecommerce::email.download_digital_products_subject',
            'can_off' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'order_note' => 'plugins/ecommerce::ecommerce.order_note',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'digital_product_list' => 'plugins/ecommerce::email.digital_product_list',
              'digital_products' => 'plugins/ecommerce::email.digital_products',
              'store' => 'plugins/marketplace::store.store',
              'store_name' => 'plugins/marketplace::store.store_name',
              'store_address' => 'plugins/marketplace::store.store_address',
              'store_phone' => 'plugins/marketplace::store.store_phone',
              'store_url' => 'plugins/marketplace::store.store_url',
            ),
          ),
          'customer-deletion-request-confirmation' => 
          array (
            'title' => 'plugins/ecommerce::email.customer_deletion_request_confirmation_title',
            'description' => 'plugins/ecommerce::email.customer_deletion_request_confirmation_description',
            'subject' => 'plugins/ecommerce::email.customer_deletion_request_confirmation_subject',
            'can_off' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_email' => 'plugins/ecommerce::ecommerce.customer_email',
              'confirm_url' => 'plugins/ecommerce::account-deletion.confirm_url',
            ),
          ),
          'customer-deletion-request-completed' => 
          array (
            'title' => 'plugins/ecommerce::email.customer_deletion_request_completed_title',
            'description' => 'plugins/ecommerce::email.customer_deletion_request_completed_description',
            'subject' => 'plugins/ecommerce::email.customer_deletion_request_completed_subject',
            'can_off' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
            ),
          ),
          'order-return-status-updated' => 
          array (
            'title' => 'plugins/ecommerce::email.order_return_status_updated_title',
            'description' => 'plugins/ecommerce::email.order_return_status_updated_description',
            'subject' => 'plugins/ecommerce::email.order_return_status_updated_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'description' => 'core/base::forms.description',
              'status' => 'core/base::forms.status',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
            ),
          ),
          'payment-proof-upload-notification' => 
          array (
            'title' => 'plugins/ecommerce::email.payment_proof_upload_notification_title',
            'description' => 'plugins/ecommerce::email.payment_proof_upload_notification_description',
            'subject' => 'plugins/ecommerce::email.payment_proof_upload_notification_subject',
            'can_off' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_email' => 'plugins/ecommerce::ecommerce.customer_email',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'payment_link' => 'plugins/ecommerce::ecommerce.order_link',
              'order_link' => 'plugins/ecommerce::ecommerce.payment_link',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
            ),
          ),
          'product-file-updated' => 
          array (
            'title' => 'plugins/ecommerce::email.product_file_updated_title',
            'description' => 'plugins/ecommerce::email.product_file_updated_description',
            'subject' => 'plugins/ecommerce::email.product_file_updated_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'product_name' => 'plugins/ecommerce::products.product_name',
              'product_link' => 'plugins/ecommerce::products.product_link',
              'download_link' => 'plugins/ecommerce::ecommerce.download_link',
              'update_time' => 'plugins/ecommerce::ecommerce.update_time',
              'product_files' => 'plugins/ecommerce::ecommerce.product_files',
            ),
          ),
        ),
      ),
    ),
    'faq' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'FAQ',
          'flag' => 'plugin.faq',
        ),
        1 => 
        array (
          'name' => 'FAQ',
          'flag' => 'faq.index',
          'parent_flag' => 'plugin.faq',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'faq.create',
          'parent_flag' => 'faq.index',
        ),
        3 => 
        array (
          'name' => 'Edit',
          'flag' => 'faq.edit',
          'parent_flag' => 'faq.index',
        ),
        4 => 
        array (
          'name' => 'Delete',
          'flag' => 'faq.destroy',
          'parent_flag' => 'faq.index',
        ),
        5 => 
        array (
          'name' => 'FAQ Categories',
          'flag' => 'faq_category.index',
          'parent_flag' => 'plugin.faq',
        ),
        6 => 
        array (
          'name' => 'Create',
          'flag' => 'faq_category.create',
          'parent_flag' => 'faq_category.index',
        ),
        7 => 
        array (
          'name' => 'Edit',
          'flag' => 'faq_category.edit',
          'parent_flag' => 'faq_category.index',
        ),
        8 => 
        array (
          'name' => 'Delete',
          'flag' => 'faq_category.destroy',
          'parent_flag' => 'faq_category.index',
        ),
        9 => 
        array (
          'name' => 'FAQ',
          'flag' => 'faqs.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
      'general' => 
      array (
        'schema_supported' => 
        array (
          0 => 'Botble\\Page\\Models\\Page',
          1 => 'Botble\\Blog\\Models\\Post',
        ),
      ),
    ),
    'location' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Location',
          'flag' => 'plugin.location',
        ),
        1 => 
        array (
          'name' => 'Countries',
          'flag' => 'country.index',
          'parent_flag' => 'plugin.location',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'country.create',
          'parent_flag' => 'country.index',
        ),
        3 => 
        array (
          'name' => 'Edit',
          'flag' => 'country.edit',
          'parent_flag' => 'country.index',
        ),
        4 => 
        array (
          'name' => 'Delete',
          'flag' => 'country.destroy',
          'parent_flag' => 'country.index',
        ),
        5 => 
        array (
          'name' => 'States',
          'flag' => 'state.index',
          'parent_flag' => 'plugin.location',
        ),
        6 => 
        array (
          'name' => 'Create',
          'flag' => 'state.create',
          'parent_flag' => 'state.index',
        ),
        7 => 
        array (
          'name' => 'Edit',
          'flag' => 'state.edit',
          'parent_flag' => 'state.index',
        ),
        8 => 
        array (
          'name' => 'Delete',
          'flag' => 'state.destroy',
          'parent_flag' => 'state.index',
        ),
        9 => 
        array (
          'name' => 'Cities',
          'flag' => 'city.index',
          'parent_flag' => 'plugin.location',
        ),
        10 => 
        array (
          'name' => 'Create',
          'flag' => 'city.create',
          'parent_flag' => 'city.index',
        ),
        11 => 
        array (
          'name' => 'Edit',
          'flag' => 'city.edit',
          'parent_flag' => 'city.index',
        ),
        12 => 
        array (
          'name' => 'Delete',
          'flag' => 'city.destroy',
          'parent_flag' => 'city.index',
        ),
      ),
      'general' => 
      array (
        'supported' => 
        array (
        ),
      ),
    ),
    'marketplace' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Marketplace',
          'flag' => 'marketplace.index',
        ),
        1 => 
        array (
          'name' => 'Stores',
          'flag' => 'marketplace.store.index',
          'parent_flag' => 'marketplace.index',
        ),
        2 => 
        array (
          'name' => 'Create',
          'flag' => 'marketplace.store.create',
          'parent_flag' => 'marketplace.store.index',
        ),
        3 => 
        array (
          'name' => 'Edit',
          'flag' => 'marketplace.store.edit',
          'parent_flag' => 'marketplace.store.index',
        ),
        4 => 
        array (
          'name' => 'Delete',
          'flag' => 'marketplace.store.destroy',
          'parent_flag' => 'marketplace.store.index',
        ),
        5 => 
        array (
          'name' => 'View',
          'flag' => 'marketplace.store.view',
          'parent_flag' => 'marketplace.store.index',
        ),
        6 => 
        array (
          'name' => 'Update balance',
          'flag' => 'marketplace.store.revenue.create',
          'parent_flag' => 'marketplace.store.index',
        ),
        7 => 
        array (
          'name' => 'Withdrawals',
          'flag' => 'marketplace.withdrawal.index',
          'parent_flag' => 'marketplace.index',
        ),
        8 => 
        array (
          'name' => 'Edit',
          'flag' => 'marketplace.withdrawal.edit',
          'parent_flag' => 'marketplace.withdrawal.index',
        ),
        9 => 
        array (
          'name' => 'Delete',
          'flag' => 'marketplace.withdrawal.destroy',
          'parent_flag' => 'marketplace.withdrawal.index',
        ),
        10 => 
        array (
          'name' => 'View invoice',
          'flag' => 'marketplace.withdrawal.invoice',
          'parent_flag' => 'marketplace.withdrawal.index',
        ),
        11 => 
        array (
          'name' => 'Vendors',
          'flag' => 'marketplace.vendors.index',
          'parent_flag' => 'marketplace.index',
        ),
        12 => 
        array (
          'name' => 'Unverified vendors',
          'flag' => 'marketplace.unverified-vendors.index',
          'parent_flag' => 'marketplace.index',
        ),
        13 => 
        array (
          'name' => 'Block/Unblock',
          'flag' => 'marketplace.vendors.control',
          'parent_flag' => 'marketplace.vendors.index',
        ),
        14 => 
        array (
          'name' => 'Edit',
          'flag' => 'marketplace.unverified-vendors.edit',
          'parent_flag' => 'marketplace.unverified-vendors.index',
        ),
        15 => 
        array (
          'name' => 'Reports',
          'flag' => 'marketplace.reports',
          'parent_flag' => 'marketplace.index',
        ),
        16 => 
        array (
          'name' => 'Settings',
          'flag' => 'marketplace.settings',
          'parent_flag' => 'ecommerce.settings',
        ),
      ),
      'email' => 
      array (
        'name' => 'plugins/marketplace::marketplace.email.title',
        'description' => 'plugins/marketplace::marketplace.email.description',
        'templates' => 
        array (
          'store_new_order' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.store_new_order_title',
            'description' => 'plugins/marketplace::marketplace.email.store_new_order_description',
            'subject' => 'plugins/marketplace::marketplace.email.store_new_order_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
              'shipping_method' => 'plugins/ecommerce::ecommerce.shipping_method',
              'payment_method' => 'plugins/ecommerce::ecommerce.payment_method',
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
              'order' => 'plugins/marketplace::marketplace.email.order',
              'shipment' => 'plugins/marketplace::marketplace.email.shipment',
              'address' => 'plugins/marketplace::marketplace.email.address',
              'products' => 'plugins/marketplace::marketplace.email.products',
            ),
          ),
          'verify_vendor' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.verify_vendor_title',
            'description' => 'plugins/marketplace::marketplace.email.verify_vendor_description',
            'subject' => 'plugins/marketplace::marketplace.email.verify_vendor_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'customer_phone' => 'plugins/ecommerce::ecommerce.customer_phone',
              'customer_address' => 'plugins/ecommerce::ecommerce.customer_address',
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'vendor-account-approved' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.vendor_account_approved_title',
            'description' => 'plugins/marketplace::marketplace.email.vendor_account_approved_description',
            'subject' => 'plugins/marketplace::marketplace.email.vendor_account_approved_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'vendor-account-rejected' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.vendor_account_rejected_title',
            'description' => 'plugins/marketplace::marketplace.email.vendor_account_rejected_description',
            'subject' => 'plugins/marketplace::marketplace.email.vendor_account_rejected_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'pending-product-approval' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.pending_product_approval_title',
            'description' => 'plugins/marketplace::marketplace.email.pending_product_approval_description',
            'subject' => 'plugins/marketplace::marketplace.email.pending_product_approval_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'product_name' => 'plugins/marketplace::marketplace.product_name',
              'product_url' => 'plugins/marketplace::marketplace.product_url',
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'product-approved' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.product_approved_title',
            'description' => 'plugins/marketplace::marketplace.email.product_approved_description',
            'subject' => 'plugins/marketplace::marketplace.email.product_approved_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'withdrawal-approved' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.withdrawal_approved_title',
            'description' => 'plugins/marketplace::marketplace.email.withdrawal_approved_description',
            'subject' => 'plugins/marketplace::marketplace.email.withdrawal_approved_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'withdrawal_amount' => 'plugins/marketplace::marketplace.withdrawal_amount',
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'store' => 'plugins/marketplace::marketplace.email.store',
            ),
          ),
          'welcome-vendor' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.welcome_vendor_title',
            'description' => 'plugins/marketplace::marketplace.email.welcome_vendor_description',
            'subject' => 'plugins/marketplace::marketplace.email.welcome_vendor_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'vendor_name' => 'plugins/marketplace::marketplace.vendor_name',
              'store_name' => 'plugins/marketplace::marketplace.store_name',
            ),
          ),
          'contact-store' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.contact_store_title',
            'description' => 'plugins/marketplace::marketplace.email.contact_store_description',
            'subject' => 'plugins/marketplace::marketplace.email.contact_store_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'customer_message' => 'plugins/marketplace::marketplace.email.customer_message',
              'customer_name' => 'plugins/marketplace::marketplace.email.customer_name',
              'customer_email' => 'plugins/marketplace::marketplace.email.customer_email',
            ),
          ),
          'vendor-account-blocked' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.vendor_account_blocked_title',
            'description' => 'plugins/marketplace::marketplace.email.vendor_account_blocked_description',
            'subject' => 'plugins/marketplace::marketplace.email.vendor_account_blocked_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'block_reason' => 'plugins/marketplace::marketplace.email.block_reason',
              'block_date' => 'plugins/marketplace::marketplace.email.block_date',
            ),
          ),
          'vendor-account-unblocked' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.vendor_account_unblocked_title',
            'description' => 'plugins/marketplace::marketplace.email.vendor_account_unblocked_description',
            'subject' => 'plugins/marketplace::marketplace.email.vendor_account_unblocked_subject',
            'can_off' => true,
            'enabled' => true,
            'variables' => 
            array (
              'store_name' => 'plugins/marketplace::marketplace.store_name',
              'store_phone' => 'plugins/marketplace::marketplace.store_phone',
              'store_address' => 'plugins/marketplace::marketplace.store_address',
              'store_url' => 'plugins/marketplace::marketplace.store_url',
              'unblock_date' => 'plugins/marketplace::marketplace.email.unblock_date',
            ),
          ),
          'order_cancellation_to_vendor' => 
          array (
            'title' => 'plugins/marketplace::marketplace.email.order_cancellation_to_vendor_title',
            'description' => 'plugins/marketplace::marketplace.email.order_cancellation_to_vendor_description',
            'subject' => 'plugins/marketplace::marketplace.email.order_cancellation_to_vendor_subject',
            'can_off' => true,
            'enabled' => false,
            'variables' => 
            array (
              'customer_name' => 'plugins/ecommerce::ecommerce.customer_name',
              'order_id' => 'plugins/ecommerce::ecommerce.order_id',
              'cancellation_reason' => 'plugins/ecommerce::order.order_cancellation_reason',
              'product_list' => 'plugins/ecommerce::ecommerce.product_list',
            ),
          ),
        ),
      ),
      'general' => 
      array (
        'prefix' => 'marketplace_',
        'vendor_panel_dir' => 'vendor',
      ),
    ),
    'newsletter' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Newsletters',
          'flag' => 'newsletter.index',
        ),
        1 => 
        array (
          'name' => 'Delete',
          'flag' => 'newsletter.destroy',
          'parent_flag' => 'newsletter.index',
        ),
        2 => 
        array (
          'name' => 'Newsletters',
          'flag' => 'newsletter.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
      'email' => 
      array (
        'name' => 'plugins/newsletter::newsletter.settings.email.templates.title',
        'description' => 'plugins/newsletter::newsletter.settings.email.templates.description',
        'templates' => 
        array (
          'subscriber_email' => 
          array (
            'title' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.title',
            'description' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.description',
            'subject' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.subject',
            'can_off' => true,
            'variables' => 
            array (
              'newsletter_name' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.newsletter_name',
              'newsletter_email' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.newsletter_email',
              'newsletter_unsubscribe_link' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.newsletter_unsubscribe_link',
              'newsletter_unsubscribe_url' => 'plugins/newsletter::newsletter.settings.email.templates.to_user.newsletter_unsubscribe_url',
            ),
          ),
          'admin_email' => 
          array (
            'title' => 'plugins/newsletter::newsletter.settings.email.templates.to_admin.title',
            'description' => 'plugins/newsletter::newsletter.settings.email.templates.to_admin.description',
            'subject' => 'plugins/newsletter::newsletter.settings.email.templates.to_admin.subject',
            'can_off' => true,
            'variables' => 
            array (
              'newsletter_email' => 'plugins/newsletter::newsletter.settings.email.templates.to_admin.newsletter_email',
            ),
          ),
        ),
        'variables' => 
        array (
        ),
      ),
    ),
    'payment' => 
    array (
      'payment' => 
      array (
        'currency' => 'USD',
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Payments',
          'flag' => 'payment.index',
        ),
        1 => 
        array (
          'name' => 'Settings',
          'flag' => 'payments.settings',
          'parent_flag' => 'payment.index',
        ),
        2 => 
        array (
          'name' => 'Delete',
          'flag' => 'payment.destroy',
          'parent_flag' => 'payment.index',
        ),
        3 => 
        array (
          'name' => 'Payment Logs',
          'flag' => 'payments.logs',
          'parent_flag' => 'payment.index',
        ),
        4 => 
        array (
          'name' => 'View',
          'flag' => 'payments.logs.show',
          'parent_flag' => 'payments.logs',
        ),
        5 => 
        array (
          'name' => 'Delete',
          'flag' => 'payments.logs.destroy',
          'parent_flag' => 'payments.logs',
        ),
      ),
    ),
    'shippo' => 
    array (
      'general' => 
      array (
        'package_types' => 
        array (
          'parcel' => 'Parcel',
          'couriersplease_500g_satchel' => 'CouriersPlease 500g Satchel',
          'couriersplease_1kg_satchel' => 'CouriersPlease 1kg Satchel',
          'couriersplease_3kg_satchel' => 'CouriersPlease 3kg Satchel',
          'couriersplease_5kg_satchel' => 'CouriersPlease 5g Satchel',
          'DHLeC_Irregular' => 'DHL eCommerce Irregular',
          'DHLeC_SM_Flats' => 'DHL eCommerce Flats',
          'Fastway_Australia_Satchel_A2' => 'Fastway Australia Satchel A2',
          'Fastway_Australia_Satchel_A3' => 'Fastway Australia Satchel A3',
          'Fastway_Australia_Satchel_A4' => 'Fastway Australia Satchel A4',
          'Fastway_Australia_Satchel_A5' => 'Fastway Australia Satchel A5',
          'FedEx_Envelope' => 'FedEx Envelope',
          'FedEx_Padded_Pak' => 'FedEx Padded Pak',
          'FedEx_Pak_2' => 'FedEx Small Pak',
          'FedEx_Pak_1' => 'FedEx Large Pak',
          'FedEx_XL_Pak' => 'FedEx Extra Large Pak',
          'FedEx_Tube' => 'FedEx Tube',
          'FedEx_Box_10kg' => 'FedEx 10kg Box',
          'FedEx_Box_25kg' => 'FedEx 25kg Box',
          'FedEx_Box_Small_1' => 'FedEx Small Box (S1)',
          'FedEx_Box_Small_2' => 'FedEx Small Box (S2)',
          'FedEx_Box_Medium_1' => 'FedEx Medium Box (M1)',
          'FedEx_Box_Medium_2' => 'FedEx Medium Box (M2)',
          'FedEx_Box_Large_1' => 'FedEx Large Box (L1)',
          'FedEx_Box_Large_2' => 'FedEx Large Box (L2)',
          'FedEx_Box_Extra_Large_1' => 'FedEx Extra Large Box (X1)',
          'FedEx_Box_Extra_Large_2' => 'FedEx Extra Large Box (X2)',
          'UPS_Express_Envelope' => 'UPS Express Envelope',
          'UPS_Express_Legal_Envelope' => 'UPS Express Legal Envelope',
          'UPS_Express_Box' => 'UPS Express Box',
          'UPS_Express_Box_Small' => 'UPS Small Express Box',
          'UPS_Express_Box_Medium' => 'UPS Medium Express Box',
          'UPS_Express_Box_Large' => 'UPS Large Express Box',
          'UPS_Box_10kg' => 'UPS 10kg Box',
          'UPS_Box_25kg' => 'UPS 25kg Box',
          'UPS_Express_Tube' => 'UPS Express Tube',
          'UPS_Express_Pak' => 'UPS Express Pak',
          'UPS_Laboratory_Pak' => 'UPS Laboratory Pak',
          'UPS_Pad_Pak' => 'UPS Pad Pak',
          'UPS_Pallet' => 'UPS Pallet',
          'UPS_MI_BPM' => 'UPS BPM (Mail Innovations - Domestic & International)',
          'UPS_MI_BPM_Flat' => 'UPS BPM Flat (Mail Innovations - Domestic & International)',
          'UPS_MI_BPM_Parcel' => 'UPS BPM Parcel (Mail Innovations - Domestic & International)',
          'UPS_MI_First_Class' => 'UPS First Class (Mail Innovations - Domestic only)',
          'UPS_MI_Irregular' => 'UPS Irregular (Mail Innovations - Domestic only)',
          'UPS_MI_Machinable' => 'UPS Machinable (Mail Innovations - Domestic only)',
          'UPS_MI_MEDIA_MAIL' => 'UPS Media Mail (Mail Innovations - Domestic only)',
          'UPS_MI_Parcel_Post' => 'UPS Parcel Post (Mail Innovations - Domestic only)',
          'UPS_MI_Priority' => 'UPS Priority (Mail Innovations - Domestic only)',
          'UPS_MI_Standard_Flat' => 'UPS Standard Flat (Mail Innovations - Domestic only)',
          'UPS_MI_Flat' => 'UPS Flat (Mail Innovations - Domestic only)',
          'USPS_FlatRateCardboardEnvelope' => 'USPS Flat Rate Cardboard Envelope',
          'USPS_FlatRateEnvelope' => 'USPS Flat Rate Envelope',
          'USPS_FlatRateGiftCardEnvelope' => 'USPS Flat Rate Gift Card Envelope',
          'USPS_FlatRateLegalEnvelope' => 'USPS Flat Rate Legal Envelope',
          'USPS_FlatRatePaddedEnvelope' => 'USPS Flat Rate Padded Envelope',
          'USPS_FlatRateWindowEnvelope' => 'USPS Flat Rate Window Envelope',
          'USPS_IrregularParcel' => 'USPS Irregular Parcel',
          'USPS_LargeFlatRateBoardGameBox' => 'USPS Large Flat Rate Board Game Box',
          'USPS_LargeFlatRateBox' => 'USPS Large Flat Rate Box',
          'USPS_APOFlatRateBox' => 'USPS APO/FPO/DPO Large Flat Rate Box',
          'USPS_LargeVideoFlatRateBox' => 'USPS Flat Rate Large Video Box (Int\'l only)',
          'USPS_MediumFlatRateBox1' => 'USPS Medium Flat Rate Box 1',
          'USPS_MediumFlatRateBox2' => 'USPS Medium Flat Rate Box 2',
          'USPS_RegionalRateBoxA1' => 'USPS Regional Rate Box A1',
          'USPS_RegionalRateBoxA2' => 'USPS Regional Rate Box A2',
          'USPS_RegionalRateBoxB1' => 'USPS Regional Rate Box B1',
          'USPS_RegionalRateBoxB2' => 'USPS Regional Rate Box B2',
          'USPS_SmallFlatRateBox' => 'USPS Small Flat Rate Box',
          'USPS_SmallFlatRateEnvelope' => 'USPS Small Flat Rate Envelope',
          'USPS_SoftPack' => 'USPS Soft Pack Padded Envelope',
        ),
        'service_levels' => 
        array (
          'usps_priority' => 'USPS Priority Mail',
          'usps_priority_express' => 'USPS Priority Mail Express',
          'usps_first' => 'USPS First Class Mail/Package',
          'usps_parcel_select' => 'USPS Parcel Select',
          'usps_media_mail' => 'USPS Media Mail, only for existing Shippo customers with grandfathered Media Mail option.',
          'usps_priority_mail_international' => 'USPS Priority Mail International',
          'usps_priority_mail_express_international' => 'USPS Priority Mail Express International',
          'usps_first_class_package_international_service' => 'USPS First Class Package International',
          'fedex_ground' => 'FedEx Ground®',
          'fedex_home_delivery' => 'FedEx Home Delivery®',
          'fedex_smart_post' => 'FedEx SmartPost®',
          'fedex_2_day' => 'FedEx 2Day®',
          'fedex_2_day_am' => 'FedEx 2Day® A.M.',
          'fedex_express_saver' => 'FedEx Express Saver®',
          'fedex_standard_overnight' => 'FedEx Standard Overnight®',
          'fedex_priority_overnight' => 'FedEx Priority Overnight®',
          'fedex_first_overnight' => 'FedEx First Overnight®',
          'fedex_freight_priority' => 'FedEx Freight® Priority',
          'fedex_next_day_freight' => 'FedEx Next Day Freight',
          'fedex_freight_economy' => 'FedEx Freight® Economy',
          'fedex_first_freight' => 'FedEx First Freight',
          'fedex_international_economy' => 'FedEx International Economy®',
          'fedex_international_priority' => 'FedEx International Priority®',
          'fedex_international_first' => 'FedEx International First®',
          'fedex_europe_first_international_priority' => 'FedEx Europe International First®',
          'fedex_international_priority_express' => 'FedEx International Priority Express',
          'international_economy_freight' => 'FedEx International Economy® Freight',
          'international_priority_freight' => 'FedEx International Priority® Freight',
          'ups_standard' => 'UPS Standard℠',
          'ups_ground' => 'UPS Ground',
          'ups_saver' => 'UPS Saver®',
          'ups_3_day_select' => 'UPS 3 Day Select®',
          'ups_second_day_air' => 'UPS 2nd Day Air®',
          'ups_second_day_air_am' => 'UPS 2nd Day Air® A.M.',
          'ups_next_day_air' => 'UPS Next Day Air®',
          'ups_next_day_air_saver' => 'UPS Next Day Air Saver®',
          'ups_next_day_air_early_am' => 'UPS Next Day Air® Early',
          'ups_mail_innovations_domestic' => 'UPS Mail Innovations (domestic)',
          'ups_surepost' => 'UPS Surepost',
          'ups_surepost_bound_printed_matter' => 'UPS SurePost® Bound Printed Matter',
          'ups_surepost_lightweight' => 'UPS Surepost Lightweight',
          'ups_surepost_media' => 'UPS SurePost® Media',
          'ups_express' => 'UPS Express®',
          'ups_express_1200' => 'UPS Express 12:00',
          'ups_express_plus' => 'UPS Express Plus®',
          'ups_expedited' => 'UPS Expedited®',
          'apc_postal_parcelconnect_expedited' => 'APC parcelConnect Expedited',
          'apc_postal_parcelconnect_priority' => 'APC parcelConnect Priority',
          'apc_postal_parcelconnect_priority_delcon' => 'APC parcelConnect Priority Delcon',
          'apc_postal_parcelconnect_priority_pqw' => 'APC parcelConnect Priority PQW',
          'apc_postal_parcelconnect_book_service' => 'APC parcelConnect Book Service',
          'apc_postal_parcelconnect_standard' => 'APC parcelConnect Standard',
          'apc_postal_parcelconnect_epmi' => 'APC parcelConnect ePMI',
          'apc_postal_parcelconnect_epacket' => 'APC parcelConnect ePacket',
          'apc_postal_parcelconnect_epmei' => 'APC parcelConnect ePMEI',
          'asendia_us_priority_tracked' => 'Asendia USA Priority Tracked',
          'asendia_us_international_express' => 'Asendia USA International Express',
          'asendia_us_international_priority_airmail' => 'Asendia USA International Priority Airmail',
          'asendia_us_international_surface_airlift' => 'Asendia USA International Surface Air Lift',
          'asendia_us_priority_mail_international' => 'Asendia USA Priority Mail International',
          'asendia_us_priority_mail_express_international' => 'Asendia USA Priority Mail Express International',
          'asendia_us_epacket' => 'Asendia USA International ePacket',
          'asendia_us_other' => 'Asendia USA Other Services (custom)',
          'australia_post_express_post' => 'Australia Express Post',
          'australia_post_parcel_post' => 'Australia Parcel Post',
          'australia_post_pack_and_track_international' => 'Australia Pack and Track International',
          'australia_post_international_airmail' => 'Australia International Airmail',
          'australia_post_express_post_international' => 'Australia Express Post International',
          'australia_post_express_courier_international' => 'Australia Express Courier International',
          'australia_post_international_express' => 'Australia International Express',
          'australia_post_international_standard' => 'Australia International Standard',
          'australia_post_international_economy' => 'Australia International Economy',
          'axlehire_next_day' => 'AxleHire Next Day',
          'canada_post_regular_parcel' => 'Canada Post Regular Parcel',
          'canada_post_expedited_parcel' => 'Canada Post Expedited Parcel',
          'canada_post_priority' => 'Canada Post Priority',
          'canada_post_xpresspost' => 'Canada Post Xpresspost',
          'canada_post_xpresspost_international' => 'Canada Post Xpresspost International',
          'canada_post_xpresspost_usa' => 'Canada Post Xpresspost USA',
          'canada_post_expedited_parcel_usa' => 'Canada Post Expedited Parcel USA',
          'canada_post_tracked_packet_usa' => 'Canada Post Tracked Packet USA',
          'canada_post_small_packet_usa_air' => 'Canada Post Small Packet USA Air',
          'canada_post_tracked_packet_international' => 'Canada Post Tracked Packet International',
          'canada_post_small_packet_international_air' => 'Canada Post Small Package International Air',
          'cdl_next_day' => 'CDL Next Day',
          'couriersplease_domestic_priority_auth_to_leave' => 'CouriersPlease Domestic Priority - Authority To Leave/POPPoints',
          'couriersplease_domestic_priority_sign_required' => 'CouriersPlease Domestic Priority - Signature Required',
          'couriersplease_gold_domestic_auth_to_leave' => 'CouriersPlease Gold Domestic - Authority To Leave/POPPoints',
          'couriersplease_gold_domestic_sign_required' => 'CouriersPlease Gold Domestic - Signature Required',
          'couriersplease_off_peak_auth_to_leave' => 'CouriersPlease Off Peak - Authority To Leave/POPPoints',
          'couriersplease_off_peak_sign_required' => 'CouriersPlease Off Peak - Signature Required',
          'couriersplease_parcel_auth_to_leave' => 'CouriersPlease Parcel - Authority To Leave',
          'couriersplease_parcel_sign_required' => 'CouriersPlease Parcel - Signature Required',
          'couriersplease_road_express' => 'CouriersPlease Road Express',
          'couriersplease_satchel_auth_to_leave' => 'Satchel - Authority To Leave',
          'couriersplease_satchel_sign_required' => 'Satchel - Signature Required',
          'purolator_ground' => 'Purolator Ground',
          'purolator_ground9_am' => 'Purolator Ground 9am',
          'purolator_ground1030_am' => 'Purolator Ground 10:30am',
          'purolator_ground_distribution' => 'Purolator Ground Distribution',
          'purolator_ground_evening' => 'Purolator Ground Evening',
          'purolator_ground_us' => 'Purolator Ground US',
          'purolator_express' => 'Purolator Express',
          'purolator_express9_am' => 'Purolator Express 9am',
          'purolator_express1030_am' => 'Purolator Express 10am',
          'purolator_express_evening' => 'Purolator Express Evening',
          'purolator_express_us' => 'Purolator Express US',
          'purolator_express_us9_am' => 'Purolator Express US 9am',
          'purolator_express_us1030_am' => 'Purolator Express US 10:30am',
          'purolator_express_us1200' => 'Purolator Express US 12pm',
          'purolator_express_international' => 'Purolator Express International',
          'purolator_express_international9_am' => 'Purolator Express International 9am',
          'purolator_express_international1030_am' => 'Purolator Express International 10:30am',
          'purolator_express_international1200' => 'Purolator Express International 12pm',
          'dhl_express_domestic_express_doc' => 'DHL Domestic Express Doc',
          'dhl_express_economy_select_doc' => 'DHL Economy Select Doc',
          'dhl_express_worldwide_nondoc' => 'DHL Express Worldwide Nondoc',
          'dhl_express_worldwide_doc' => 'DHL Express Worldwide Doc',
          'dhl_express_worldwide' => 'DHL Worldwide',
          'dhl_express_worldwide_eu_doc' => 'DHL Express Worldwide EU Doc',
          'dhl_express_break_bulk_express_doc' => 'DHL Break Bulk Express Doc',
          'dhl_express_express_9_00_nondoc' => 'DHL Express 9:00 NonDoc',
          'dhl_express_economy_select_nondoc' => 'DHL Economy Select NonDoc',
          'dhl_express_break_bulk_economy_doc' => 'DHL Break Bulk Economy Doc',
          'dhl_express_express_9_00_doc' => 'DHL Express 9:00 Doc',
          'dhl_express_express_10_30_doc' => 'DHL Express 10:30 Doc',
          'dhl_express_express_10_30_nondoc' => 'DHL Express 10:30 NonDoc',
          'dhl_express_express_12_00_doc' => 'DHL Express 12:00 Doc',
          'dhl_express_europack_nondoc' => 'DHL Europack NonDoc',
          'dhl_express_express_envelope_doc' => 'DHL Express Envelope Doc',
          'dhl_express_express_12_00_nondoc' => 'DHL Express 12:00 NonDoc',
          'dhl_express_express_12_doc' => 'DHL Domestic Express 12:00',
          'dhl_express_worldwide_b2c_doc' => 'DHL Express Worldwide (B2C) Doc',
          'dhl_express_worldwide_b2c_nondoc' => 'DHL Express Worldwide (B2C) NonDoc',
          'dhl_express_medical_express' => 'DHL Medical Express',
          'dhl_express_express_easy_nondoc' => 'DHL Express Easy NonDoc',
          'dhl_ecommerce_marketing_parcel_expedited' => 'DHL eCommerce Marketing Parcel Expedited',
          'dhl_ecommerce_globalmail_business_ips' => 'DHL eCommerce Parcel International Expedited',
          'dhl_ecommerce_parcel_international_direct' => 'DHL eCommerce GlobalMail Business Standard',
          'dhl_ecommerce_parcels_expedited_max' => 'DHL eCommerce Parcels Expedited Max',
          'dhl_ecommerce_bpm_ground' => 'DHL eCommerce Bounded Printed Matter Ground',
          'dhl_ecommerce_priority_expedited' => 'DHL eCommerce Priority Expedited',
          'dhl_ecommerce_globalmail_packet_ipa' => 'DHL eCommerce GlobalMail Packet Priority',
          'dhl_ecommerce_globalmail_packet_isal' => 'DHL eCommerce GlobalMail Packet Standard',
          'dhl_ecommerce_easy_return_plus' => 'DHL eCommerce Easy Return Plus',
          'dhl_ecommerce_marketing_parcel_ground' => 'DHL eCommerce Marketing Parcel Ground',
          'dhl_ecommerce_first_class_parcel_expedited' => 'DHL eCommerce First Class Parcel Expedited',
          'dhl_ecommerce_globalmail_business_priority' => 'DHL eCommerce Parcel International Standard',
          'dhl_ecommerce_parcels_expedited' => 'DHL eCommerce Parcels Expedited',
          'dhl_ecommerce_globalmail_business_isal' => 'DHL eCommerce Parcel International Direct',
          'dhl_ecommerce_parcel_plus_expedited_max' => 'DHL eCommerce Parcel Plus Expedited Max',
          'dhl_ecommerce_globalmail_packet_plus' => 'DHL eCommerce GlobalMail Packet IPA',
          'dhl_ecommerce_parcels_ground' => 'DHL eCommerce Parcels Ground',
          'dhl_ecommerce_expedited' => 'DHL eCommerce Expedited',
          'dhl_ecommerce_parcel_plus_ground' => 'DHL eCommerce Parcel Plus Ground',
          'dhl_ecommerce_parcel_international_standard' => 'DHL eCommerce GlobalMail Business ISAL',
          'dhl_ecommerce_bpm_expedited' => 'DHL eCommerce Bounded Printed Matter Expedited',
          'dhl_ecommerce_parcel_international_expedited' => 'DHL eCommerce GlobalMail Business IPA',
          'dhl_ecommerce_globalmail_packet_priority' => 'DHL eCommerce GlobalMail Packet ISAL',
          'dhl_ecommerce_easy_return_light' => 'DHL eCommerce Easy Return Light',
          'dhl_ecommerce_parcel_plus_expedited' => 'DHL eCommerce Parcel Plus Expedited',
          'dhl_ecommerce_globalmail_business_standard' => 'DHL eCommerce GlobalMail Packet Plus',
          'dhl_ecommerce_ground' => 'DHL eCommerce Ground',
          'dhl_ecommerce_globalmail_packet_standard' => 'DHL eCommerce GlobalMail Business Priority',
          'dhl_germany_europaket' => 'DHL Germany Europaket',
          'dhl_germany_paket' => 'DHL Germany Paket',
          'dhl_germany_paket_connect' => 'DHL Germany Paket Connect',
          'dhl_germany_paket_international' => 'DHL Germany Paket International',
          'dhl_germany_paket_priority' => 'DHL Germany Paket Priority',
          'dhl_germany_paket_sameday' => 'DHL Germany Paket Sameday',
          'deutsche_post_postkarte' => 'Deutsche Post Postkarte',
          'deutsche_post_standardbrief' => 'Deutsche Post Standardbrief',
          'deutsche_post_kompaktbrief' => 'Deutsche Post Kompaktbrief',
          'deutsche_post_grossbrief' => 'Deutsche Post Grossbrief',
          'deutsche_post_maxibrief' => 'Deutsche Post Maxibrief',
          'deutsche_post_maxibrief_plus' => 'Deutsche Post Maxibrief Plus',
          'deutsche_post_warenpost_international_xs' => 'Deutsche Post Warenpost International XS',
          'deutsche_post_warenpost_international_s' => 'Deutsche Post Warenpost International S',
          'deutsche_post_warenpost_international_m' => 'Deutsche Post Warenpost International M',
          'deutsche_post_warenpost_international_l' => 'Deutsche Post Warenpost International L',
          'fastway_australia_parcel' => 'Fastway Australia Parcel',
          'fastway_australia_satchel' => 'Fastway Australia Satchel',
          'fastway_australia_box_small' => 'Fastway Australia Box Small',
          'fastway_australia_box_medium' => 'Fastway Australia Box Medium',
          'fastway_australia_box_large' => 'Fastway Australia Box Large',
          'globegistics_priority_mail_express_international' => 'Globegistics Priority Mail Express International',
          'globegistics_priority_mail_international' => 'Globegistics Priority Mail International',
          'globegistics_priority_mail_express_international_pds' => 'Globegistics Priority Mail Express International PreSort Drop Ship',
          'globegistics_priority_mail_international_pds' => 'Globegistics Priority Mail International PreSort Drop Ship',
          'globegistics_epacket' => 'Globegistics ePacket',
          'globegistics_ecom_tracked_ddp' => 'Globegistics eCom Tracked DDP',
          'globegistics_ecom_packet_ddp' => 'Globegistics eCom Packet DDP',
          'globegistics_ecom_priority_mail_international_ddp' => 'Globegistics eCom Priority Mail International DDP',
          'globegistics_ecom_priority_mail_express_international_ddp' => 'Globegistics eCom Priority Mail Express International DDP',
          'globegistics_ecom_extra' => 'Globegistics eCom Extra',
          'globegistics_ecom_international_priority_airmail' => 'Globegistics eCom International Priority Airmail',
          'globegistics_ecom_international_surface_airlift' => 'Globegistics eCom International Surface Air Lift',
          'gls_deutschland_business_parcel' => 'GLS Germany Business Parcel',
          'gls_france_business_parcel' => 'GLS France Business Parcel',
          'lso_ground' => 'LSO Ground',
          'lso_economy_next_day' => 'LSO Economy Next Day',
          'lso_saturday_delivery' => 'LSO Saturday Delivery',
          'lso_2nd_day' => 'LSO 2nd Day',
          'lso_priority_next_day' => 'LSO Priority Next Day',
          'lso_early_overnight' => 'LSO Early Overnight',
          'mondial_relay_pointrelais' => 'Mondial Relay Point Relais',
          'parcelforce_express48' => 'Parcelforce Express 48',
          'parcelforce_express24' => 'Parcelforce Express 24',
          'parcelforce_expressam' => 'Parcelforce Express AM',
          'rr_donnelley_domestic_economy_parcel' => 'RR Donnelley Domestic Economy Parcel',
          'rr_donnelley_domestic_priority_parcel' => 'RR Donnelley Domestic Priority Parcel ',
          'rr_donnelley_domestic_parcel_bpm' => 'RR Donnelley Domestic Parcel BPM',
          'rr_donnelley_priority_domestic_priority_parcel_bpm' => 'RR Donnelley Domestic Priority Parcel BPM',
          'rr_donnelley_priority_parcel_delcon' => 'RR Donnelley International Priority Parcel DelCon',
          'rr_donnelley_priority_parcel_nondelcon' => 'RR Donnelley International Priority Parcel NonDelcon',
          'rr_donnelley_economy_parcel' => 'RR Donnelley Economy Parcel Service ',
          'rr_donnelley_ipa' => 'RR Donnelley International Priority Airmail (IPA)',
          'rr_donnelley_courier' => 'RR Donnelley International Courier',
          'rr_donnelley_isal' => 'RR Donnelley International Surface Air Lift (ISAL)',
          'rr_donnelley_epacket' => 'RR Donnelley e-Packet',
          'rr_donnelley_pmi' => 'RR Donnelley Priority Mail International',
          'rr_donnelley_emi' => 'RR Donnelley Express Mail International',
          'sendle_parcel' => 'Sendle Parcel',
          'newgistics_parcel_select_lightweight' => 'Newgistics Parcel Select Lightweight',
          'newgistics_parcel_select' => 'Newgistics Parcel Select',
          'newgistics_priority_mail' => 'Newgistics Priority Mail',
          'newgistics_first_class_mail' => 'Newgistics First Class Mail',
          'ontrac_ground' => 'OnTrac Ground',
          'ontrac_sunrise_gold' => 'OnTrac Sunrise Gold',
          'ontrac_sunrise' => 'OnTrac Sunrise',
          'lasership_routed_delivery' => 'Lasership Routed Delivery',
          'hermes_uk_courier_collection' => 'Hermes UK Courier Collection',
          'hermes_uk_parcelshop_dropoff' => 'Hermes UK ParcelShop Drop-Off',
          'FedEx_Box_10kg' => 'FedEx® 10kg Box',
          'FedEx_Box_25kg' => 'FedEx® 25kg Box',
          'FedEx_Box_Extra_Large_1' => 'FedEx® Extra Large Box (X1)',
          'FedEx_Box_Extra_Large_2' => 'FedEx® Extra Large Box (X2)',
          'FedEx_Box_Large_1' => 'FedEx® Large Box (L1)',
          'FedEx_Box_Large_2' => 'FedEx® Large Box (L2)',
          'FedEx_Box_Medium_1' => 'FedEx® Medium Box (M1)',
          'FedEx_Box_Medium_2' => 'FedEx® Medium Box (M2)',
          'FedEx_Box_Small_1' => 'FedEx® Small Box (S1)',
          'FedEx_Box_Small_2' => 'FedEx® Small Box (S2)',
          'FedEx_Envelope' => 'FedEx® Envelope',
          'FedEx_Padded_Pak' => 'FedEx® Padded Pak',
          'FedEx_Pak_1' => 'FedEx® Large Pak',
          'FedEx_Pak_2' => 'FedEx® Small Pak',
          'FedEx_Tube' => 'FedEx® Tube',
          'FedEx_XL_Pak' => 'FedEx® Extra Large Pak',
          'UPS_Box_10kg' => 'Box 10kg',
          'UPS_Box_25kg' => 'Box 25kg',
          'UPS_Express_Box' => 'UPS Express Box',
          'UPS_Express_Box_Large' => 'UPS Express Box Large',
          'UPS_Express_Box_Medium' => 'UPS Express Box Medium',
          'UPS_Express_Box_Small' => 'UPS Express Box Small',
          'UPS_Express_Envelope' => 'UPS Express Envelope',
          'UPS_Express_Hard_Pak' => 'UPS Express Hard Pak',
          'UPS_Express_Legal_Envelope' => 'UPS Express Legal Envelope',
          'UPS_Express_Pak' => 'UPS Express Pak',
          'UPS_Express_Tube' => 'UPS Express Tube',
          'UPS_Laboratory_Pak' => 'Laboratory Pak',
          'UPS_MI_BPM' => 'BPM (Mail Innovations - Domestic &amp; International)',
          'UPS_MI_BPM_Flat' => 'BPM Flat (Mail Innovations - Domestic &amp; International)',
          'UPS_MI_BPM_Parcel' => 'BPM Parcel (Mail Innovations - Domestic &amp; International)',
          'UPS_MI_First_Class' => 'First Class (Mail Innovations - Domestic only)',
          'UPS_MI_Flat' => 'Flat (Mail Innovations - Domestic only)',
          'UPS_MI_Irregular' => 'Irregular (Mail Innovations - Domestic only)',
          'UPS_MI_Machinable' => 'Machinable (Mail Innovations - Domestic only)',
          'UPS_MI_MEDIA_MAIL' => 'Media Mail (Mail Innovations - Domestic only)',
          'UPS_MI_Parcel_Post' => 'Parcel Post (Mail Innovations - Domestic only)',
          'UPS_MI_Priority' => 'Priority (Mail Innovations - Domestic only)',
          'UPS_MI_Standard_Flat' => 'Standard Flat (Mail Innovations - Domestic only)',
          'UPS_Pad_Pak' => 'UPS Pad Pak',
          'UPS_Pallet' => 'UPS Pallet',
          'USPS_FlatRateCardboardEnvelope' => 'USPS Flat Rate Cardboard Envelope',
          'USPS_FlatRateEnvelope' => 'USPS Flat Rate Envelope',
          'USPS_FlatRateGiftCardEnvelope' => 'USPS Flat Rate Gift Card Envelope',
          'USPS_FlatRateLegalEnvelope' => 'USPS Flat Rate Legal Envelope',
          'USPS_FlatRatePaddedEnvelope' => 'USPS Flat Rate Padded Envelope',
          'USPS_FlatRateWindowEnvelope' => 'USPS Flat Rate Window Envelope',
          'USPS_IrregularParcel' => 'USPS Irregular Parcel',
          'USPS_LargeFlatRateBoardGameBox' => 'USPS Large Flat Rate Board Game Box',
          'USPS_LargeFlatRateBox' => 'USPS Large Flat Rate Box',
          'USPS_APOFlatRateBox' => 'USPS APO/FPO/DPO Large Flat Rate Box',
          'USPS_LargeVideoFlatRateBox' => 'USPS Flat Rate Large Video Box (Int\'l only)',
          'USPS_MediumFlatRateBox1' => 'USPS Medium Flat Rate Box 1',
          'USPS_MediumFlatRateBox2' => 'Medium Flat Rate Box 2',
          'USPS_RegionalRateBoxA1' => 'USPS Regional Rate Box A1',
          'USPS_RegionalRateBoxA2' => 'USPS Regional Rate Box A2',
          'USPS_RegionalRateBoxB1' => 'USPS Regional Rate Box B1',
          'USPS_RegionalRateBoxB2' => 'USPS Regional Rate Box B2',
          'USPS_SmallFlatRateBox' => 'USPS Small Flat Rate Box',
          'USPS_SmallFlatRateEnvelope' => 'USPS Small Flat Rate Envelope',
          'USPS_SoftPack' => 'USPS Soft Pack Padded Envelope',
        ),
      ),
    ),
    'simple-slider' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Simple Sliders',
          'flag' => 'simple-slider.index',
        ),
        1 => 
        array (
          'name' => 'Create',
          'flag' => 'simple-slider.create',
          'parent_flag' => 'simple-slider.index',
        ),
        2 => 
        array (
          'name' => 'Edit',
          'flag' => 'simple-slider.edit',
          'parent_flag' => 'simple-slider.index',
        ),
        3 => 
        array (
          'name' => 'Delete',
          'flag' => 'simple-slider.destroy',
          'parent_flag' => 'simple-slider.index',
        ),
        4 => 
        array (
          'name' => 'Slider Items',
          'flag' => 'simple-slider-item.index',
          'parent_flag' => 'simple-slider.index',
        ),
        5 => 
        array (
          'name' => 'Create',
          'flag' => 'simple-slider-item.create',
          'parent_flag' => 'simple-slider-item.index',
        ),
        6 => 
        array (
          'name' => 'Edit',
          'flag' => 'simple-slider-item.edit',
          'parent_flag' => 'simple-slider-item.index',
        ),
        7 => 
        array (
          'name' => 'Delete',
          'flag' => 'simple-slider-item.destroy',
          'parent_flag' => 'simple-slider-item.index',
        ),
        8 => 
        array (
          'name' => 'Simple Slider Settings',
          'flag' => 'simple-slider.settings',
          'parent_flag' => 'simple-slider-item.index',
        ),
      ),
    ),
    'social-login' => 
    array (
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Social Login',
          'flag' => 'social-login.settings',
          'parent_flag' => 'settings.others',
        ),
      ),
      'general' => 
      array (
        'supported' => 
        array (
          'customer' => 
          array (
            'guard' => 'customer',
            'model' => 'Botble\\Ecommerce\\Models\\Customer',
            'login_url' => 'http://localhost/login',
            'redirect_url' => 'http://localhost',
          ),
        ),
      ),
    ),
    'sslcommerz' => 
    array (
      'sslcommerz' => 
      array (
        'apiUrl' => 
        array (
          'make_payment' => '/gwprocess/v4/api.php',
          'transaction_status' => '/validator/api/merchantTransIDvalidationAPI.php',
          'order_validate' => '/validator/api/validationserverAPI.php',
          'refund_payment' => '/validator/api/merchantTransIDvalidationAPI.php',
          'refund_status' => '/validator/api/merchantTransIDvalidationAPI.php',
          'payment_detail' => '/validator/api/merchantTransIDvalidationAPI.php',
        ),
        'connect_from_localhost' => true,
        'success_url' => '/sslcommerz/payment/success',
        'failed_url' => '/sslcommerz/payment/fail',
        'cancel_url' => '/sslcommerz/payment/cancel',
        'ipn_url' => '/sslcommerz/payment/ipn',
      ),
    ),
    'translation' => 
    array (
      'general' => 
      array (
        'exclude_groups' => 
        array (
        ),
      ),
      'permissions' => 
      array (
        0 => 
        array (
          'name' => 'Localization',
          'flag' => 'plugins.translation',
          'parent_flag' => 'settings.index',
        ),
        1 => 
        array (
          'name' => 'Locales',
          'flag' => 'translations.locales',
          'parent_flag' => 'plugins.translation',
        ),
        2 => 
        array (
          'name' => 'Theme translations',
          'flag' => 'translations.theme-translations',
          'parent_flag' => 'plugins.translation',
        ),
        3 => 
        array (
          'name' => 'Other translations',
          'flag' => 'translations.index',
          'parent_flag' => 'plugins.translation',
        ),
        4 => 
        array (
          'name' => 'Export Theme translations',
          'flag' => 'theme-translations.export',
          'parent_flag' => 'tools.data-synchronize',
        ),
        5 => 
        array (
          'name' => 'Export Other Translations',
          'flag' => 'other-translations.export',
          'parent_flag' => 'tools.data-synchronize',
        ),
        6 => 
        array (
          'name' => 'Import Theme Translations',
          'flag' => 'theme-translations.import',
          'parent_flag' => 'tools.data-synchronize',
        ),
        7 => 
        array (
          'name' => 'Import Other Translations',
          'flag' => 'other-translations.import',
          'parent_flag' => 'tools.data-synchronize',
        ),
      ),
    ),
  ),
  'paystack' => 
  array (
    'publicKey' => NULL,
    'secretKey' => NULL,
    'paymentUrl' => 'https://api.paystack.co',
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
