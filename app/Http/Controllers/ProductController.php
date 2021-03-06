<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product, $review;

    public function __construct(Product $product, Review $review)
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);
        $this->product = $product;
        $this->review = $review;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->paginate(9);
        $prices = $this->product->pricesCalculation($products);
        return view('home', compact('products', 'prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataValid = $this->validate($request, [
            'name' => 'required|max:60',
            'sku' => 'required|string|max:4',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'sometimes|nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);
        $dataValid['status'] = $request->status == true ? 1 : 0;

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('/images' . '/'), $fileName);

        $dataValid['image'] = $fileName;

        $this->product->create($dataValid);
        return redirect('/')->withSuccess('Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('review')->findOrFail($id);
        $price = $this->product->priceCalculation($product);
        return view('product.index', compact('product', 'price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = $this->product->findOrFail($id);

        $dataValid = $this->validate($request, [
            'name' => 'required|max:60',
            'sku' => 'required|string|max:4',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'sometimes|nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);
        $dataValid['status'] = $request->status == true ? 1 : 0;

        if ($request->has('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/images' . '/'), $fileName);

            $dataValid['image'] = $fileName;

            if (\File::exists(public_path('images' . '/' . $product->image))) {
                \File::delete(public_path('images' . '/' . $product->image));
            }
        }
        $product->update($dataValid);
        return redirect('/product' . '/' . $id)->withSuccess('Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        if (\File::exists(public_path('images' . '/' . $product->image))) {
            \File::delete(public_path('images' . '/' . $product->image));
        }
        $product->delete();
        return redirect('/')->withSuccess('Product has been deleted');
    }
}
