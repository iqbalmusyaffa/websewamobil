<?php

namespace App\Observers;

use App\Models\Job;
use Illuminate\Support\Str;

class JobObserver
{
    /**
     * Handle the Job "creating" event.
     */
    public function creating(Job $job): void
    {
        if (empty($job->slug)) {
            $job->slug = Str::slug($job->title);
        }
        $this->convertTextToArray($job);
    }

    /**
     * Handle the Job "updating" event.
     */
    public function updating(Job $job): void
    {
        $this->convertTextToArray($job);
    }

    /**
     * Convert text requirements and benefits to arrays
     */
    private function convertTextToArray(Job $job): void
    {
        // Convert requirements_text to requirements array
        if (isset($job->attributes['requirements_text']) && is_string($job->attributes['requirements_text'])) {
            $job->requirements = array_filter(
                array_map('trim', explode("\n", $job->attributes['requirements_text']))
            );
            unset($job->attributes['requirements_text']);
        }

        // Convert benefits_text to benefits array
        if (isset($job->attributes['benefits_text']) && is_string($job->attributes['benefits_text'])) {
            $job->benefits = array_filter(
                array_map('trim', explode("\n", $job->attributes['benefits_text']))
            );
            unset($job->attributes['benefits_text']);
        }
    }
}
