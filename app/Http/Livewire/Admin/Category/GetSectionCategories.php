<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Str;

class GetSectionCategories extends Component
{
    public  $section,
        $parent_id,
        $categories;


    public $name,
        $url;

    public function generateURL()
    {
        $this->url = Str::slug($this->name, '-');
    }

    public function updatedSection($section_id)
    {
        $this->categories = Category::with('subCategories')->where(['section_id' => $section_id, 'parent_id' => 0])->get();
    }

    public function render()
    {
        return view('livewire.admin.category.get-section-categories', [
            'sections'  => Section::all(),
        ]);
    }
}