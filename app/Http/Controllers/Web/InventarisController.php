<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of inventory items.
     */
    public function index()
    {
        // TODO: Implement inventory list view
        return view('inventaris.index');
    }

    /**
     * Show the form for creating a new inventory item.
     */
    public function create()
    {
        // TODO: Implement create form
        return view('inventaris.create');
    }

    /**
     * Store a newly created inventory item.
     */
    public function store(Request $request)
    {
        // TODO: Validate & save inventory item
        // Placeholder response
        return redirect()->route('inventaris.index')->with('alert', 'Item inventaris berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit($id)
    {
        // TODO: Load item and return edit view
        return view('inventaris.edit', compact('id'));
    }

    /**
     * Update the specified inventory item.
     */
    public function update(Request $request, $id)
    {
        // TODO: Validate & update item
        return redirect()->route('inventaris.index')->with('alert', 'Item inventaris berhasil diupdate.');
    }

    /**
     * Remove the specified inventory item.
     */
    public function destroy($id)
    {
        // TODO: Delete item
        return redirect()->route('inventaris.index')->with('alert', 'Item inventaris berhasil dihapus.');
    }
}
?>