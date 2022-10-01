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
        $url;

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
}
