<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    //
    public function index(Request $request): Response
    {
        $query = User::query();

        // 1. Proses Filter Search
        if ($request->filled('search')) {
            $query->where('name', 'ilike', "%{$request->search}%")
                ->orWhere('email', 'ilike', "%{$request->search}%");
        }

        // 2. Proses Sorting
        $sortField = $request->input('sort_field', 'id'); // default id
        $sortDirection = $request->input('sort_direction', 'asc'); // default asc

        // Validasi whitelist column agar aman dari SQL Injection
        if (in_array($sortField, ['id', 'name', 'email', 'created_at', 'updated_at'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // 3. Proses Pagination
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage)->withQueryString();

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => [
                'search' => $request->search,
                'sort' => [
                    'field' => $request->sort_field,
                    'direction' => $request->sort_direction,
                ],
            ],
        ]);
    }
}
