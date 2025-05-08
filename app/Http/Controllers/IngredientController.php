<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class IngredientController extends Controller
{
    public function index() : Response
    {
        $ingredients = Ingredient::all();

        return Inertia::render('cms/Ingredients', ['ingredients' => $ingredients]);
    }

    public function create() : Response
    {
        return Inertia::render('cms/CreateIngredient');
    }

    public function edit(int $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        return Inertia::render('cms/EditIngredient', ['ingredient' => $ingredient->only('id', 'ingredient_name', 'image_path'),]);
    }

    public function store(Request $request)
    {
        $ingredient = new Ingredient();

        return $this->update($request, $ingredient);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        try
        {
            $validated = $request->validate([
                'ingredient_name' => 'required|string|max:255',
                'image_path'      => 'nullable|mimes:jpg,png,gif,avif,jpeg|max:2048',
            ]);

            if ($request->hasFile('image_path'))
            {
                $imagePath               = $request->file('image_path')->store('ingredients', 'public');
                $validated['image_path'] = $imagePath;
            }

            $ingredient->fill($validated);
            $ingredient->save();

            return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully');
        }
        catch (\Illuminate\Validation\ValidationException $e)
        {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        }
        catch (\Exception $e)
        {
            Log::error('Update error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Ingredient $ingredient) : Response
    {
        Ingredient::findOrFail($ingredient->id)->delete();

        return $this->index();
    }
}
