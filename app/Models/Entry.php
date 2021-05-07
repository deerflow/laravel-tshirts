<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Entry
 *
 * @property int $id
 * @property int $historic_id
 * @property string $url
 * @property string $relative_path
 * @property string $absolute_path
 * @property int $offset_x
 * @property int $offset_y
 * @property float $zoom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereAbsolutePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereHistoricId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereOffsetX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereOffsetY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereRelativePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereZoom($value)
 * @mixin \Eloquent
 */
class Entry extends Model
{
    use HasFactory;

    public function historic()
    {
        $this->belongsTo(Historic::class);
    }
}
