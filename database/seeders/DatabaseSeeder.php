<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\PaymentMethod;
use App\Models\UserInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@alexlucifer.com',
            'phone'=>'09980730638',
            'address'=>'Yangon',
            'gender'=>'male',
            'role'=>'admin',
            'show_category'=>[],
            'position'=>'CEO',
            'active'=>0,
            'password'=>Hash::make('admin0912')
         ]);

         User::create([
             'name'=>'User',
             'email'=>'user@alexlucifer.com',
             'phone'=>'09757589796',
             'address'=>'Yangon',
             'gender'=>'male',
             'role'=>'user',
             'show_category'=>[],
             'position'=>'seller',
             'active'=>0,
             'password'=>Hash::make('user0912')
          ]);

          Category::create([
            'name'=>'Collection',
            'active'=>1,
            'feature'=>0,
            'add_by'=>1,
            'image'=>'null',
          ]);

          PaymentMethod::create([
            'name'=>'Wave Pay',
            'number'=>'09980730638',
            'user_name'=>'Htet Arkar Lin',
            'user_id'=>null,
          ]);

          PaymentMethod::create([
            'name'=>'KBZ Pay',
            'number'=>'09980730638',
            'user_name'=>'Htet Arkar Lin',
            'user_id'=>null,
          ]);

          PaymentMethod::create([
            'name'=>'AYA Pay',
            'number'=>'09980730638',
            'user_name'=>'Htet Arkar Lin',
            'user_id'=>null,
          ]);

          PaymentMethod::create([
            'name'=>'UAB Pay',
            'number'=>'09980730638',
            'user_name'=>'Htet Arkar Lin',
            'user_id'=>null,
          ]);


          UserInterface::create([
            'company_name'=>'Angle',
            'company_email'=>'angle@alexlucifer.com',
            'company_phone'=>'+959980730638',
            'company_address'=>'A108 Adam Street, New York, NY 535022, United States',
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe veritatis, totam doloremque error voluptatem dolore dolores illo, animi ullam ex quia cupiditate necessitatibus reprehenderit minima corrupti? Magnam et voluptatem reiciendis?',
            'about_us_description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe veritatis, totam doloremque error voluptatem dolore dolores illo, animi ullam ex quia cupiditate necessitatibus reprehenderit minima corrupti? Magnam et voluptatem reiciendis?',
            'footer_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem voluptas similique laboriosam officia? Eveniet labore iure optio. Rem rerum quaerat, expedita architecto fuga ullam vitae amet eveniet saepe provident iusto?',
            'supplier_policy'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem voluptas similique laboriosam officia? Eveniet labore iure optio. Rem rerum quaerat, expedita architecto fuga ullam vitae amet eveniet saepe provident iusto?',
            'company_logo'=>null,
            'cover_image'=>null,
            'about_us_image'=>[],
            'font_color'=>null,
            'bg_color'=>null,
          ]);
    }
}
