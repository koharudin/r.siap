<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedCountryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('country')->delete();
        
        \DB::table('country')->insert(array (
            0 => 
            array (
                'id' => '004',
                'name' => 'ALASKA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => '005',
                'name' => 'ALBANIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => '006',
                'name' => 'ALGERIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            3 => 
            array (
                'id' => '007',
                'name' => 'ANGOLA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            4 => 
            array (
                'id' => '008',
                'name' => 'ANTILLEN, NETH',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            5 => 
            array (
                'id' => '009',
                'name' => 'ARABIA, KINGDOM OF SAUDI ARABIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            6 => 
            array (
                'id' => '010',
                'name' => 'ARGENTINA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            7 => 
            array (
                'id' => '011',
                'name' => 'AUSTRALIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            8 => 
            array (
                'id' => '012',
                'name' => 'AUSTRIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            9 => 
            array (
                'id' => '013',
                'name' => 'AZORAS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            10 => 
            array (
                'id' => '014',
                'name' => 'BAHAMAS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            11 => 
            array (
                'id' => '015',
                'name' => 'BAHRAIN',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            12 => 
            array (
                'id' => '016',
                'name' => 'BALEARES',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            13 => 
            array (
                'id' => '017',
                'name' => 'BANGLADESH',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            14 => 
            array (
                'id' => '018',
                'name' => 'BARBADOS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            15 => 
            array (
                'id' => '019',
                'name' => 'BELGIUM',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            16 => 
            array (
                'id' => '020',
                'name' => 'BERMUDA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            17 => 
            array (
                'id' => '021',
                'name' => 'BISSAU, GUINES PORTUGUESE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            18 => 
            array (
                'id' => '022',
                'name' => 'BOLIVIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            19 => 
            array (
                'id' => '023',
                'name' => 'BOSTWANA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            20 => 
            array (
                'id' => '024',
                'name' => 'BRAZIL',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            21 => 
            array (
                'id' => '025',
                'name' => 'BRITISH WEST INDIES',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            22 => 
            array (
                'id' => '026',
                'name' => 'BRUNAI',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            23 => 
            array (
                'id' => '027',
                'name' => 'BULGARIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            24 => 
            array (
                'id' => '028',
                'name' => 'BURMA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            25 => 
            array (
                'id' => '029',
                'name' => 'BURUNDI',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            26 => 
            array (
                'id' => '030',
                'name' => 'CAMBOJA/KHMER',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            27 => 
            array (
                'id' => '031',
                'name' => 'CAMEROON,REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            28 => 
            array (
                'id' => '032',
                'name' => 'CANADA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            29 => 
            array (
                'id' => '033',
                'name' => 'CANARIES,ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            30 => 
            array (
                'id' => '034',
                'name' => 'CAPE VERDE, ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            31 => 
            array (
                'id' => '035',
                'name' => 'CAYMAN, ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            32 => 
            array (
                'id' => '036',
                'name' => 'CENTRAL AFRICAN REP',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            33 => 
            array (
                'id' => '037',
                'name' => 'CEUTA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            34 => 
            array (
                'id' => '038',
                'name' => 'CHAD',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            35 => 
            array (
                'id' => '039',
                'name' => 'CHECHOSLOVAKIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            36 => 
            array (
                'id' => '040',
                'name' => 'CHILE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            37 => 
            array (
                'id' => '041',
                'name' => 'CHINA, PEOPLE REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            38 => 
            array (
                'id' => '042',
                'name' => 'CHRISTMAS ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            39 => 
            array (
                'id' => '043',
                'name' => 'COLOMBIA, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            40 => 
            array (
                'id' => '044',
                'name' => 'COMORA ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            41 => 
            array (
                'id' => '045',
                'name' => 'CONGO, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            42 => 
            array (
                'id' => '046',
                'name' => 'COOK ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            43 => 
            array (
                'id' => '047',
                'name' => 'COSTARICA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            44 => 
            array (
                'id' => '048',
                'name' => 'CUBA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            45 => 
            array (
                'id' => '049',
                'name' => 'CURACAO, NETH',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            46 => 
            array (
                'id' => '050',
                'name' => 'CYPRUS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            47 => 
            array (
                'id' => '051',
            'name' => 'DAHOMEY, REP OF (BENIN)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            48 => 
            array (
                'id' => '052',
                'name' => 'DENMARK',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            49 => 
            array (
                'id' => '053',
                'name' => 'DOMINICA, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            50 => 
            array (
                'id' => '054',
                'name' => 'DUBAI',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            51 => 
            array (
                'id' => '055',
                'name' => 'EGYPT, ARAB REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            52 => 
            array (
                'id' => '056',
                'name' => 'EL SALVADOR',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            53 => 
            array (
                'id' => '057',
                'name' => 'EQUADOR',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            54 => 
            array (
                'id' => '058',
                'name' => 'ETHIOPIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            55 => 
            array (
                'id' => '059',
                'name' => 'FALKLAND, ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            56 => 
            array (
                'id' => '060',
                'name' => 'FIJI ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            57 => 
            array (
                'id' => '061',
                'name' => 'FINLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            58 => 
            array (
                'id' => '062',
                'name' => 'FRANCE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            59 => 
            array (
                'id' => '063',
                'name' => 'GABON, REP',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            60 => 
            array (
                'id' => '064',
                'name' => 'GAMBIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            61 => 
            array (
                'id' => '065',
            'name' => 'GERMANY, EAST (DR)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            62 => 
            array (
                'id' => '066',
            'name' => 'GERMANY, WEST (FR)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            63 => 
            array (
                'id' => '067',
                'name' => 'GHANA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            64 => 
            array (
                'id' => '068',
                'name' => 'GIBRALTAR',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            65 => 
            array (
                'id' => '069',
                'name' => 'GILBERT AND ALICE ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            66 => 
            array (
                'id' => '070',
                'name' => 'GREECE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            67 => 
            array (
                'id' => '071',
                'name' => 'GREENLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            68 => 
            array (
                'id' => '072',
                'name' => 'GUEDELOUPE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            69 => 
            array (
                'id' => '073',
                'name' => 'GUAM',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            70 => 
            array (
                'id' => '074',
                'name' => 'GUATEMALA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            71 => 
            array (
                'id' => '075',
                'name' => 'GUIANA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            72 => 
            array (
                'id' => '076',
            'name' => 'GUINE, EQUATORIAL (SPANISH)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            73 => 
            array (
                'id' => '077',
                'name' => 'GUINEA, REP OF CONAKRY',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            74 => 
            array (
                'id' => '078',
                'name' => 'HAITI, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            75 => 
            array (
                'id' => '079',
                'name' => 'HAWAII',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            76 => 
            array (
                'id' => '080',
                'name' => 'HAONDURAS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            77 => 
            array (
                'id' => '081',
            'name' => 'HONDURAS, BRITISH (BELIZE)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            78 => 
            array (
                'id' => '082',
                'name' => 'HONGKONG',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            79 => 
            array (
                'id' => '083',
                'name' => 'HONGARY',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            80 => 
            array (
                'id' => '084',
                'name' => 'ICELAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            81 => 
            array (
                'id' => '085',
                'name' => 'Indonesia',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            82 => 
            array (
                'id' => '086',
                'name' => 'INDIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            83 => 
            array (
                'id' => '087',
                'name' => 'IRAN',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            84 => 
            array (
                'id' => '088',
                'name' => 'IRAQ',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            85 => 
            array (
                'id' => '089',
                'name' => 'IRELAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            86 => 
            array (
                'id' => '090',
                'name' => 'ISRAEL',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            87 => 
            array (
                'id' => '091',
                'name' => 'ITALY',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            88 => 
            array (
                'id' => '092',
                'name' => 'IVORY COAST',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            89 => 
            array (
                'id' => '093',
                'name' => 'JAMAICA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            90 => 
            array (
                'id' => '094',
                'name' => 'JAPAN',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            91 => 
            array (
                'id' => '095',
                'name' => 'JORDAN, HASHEMITE KINGDOM OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            92 => 
            array (
                'id' => '096',
                'name' => 'KENYA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            93 => 
            array (
                'id' => '097',
            'name' => 'KOREA, NORTH (PDR)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            94 => 
            array (
                'id' => '098',
                'name' => 'KOREA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            95 => 
            array (
                'id' => '099',
                'name' => 'KUWAIT',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            96 => 
            array (
                'id' => '100',
                'name' => 'LAOS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            97 => 
            array (
                'id' => '101',
                'name' => 'LEBANON',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            98 => 
            array (
                'id' => '102',
                'name' => 'LEEWARD ISLAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            99 => 
            array (
                'id' => '103',
                'name' => 'LESOTHO',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            100 => 
            array (
                'id' => '104',
                'name' => 'LIBERIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            101 => 
            array (
                'id' => '105',
                'name' => 'LYBIA, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            102 => 
            array (
                'id' => '106',
                'name' => 'LICHTENSTEIN',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            103 => 
            array (
                'id' => '107',
                'name' => 'LUXEMBURG',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            104 => 
            array (
                'id' => '108',
                'name' => 'MACAO',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            105 => 
            array (
                'id' => '109',
                'name' => 'MADERIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            106 => 
            array (
                'id' => '110',
                'name' => 'MALAGASY, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            107 => 
            array (
                'id' => '111',
                'name' => 'MALAWI',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            108 => 
            array (
                'id' => '112',
                'name' => 'MALAYSIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            109 => 
            array (
                'id' => '113',
                'name' => 'MALDIVAS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            110 => 
            array (
                'id' => '114',
                'name' => 'MALI, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            111 => 
            array (
                'id' => '115',
                'name' => 'MALTA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            112 => 
            array (
                'id' => '003',
                'name' => 'AFGANISTAN',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-07-15 00:24:02',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            113 => 
            array (
                'id' => '116',
                'name' => 'MAROCCO, REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            114 => 
            array (
                'id' => '117',
            'name' => 'MARTINIQUE (FRANCE)',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            115 => 
            array (
                'id' => '118',
                'name' => 'MAURITANIA, ISLAMIC REP OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            116 => 
            array (
                'id' => '119',
                'name' => 'MAURITIUS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            117 => 
            array (
                'id' => '120',
                'name' => 'MEXICO',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            118 => 
            array (
                'id' => '121',
                'name' => 'MONACO',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            119 => 
            array (
                'id' => '123',
                'name' => 'MOZAMBIQUE',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            120 => 
            array (
                'id' => '124',
                'name' => 'NAURU',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            121 => 
            array (
                'id' => '125',
                'name' => 'NEPAL',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            122 => 
            array (
                'id' => '126',
                'name' => 'NETHERLAND, KINGDOM OF',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            123 => 
            array (
                'id' => '127',
                'name' => 'NEW CALEDONIA',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            124 => 
            array (
                'id' => '128',
                'name' => 'NEW HEBRIDES',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            125 => 
            array (
                'id' => '129',
                'name' => 'NEW ZEALAND',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-06-27 01:50:53',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            126 => 
            array (
                'id' => '130',
                'name' => 'NICARAGUA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            127 => 
            array (
                'id' => '131',
                'name' => 'NIGER, REP OF THE',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            128 => 
            array (
                'id' => '132',
                'name' => 'NIGERIA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            129 => 
            array (
                'id' => '133',
                'name' => 'NORWAY',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            130 => 
            array (
                'id' => '134',
            'name' => 'NUGINI (PAPUA NG)',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            131 => 
            array (
                'id' => '135',
                'name' => 'OKINAWA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            132 => 
            array (
                'id' => '136',
                'name' => 'OMAN & MUSCATE',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            133 => 
            array (
                'id' => '137',
                'name' => 'PAKISTAN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            134 => 
            array (
                'id' => '138',
                'name' => 'PANAMA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            135 => 
            array (
                'id' => '139',
                'name' => 'PARAGUAY',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            136 => 
            array (
                'id' => '140',
                'name' => 'PERI',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            137 => 
            array (
                'id' => '141',
                'name' => 'PHILIPPINES',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            138 => 
            array (
                'id' => '142',
                'name' => 'POLANDS',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            139 => 
            array (
                'id' => '143',
                'name' => 'POLYNESIA, FRENCH',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            140 => 
            array (
                'id' => '144',
                'name' => 'PORTUGAL',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            141 => 
            array (
                'id' => '145',
                'name' => 'PUERTO RICO',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            142 => 
            array (
                'id' => '146',
                'name' => 'QATAR',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            143 => 
            array (
                'id' => '147',
                'name' => 'REUNION, FRENCH',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            144 => 
            array (
                'id' => '148',
                'name' => 'RHODESIA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            145 => 
            array (
                'id' => '149',
                'name' => 'RUMANIA, REP OF',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            146 => 
            array (
                'id' => '150',
                'name' => 'RUWANDA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            147 => 
            array (
                'id' => '151',
                'name' => 'SAIPAN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            148 => 
            array (
                'id' => '152',
                'name' => 'SALOMON ISLAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            149 => 
            array (
                'id' => '153',
                'name' => 'SAMOA, AMERICA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            150 => 
            array (
                'id' => '154',
                'name' => 'SAMOA, WESTERN NZL',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            151 => 
            array (
                'id' => '155',
                'name' => 'SAOTOME',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            152 => 
            array (
                'id' => '156',
                'name' => 'SENEGAL',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            153 => 
            array (
                'id' => '157',
                'name' => 'SEYCHELLES',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            154 => 
            array (
                'id' => '158',
                'name' => 'SHANGHAI',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            155 => 
            array (
                'id' => '159',
                'name' => 'SIERRA LEONE',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            156 => 
            array (
                'id' => '160',
                'name' => 'SINGAPORE',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            157 => 
            array (
                'id' => '161',
                'name' => 'SOMALI LAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            158 => 
            array (
                'id' => '162',
                'name' => 'SOUTH AFRICA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            159 => 
            array (
                'id' => '163',
                'name' => 'SPAIN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            160 => 
            array (
                'id' => '164',
                'name' => 'SPANISH SAHARA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            161 => 
            array (
                'id' => '165',
                'name' => 'SRILANGKA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            162 => 
            array (
                'id' => '166',
                'name' => 'ST HELENA ASCENCION',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            163 => 
            array (
                'id' => '167',
                'name' => 'ST PIERE & MIQUELON',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            164 => 
            array (
                'id' => '168',
                'name' => 'ST THOME & PRINCIPE',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            165 => 
            array (
                'id' => '169',
                'name' => 'SUDAN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            166 => 
            array (
                'id' => '170',
                'name' => 'SURINAME',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            167 => 
            array (
                'id' => '171',
                'name' => 'SWAZILAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            168 => 
            array (
                'id' => '172',
                'name' => 'SWEDEN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            169 => 
            array (
                'id' => '173',
                'name' => 'SWITZERLAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            170 => 
            array (
                'id' => '174',
                'name' => 'SYRIA, ARAB REP OF',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            171 => 
            array (
                'id' => '175',
                'name' => 'TAIWAN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            172 => 
            array (
                'id' => '176',
                'name' => 'TANGIER',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            173 => 
            array (
                'id' => '177',
                'name' => 'TANZIA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            174 => 
            array (
                'id' => '178',
                'name' => 'TOGO',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            175 => 
            array (
                'id' => '179',
                'name' => 'THAILAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            176 => 
            array (
                'id' => '180',
                'name' => 'TONGGA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            177 => 
            array (
                'id' => '181',
                'name' => 'TRINIDAD & TOBACO',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            178 => 
            array (
                'id' => '182',
                'name' => 'TUNISIA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            179 => 
            array (
                'id' => '183',
                'name' => 'TURKS & CAISOS ISLAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            180 => 
            array (
                'id' => '184',
                'name' => 'TURKEY',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            181 => 
            array (
                'id' => '185',
                'name' => 'UGANDA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            182 => 
            array (
                'id' => '186',
                'name' => 'UNITED ARAB EMIRATES',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            183 => 
            array (
                'id' => '188',
                'name' => 'UNITED KINGDOM OF GREAT BRIATAIN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            184 => 
            array (
                'id' => '189',
                'name' => 'UNITED STATES OF AMERICA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            185 => 
            array (
                'id' => '190',
                'name' => 'UNION OF SOC SOVIET, REP',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            186 => 
            array (
                'id' => '191',
                'name' => 'UPPER VOLTA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            187 => 
            array (
                'id' => '192',
                'name' => 'URUGUAY',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            188 => 
            array (
                'id' => '193',
                'name' => 'VATICAN',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            189 => 
            array (
                'id' => '194',
                'name' => 'VENEZUELA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            190 => 
            array (
                'id' => '195',
                'name' => 'VIETNAM',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            191 => 
            array (
                'id' => '196',
                'name' => 'VIRGIN ISLAND',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            192 => 
            array (
                'id' => '197',
                'name' => 'WALLS, FUTUNA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            193 => 
            array (
                'id' => '198',
            'name' => 'YEMEN, REP ARAB (ADEN)',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            194 => 
            array (
                'id' => '199',
            'name' => 'YEMEN (SANNA)',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            195 => 
            array (
                'id' => '200',
                'name' => 'YUGOSLAVIA',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            196 => 
            array (
                'id' => '201',
                'name' => 'England',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            197 => 
            array (
                'id' => '233',
                'name' => 'MONGOLIAN, REP',
                'created_at' => '2023-06-27 01:50:54',
                'updated_at' => '2023-06-27 01:50:54',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            198 => 
            array (
                'id' => '001',
                'name' => 'ABUDHABI',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-07-15 00:20:03',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
            199 => 
            array (
                'id' => '002',
                'name' => 'AFFARS AND ISSAS',
                'created_at' => '2023-06-27 01:50:53',
                'updated_at' => '2023-07-15 00:23:51',
                'deleted_at' => NULL,
                'order' => 1,
                'parent_id' => NULL,
            ),
        ));
        
        
    }
}