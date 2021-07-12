<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Cinese',
            'Giapponese',
            'Pizzeria',
            'Gourmet',
            'Kebab',
            'Messicano',
            'Panini',
            'Indiano',
            'Hamburger'
        ];
        foreach($types as $type) {
            $newType = new Type();
            $newType->type_name = $type;
            $newType->save();
        }
    }
}
