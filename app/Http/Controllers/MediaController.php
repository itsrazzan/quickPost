<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Tampilkan media library milik user yang sedang login.
     * Relasi user->media() otomatis membatasi hasil ke media milik user ini.
     */
    public function index(Request $request): View
    {
        $mediaItems = $request->user()
            ->media()
            ->latest()
            ->paginate(24);

        return view('workspace.media-library', ['mediaItems' => $mediaItems]);
    }

    /**
     * Simpan gambar yang diunggah ke disk "public", lalu catat metadatanya.
     * Disk "public" dipakai eksplisit karena FILESYSTEM_DISK default = local
     * (private) sehingga tidak bisa diakses browser.
     */
    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $file = $request->file('file');

        // Simpan fisik file di storage/app/public/media/{user_id}.
        $path = $file->store('media/'.$request->user()->id, 'public');

        // getimagesize mengembalikan [width, height] untuk gambar.
        $size = @getimagesize($file->getRealPath());

        $request->user()->media()->create([
            'disk' => 'public',
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'dimensions' => $size ? ['width' => $size[0], 'height' => $size[1]] : null,
            'metadata' => null,
        ]);

        return to_route('media-library')->with('status', 'Media uploaded.');
    }

    /**
     * Hapus media (soft delete). File fisik sengaja dipertahankan agar masih
     * bisa dipulihkan bila fitur restore ditambahkan nanti.
     */
    public function destroy(Request $request, Media $media): RedirectResponse
    {
        // Cari lewat relasi user agar user tidak bisa menghapus media user lain.
        $request->user()
            ->media()
            ->findOrFail($media->getKey())
            ->delete();

        return to_route('media-library')->with('status', 'Media moved to recently deleted.');
    }
}
