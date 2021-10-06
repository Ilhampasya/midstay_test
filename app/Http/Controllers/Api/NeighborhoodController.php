<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Neighborhood::query();

        if ($request->search) {
            $query = $query->where('name', 'like', "%{$request->search}%");
        }

        return response()->jsonApi(
            $query->latest()
            ->paginate($request->perPage ?: 10)
        );
    }
}
