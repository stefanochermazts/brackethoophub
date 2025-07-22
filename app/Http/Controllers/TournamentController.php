<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Gli admin vedono tutti i tornei, gli organizzatori solo i propri
        if ($user->isAdmin()) {
            $tournaments = Tournament::with(['organizer', 'categories'])
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            $tournaments = Tournament::with(['organizer', 'categories'])
                ->forOrganizer($user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }

        return view('admin.tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Reindirizza al wizard
        return redirect()->route('admin.tournaments.wizard.step1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // La creazione avviene tramite wizard
        return redirect()->route('admin.tournaments.wizard.step1');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        // Verifica che l'utente possa vedere questo torneo
        $user = auth()->user();
        if (!$user->isAdmin() && $tournament->organizer_id !== $user->id) {
            abort(403, 'Non hai il permesso di visualizzare questo torneo.');
        }

        $tournament->load(['organizer', 'categories.teams', 'venues']);

        return view('admin.tournaments.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournament $tournament)
    {
        // Verifica che l'utente possa modificare questo torneo
        $user = auth()->user();
        if (!$user->isAdmin() && $tournament->organizer_id !== $user->id) {
            abort(403, 'Non hai il permesso di modificare questo torneo.');
        }

        return view('admin.tournaments.edit', compact('tournament'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournament $tournament)
    {
        // Verifica che l'utente possa modificare questo torneo
        $user = auth()->user();
        if (!$user->isAdmin() && $tournament->organizer_id !== $user->id) {
            abort(403, 'Non hai il permesso di modificare questo torneo.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:male,female,mixed',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,published,ongoing,completed,cancelled',
        ]);

        $tournament->update($request->all());

        return redirect()->route('admin.tournaments.show', $tournament)
            ->with('success', 'Torneo aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournament $tournament)
    {
        // Verifica che l'utente possa eliminare questo torneo
        $user = auth()->user();
        if (!$user->isAdmin() && $tournament->organizer_id !== $user->id) {
            abort(403, 'Non hai il permesso di eliminare questo torneo.');
        }

        // Non permettere l'eliminazione di tornei in corso o completati
        if (in_array($tournament->status, ['ongoing', 'completed'])) {
            return redirect()->route('admin.tournaments.index')
                ->with('error', 'Non è possibile eliminare un torneo in corso o completato.');
        }

        $tournament->delete();

        return redirect()->route('admin.tournaments.index')
            ->with('success', 'Torneo eliminato con successo!');
    }
}
