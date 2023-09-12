<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Suggestion;

class DashboardSuggestionController extends Controller
{
    public function index(Request $request)
    {
        $suggestions = Suggestion::query()->with('user')->orderByDesc('id');
        return Inertia::render('Dashboard/Suggestions/Index',
            [
                'suggestions' => $suggestions
                ->when($request->input('search'), function($query, $search) {
                    $query->where('comment', 'like', '%'.$search.'%')
                    ->orWhere('suggestion', 'like', '%'.$search.'%');
                })->paginate(10)->withQueryString(),
                'filters' => $request->only(['search'])
            ]
        );
    }

    public function delete(string $id)
    {
        Suggestion::findOrFail($id)->delete();
        return redirect()->route('suggestions.index')->with('success', 'Suggestion deleted successfully');
    }
}
