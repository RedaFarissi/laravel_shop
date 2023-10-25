<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\File;

class ProductsSeeder extends Seeder{
    public function run(): void {
        $productData = json_decode(file_get_contents(public_path('products-test/products.json')), true);
         
        $user = User::where('role' , "super admin")->first();
        if($user) {
            // create images folder inside storage/app/public/ if not exist
            if (!Storage::exists('app/public/images')) {
                exec('php artisan storage:link');
                Storage::makeDirectory('public/images', 0775, true);
            }
        

            foreach ($productData as $item) {
                //Copy images from public to storage to be readable in .blade.php
            
                if(!file_exists(storage_path('app/public/images/'.$item['image'])) ) {
                    copy(
                        public_path('products-test/images-test/'.$item['image']) , 
                        storage_path('app/public/images/'.$item['image']) 
                    );
                } 

                //Check if the category already exists by name
                $existingCategory = Category::where('name', $item['category'])->first();
                if ($existingCategory === null) {
                    $category = Category::create(['name'=> $item['category']]);
                    $categoryID = $category->id;
                }else{
                    $categoryID = $existingCategory->id;
                }

                $existingProduct = Product::where('name', $item['name'])->where('price', $item['price'])->first();
                if ($existingProduct === null) {
                    $newProduct =  Product::create([
                        "name"=>$item['name'],
                        "image"=> $item['image'],
                        "description"=>$item['description'],
                        "category_id"=>$categoryID,
                        "price"=>$item['price'],
                        "available"=>true,
                        "user_id"=>$user->id
                    ]);

                    foreach( $item['sizes'] as $size ){
                        //check if Size in DB and add it if not exist
                        $existingSize = Size::where('name', $size)->first();
                        if($existingSize === null){
                            $sizeCreate =Size::create([ 'name' => $size ]);
                            $SizeID = $sizeCreate->id;
                        }else{
                            $SizeID = $existingSize->id;
                        }
                        //pivot table
                        DB::table('product_size')->insert([
                            'product_id' => $newProduct->id,
                            'size_id' => $SizeID
                        ]);
                    }
                }
            }
            $this->command->info('Products created successfully.');
        }else{
            $this->command->error("You don't have Super Admin Account");
            $this->command->line(" ''' Run Seeder class first to run it use 'php artisan db:seed --class=SuperAdminSeeder' ''' ");
        }
    }
}
