<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Blacklist;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        return Inertia::render(
            'Dashboard/Blacklists/Index', 
            [
                'blacklists' => Blacklist::query()
                ->when($request->input('search'), function($query, $search){
                    $query->where('full_name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
                })->orderByDESC('id')->paginate(6)->withQueryString(),
                'filters' => $request->only(['search'])
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blacklist $blacklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blacklist $blacklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blacklist $blacklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blacklist $blacklist)
    {
        //
    }
}
