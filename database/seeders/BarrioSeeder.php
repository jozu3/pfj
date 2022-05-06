<?php

namespace Database\Seeders;

use App\Models\Barrio;
use App\Models\ConsejoCoordinacione;
use App\Models\Estaca;
use Illuminate\Database\Seeder;

class BarrioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Barrio desconocido
        $nn = ConsejoCoordinacione::create(['nombre' => 'NaN']);
        $eNN = Estaca::create(['nombre' => 'Desconocido', 'consejo_coordinacione_id' => $nn->id]);
        Barrio::create(['nombre' => 'Desconocido', 'estaca_id' => $eNN->id]);

        
        $cclimanorte = ConsejoCoordinacione::create([
            'nombre' => 'Lima Norte'
        ]);

        //Lima Norte
        $eComas = Estaca::create(['nombre' => 'Comas', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eCarabayllo = Estaca::create(['nombre' => 'Carabayllo', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eTahuantinsuyo = Estaca::create(['nombre' => 'Tahuantinsuyo', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eSanFelipe = Estaca::create(['nombre' => 'San Felipe', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eSanta = Estaca::create(['nombre' => 'Santa Isabel', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eTorre = Estaca::create(['nombre' => 'Torre Blanca', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eMagnolias = Estaca::create(['nombre' => 'Magnolias', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eWiesse = Estaca::create(['nombre' => 'Wiesse', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eCanto = Estaca::create(['nombre' => 'Canto Grande', 'consejo_coordinacione_id' => $cclimanorte->id]);
        $eBegonias = Estaca::create(['nombre' => 'Begonias', 'consejo_coordinacione_id' => $cclimanorte->id]);


        //Lima Begonias Stake
        Barrio::create(['nombre' => 'Begonias Ward', 'estaca_id' => $eBegonias->id]);
        Barrio::create(['nombre' => 'Canto Chico Ward', 'estaca_id' => $eBegonias->id]);
        Barrio::create(['nombre' => 'Los Manzanos Ward', 'estaca_id' => $eBegonias->id]);
        Barrio::create(['nombre' => 'Los Postes Ward', 'estaca_id' => $eBegonias->id]);
        Barrio::create(['nombre' => 'Santa Fe Ward', 'estaca_id' => $eBegonias->id]);
        Barrio::create(['nombre' => 'Viña Ward', 'estaca_id' => $eBegonias->id]);

        //Lima Canto Grande Stake
        Barrio::create(['nombre' => 'Canto Grande Ward', 'estaca_id' => $eCanto->id]);
        Barrio::create(['nombre' => 'Canto Nuevo Ward', 'estaca_id' => $eCanto->id]);
        Barrio::create(['nombre' => 'Canto Rey Ward', 'estaca_id' => $eCanto->id]);
        Barrio::create(['nombre' => 'Las Lomas Ward', 'estaca_id' => $eCanto->id]);
        Barrio::create(['nombre' => 'Machu Picchu Ward', 'estaca_id' => $eCanto->id]);

        //Lima Carabayllo Stake
        Barrio::create(['nombre' => 'Carabayllo Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'Comas 1st Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'La Habana Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'Libertad Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'Los Jardines Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'Santa Luisa Ward', 'estaca_id' => $eCarabayllo->id]);
        Barrio::create(['nombre' => 'Santa Luzmila Ward', 'estaca_id' => $eCarabayllo->id]);

        //Lima Comas Stake
        Barrio::create(['nombre' => 'Año Nuevo Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'Belaunde Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'El Pinar Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'El Retablo Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'Infantas Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'La Mar Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'San Agustín Ward', 'estaca_id' => $eComas->id]);
        Barrio::create(['nombre' => 'Vista Alegre Ward', 'estaca_id' => $eComas->id]);

        //Lima Magnolias Stake
        Barrio::create(['nombre' => 'Bayovar Ward', 'estaca_id' => $eMagnolias->id]);
        Barrio::create(['nombre' => 'Buenos Aires Ward', 'estaca_id' => $eMagnolias->id]);
        Barrio::create(['nombre' => 'La Fragata Ward', 'estaca_id' => $eMagnolias->id]);
        Barrio::create(['nombre' => 'Las Magnolias Ward', 'estaca_id' => $eMagnolias->id]);
        Barrio::create(['nombre' => 'Valle Sagrado Ward', 'estaca_id' => $eMagnolias->id]);
        Barrio::create(['nombre' => 'Villa Hermosa Ward', 'estaca_id' => $eMagnolias->id]);

        //Lima San Felipe Stake
        Barrio::create(['nombre' => 'Bello Horizonte Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'Collique Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'El Sol del Pinar Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'La Alborada Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'Las Casuarinas Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'San Carlos Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'San Felipe Ward', 'estaca_id' => $eSanFelipe->id]);
        Barrio::create(['nombre' => 'Trapiche Branch', 'estaca_id' => $eSanFelipe->id]);
        

        //Lima Santa Isabel Stake
        Barrio::create(['nombre' => 'Famesa 2nd Ward', 'estaca_id' => $eSanta->id]);
        Barrio::create(['nombre' => 'Los Portales Ward', 'estaca_id' => $eSanta->id]);
        Barrio::create(['nombre' => 'Lucyana Ward', 'estaca_id' => $eSanta->id]);
        Barrio::create(['nombre' => 'Santa Isabel Ward', 'estaca_id' => $eSanta->id]);
        Barrio::create(['nombre' => 'Santo Domingo Ward', 'estaca_id' => $eSanta->id]);
        Barrio::create(['nombre' => 'Tungasuca Ward', 'estaca_id' => $eSanta->id]);

        //Lima Tahuantinsuyo Stake
        Barrio::create(['nombre' => 'Antisuyo Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Chinchaysuyo Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Contisuyo Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Deseret Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Olaya Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Payet Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Quiñones Ward', 'estaca_id' => $eTahuantinsuyo->id]);
        Barrio::create(['nombre' => 'Tahuantinsuyo Ward', 'estaca_id' => $eTahuantinsuyo->id]);

        //Lima Torre Blanca Stake
        Barrio::create(['nombre' => 'El Progreso Ward', 'estaca_id' => $eTorre->id]);
        Barrio::create(['nombre' => 'Industrial Ward', 'estaca_id' => $eTorre->id]);
        Barrio::create(['nombre' => 'Los Angeles Ward', 'estaca_id' => $eTorre->id]);
        Barrio::create(['nombre' => 'Nueva América Ward', 'estaca_id' => $eTorre->id]);
        Barrio::create(['nombre' => 'San Pedro de Carabayllo Ward', 'estaca_id' => $eTorre->id]);
        Barrio::create(['nombre' => 'Torre Blanca Ward', 'estaca_id' => $eTorre->id]);

        //Lima Wiesse Stake
        Barrio::create(['nombre' => 'Casa Blanca Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'El Valle Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'Las Galeras Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'Mariategui Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'Mariscal Cáceres Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'Montenegro Ward', 'estaca_id' => $eWiesse->id]);
        Barrio::create(['nombre' => 'Wiesse Ward', 'estaca_id' => $eWiesse->id]);
        



        
    }
}
