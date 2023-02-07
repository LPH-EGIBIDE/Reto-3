<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Attachment
     */
    public function store(UploadedFile $file, $isPublic = true)
    {
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', uniqid().'.bin', 'public');
        $fileType = $file->getMimeType();

        $attachment = new Attachment();
        $attachment->file_name = $fileName;
        $attachment->file_path = $filePath;
        $attachment->file_type = $fileType;
        $attachment->persona_id = auth()->user()->persona->id;
        $attachment->is_public = intval($isPublic);
        $attachment->save();

        return $attachment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show($id, $width = null, $height = null)
    {
        $attachment = Attachment::findOrFail($id);
        if (!$attachment->is_public && $attachment->persona_id != auth()->user()->persona->id) {
            abort(403);
        }
        $file = Storage::disk('public')->get($attachment->file_path);
        $image_mime_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if ($width && $height && in_array($attachment->file_type, $image_mime_types)) {
            $width = min(intval($width), 1000);
            $height = min(intval($height), 1000);
            $image = Image::make($file);
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->fit($width, $height);
            $file = $image->encode();
        }
        return response($file, 200)->header('Content-Type', $attachment->file_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return boolean
     */
    public function destroy(Attachment $attachment)
    {
        //Delete the file from the storage
        Storage::disk('public')->delete($attachment->file_path);
        //Delete the record from the database
        $attachment->delete();
        return true;
    }
}
