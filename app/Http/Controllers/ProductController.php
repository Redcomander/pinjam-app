<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Nette\Utils\Html;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = CartItem::all();
        $products = Product::where('user_id', auth()->id())->paginate(6); // Paginate with 6 products per page
        return view('product.index', compact('products', 'cartItems'));
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
            'category' => 'required|string|max:255',
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
            'category' => $request->category,
            'user_id' => auth()->id(),
            'shop_id' => $shopId,
        ]);

        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Decode images from JSON string to array
        $images = json_decode($product->images, true); // Ensure it's decoded as an associative array

        // Check if decoding was successful and images is an array
        if (!is_array($images)) {
            $images = []; // Set default empty array if decoding fails or returns null
        }

        return view('product.show', compact('product', 'images'));
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
        $product->category = $request->category;
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
        $cartItems = CartItem::all();
        $hotDeals = Product::with('shop')->where('price_discount', '>', 0)->limit(3)->get();

        return view('welcome', compact('hotDeals', 'cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $cartItem = CartItem::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($cartItem) {
            // Increment the quantity of the existing cart item
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create a new cart item
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => $request->quantity,
                'duration' => $request->duration,
                'available' => 1,
                'image_thumbnail' => $product->image_thumbnail, // Assuming you fetch this from the product model
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }



    public function clearCart()
    {
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::find($id);

        if ($cartItem && $cartItem->user_id == Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Item removed from cart.');
    }

    public function cart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        return view('cart', compact('cartItems'));
    }
}
