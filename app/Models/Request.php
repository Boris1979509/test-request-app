<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RequestStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Request
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property  string $comment
 * @property RequestStatus $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Request extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment'
    ];
    /**
     * @var array $casts
     */
    protected $casts = [
        'status' => RequestStatus::class
    ];

    /**
     * @param string $name
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = Str::ucfirst($name);
    }

    /**
     * Create request
     * @param array $requestData
     * @return Request
     */
    public static function new(array $requestData): self
    {
        return static::create($requestData);
    }

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if ($model->status === RequestStatus::ACTIVE)
                $model->updated_at = null;
        });
    }

    /**
     * @param string $comment
     * @return Request
     */
    public function updateRequest(string $comment): self
    {
        $this->update([
            'comment' => $comment,
            'status' => RequestStatus::RESOLVED
        ]);
        return $this;
    }
}
