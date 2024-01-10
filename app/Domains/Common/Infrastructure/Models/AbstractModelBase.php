<?php

declare(strict_types=1);

namespace App\Domains\Common\Infrastructure\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 *
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 * @property-read ?CarbonImmutable $deleted_at
 *
 * @method string getKey()
 */
abstract class AbstractModelBase extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';
    protected array $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden = ['deleted_at'];
}
