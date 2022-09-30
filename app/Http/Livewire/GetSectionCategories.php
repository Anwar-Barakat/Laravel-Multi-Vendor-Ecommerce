<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class GetSectionCategories extends Component
{
    use WithFileUploads;
    public  $section,
        $categories;


    public $name,
        $url,
        $section_id,
        $parent_id,
        $discount,
        $image,
        $description,
        $meta_title,
        $meta_description,
        $meta_keywords;

    public function generateURL()
    {
        $this->url = Str::slug($this->name, '-');
    }

    public function render()
    {
        return view('livewire.get-section-categories', [
            'sections'  => Section::all(),
        ]);
    }

    public function updatedSection($section_id)
    {
        $this->categories = Category::with('subCategories')->where(['section_id' => $section_id, 'parent_id' => 0])->get();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'              => ['required', 'min:3', 'regex:/^[\pL\s\-]+$/u'],
            'url'               => ['required'],
            'section_id'        => ['required'],
            'parent_id'         => ['required'],
            'discount'          => ['required', 'numeric'],
            'image'             => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'meta_title'        => ['required', 'min:3'],
            'meta_description'  => ['required', 'min:10'],
            'meta_keywords'     => ['required', 'min:3'],
        ]);
    }

    public function addCategory()
    {
        $data = $this->validate([
            'name'              => ['required', 'min:3', 'regex:/^[\pL\s\-]+$/u'],
            'url'               => ['required'],
            'section'           => ['required'],
            'categories'        => ['required'],
            'discount'          => ['required', 'numeric'],
            'image'             => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'description'       => ['required', 'min:10'],
            'meta_title'        => ['required', 'min:3'],
            'meta_description'  => ['required', 'min:10'],
            'meta_keywords'     => ['required', 'min:3'],
        ]);

        $category = Category::create($data);


        if ($this->image) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('image')->toMediaCollection('categories');
        }

        $this->reset();

        toastr()->success('Category Has Been Added Successfully');
    }
}