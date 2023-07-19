<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Blacklist;
use App\Models\User;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // $users = Blacklist::find(1)->user;
        // dd($users);
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
        $users = User::where('role', 'user')->get();
        return Inertia::render('Dashboard/Blacklists/Create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
			'full_name' => 'required|min:2',
			'user_id' => 'required|unique:blacklists,user_id',
			'start_date' => 'required|date',
			'end_date' => 'required|date',
			'description' => 'required|min:10'
		]);

        Blacklist::create([
            'full_name' => $request->full_name,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return redirect()->route('blacklists.index')->with('success', 'Blacklists Has Been Created!');
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
        Blacklist::destroy($blacklist->id);
        return redirect()->route('blacklists.index')->with('success', 'User deleted successfully.');
    }
}
