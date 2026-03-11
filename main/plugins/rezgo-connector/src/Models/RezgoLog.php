<?php

namespace Botble\RezgoConnector\Models;

use Illuminate\Database\Eloquent\Model;

class RezgoLog extends Model
{
    protected $table = 'rezgo_logs';

    protected $fillable = [
        'log_type',
        'operation',
        'related_id',
        'message',
        'context',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    /**
     * Log types
     */
    const TYPE_SYNC = 'sync';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';

    /**
     * Create sync log
     */
    public static function sync(string $operation, $relatedId = null, string $message = '', array $context = []): void
    {
        static::create([
            'log_type' => self::TYPE_SYNC,
            'operation' => $operation,
            'related_id' => $relatedId,
            'message' => $message,
            'context' => json_encode($context),
        ]);
    }

    /**
     * Create error log
     */
    public static function error(string $operation, $relatedId = null, string $message = '', array $context = []): void
    {
        static::create([
            'log_type' => self::TYPE_ERROR,
            'operation' => $operation,
            'related_id' => $relatedId,
            'message' => $message,
            'context' => json_encode($context),
        ]);
    }

    /**
     * Create warning log
     */
    public static function warning(string $operation, $relatedId = null, string $message = '', array $context = []): void
    {
        static::create([
            'log_type' => self::TYPE_WARNING,
            'operation' => $operation,
            'related_id' => $relatedId,
            'message' => $message,
            'context' => json_encode($context),
        ]);
    }

    /**
     * Create info log
     */
    public static function info(string $operation, $relatedId = null, string $message = '', array $context = []): void
    {
        static::create([
            'log_type' => self::TYPE_INFO,
            'operation' => $operation,
            'related_id' => $relatedId,
            'message' => $message,
            'context' => json_encode($context),
        ]);
    }

    /**
     * Get context as array
     */
    public function getContextData(): array
    {
        return json_decode($this->context, true) ?? [];
    }
}
