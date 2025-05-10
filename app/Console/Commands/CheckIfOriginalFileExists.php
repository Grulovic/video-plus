<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
                $missingIds = [];

                foreach ($videos as $video) {
                    $this->info("Checking video ID: {$video->id}");

                    $fileName = $video->file_name;

                    if (!Storage::disk('videos')->exists($fileName)) {
                        $missingIds[] = $video->id;
                        $this->warn("File missing: {$fileName}");
                    } else {
                        $this->info("File exists: {$fileName}");
                    }
                }

                if (!empty($missingIds)) {
                    Video::whereIn('id', $missingIds)->update(['has_missing_original_file' => true]);
                    $this->info("Updated " . count($missingIds) . " videos with missing files.");
                }
            });

        $this->info('File existence check complete.');
        return 0;
    }
}
