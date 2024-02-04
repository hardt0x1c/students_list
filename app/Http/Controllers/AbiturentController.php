<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbiturentRequest;
use App\Models\Abiturent;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbiturentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Abiturent::query();
        $sortColumn = $request->input('sort', 'total_ege');
        $sortOrder = $request->input('order', 'desc');
        $abiturents = $query->orderBy($sortColumn, $sortOrder)->paginate(50);
        $order = $sortOrder === 'asc' ? 'desc' : 'asc';

        $search = $request->get('search', '');

        if ($search) {
            $abiturents = $query->where('name', 'like', "%{$search}%")
                ->orWhere('surname', 'like', "%{$search}%")
                ->orWhere('group_number', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('total_ege', 'like', "%{$search}%")
                ->orWhere('date_of_birth', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%")
                ->paginate(50);

            return view('index', compact('abiturents', 'search', 'order'));
        }
        return view('index', compact('abiturents', 'order'));
    }



    public function store(AbiturentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $abiturent = Abiturent::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'gender' => $validated['gender'],
            'group_number' => $validated['groupNumber'],
            'email' => $validated['email'],
            'total_ege' => $validated['totalEge'],
            'date_of_birth' => $validated['birthday'],
            'phone_number' => $validated['phone'],
        ]);

        return redirect()->back()->with('success', 'Заявка успешно зарегистрирована');
    }

    public function show(Request $request): View
    {
        $abiturent = Abiturent::find($request->id);
        return view('abiturent', compact('abiturent'));
    }

    public function update(AbiturentRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $abiturent = Abiturent::findOrFail($id);
        $this->authorize('update', $abiturent);

        if (!$abiturent) {
            return redirect()->back()->with('error', 'Заявка не найдена');
        }

        $abiturent->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'gender' => $validated['gender'],
            'group_number' => $validated['groupNumber'],
            'total_ege' => $validated['totalEge'],
            'date_of_birth' => $validated['birthday'],
            'phone_number' => $validated['phone'],
        ]);

        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }

    public function destroy($id): RedirectResponse
    {
        $abiturent = Abiturent::findOrFail($id);
        $this->authorize('delete', $abiturent);
        $abiturent->delete();

        return redirect()->back()->with('success', 'Ваша заявка удалена!');
    }
}
