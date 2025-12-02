<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file fisik
        $path = public_path('uploads/' . $media->file_name);
        if (File::exists($path)) {
            File::delete($path);
        }

        // Hapus record database
        $media->delete();

        return back()->with('success', 'Media berhasil dihapus');
    }
     public function destroyPerangkatDesa($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file fisik
        $filePath = public_path('uploads/perangkat_desa/' . $media->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus dari database
        $media->delete();

        return back()->with('success', 'Media berhasil dihapus');
    }
}
