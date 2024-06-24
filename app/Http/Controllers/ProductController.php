<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->id())->paginate(6); // Paginate with 6 products per page
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'available' => 'required|integer',
            'description' => 'required|string',
            'image_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Initialize thumbnailPath and imagePaths
        $thumbnailPath = null;
        $imagePaths = [];

        // Validate and store image_thumbnail if provided
        if ($request->hasFile('image_thumbnail')) {
            $thumbnailPath = $request->file('image_thumbnail')->store('thumbnails', 'public');
        }

        // Process and store multiple images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        // Get the authenticated user's shop_id
        $shopId = auth()->user()->shops()->first()->id;
        $description = new HtmlString($request->description);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'available' => $request->available,
            'description' => $description,
            'image_thumbnail' => $thumbnailPath,
            'images' => json_encode($imagePaths),
            'user_id' => auth()->id(),
            'shop_id' => $shopId,
        ]);

        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric', // Add validation for discount
            'available' => 'required|integer',
            'description' => 'required|string',
            'image_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Handle image update if provided
        if ($request->hasFile('image_thumbnail')) {
            // Validate and store image_thumbnail
            $thumbnailPath = $request->file('image_thumbnail')->store('thumbnails', 'public');
            $product->image_thumbnail = $thumbnailPath;
        }

        // Update other fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->price_discount = $request->price_discount; // Update discount field
        $product->available = $request->available;
        $product->description = new HtmlString($request->description);

        // Process and store multiple images if provided
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
            $product->images = json_encode($imagePaths);
        }

        // Save the updated product
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        Product::destroy($id);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    public function fetchHotDeals()
    {
        $hotDeals = Product::whereNotNull('price_discount')
            ->select('id', 'name', 'price', 'price_discount', 'image_thumbnail')
            ->limit(3) // Limit to 3 hot deals
            ->get();

        return $hotDeals;
    }

    /**
     * Show the welcome page.
     */
    public function welcome()
    {
        $hotDeals = Product::with('shop')->where('price_discount', '>', 0)->limit(3)->get();

        return view('welcome', compact('hotDeals'));
    }
}
