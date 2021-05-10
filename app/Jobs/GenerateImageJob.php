<?php

namespace App\Jobs;

use App\Events\ImageGeneratedEvent;
use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use InterventionImage;

class GenerateImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const MINIMIZE_IMAGE_FACTOR = 3;

    private $email;
    private $tshirtId;
    private $imageId;
    private $offsetX;
    private $offsetY;
    private $zoom;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, int $tshirtId, int $imageId, ?int $offsetX = null, ?int $offsetY = null, ?int $zoom = 1)
    {
        $this->email = $email;
        $this->tshirtId = $tshirtId;
        $this->imageId = $imageId;
        $this->offsetX = $offsetX;
        $this->offsetY = $offsetY;
        $this->zoom = $zoom;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tshirtModel = Tshirt::findOrFail($this->tshirtId);
        $imageModel = Image::findOrFail($this->imageId);

        $tshirt = InterventionImage::make($tshirtModel->absolute_path);
        $image = InterventionImage::make($imageModel->absolute_path);

        if (!$this->zoom) {
            $this->zoom = 1;
        }

        if (!$this->offsetX) {
            $this->offsetX = (int)round($tshirt->width() / 2 - $tshirt->width() / self::MINIMIZE_IMAGE_FACTOR / 2 * $this->zoom);
        }

        if (!$this->offsetY) {
            $this->offsetY = (int)round($tshirt->height() / 2 - $tshirt->height() / self::MINIMIZE_IMAGE_FACTOR / 2 * $this->zoom);
        }

        $width = (int)round($tshirt->width() / self::MINIMIZE_IMAGE_FACTOR * $this->zoom);
        $height = (int)round($tshirt->height() / self::MINIMIZE_IMAGE_FACTOR * $this->zoom);

        if ($tshirt->width() > $tshirt->height()) {
            $width = null;
        } else {
            $height = null;
        }

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $tshirt->insert($image, 'top-left', $this->offsetX, $this->offsetY);

        $path = storage_path() . '/app/public/entries-api/' . Str::uuid() . '.png';
        $tshirt->save($path);

        ImageGeneratedEvent::dispatch($this->email, $path);
    }
}
