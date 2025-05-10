<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckIfOriginalFileExists extends Command
{
    protected $signature = 'check:original-file-exists';
    protected $description = 'Checks if the original file exists for local videos and updates has_missing_original_file flag.';

    public function handle()
    {
        Video::where('disk', 'local')
            ->where(function ($query) {
                $query->whereNull('has_missing_original_file')->orWhere('has_missing_original_file', false);
            })
            ->orderBy('id')
            ->chunk(100, function ($videos) {
                foreach ($videos as $video) {
                    $this->info("Checking video ID: {$video->id}");

                    $fileName = $video->file_name;

                    if (!Storage::disk('videos')->exists($fileName)) {
                        $video->has_missing_original_file = true;
                        $video->save();
                        $this->warn("File missing: {$fileName}");
                    } else {
                        $this->info("File exists: {$fileName}");
                    }
                }
            });

        $this->info('File existence check complete.');
        return 0;
    }
}
