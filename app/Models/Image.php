<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUrl($value)
 * @mixin \Eloquent
 * @property string $path
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @property string $relative_path
 * @property string $absolute_path
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereAbsolutePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereRelativePath($value)
 */
class Image extends Model implements isUploadable
{
    public function getUploadPath(): string
    {
        return 'public/images';
    }

    use HasFactory;
}
