<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    // 🔹 Liste des hôtels
    public function index()
    {
        $hotels = Hotel::latest()->get();

        // Ajouter l'URL complète de l'image pour le frontend
        $hotels->transform(function ($hotel) {
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;
            return $hotel;
        });

        return response()->json($hotels);
    }

    // 🔹 Création d'un hôtel
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:50',
                'price' => 'nullable|numeric',
                'currency' => 'nullable|string|max:10',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Upload image si présente
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('hotels', 'public');
            }

            // Valeurs par défaut si null
            $validated['price'] = $validated['price'] ?? 0;
            $validated['currency'] = $validated['currency'] ?? 'USD';

            $hotel = Hotel::create($validated);

            // Ajouter l'URL complète pour l'image
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;

            return response()->json($hotel, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    // 🔹 Mise à jour d'un hôtel
    public function update(Request $request, Hotel $hotel)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:50',
                'price' => 'nullable|numeric',
                'currency' => 'nullable|string|max:10',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Upload image si présente, supprimer l'ancienne
            if ($request->hasFile('image')) {
                if ($hotel->image) {
                    Storage::disk('public')->delete($hotel->image);
                }
                $validated['image'] = $request->file('image')->store('hotels', 'public');
            }

            // Valeurs par défaut si null
            $validated['price'] = $validated['price'] ?? $hotel->price ?? 0;
            $validated['currency'] = $validated['currency'] ?? $hotel->currency ?? 'USD';

            $hotel->update($validated);

            // Ajouter URL complète
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;

            return response()->json($hotel);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    // 🔹 Suppression d'un hôtel
    public function destroy(Hotel $hotel)
    {
        try {
            // Supprimer l'image si existante
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }

            $hotel->delete();

            return response()->json([
                'message' => 'Hôtel supprimé avec succès',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
