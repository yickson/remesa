<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->truncate();
        DB::table('banks')->insert([
            0 => [
                'prefix' => '0156',
                'name' => '100%BANCO'
            ],
            1 => [
                'prefix' => '0172',
                'name' => 'BANCAMIGA BANCO MICROFINANCIERO, C.A.'
            ],
            2 => [
                'prefix' => '0171',
                'name' => 'BANCO ACTIVO BANCO COMERCIAL, C.A.'
            ],
            3 => [
                'prefix' => '0166',
                'name' => 'BANCO AGRICOLA'
            ],
            4 => [
                'prefix' => '0175',
                'name' => 'BANCO BICENTENARIO'
            ],
            5 => [
                'prefix' => '0128',
                'name' => 'BANCO CARONI, C.A. BANCO UNIVERSAL'
            ],
            6 => [
                'prefix' => '0164',
                'name' => 'BANCO DE DESARROLLO DEL MICROEMPRESARIO'
            ],
            7 => [
                'prefix' => '0102',
                'name' => 'BANCO DE VENEZUELA S.A.I.C.A'
            ],
            8 => [
                'prefix' => '0114',
                'name' => 'BANCO DEL CARIBE C.A.'
            ],
            9 => [
                'prefix' => '0149',
                'name' => 'BANCO DEL PUEBLO SOBERANO C.A.'
            ],
            10 => [
                'prefix' => '0163',
                'name' => 'BANCO DEL TESORO'
            ],
            11 => [
                'prefix' => '0176',
                'name' => 'BANCO ESPIRITO SANTO S.A.'
            ],
            12 => [
                'prefix' => '0115',
                'name' => 'BANCO EXTERIOR C.A.'
            ],
            13 => [
                'prefix' => '0003',
                'name' => 'BANCO INDUSTRIAL DE VENEZUELA'
            ],
            14 => [
                'prefix' => '0173',
                'name' => 'BANCO INTERNACIONAL DE DESARROLLO, C.A.'
            ],
            15 => [
                'prefix' => '0105',
                'name' => 'BANCO MERCANTIL C.A.'
            ],
            16 => [
                'prefix' => '0191',
                'name' => 'BANCO NACIONAL DE CREDITO'
            ],
            17 => [
                'prefix' => '0116',
                'name' => 'BANCO OCCIDENTAL DE DESCUENTO'
            ],
            18 => [
                'prefix' => '0138',
                'name' => 'BANCO PLAZA'
            ],
            19 => [
                'prefix' => '0108',
                'name' => 'BANCO PROVINCIAL BBVA'
            ],
            20 => [
                'prefix' => '0104',
                'name' => 'BANCO VENEZOLANO DE CREDITO S.A.'
            ],
            21 => [
                'prefix' => '0168',
                'name' => 'BANCRECER S.A. BANCO DE DESARROLLO'
            ],
            22 => [
                'prefix' => '0134',
                'name' => 'BANESCO BANCO UNIVERSAL'
            ],
            23 => [
                'prefix' => '0177',
                'name' => 'BANFANB'
            ],
            24 => [
                'prefix' => '0174',
                'name' => 'BANPLUS BANCO COMERCIAL C.A.'
            ],
            25 => [
                'prefix' => '0190',
                'name' => 'CITIBANK'
            ],
            26 => [
                'prefix' => '0121',
                'name' => 'CORP BANCA'
            ],
            27 => [
                'prefix' => '0157',
                'name' => 'DELSUR BANCO UNIVERSAL'
            ],
            28 => [
                'prefix' => '0151',
                'name' => 'BANCO FONDO COMUN'
            ],
            29 => [
                'prefix' => '0169',
                'name' => 'MIBANCO BANCO DE DESARROLLO C.A.'
            ],
            30 => [
                'prefix' => '0137',
                'name' => 'SOFITASA'
            ],
        ]);
    }
}
