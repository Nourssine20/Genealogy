<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the people.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère toutes les personnes avec leur créateur
        $people = Person::all();
        return view('people.index', compact('people'));
    }
    public function testDegree()
    {
        // Active l'enregistrement des requêtes SQL
        DB::enableQueryLog();

        // Démarre le chronomètre
        $timestart = microtime(true);

        try {
            // Trouver la personne par son ID (ici 84)
            $person = Person::findOrFail(84);  // On cherche la personne par ID
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Person not found'], 404);
        }

        // Calculer le degré avec la personne cible (ici 1265)
        $degree = $person->getDegreeWith(1265);

        // Calculer le temps d'exécution et le nombre de requêtes SQL
        $executionTime = microtime(true) - $timestart;
        $queriesCount = count(DB::getQueryLog());

        // Retourner les résultats à la vue
        return view('test-degree', compact('degree', 'executionTime', 'queriesCount'));
    }

    /**
     * Show the form for creating a new person.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created person in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
        ]);

        // Ajouter l'utilisateur authentifié comme créateur
        $validated['created_by'] = Auth::id();

        // Formatage des prénoms et noms
        // Format de first_name : première lettre en majuscule, le reste en minuscule
        $validated['first_name'] = ucfirst(strtolower($validated['first_name']));

        // Format de last_name : tout en majuscules
        $validated['last_name'] = strtoupper($validated['last_name']);

        // Format de middle_names : chaque prénom séparé par une virgule, première lettre majuscule
        $validated['middle_names'] = $validated['middle_names']
            ? collect(explode(',', $validated['middle_names']))
                ->map(fn($name) => ucfirst(trim(strtolower($name))))  // Mettre en minuscule puis la première lettre en majuscule
                ->join(', ')
            : null;

        // Format de birth_name : tout en majuscules, sinon égal au last_name
        $validated['birth_name'] = $validated['birth_name']
            ? strtoupper($validated['birth_name'])
            : strtoupper($validated['last_name']);

        // Date of birth : Si non renseignée, NULL, sinon valider avec le format YYYY-MM-DD
        $validated['date_of_birth'] = $validated['date_of_birth'] ?: null;

        // Création de la personne
        Person::create($validated);

        // Redirection avec message de succès
        return redirect()->route('people.index')->with('success', 'Person created successfully.');
    }

    /**
     * Display the specified person with their parents and children.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Récupérer la personne avec ses parents et enfants
        $person = Person::with(['creator', 'children', 'parents'])->findOrFail($id);

        return view('people.show', compact('person'));
    }
    public function edit($id)
{
    $person = Person::with('children')->findOrFail($id);
    $people = Person::all(); // Charge toutes les personnes pour la liste déroulante
    return view('people.edit', compact('person', 'people'));
}


    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $person->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ]);

        return redirect()->route('people.index')->with('success', 'Person updated successfully.');
    }


}
