<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        $educations = Education::orderBy('id', 'desc')->get();
        $experiences = Experience::orderBy('id', 'desc')->get();
        $services = Service::all();
        $portfolios = Portfolio::orderBy('id', 'desc')->limit(4)->get();
        $blogs = Blog::orderBy('id', 'desc')->limit(4)->get();
        return view('index', [
            'skills' => $skills,
            'educations' => $educations,
            'experiences' => $experiences,
            'services' => $services,
            'portfolios' => $portfolios,
            'blogs' => $blogs,
        ]);
    }

    public function contact_me(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email",
            "subject" => "required|min:3",
            "message" => "required|min:3",
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            "text" => "Pesan anda berhasil dikirimkan"
        ]);
    }

    public function service_detail($slug)
    {
        $service = Service::where('slug', $slug)->first();
        return view('service-detail', ['service' => $service]);
    }

    public function portfolios()
    {
        $portfolios = Portfolio::orderBy('id', 'desc')->get();
        return view('portfolios', ['portfolios' => $portfolios]);
    }

    public function portfolio_detail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->first();
        return view('portfolio-detail', ['portfolio' => $portfolio]);
    }

    public function blogs()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('blogs', ['blogs' => $blogs]);
    }
    
    public function blog_detail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('blog-detail', ['blog' => $blog]);
    }
    
}
