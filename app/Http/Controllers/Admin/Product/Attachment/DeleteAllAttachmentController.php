<?php

namespace App\Http\Controllers\Admin\Product\Attachment;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteAllAttachmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $product = Product::findOrFail($id);
        Media::where(['model_id' => $id, 'collection_name' => 'product_attachments'])->get();
        $product->clearMediaCollection('product_attachments');
        toastr()->info('All Attachments Has Been Deleted Successfully');
        return redirect()->back();
    }
}