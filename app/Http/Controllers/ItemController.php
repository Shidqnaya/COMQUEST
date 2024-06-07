<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function create(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama' => 'required|string|max:255',
            'price' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle the file upload
        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('gambaritem'), $imageName);

        // Create the item
        $item = new Item;
        $item->nama = $request->nama;
        $item->price = $request->price;
        $item->foto = $imageName;

        if ($item->save()) {
            return back()->with('success', 'Item created successfully.');
        } else {
            return back()->with('error', 'Failed to create item.');
        }
    }

    public function purchase($itemId)
{
    $user = Auth::user(); // Assuming the user is authenticated

    // Retrieve the item using the item ID
    $item = Item::findOrFail($itemId);

    // Check if the user already owns this item
    $userItem = UserItem::where('user_id', $user->id)->where('item_id', $item->id)->first();

    if ($userItem) {
        return back()->with('info', 'You already own this item.');
    }

    // Check if the user has enough balance to purchase the item
    if ($user->balance < $item->price) {
        return back()->with('error', 'Balance tidak mencukupi.');
    }

    // Deduct the item price from the user's balance
    $user->balance -= $item->price;
    $user->save();

    // If the user does not own the item, create a new record
    UserItem::create([
        'user_id' => $user->id,
        'item_id' => $item->id,
    ]);

    return back()->with('success', 'Item purchased successfully.');
}



    public function update(Request $request, Item $item)
    {
        // Validate the request
        $request->validate([
            'nama' => 'required|string|max:255',
            'price' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle the file upload
        if ($request->hasFile('foto')) {
            $imageName = time().'.'.$request->foto->extension();  
            $request->foto->move(public_path('gambaritem'), $imageName);
            $item->foto = $imageName;
        }

        // Update the item
        $item->nama = $request->nama;
        $item->price = $request->price;

        if ($item->save()) {
            return back()->with('success', 'Item updated successfully.');
        } else {
            return back()->with('error', 'Failed to update item.');
        }
    }

    public function destroy(Item $item)
    {
        // Delete the item
        if ($item->delete()) {
            return back()->with('success', 'Item deleted successfully.');
        } else {
            return back()->with('error', 'Failed to delete item.');
        }
    }
}
