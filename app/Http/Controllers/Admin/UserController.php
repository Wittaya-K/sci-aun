<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AunCriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    private function allCriteria()
    {
        return AunCriteria::orderBy('sort_order')->get();
    }

    public function index(): Response
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email', 'created_at']);

        return Inertia::render('Admin/Users/Index', [
            'users'       => $users,
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Users/Edit', [
            'user'        => null,
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)],
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'เพิ่มผู้ใช้เรียบร้อยแล้ว');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/Users/Edit', [
            'user'        => $user->only('id', 'name', 'email'),
            'allCriteria' => $this->allCriteria(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::min(8)],
        ]);

        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            ...($validated['password']
                ? ['password' => Hash::make($validated['password'])]
                : []),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'แก้ไขผู้ใช้เรียบร้อยแล้ว');
    }

    public function destroy(Request $request, User $user)
    {
        // ป้องกันลบตัวเอง
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'ไม่สามารถลบบัญชีของตัวเองได้');
        }

        // ป้องกันลบ user คนสุดท้าย
        if (User::count() <= 1) {
            return back()->with('error', 'ต้องมีผู้ใช้อย่างน้อย 1 คนในระบบ');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'ลบผู้ใช้เรียบร้อยแล้ว');
    }
}
