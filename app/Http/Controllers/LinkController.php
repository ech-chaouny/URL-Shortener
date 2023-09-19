<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $getLinks = Link::where('user_id', $user_id)->latest()->get();
        return response()->json($getLinks);
    }

    /**
     * Show basic stats about URL visits, most visited URLs.
     */
    public function mostVisited($user_id)
    {
        $mostVisitedUrls = Link::where('user_id', $user_id)->orderByDesc('visits')
            ->take(10)
            ->get();
        return response()->json($mostVisitedUrls);
    }
    public function totalVisits($user_id)
    {
        $totalVisits = Link::where('user_id', $user_id)->sum('visits');
        return response()->json($totalVisits);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        $link = Link::create([
            'full_link' => $request->full_link,
            'name_link' => $request->name_link,
            'shortner_link' => 'linkshort.ech' . Str::random(5),
            'visits' => 0,
            'user_id' => $request->user_id,
        ]);
        return response()->json($link);
    }

    /**
     * Display the specified resource.
     */
    public function show($shortner_link)
    {
        $link = Link::where('shortner_link', $shortner_link)->first();
        //update number of visits
        $link->increment('visits');
        //Redirect the user to the real URL
        return redirect($link->full_link);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link->update([
            'full_link' => $request->full_link,
            'full_name' => $request->full_name,
            'shortner_link' => 'www.linkshort' + Str::random(4) + '.ech',
            'visits' => 0,
            'user_id' => $request->user_id,
        ]);
        return response()->json($link);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($url_id)
    {
        $link = Link::find($url_id);
        $link->delete();
        return response()->json('deleted success');
    }
}
