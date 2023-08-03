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
      
        $blacklists = Blacklist::query()->with('user');
        return Inertia::render(
            'Dashboard/Blacklists/Index', 
            [
                'blacklists' => $blacklists
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
        $users = User::where('role', 'user')
        ->whereNull('blacklist_id')
        ->get();
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

        $user = User::findOrFail($request->user_id);

        $blacklist = new Blacklist();
        $blacklist->full_name = $request->full_name;
        $blacklist->user_id = $request->user_id;
        $blacklist->start_date = $request->start_date;
        $blacklist->end_date = $request->end_date;
        $blacklist->description = $request->description;
        $blacklist->save();

        $user->blacklist_id = $blacklist->id;
        $user->save();

        return redirect()->route('blacklists.index')->with('success', 'Blacklists Has Been Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::where('role', 'user')
        ->get();

        $blacklist = Blacklist::findOrFail($id);
        return Inertia::render('Dashboard/Blacklists/Edit', [
            'users' => $users,
            'blacklist' => $blacklist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
			'full_name' => 'required|min:2',
			'user_id' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|date',
			'description' => 'required|min:10'
		]);

        $blacklist = Blacklist::findOrFail($id);
        $blacklist->full_name = $request->full_name;
        $blacklist->user_id = $request->user_id;
        $blacklist->start_date = $request->start_date;
        $blacklist->end_date = $request->end_date;
        $blacklist->description = $request->description;
        $blacklist->save();

        $user = User::findOrFail($request->user_id);
        $user->blacklist_id = $blacklist->id;
        $user->save();

        return redirect()->route('blacklists.index')->with('success', 'Blacklist has been updated and associated with the user!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blacklist = Blacklist::findOrFail($id);

        $user = User::where('blacklist_id', $blacklist->id)->first();
        if ($user) {
            $user->blacklist_id = null;
            $user->save();
        }
        
        $blacklist->delete();
        return redirect()->route('blacklists.index')->with('success', 'User deleted successfully.');
    }
}
