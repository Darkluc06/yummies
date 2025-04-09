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

		return Inertia::render('cms/ingredients', ['ingredients' => $ingredients]);
	}

	public function create() : Response
	{
		return Inertia::render('cms/CreateIngredient');
	}

	public function edit(int $id)
	{
		$ingredient = Ingredient::findOrFail($id);

		return Inertia::render('cms/ingredientEdit', ['ingredient' => $ingredient]);
	}

//	public function store(Request $request)
//	{
//		// Validate the incoming request data
//		$validated = $request->validate([
//			'ingredient_name' => 'required|string|max:255',
//			'image_path' => 'nullable|image|max:2048', // Adjust max file size as needed
//		]);
//
//		// Handle file upload if present
//		if ($request->hasFile('image_path')) {
//			$imagePath = $request->file('image_path')->store('ingredients', 'public');
//			$validated['image_path'] = $imagePath;
//		}
//
//		// Create the ingredient
//		$ingredient = Ingredient::create($validated);
//
//		// Log for debugging (optional)
//		Log::info('Ingredient created', ['ingredient' => $ingredient]);
//
//		// Redirect back or to a specific route (Inertia handles this)
//		return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully');
//	}

	public function store(Request $request)
	{
		$ingredient = new Ingredient();

		return $this->update($request, $ingredient);
	}

	public function update(Request $request, Ingredient $ingredient)
	{
		// @TODO create update function
		try
		{
			$validated = $request->validate([
				'ingredient_name' => 'required|string|max:255',
				'image_path' => 'nullable|image|max:2048', // Adjust max file size as needed
			]);

			if ($request->hasFile('image_path')) {
				$imagePath = $request->file('image_path')->store('ingredients', 'public');
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
