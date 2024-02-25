<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSupplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSuppliesController extends Controller
{
    public function indexIncome (Request $request) {
        if($request->has('search')){
            $productsIncome = ProductSupplies::with(['product', 'user', 'supplier'])
            ->join('products', 'product_supplies.product_id', '=', 'products.id')
                ->where('products.name', 'LIKE' ,"%{$request->search}%")
                ->where('product_supplies.type', '=','income')->paginate(10);
        } else {
            $productsIncome = ProductSupplies::with(['product', 'user', 'supplier'])->where('type', '=','income')->paginate(10);
        }
        
        return view('dashboard.income.index', ['productsIncome'=>$productsIncome]);
    }

    public function indexOutcome(Request $request) {
        $userRole = Auth::user()->role;
    
        if($userRole === 'admin') {
            if($request->has('search')){
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->join('products', 'product_supplies.product_id', '=', 'products.id')
                ->where('products.name', 'LIKE' ,"%{$request->search}%")
                ->where('product_supplies.status', 'pending')
                ->where('product_supplies.type', '=','outcome')->paginate(10);
            } else {
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->where('status', 'pending')
                ->where('type', '=','outcome')->paginate(10);
            }
        } else if($userRole === 'officer') {
            if($request->has('search')){
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->join('products', 'product_supplies.product_id', '=', 'products.id')
                ->where('products.name', 'LIKE' ,"%{$request->search}%")
                ->where('user_id', Auth::user()->id)
                ->where('product_supplies.status', 'pending')
                ->where('product_supplies.type', '=','outcome')->paginate(10);
            } else {
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->where('user_id', Auth::user()->id)
                ->where('status', 'pending')
                ->where('type', '=','outcome')->paginate(10);
            }
        } else {
            abort(403, 'Unauthorized');
        }
    
        return view('dashboard.outcome.index', ['productsOutcome' => $productsOutcome]);
    }

    public function outcome(Request $request) {
        $userRole = Auth::user()->role;
    
        if($userRole === 'admin') {
            if($request->has('search')){
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->join('products', 'product_supplies.product_id', '=', 'products.id')
                ->where('products.name', 'LIKE' ,"%{$request->search}%")
                ->where('product_supplies.status', 'approved')
                ->where('product_supplies.type', '=','outcome')->paginate(10);
            } else {
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->where('status', 'approved')->where('type', '=','outcome')
                ->orderBy('updated_at', 'desc')->paginate(10);
            }
        } else if($userRole === 'officer') {
            if($request->has('search')){
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->join('products', 'product_supplies.product_id', '=', 'products.id')
                ->where('products.name', 'LIKE' ,"%{$request->search}%")
                ->where('user_id', Auth::user()->id)
                ->where('product_supplies.status', 'approved')
                ->where('product_supplies.type', '=','outcome')->paginate(10);
            } else {
                $productsOutcome = ProductSupplies::with(['product', 'user', 'supplier'])
                ->where('user_id', Auth::user()->id)
                ->where('status', 'approved')
                ->where('type', '=','outcome')->paginate(10);
            }
        } else {
            abort(403, 'Unauthorized');
        }
    
        return view('dashboard.outcome.out', ['productsOutcome' => $productsOutcome]);
    }
    

    public function createIncome(){
        return view('dashboard.income.input');
    }

    public function createOutcome(){
        return view('dashboard.outcome.input');
    }

    public function storeIncome(Request $request) {
        $this->validate($request, [
            'date'=> ['required'],
            'quantity'=>['required'],
            'product'=>['required'],
            'supplier'=>['required'],
        ]);

       $created = ProductSupplies::create([
            'product_id'=>$request->product,
            'supplier_id'=>$request->supplier,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
            'type'=>'income',
            'status'=>'pending'
            
       ]);

       $sumIncomeQuantity = ProductSupplies::where('type', 'income')->where('product_id', $request->product_id)->sum('quantity');
       $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->where('product_id', $request->product_id)->sum('quantity');
       $product = Product::findOrFail($request->product_id);
       $quantityUpdated = $product->update([
        //'stock'=>($sumIncomeQuantity - $sumOutcomeQuantity)
        'stock'=>$product->stock + $request->quantity
       ]);

       if($created && $quantityUpdated){
        return redirect('/barang-masuk')->with('message', 'data berhasil ditambahkan');
       }
    }

    // public function storeOutcome(Request $request) {
    //     $this->validate($request, [
    //         'date'=> ['required'],
    //         'quantity'=>['required'],
    //         'product_id'=>['required'],
    //         //'supplier_id'=>['required'],
    //     ]);

    //    $created = ProductSupplies::create([
    //         'product_id'=>$request->product_id,
    //         //'supplier_id'=>$request->supplier_id,
    //         'user_id'=>Auth::user()->id,
    //         'date'=>$request->date,
    //         'quantity'=>$request->quantity,
    //         'type'=>'outcome',
    //         'status'=>'pending'
            
    //    ]);

    //    $sumIncomeQuantity = ProductSupplies::where('type', 'income')->where('product_id', $request->product_id)->sum('quantity');
    //    $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->where('product_id', $request->product_id)->sum('quantity');
    //    $product = Product::findOrFail($request->product_id);
    //    $quantityUpdated = $product->update([
    //     'stock'=>$sumIncomeQuantity - $sumOutcomeQuantity
    //    ]);

    //    if($created && $quantityUpdated){
    //     return redirect('/barang-permintaan')->with('message', 'data berhasil disimpan');
    //    }
    // }

    public function storeOutcome(Request $request) {
        $this->validate($request, [
            'date'=> ['required'],
            'quantity'=>['required'],
            'product'=>['required'],
            //'supplier_id'=>['required'],
        ]);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->where('product_id', $request->product_id)->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->where('product_id', $request->product_id)->sum('quantity');
        $product = Product::findOrFail($request->product_id);
        $stockProduct = $product->stock - $request->quantity;

        if($stockProduct >= 0){
            $created = ProductSupplies::create([
                'product_id'=>$request->product,
                //'supplier_id'=>$request->supplier_id,
                'user_id'=>Auth::user()->id,
                'date'=>$request->date,
                'quantity'=>$request->quantity,
                'type'=>'outcome',
                'status'=>'pending'
                
            ]);
            $quantityUpdated = $product->update([
                'stock'=>$stockProduct
            ]); 
        } else {
            return redirect('/barang-permintaan')->with('error', 'gagal, stok tidak cukup');
        }

        if($created && $quantityUpdated){
            return redirect('/barang-permintaan')->with('message', 'data berhasil disimpan');
        } else {
            return redirect('/barang-permintaan')->with('error', 'ups ada yang salah nih');
        }
    }

    public function deleteProductSupply($id) {
        $productSupply = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productSupply->product_id);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        if($productSupply->type === 'outcome'){
            $updated = $product->update([
                'stock'=>$product->stock + $productSupply->quantity
            ]);
        } else {
            $updated = $product->update([
                'stock'=>$product->stock - $productSupply->quantity
            ]);
        }
        $deleted = $productSupply->delete();
        if($deleted && $updated){
            session()->flash('message', 'berhasil hapus data');
            return response()->json(['message'=> 'success delete data'],200);
        }
    }

    public function editIncome ($id) {
        $productIncome = ProductSupplies::findOrFail($id);
        return view('dashboard.income.update', ['productIncome'=>$productIncome]);
    }

    public function editOutCome ($id) {
        $productOutcome = ProductSupplies::findOrFail($id);
        return view('dashboard.outcome.update', ['productOutcome'=>$productOutcome]);
    }

    public function updateIncome(Request $request, $id) {
        $productIncome = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productIncome->product_id);

        $updated = $productIncome->update([
            'product_id'=>$request->product_id,
            'supplier_id'=>$request->supplier_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
        ]);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        $product->update([
            'stock'=>$product->stock + $request->quantity
        ]);

        if($updated){
            return redirect('/barang-masuk')->with('message', 'data berhasil diubah');
        }
    }

    public function updateOutcome(Request $request, $id) {
        $productOutcome = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productOutcome->product_id);

        $updated = $productOutcome->update([
            'product_id'=>$request->product_id,
            'supplier_id'=>$request->supplier_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
        ]);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        $product->update([
            'stock'=>($sumIncomeQuantity - $sumOutcomeQuantity)
        ]);

        if($updated){
            return redirect('/barang-keluar')->with('message', 'data berhasil diubah');
        }
    }

    public function approveOutcome($id)
    {
        $productOutcome = ProductSupplies::findOrFail($id);

        if ($productOutcome->status === 'pending') {
            $productOutcome->update(['status' => 'approved']);
            return redirect()->back()->with('message', 'Product Outcome approved successfully.');
        }

        return redirect()->back()->with('message', 'Unable to approve Product Outcome. Status is not pending.');
    }
}
