<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();
        sleep(1); // 1 detik delay untuk simulasi loading 

        // Global Search
        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $filters = request('filters', []);

        foreach ($filters as $field => $filter) {

            $value = $filter['value'] ?? null;
            $operator = $filter['operator'] ?? 'like';

            if (empty($value)) {
                continue;
            }

            if ($operator === 'like') {
                $query->where(
                    $field,
                    'like',
                    "%{$value}%"
                );
            } else {
                $query->where(
                    $field,
                    $operator,
                    $value
                );
            }
        }
        // Sorting
        if ($request->sort_by) {
            $query->orderBy(
                $request->sort_by,
                $request->sort_direction ?? 'asc'
            );
        }

        $users = $query->paginate(
            $request->per_page ?? 10
        );

        return response()->json([
            'data' => $users->items(),
            'meta' => [
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'total'        => $users->total(),
                'last_page'    => $users->lastPage(),
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $query = User::query();
        sleep(1); // 1 detik delay untuk simulasi loading 

        // Global Search
        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $filters = request('filters', []);

        foreach ($filters as $field => $filter) {

            $value = $filter['value'] ?? null;
            $operator = $filter['operator'] ?? 'like';

            if (empty($value)) {
                continue;
            }

            if ($operator === 'like') {
                $query->where(
                    $field,
                    'like',
                    "%{$value}%"
                );
            } else {
                $query->where(
                    $field,
                    $operator,
                    $value
                );
            }
        }
        // Sorting
        if ($request->sort_by) {
            $query->orderBy(
                $request->sort_by,
                $request->sort_direction ?? 'asc'
            );
        }

        $users = $query->paginate(
            $request->per_page ?? 10
        );

        return response()->json([
            'data' => $users->items(),
            'meta' => [
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'total'        => $users->total(),
                'last_page'    => $users->lastPage(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
