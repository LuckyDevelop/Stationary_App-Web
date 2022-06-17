<?php

namespace App\Http\Controllers;

use App\Models\Qty;
use App\Models\Stock;
use App\Models\Type;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Type::all();
        $uoms = Qty::all();
        $stocks = Stock::orderBy('stock_name', 'asc')->paginate(20);
        if (request('search') == null || request('search') == " ") {
            $stocks = Stock::orderBy('stock_name', 'asc')->paginate(20);
        } else {
            $search = request('search');
            $stocks = Stock::orderBy('stock_name', 'asc')->where('stock_name', 'like', '%' . $search . '%')
                ->orWhereHas("Type", function ($query) use ($search) {
                    $query->where('type_name', 'like', '%' . $search . '%');
                })
                ->paginate(20);
        }
        return view('stocks.stock', compact('stocks', 'uoms', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     "stock_name" => 'required',
        //     "qty_id" => 'required',
        //     "type_id" => 'required',
        //     "qty" => 0,
        // ]);
        Stock::create([
            "stock_name" => $request->stock_name,
            "qty_id" => $request->qty_name,
            "type_id" => $request->type_name,
            "qty" => 0,
        ]);

        // Stock::create($validate);
        return redirect('/stock');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
