<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class RecipeController extends Controller
{
    public function index() : Response
    {
        $recipes = Recipe::all();

        return Inertia::render('cms/Recipes', ['recipes' => $recipes]);
    }

//    public function show(int $id) : Response
//    {
//        $recipe = Recipe::findOrFail($id);
//
//        return Inertia::render('cms/Recipe', ['recipe' => $recipe]);
//    }

    public function create() : Response
    {
        return Inertia::render('cms/CreateRecipe');
    }

//    public function edit(int $id) : Response
//    {
//        $recipe = Recipe::findOrFail($id);
//
//        return Inertia::render('cms/EditRecipe', ['recipe' => $recipe]);
//    }

    public function store(Request $request)
    {
        $recipe = new Recipe();

        return $this->update($request, $recipe);
    }

    public function update(Request $request, Recipe $recipe)
    {
        try
        {
            $validated = $request->validate([
                'recipe_name' => 'required',
                'description' => 'required',
                'image_path'      => 'required|mimes:jpg,png,gif,avif,jpeg|max:2048',
                'recipe_duration' => 'required|numeric',
                'portions' => 'required|numeric',
                'food_category' => 'required',
                'keywords' => 'required',
            ]);

            if ($request->hasFile('image_path'))
            {
                $imagePath               = $request->file('image_path')->store('ingredients', 'public');
                $validated['image_path'] = $imagePath;
            }

            $recipe->fill($validated);
            $recipe->save();

            return redirect()->route('recipes.index')->with('success', 'Recipe created successfully');

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
    public function destroy(Recipe $recipe)
    {
        Recipe::findOrFail($recipe->id)->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully');
    }
}
