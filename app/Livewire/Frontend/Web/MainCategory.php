<?php

namespace App\Livewire\Frontend\Web;

use App\Models\Business\Categories;
use App\Models\Warehouse\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]
class MainCategory extends Component
{
    public $slug;
    public $category;
    public $subCategories;
    public $products;
    public $mainCategory;
    // Route parameter theke slug auto mount e chole ashbe
    public function mount($slug)
    {
        $this->slug = $slug;

        // 1. Main category ta khuje ber kora with recursive children
        $this->mainCategory = Categories::with('childrenRecursive')->where('slug', $slug)->firstOrFail();

        // 2. Direct sub-categories gulo neya (view er jonno)
        $this->subCategories = Categories::where('parent_id', $this->mainCategory->id)->get();

        // 3. Oi Main Category-r under-e thaka sob recursive sub-categories-er ID gulo neya
        $subCategoryIds = $this->mainCategory->getAllDescendantIds();

        // 4. Main Category-r ID-tao list-e rakha (jodi kichu product main-e thake)
        $allIds = array_merge([$this->mainCategory->id], $subCategoryIds);

        // 5. Products Table theke query kora
        $this->products = Product::whereIn('category_id', $allIds)
            ->latest()
            ->take(15)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.web.main-category');
    }
}
