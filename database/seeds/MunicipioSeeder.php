<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
    static $municipios = [
        //Namibe
        [
            'id_provincia' => 1,
            'municipio' => 'Moçamedes'
        ], [
            'id_provincia' => 1,
            'municipio' => 'Tômbwa'
        ], [
            'id_provincia' => 1,
            'municipio' => 'Virei'
        ], [
            'id_provincia' => 1,
            'municipio' => 'Bibala'
        ], [
            'id_provincia' => 1,
            'municipio' => 'Camucuio'
        ], [
            'id_provincia' => 1,
            'municipio' => 'Lucira'
        ],
        //fim


        //Benguela
        [
            'id_provincia' => 2,
            'municipio' => 'Benguela'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Baía Farta'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Balombo'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Bocoio'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Caimbambo'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Chongoroi'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Cubal'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Ganda'
        ], [
            'id_provincia' => 2,
            'municipio' => 'Lubito'
        ],
        //fim

        //Huíla
        [
            'id_provincia' => 3,
            'municipio' => 'Lubango'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Matala'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Humpata'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Quipungo'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Chibia'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Chicomba'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Cuvango'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Caconda'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Chipindo'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Quilengues'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Cacula'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Jamba'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Caluquembe'
        ], [
            'id_provincia' => 3,
            'municipio' => 'Chiange'
        ],
        //fim


        //Malanje
        [
            'id_provincia' => 4,
            'municipio' => 'Malanje'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Cacuso'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Calandula'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Cambundi-Catembo'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Cangandala'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Caombo'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Cuaba Nzongo'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Cuanda-Dia-Baze'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Luquembo'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Marimba'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Massango'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Mucari'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Quela'
        ], [
            'id_provincia' => 4,
            'municipio' => 'Quirima'
        ],
        //fim


        //Cabinda
        [
            'id_provincia' => 5,
            'municipio' => 'Cabinda'
        ], [
            'id_provincia' => 5,
            'municipio' => 'Belize'
        ], [
            'id_provincia' => 5,
            'municipio' => 'Buco-Zau'
        ], [
            'id_provincia' => 5,
            'municipio' => 'Cacongo'
        ],
        //fim


        //Zaire
        [
            'id_provincia' => 6,
            'municipio' => 'MBanza Kongo'
        ], [
            'id_provincia' => 6,
            'municipio' => 'Cuimba'
        ], [
            'id_provincia' => 6,
            'municipio' => 'Noqui'
        ], [
            'id_provincia' => 6,
            'municipio' => 'NZeto'
        ], [
            'id_provincia' => 6,
            'municipio' => 'Soyo'
        ], [
            'id_provincia' => 6,
            'municipio' => 'Tomboco'
        ],
        //fim

        //Uíge
        [
            'id_provincia' => 7,
            'municipio' => 'Uíge'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Alto Cauale'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Ambuíla'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Bembe'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Buengas'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Damba'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Macocola'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Mucaba'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Negage'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Puri'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Quimbele'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Quitexe'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Sanza Pombo'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Songo'
        ], [
            'id_provincia' => 7,
            'municipio' => 'Zombo'
        ],
        //fim


        //Bengo
        [
            'id_provincia' => 8,
            'municipio' => 'Caxito'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Ambriz'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Ícolo e Bengo'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Bula Atumba'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Dande'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Dembos'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Nambuangongo'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Pango Aluquém'
        ], [
            'id_provincia' => 8,
            'municipio' => 'Quiçama'
        ],
        //fim


        //Lunda Sul
        [
            'id_provincia' => 9,
            'municipio' => 'Saurimo'
        ], [
            'id_provincia' => 9,
            'municipio' => 'Cacolo'
        ], [
            'id_provincia' => 9,
            'municipio' => 'Dala'
        ], [
            'id_provincia' => 9,
            'municipio' => 'Muconda'
        ],
        //fim

        //Lunda Norte
        [
            'id_provincia' => 10,
            'municipio' => 'Dundo'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Cambulo'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Capenda-Camulemba'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Caungula'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Chitato'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Cuango'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Cuílo'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Lubalo'
        ], [
            'id_provincia' => 10,
            'municipio' => 'Xá-Muteba'
        ],
        //fim

        //Cuanza Sul
        [
            'id_provincia' => 11,
            'municipio' => 'Sumbe'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Amboim'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Cassongue'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Cela'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Conda'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Ebo'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Mussende'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Porto Amboim'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Quibala'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Quilenda'
        ], [
            'id_provincia' => 11,
            'municipio' => 'Seles'
        ],
        //fim

        //Cuanza Norte
        [
            'id_provincia' => 12,
            'municipio' => 'Ndalatando'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Ambaca'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Banga'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Bolongongo'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Cambambe'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Cazengo'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Golungo Alto'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Gonguembo'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Lucala'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Quiculungo'
        ], [
            'id_provincia' => 12,
            'municipio' => 'Samba Caju'
        ],
        //fim


        //Luanda
        [
            'id_provincia' => 13,
            'municipio' => 'Luanda'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Cacuaco'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Cazenga'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Ingombota'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Kilamba Kiaxi'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Maianga'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Rangel'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Samba'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Sambizanga'
        ], [
            'id_provincia' => 13,
            'municipio' => 'Viana'
        ],
        //fim


        //Cunene
        [
            'id_provincia' => 14,
            'municipio' => 'Ondjiva'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Cahama'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Cuanhama'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Curoca'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Cuvale'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Namacunde'
        ], [
            'id_provincia' => 14,
            'municipio' => 'Ombanja'
        ],
        //fim


        //Moxico
        [
            'id_provincia' => 15,
            'municipio' => 'Luena'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Alto Zambeze'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Bundas'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Camanongue'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Léua'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Luau'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Luacano'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Luchazes'
        ], [
            'id_provincia' => 15,
            'municipio' => 'Moxico'
        ],
        //fim

        //Cuando Cubango
        [
            'id_provincia' => 16,
            'municipio' => 'Menongue'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Calai'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Cuangar'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Cuchi'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Cuito Cuanavale'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Dirico'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Mavinga'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Nancova'
        ], [
            'id_provincia' => 16,
            'municipio' => 'Rivungo'
        ],
        //fim

        //Huambo
        [
            'id_provincia' => 17,
            'municipio' => 'Huambo'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Bailundo'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Catchiungo'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Caála'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Ekunha'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Londuimbale'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Longonjo'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Mungo Amboim'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Tchicala-Tcholoanga'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Tchindjenje'
        ], [
            'id_provincia' => 17,
            'municipio' => 'Ucuma'
        ],
        //fim


        //Bié
        [
            'id_provincia' => 18,
            'municipio' => 'Kuito'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Andulo'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Camacupa'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Catabola'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Chingular'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Chitembo'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Cuemba'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Cunhinga'
        ], [
            'id_provincia' => 18,
            'municipio' => 'Nharea'
        ],
    ];

    public function run()
    {
        foreach (Self::$municipios as $municipio) {
            DB::table('municipios')->insert(
                $municipio
            );
        }
    }
}