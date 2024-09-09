<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    /**
     * check url is full url or base 64 string
     */
    public function isLink(string $url)
    {
        $http = substr($url, 0, 4);
        if (strtolower($http) == 'http') {
            return true;
        }

        return false;
    }

    public function upload($file, $imgContainer, $customName = null)
    {
        if ($this->isLink($file)) {
            return $file;
        }
        $path = ($customName) ? $file->storeAs($imgContainer, $customName) : $file->store($imgContainer);
        $url = Storage::url($path);

        return $url;
    }

    public function remove($url)
    {
        $path = $this->changeUrlToPath($url);
        if ($this->canDeletePhoto($url) && Storage::exists($path)) {
            try {
                Storage::delete($path);
            } catch (Exception $e) {
                dd($e);
            }
        }
    }

    public function changeUrlToPath($url)
    {
        return parse_url($url)['path'];
    }

    public function getFolderNameByUrl($url)
    {
        $path = $this->changeUrlToPath($url);
        $parts = explode('/', $path);

        if (count($parts) >= 2) {
            return $parts[1];
        } else {
            // Handle the case when the array doesn't have at least 2 elements.
            // You might want to return a default value or handle the error accordingly.
            return null;
        }
    }

    public function canDeletePhoto($url)
    {
        if ($this->isOnDevelopmentOrStagingEnv($url)) {
            return false;
        }

        return true;
    }

    protected function isOnDevelopmentOrStagingEnv($url)
    {
        return
            app()->environment() !== 'production' &&
            $this->getFolderNameByUrl($url) !== app()->environment();
    }
}
