<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryBook;

class LibrarybookController extends Controller
{
    public function index()
    {
        $librarybooks = LibraryBook::all();
        return view('index', compact('librarybooks'));
    }

    public function insert(Request $req)
    {
        $data = $req->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'quantity' => 'required|integer',
            'publish_year' => 'required|integer',
            'image' => 'required|image'
        ]);

        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $fileName = $file->getClieOriginalName();
            $file->move('image/', $fileName);
            $data['image'] = 'image/' . $fileName;
        }

        LibraryBook::create($data);
        return redirect('/');
    }

    public function delete($id)
    {
        $book = LibraryBook::findOrFail($id);
        $book->delete();
        return redirect('/');
    }

    public function update(Request $req, $id)
    {
        $book = LibraryBook::findOrFail($id);

        $data = $req->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'publish_year' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move('image/', $fileName);
            $data['image'] = 'image/' . $fileName;
        }

        $book->update($data);
        return redirect('/');
    }
}