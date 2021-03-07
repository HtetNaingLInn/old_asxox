<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  Sport & Outdoor
     * @return void
     */
    public function run()
    {
        $categories=[
            ["name"=>"Electronic Accessories","image"=>"Electronic Accessories_image.jpg","logo"=>"Electronic Accessories_logo.png"],
            ["name"=>"Electric Device","image"=>"Electric Device_image.jpg","logo"=>"Electric Device_logo.png"],
            ["name"=>"Home Appliances","image"=>"Home Appliances _image.jpg","logo"=>"Home Appliances _logo.png"],
            ["name"=>"Health & Beauty ","image"=>"Health & Beauty_image.jpg","logo"=>"Health & Beauty_logo.png"],
            ["name"=>"Toys ","image"=>"Babies & Toys_image.jpg","logo"=>"Toys_logo.png"],
            ["name"=>"Groceries & Pet","image"=>"Groceries & Pet_image.jpg","logo"=>"Groceries & Pet_logo.png"],
            ["name"=>"Home & Lifestyle","image"=>"Home & Lifestyle_image.jpg","logo"=>"Home & Lifestyle_logo.png"],
            ["name"=>"Women Fashion","image"=>"Women Fashion_image.jpg","logo"=>"Women Fashion_logo.png"],
            ["name"=>"Men Fashion","image"=>"Men Fashion_image.jpg","logo"=>"Men Fashion_logo.png"],
            ["name"=>"Watch & Accessories","image"=>"Watch & Accessories_image.jpg","logo"=>"Watch & Accessories_logo.png"],
            ["name"=>"Sport & Outdoor","image"=>"Sport & Outdoor_image.jpg","logo"=>"Sport & Outdoor_logo.png"],
            ["name"=>"Automotive & motorbike","image"=>"Automotive & motorbike_image.jpg","logo"=>"Automotive & motorbike_logo.png"],

        ];

        foreach($categories as $category){
            Category::create([
                'name'=>$category['name'],
                'image'=>$category['image'],
                'logo'=>$category['logo'],
                'category_id'=>null
            ]);
        }
    }
}
