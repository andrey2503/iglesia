<?php

use Illuminate\Database\Seeder;
use App\TipoLicor;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   
    public function run()
    {
        $array = array("Tequila", "Vocka", "Ron", "Wisky");
        $longitud = count($array);
        //Recorro todos los elementos
        for($i=0; $i<$longitud; $i++){
            echo $array[$i];
            $tipo = new TipoLicor();
            $tipo->nombre=$array[$i];
            echo $tipo->save();
            }
        // $this->call(UsersTableSeeder::class);
    }
}
