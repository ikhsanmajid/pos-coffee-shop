<?php

namespace App\Http\Controllers;

use App\Models\TestTable;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    //

    public function index(Request $request): Response
    {
        return Inertia::render('LayoutTest');
    }

    // untuk search berdasarkan nama -- multiple select
    public function testSelect(Request $request): JsonResponse
    {
        $search = $request->get('search');

        $listPermission = TestTable::select(['id', 'nama'])
            ->when($search, function ($query, $search) {
                $query->where('nama', 'ilike', "%{$search}%");
            })
            ->get();

        $formattedData = $listPermission->map(fn($p) => [
            'value' => $p->id,
            'label' => $p->nama
        ]);

        return response()->json($formattedData);
    }
}
