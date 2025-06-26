<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\User;

class ComplaintController extends Controller
{
    public function index()
    {        
        $user = auth()->user();

        if ($user->role === 'admin') {
            $complaints = Complaint::with('user')->get();
        } else {
            $complaints = Complaint::with('user')->where('user_id', $user->id)->get();
        }

        return response()->json($complaints);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        return Complaint::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|string',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully']);
    }


}
