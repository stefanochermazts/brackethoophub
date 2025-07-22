<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Category;
use App\Models\Team;
use App\Models\Venue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class TournamentWizardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Step 1: Informazioni base del torneo
     */
    public function step1(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        return view('admin.tournaments.wizard.step1', compact('wizardData'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'required|in:male,female,mixed',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'format' => 'required|in:round_robin,knockout,mixed',
        ]);

        $wizardData = Session::get('tournament_wizard', []);
        $wizardData['step1'] = $request->all();
        Session::put('tournament_wizard', $wizardData);

        return redirect()->route('admin.tournaments.wizard.step2');
    }

    /**
     * Step 2: Gestione categorie
     */
    public function step2(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        if (!isset($wizardData['step1'])) {
            return redirect()->route('admin.tournaments.wizard.step1')
                ->with('error', 'Completa prima le informazioni base del torneo.');
        }

        return view('admin.tournaments.wizard.step2', compact('wizardData'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'categories' => 'required|array|min:1',
            'categories.*.name' => 'required|string|max:255',
            'categories.*.description' => 'nullable|string',
            'categories.*.min_age' => 'nullable|integer|min:5|max:100',
            'categories.*.max_age' => 'nullable|integer|min:5|max:100|gte:categories.*.min_age',
            'categories.*.gender' => 'required|in:male,female,mixed',
            'categories.*.min_teams' => 'required|integer|min:3',
            'categories.*.max_teams' => 'nullable|integer|min:3|gte:categories.*.min_teams',
            'categories.*.format' => 'required|in:round_robin,knockout,mixed',
        ]);

        $wizardData = Session::get('tournament_wizard', []);
        $wizardData['step2'] = $request->all();
        Session::put('tournament_wizard', $wizardData);

        return redirect()->route('admin.tournaments.wizard.step3');
    }

    /**
     * Step 3: Gestione squadre
     */
    public function step3(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        if (!isset($wizardData['step1']) || !isset($wizardData['step2'])) {
            return redirect()->route('admin.tournaments.wizard.step1')
                ->with('error', 'Completa prima i passaggi precedenti.');
        }

        // Carica companies e coaches disponibili per l'organizzatore
        $organizerId = auth()->id();
        
        // Crea companies e coaches di esempio se non esistono
        $companies = User::where('role', 'company')->get();
        if ($companies->isEmpty()) {
            $companies = collect([
                (object)['id' => null, 'name' => 'Società Basket Roma'],
                (object)['id' => null, 'name' => 'ASD Milano Basket'],
                (object)['id' => null, 'name' => 'Pallacanestro Napoli'],
            ]);
        }

        $coaches = User::where('role', 'coach')->get();
        if ($coaches->isEmpty()) {
            $coaches = collect([
                (object)['id' => null, 'name' => 'Marco Rossi'],
                (object)['id' => null, 'name' => 'Luigi Bianchi'],
                (object)['id' => null, 'name' => 'Andrea Verdi'],
            ]);
        }

        return view('admin.tournaments.wizard.step3', compact('wizardData', 'companies', 'coaches'));
    }

    public function storeStep3(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        $categories = $wizardData['step2']['categories'] ?? [];

        // Validazione dinamica basata sulle categorie
        $rules = ['teams' => 'required|array'];
        
        foreach ($categories as $categoryIndex => $category) {
            $minTeams = $category['min_teams'];
            $maxTeams = $category['max_teams'] ?? 999;
            
            $rules["teams.category_{$categoryIndex}"] = "required|array|min:{$minTeams}|max:{$maxTeams}";
            $rules["teams.category_{$categoryIndex}.*.name"] = 'required|string|max:255';
            $rules["teams.category_{$categoryIndex}.*.short_name"] = 'nullable|string|max:20';
            $rules["teams.category_{$categoryIndex}.*.company_id"] = 'nullable|exists:users,id';
            $rules["teams.category_{$categoryIndex}.*.coach_id"] = 'nullable|exists:users,id';
        }

        $request->validate($rules);

        $wizardData['step3'] = $request->all();
        Session::put('tournament_wizard', $wizardData);

        return redirect()->route('admin.tournaments.wizard.step4');
    }

    /**
     * Step 4: Gestione palestre
     */
    public function step4(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        if (!isset($wizardData['step1']) || !isset($wizardData['step2']) || !isset($wizardData['step3'])) {
            return redirect()->route('admin.tournaments.wizard.step1')
                ->with('error', 'Completa prima i passaggi precedenti.');
        }

        return view('admin.tournaments.wizard.step4', compact('wizardData'));
    }

    public function storeStep4(Request $request)
    {
        $request->validate([
            'venues' => 'required|array|min:1',
            'venues.*.name' => 'required|string|max:255',
            'venues.*.address' => 'required|string',
            'venues.*.city' => 'required|string|max:255',
            'venues.*.postal_code' => 'nullable|string|max:10',
            'venues.*.phone' => 'nullable|string|max:20',
            'venues.*.capacity' => 'nullable|integer|min:1',
            'venues.*.availability' => 'nullable|array',
        ]);

        $wizardData = Session::get('tournament_wizard', []);
        $wizardData['step4'] = $request->all();
        Session::put('tournament_wizard', $wizardData);

        return redirect()->route('admin.tournaments.wizard.review');
    }

    /**
     * Step 5: Revisione e salvataggio finale
     */
    public function review(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        if (!isset($wizardData['step1']) || !isset($wizardData['step2']) || 
            !isset($wizardData['step3']) || !isset($wizardData['step4'])) {
            return redirect()->route('admin.tournaments.wizard.step1')
                ->with('error', 'Completa tutti i passaggi del wizard.');
        }

        return view('admin.tournaments.wizard.review', compact('wizardData'));
    }

    public function store(Request $request)
    {
        $wizardData = Session::get('tournament_wizard', []);
        
        if (!$wizardData) {
            return redirect()->route('admin.tournaments.wizard.step1')
                ->with('error', 'Sessione scaduta. Ricomincia la creazione del torneo.');
        }

        try {
            DB::beginTransaction();

            // Crea il torneo
            $tournament = Tournament::create([
                'name' => $wizardData['step1']['name'],
                'description' => $wizardData['step1']['description'],
                'gender' => $wizardData['step1']['gender'],
                'start_date' => $wizardData['step1']['start_date'],
                'end_date' => $wizardData['step1']['end_date'],
                'format' => $wizardData['step1']['format'],
                'organizer_id' => auth()->id(),
                'status' => 'draft',
            ]);

            // Crea le categorie
            $categoryMapping = [];
            foreach ($wizardData['step2']['categories'] as $index => $categoryData) {
                $category = Category::create([
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'min_age' => $categoryData['min_age'],
                    'max_age' => $categoryData['max_age'],
                    'gender' => $categoryData['gender'],
                    'tournament_id' => $tournament->id,
                    'min_teams' => $categoryData['min_teams'],
                    'max_teams' => $categoryData['max_teams'],
                    'format' => $categoryData['format'],
                ]);
                
                $categoryMapping[$index] = $category->id;
            }

            // Crea le squadre
            foreach ($wizardData['step3']['teams'] as $categoryKey => $teams) {
                $categoryIndex = (int) str_replace('category_', '', $categoryKey);
                $categoryId = $categoryMapping[$categoryIndex];
                
                foreach ($teams as $teamData) {
                    Team::create([
                        'name' => $teamData['name'],
                        'short_name' => $teamData['short_name'],
                        'category_id' => $categoryId,
                        'company_id' => $teamData['company_id'] ?: null,
                        'coach_id' => $teamData['coach_id'] ?: null,
                        'status' => 'registered',
                    ]);
                }
            }

            // Crea le palestre
            foreach ($wizardData['step4']['venues'] as $venueData) {
                Venue::create([
                    'name' => $venueData['name'],
                    'address' => $venueData['address'],
                    'city' => $venueData['city'],
                    'postal_code' => $venueData['postal_code'],
                    'phone' => $venueData['phone'],
                    'capacity' => $venueData['capacity'],
                    'tournament_id' => $tournament->id,
                    'availability' => $venueData['availability'] ?? [],
                ]);
            }

            DB::commit();

            // Pulisci la sessione
            Session::forget('tournament_wizard');

            return redirect()->route('admin.tournaments.show', $tournament)
                ->with('success', 'Torneo creato con successo!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Errore durante la creazione del torneo: ' . $e->getMessage());
        }
    }

    /**
     * Cancella il wizard e ricomincia
     */
    public function cancel(Request $request)
    {
        Session::forget('tournament_wizard');
        
        return redirect()->route('admin.tournaments.index')
            ->with('info', 'Creazione torneo annullata.');
    }
}
