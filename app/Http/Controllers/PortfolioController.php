<?php

namespace App\Http\Controllers;

use App\DataTables\PortfolioDataTable;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortfolioController extends Controller
{
    public function index(PortfolioDataTable $dataTable)
    {
        return $dataTable->render('admin.portfolio');
    }

    public function create()
    {
        return view('admin.portfolio-form');
    }

    public function edit($slug)
    {
        $data = Portfolio::where('slug', $slug)->first();
        return view('admin.portfolio-form', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $newName = '';
        if($request->id) {
            $validated = $request->validate([
                "title" => "required",
            ]);    
            $newName = Portfolio::findOrFail($request->id)->image;
        } else {
            $validated = $request->validate([
                "title" => "required",
                "image" => "required|image|mimes:jpg,png,jpeg,gif,svg"
            ]);
        }

        if($request->file('image')) {
            $extenstion = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extenstion;
            $request->file('image')->storeAs('public/portfolio', $newName);
        }

        $count = strlen($request->content);
        $preview = "";
        if ($count != 0) {
            $preview = substr(strip_tags($request->content), 0, 100) . "...";
        }

        $data = Portfolio::updateOrCreate([
            "id" => $request->id
        ],[
            "title" => $request->title,
            "image" => $newName,
            "content" => $request->content,
            "short_content" => $preview
        ]);

        $text = "Data Created";
        if($request->id) {
            $text = "Data Updated";
        }

        Session::flash('status', 'success');
        Session::flash('text', $text);

        return response()->json(['redirect' => '/portfolio']);
    }

    public function destroy(Request $request)
    {
        $data = Portfolio::where('slug', $request->slug)->first();
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }
}
