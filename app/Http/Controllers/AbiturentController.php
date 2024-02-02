<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbiturentRequest;
use Faker\Generator;
use App\Models\Abiturent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbiturentController extends Controller
{
    public function index(Request $request)
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

    public function show(Request $request)
    {
        $abiturent = Abiturent::find($request->id);
        return view('abiturent', compact('abiturent'));
    }

    public function update(AbiturentRequest $request, $id): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $abiturent = Abiturent::findOrFail($id);
        $this->authorize('update', $abiturent);

        if (!$abiturent) {
            return response()->json(['error' => 'Запись не найдена'], 404);
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

    public function destroy($id)
    {
        $abiturent = Abiturent::findOrFail($id);
        $this->authorize('delete', $abiturent);
        $abiturent->delete();

        return redirect()->back()->with('success', 'Ваша заявка удалена!');
    }

    public function makeAbiturents(Generator $faker): void
    {
        for ($i = 1; $i<150; $i++) {
            $gender = rand(0, 1);
            $name = $gender ? $faker->firstName('female') : $faker->firstName('male');
            $surname = $gender ? $faker->lastName('female') : $faker->lastName('male');
            $group_number = rand(1000, 9999);
            $email = $faker->email();
            $total_ege = rand(1, 100);
            $date_of_birth = $faker->date();
            $phone_number = $faker->phoneNumber();

            $abiturent = Abiturent::create([
                'name' => $name,
                'surname' => $surname,
                'gender' => $gender,
                'group_number' => $group_number,
                'email' => $email,
                'total_ege' => $total_ege,
                'date_of_birth' => $date_of_birth,
                'phone_number' => $phone_number
            ]);
        }
        dd($abiturent);
    }
}
