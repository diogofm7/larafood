<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function categories(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct))
            return redirect()->back();

        $filters = $request->except('_token');

        $categories = $product->categoriesAtaccheds($request->filter);

        return view('admin.pages.products.categories.categories', [
            'product' => $product,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    public function products($idCategory)
    {
        if (!$category = $this->category->find($idCategory))
            return redirect()->back();

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct))
            return redirect()->back();

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    public function categoriesAttach(Request $request, $idProduct)
    {
        if ((!$product = $this->product->find($idProduct)) || (!$request->categories))
            return redirect()->back();

        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products.categories', $product->id);
    }

    public function categoriesDetach($idProduct, $idCategory)
    {
        $product = $this->product->with('categories')->find($idProduct);
        $category = $product->categories->find($idCategory);


        if (!$product || !$category)
            return redirect()->back();

        $product->categories()->detach($category);

        return redirect()->route('admin.products.categories', $product->id);
    }
}
