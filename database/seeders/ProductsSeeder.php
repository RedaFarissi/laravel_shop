<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\File;

class ProductsSeeder extends Seeder{


    public function run(): void {

        $productData = json_decode(file_get_contents(storage_path('app/products.json')), true);
        $user = User::where('role' , "super admin")->first();

        foreach ($productData as $item) {
            // Check if the category already exists by name
            $existingCategory = Category::where('name', $item['category'])->first();
            if ($existingCategory === null) {
                $category = Category::create(['name'=> $item['category']]);
                $categoryID = $category->id;
            }else{
                $categoryID = $existingCategory->id;
            }

            $existingProduct = Product::where('name', $item['name'])->where('price', $item['price'])->first();
            if ($existingProduct === null) {

                $imagePath = 'images/' . $item['image'];
                Storage::copy($imagePath, 'public/images/' . $item['image']);

                Product::create([
                    "name"=>$item['name'],
                    "image"=> $item['image'],
                    "description"=>$item['description'],
                    "category_id"=>$categoryID,
                    "price"=>$item['price'],
                    "available"=>true,
                    "user_id"=>$user->id
                ]);
            }
        }
        $this->command->info('Products created successfully.');
    }
}
