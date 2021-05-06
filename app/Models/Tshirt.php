<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tshirt
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt whereUrl($value)
 * @mixin \Eloquent
 * @property string $path
 * @method static \Illuminate\Database\Eloquent\Builder|Tshirt wherePath($value)
 */
class Tshirt extends Model
{
    use HasFactory;
}
