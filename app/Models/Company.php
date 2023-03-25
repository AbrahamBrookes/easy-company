<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];


    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Save an uploaded logo file to storage, and return its path.
     */
    public function saveLogo(UploadedFile $file)
    {
        // force create any directories that don't exist
        Storage::makeDirectory('public/companies/' . $this->id . '/logo', 0644, true);
        // store the file,
        $path = $file->store('public/companies/' . $this->id . '/logo', 'local', true);

        // update the model with the new path
        $this->update([
            'logo' => $path,
        ]);
    }

    /**
     * Delete the logo file from storage.
     */
    public function deleteLogo()
    {
        if ($this->logo) {
            Storage::delete($this->logo);
        }
    }

    /**
     * The logo is either a file path to storage or a url.
     * If it's a url, just return it.
     * If it's a file path, return the url to the file.
     */
    public function getLogoUrlAttribute()
    {
        if (isset(parse_url($this->logo)['host'])) {
            return $this->logo;
        } else {
            return config('app.url') . Storage::url($this->logo);
        }
    }
}
