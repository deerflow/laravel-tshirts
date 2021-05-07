<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Historic
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Historic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Historic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Historic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Historic extends Model
{
    use HasFactory;
}
