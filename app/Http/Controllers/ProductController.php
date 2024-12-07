<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();
    
        if ($request->filled('search')) {
            $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->search) . '%']);
        }
    
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $products = $query->paginate(10);
        return view('products.index', compact('products', 'categories'));
    }
    
    public function create(){
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,png|max:100'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
    // Menyimpan data produk ke database
    Product::create([
        'category_id' => $validated['category_id'],
        'name' => $validated['name'],
        'purchase_price' => $validated['purchase_price'],
        'sale_price' => $validated['sale_price'],
        'stock' => $validated['stock'],
        'image' => $imagePath ?? null,
    ]);
        
        return redirect ()
        ->route('products.index')
        ->with('success','Produk berhasil ditambahkan!');
    }

    public function edit( $id){
    $product = Product::findOrFail($id);
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|unique:products,name,' . $id,
            'purchase_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        $product->category_id = $validated['category_id'];
        $product->name = $validated['name'];
        $product->purchase_price = $validated['purchase_price'];
        $product->sale_price = $validated['purchase_price'] * 1.3;
        $product->stock = $validated['stock'];
    
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }
    
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
    

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
    
        // Hapus data produk dari database
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
    
    public function export()
    {
    return Excel::download(new ProductsExport, 'Data_Produk.xlsx');
    }

}
