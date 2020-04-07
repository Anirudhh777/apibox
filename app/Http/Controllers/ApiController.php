<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Validator;

class ApiController extends Controller
{
    protected function add_ingredient(Request $request){
    	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:ingredients|string',
            'supplier' => 'required|string',
            'measure' => [
				        'required',
				        'max:6',
				        'string',
				        function ($attribute, $value, $fail) {
				        	$measures = ['g', 'kg', 'pieces'];
				            if (!in_array($value, $measures)) {
				                $fail($attribute.' is invalid.');
				            }
				        },
				    ],
        ]);

        if ($validator->fails()) {
            return response()->json([
	            'status' => 500,
	            'message' => $validator->messages()
	        ]);
        }

        $id = DB::table('ingredients')->insertGetId(['name' => $request->name, 'measure' => $request->measure, 'supplier' => $request->supplier, 'created_at' =>  \Carbon\Carbon::now()]);

        $data = array('id' => $id, 'name' => $request->name, 'measure' => $request->measure, 'supplier' => $request->supplier);

         return response()->json([
	            'status' => 200,
	            'data' => (object) $data
	        ]); 
    }

     protected function fetch_ingredients(){
     	$data = DB::table('ingredients')->paginate(2);
     	return response()->json([
	            'status' => 200,
	            'data' => $data
	        ]); 
     }

     protected function add_recipe(Request $request){
     	$validator = Validator::make($request->all(), [
            'name' => 'required|unique:recipes|string',
            'description' => 'required|string',
            "ingredients" => "required|array|min:2",
            "ingredients.*" => "required|array|min:2",
            "ingredients.*.id" => [
						        'required',
						        'integer',
						        function ($attribute, $value, $fail) {
						            if (DB::table("ingredients")->where('id', $value)->doesntExist()) {
						                $fail($attribute.' is invalid.');
						            }
						        },
						    ],
			"ingredients.*.quantity" => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
	            'status' => 500,
	            'message' => $validator->messages()
	        ]);
        }

        $id = DB::table('recipes')->insertGetId(['name' => $request->name, 'description' => $request->description, 'created_at' =>  \Carbon\Carbon::now()]);

        foreach ($request->ingredients as $ingredient) {
        	DB::table('recipe_ingredients')->insert(['recipe_id' => $id, 'ingredient_id' => $ingredient['id'], 'quantity' => $ingredient['quantity']]);
        }

         return response()->json([
	            'status' => 200
	        ]); 
     }

     protected function fetch_recipes(){
     	$recipes = DB::table('recipes')->paginate(2);
     	foreach ($recipes as $recipe) {
     		$ingredients = DB::table('recipe_ingredients')->where('recipe_id', $recipe->id)->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')->select('ingredients.*', 'recipe_ingredients.quantity')->get();
     		$recipe->ingredients = $ingredients;
     	}

     	return response()->json([
	            'status' => 200,
	            'data' => $recipes
	        ]); 
     }

     protected function add_box(Request $request){
     	$validator = Validator::make($request->all(), [
            "delivery_date" => [
						        'required',
						        'date',
						        function ($attribute, $value, $fail) {
						        	$timestamp = strtotime($value);
						            if ($timestamp < time() + 172800) {
						                $fail('Delivery Date needs to be atleast 48 hours more than current date.');
						            }
						        },
						    ],
			 "recipes" => "required|array|min:1|max:4",
			 "recipes.*" => [
			 				 'integer',
			 				 function ($attribute, $value, $fail) {
						            if (DB::table("recipes")->where('id', $value)->doesntExist()) {
						                 $fail('Recipe ID '.$value.' is invalid.');
						            }
						        },
			 				]
        ]);

        if ($validator->fails()) {
            return response()->json([
	            'status' => 500,
	            'message' => $validator->messages()
	        ]);
        }

        
        $id = DB::table("user_box")->insert(['delivery_date' => $request->delivery_date]);
        $box = array('delivery_date' => $request->delivery_date, 'recipes' => array());

     	foreach ($request->recipes as $recipe) {
     		DB::table('box_recipes')->insert(['user_box_id' => $id, 'recipe_id' => $recipe]);

     		$ingredients = DB::table('recipe_ingredients')->where('recipe_id', $recipe)->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')->join('recipes', 'recipe_ingredients.recipe_id', '=', 'recipes.id')->select('ingredients.*', 'recipe_ingredients.quantity')->get();

     		$data = DB::table('recipes')->where('id', $recipe)->first();

     		array_push($box['recipes'], array('name' => $data->name, 'description' => $data->description, 'ingredients' => $ingredients));
     	}

	 	return response()->json([
	            'status' => 200,
	            'data' => (object) $box
	    ]); 

     }

     protected function order_requirements(){

     	$requirements = array();
     	$ingredients = DB::table("user_box")->whereBetween('delivery_date', [date('Y-m-d ', strtotime("now")), date('Y-m-d ', strtotime("+7 day"))])->join('box_recipes', 'user_box.id' , '=', 'box_recipes.user_box_id')->join('recipes', 'box_recipes.recipe_id', '=', 'recipes.id')->join('recipe_ingredients', 'recipes.id', '=', 'recipe_ingredients.recipe_id')->join('ingredients', 'ingredients.id', '=', 'recipe_ingredients.ingredient_id')->select('ingredients.id','ingredients.name', 'ingredients.measure', 'recipe_ingredients.quantity')->get();

     	foreach ($ingredients as $ingredient) {
     		if (!array_key_exists($ingredient->name, $requirements)) {
     			$requirements[$ingredient->name] = array('measure' => $ingredient->measure, 'quantity' => $ingredient->quantity);
     		}else{
     			$requirements[$ingredient->name]['quantity'] += $ingredient->quantity;
     		}
     	}

     	return response()->json([
	            'status' => 200,
	            'data' => (object) $requirements
	    ]); 
  
     }
}
