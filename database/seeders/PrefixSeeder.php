<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prefix;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayPrefix =
        [   
            [
                'name' => 'AFG',
                'prefix' => '+93'
            ],
            [
                'name' => 'ALB',
                'prefix' => '+355'
            ],
            [
                'name' => ' DE',
                'prefix' => '+49'
            ],
            [
                'name' => 'AND',
                'prefix' => '+376'
            ],
            [
                'name' => 'AGO',
                'prefix' => '+244'
            ],
            [
                'name' => 'ATG',
                'prefix' => '+1'
            ],
            [
                'name' => 'SAU',
                'prefix' => '+966'
            ],
            [
                'name' => 'DZA',
                'prefix' => '+213'
            ],
            [
                'name' => 'ARG',
                'prefix' => '+54'
            ],
            [
                'name' => 'ARM',
                'prefix' => '+374'
            ],
            [
                'name' => 'AUS',
                'prefix' => '+61'
            ],
            [
                'name' => 'AUT',
                'prefix' => '+43'
            ],
            [
                'name' => 'AZE',
                'prefix' => '+994'
            ],
            [
                'name' => 'BHS',
                'prefix' => '+1'
            ],
            [
                'name' => 'BGD',
                'prefix' => '+880'
            ],
            [
                'name' => 'BRB',
                'prefix' => '+1'
            ],
            [
                'name' => 'BHR',
                'prefix' => '+973'
            ],
            [
                'name' => 'BEL',
                'prefix' => '+32'
            ],
            [
                'name' => 'BLZ',
                'prefix' => '+501'
            ],
            [
                'name' => 'BEN',
                'prefix' => '+229'
            ],
            [
                'name' => 'BY',
                'prefix' => '+375'
            ],
            [
                'name' => 'NLD',
                'prefix' => '+95'
            ],
            [
                'name' => 'BOL',
                'prefix' => '+591'
            ],
            [
                'name' => 'BIH',
                'prefix' => '+387'
            ],
            [
                'name' => 'BWA',
                'prefix' => '+267'
            ],
            [
                'name' => 'BRA',
                'prefix' => '+55'
            ],
            [
                'name' => 'BRN',
                'prefix' => '+673'
            ],
            [
                'name' => 'BGR',
                'prefix' => '+359'
            ],
            [
                'name' => 'CPV',
               'prefix' => '+238'
            ],
            [
                'name' => 'CMR',
                'prefix' => '+237'
            ],
            [
                'name' => 'CAN',
                'prefix' => '+1'
            ],
            [
                'name' => 'QAT',
                'prefix' => '+974'
            ], 
            [
                'name' => 'CHL',
                'prefix' => '+56' 
            ],
            [
                'name' => 'CHN',
                'prefix' => '+86'
            ],
            [
                'name' => 'CYP',
                'prefix' => '+357'
            ],
            [
                'name' => 'VAT',
                'prefix' => '+379'
            ],
            [
                'name' => 'COL',
                'prefix' => '+57'
            ],
            [
                'name' => 'PRK',
                'prefix' => '+850'
            ],
            [
                'name' => 'KOR',
                'prefix' => '+82'
            ],
            [
                'name' => 'CIV',
                'prefix' => '+225'
            ],
            [
                'name' => 'CRI',
                'prefix' => '+506'
            ],
            [
                'name' => 'HRV',
                'prefix' => '+385'
            ],
            [
                'name' => 'CUB',
                'prefix' => '+53'
            ],
            [
                'name' => 'DNK',
                'prefix' => '+45'
            ],
            [
                'name' => 'DM',
                'prefix' => '+1'
            ],
            [
                'name' => 'ECU',
                'prefix' => '593'
            ],
            [
                'name' => 'EGY',
                'prefix' => '+20'
            ],
            [
                'name' => 'SLV',
                'prefix' => '+503'
            ],
            [
                'name' => 'ARE',
                'prefix' => '+971'
            ],
            [
                'name' => 'SVK',
                'prefix' => '+421'
            ],
            [
                'name' => 'SVN',
                'prefix' => '+386'
            ],
            [
                'name' => 'ESP',
                'prefix' =>'+34'
            ],
            [
                'name' => 'ESA',
                'prefix' => '+1'
            ],
            [
                'name' => 'EST',
                'prefix' => '+372'
            ],
            [
                'name' => 'FHL',
                'prefix' => '+63'
            ],
            [
                'name' => 'FIN',
                'prefix' => '+358'
            ],
            [
                'name' => 'FRA',
                'prefix' => '+33'
            ],
            [
                'name' => 'GHA',
                'prefix' => '+233'
            ],
            [
                'name' => 'GRC',
                'prefix' => '+30'
            ],
            [
                'name' => 'GTM',
                'prefix' => '+502'
            ],
            [
                'name' => 'HTI',
                'prefix' => '+509'
            ],
            [
                'name' => 'HND',
                'prefix' => '+504'
            ],
            [
                'name' => 'HUN',
                'prefix' => '+36'
            ],
            [
                'name' => 'IND',
                'prefix' => '+91'
            ],
            [
                'name' => 'IDN',
                'prefix' => '+62'
            ],
            [
                'name' => 'IRQ',
                'prefix' => '+964'
            ],
            [
                'name' => 'IRN',
                'prefix' => '+98'
            ],
            [
                'name' => 'IRL',
                'prefix' => '+353'
            ],
            [
                'name' => 'ISL',
                'prefix' => '+354'
            ],
            [
                'name' => 'MHL',
                'prefix' => '+692'
            ],
            [
                'name' => 'SLB',
                'prefix' => '+677'
            ],
            [
                'name' => 'ISR',
                'prefix' => '+972'
            ],
            [
                'name' => 'ITA',
                'prefix' => '+39'
            ],
            [
                'name' => 'JAM',
                'prefix' => '+1'
            ],
            [
                'name' => 'JPN',
                'prefix' => '+81'  
            ],
           
            [
                'name' => 'KAZ',
                'prefix' => '+7'
            ],
            [
                'name' => 'LVA',
                'prefix' => '+371'
            ],
            [
                'name' => 'LBN',
                'prefix' => '+961'
            ],
            [
                'name' => 'LBR',
                'prefix' => '+231'
            ],
            [
                'name' => 'LBY',
                'prefix' => '+218'
            ],
            [
                'name' => 'LIE',
                'prefix' => '+423'
            ],
            [
                'name' => 'LTU',
                'prefix' => '+370'
            ],
            [
                'name' => 'LUX',
                'prefix' => '+352'
            ],
            [
                'name' => 'MYS',
                'prefix' => '+60'
            ],
            [
                'name' => 'MDV',
                'prefix' => '+960'
            ],
            [
                'name' => 'MLI',
                'prefix' => '+223'
            ],
            [
                'name' => 'MLT',
                'prefix' => '+356'
            ],
            [
                'name' => 'MAR',
                'prefix' => '+212'
            ],
            [
                'name' => 'MUS',
                'prefix' => '+230'
            ],
            [
                'name' => 'MRT',
                'prefix' => '+222'
            ],
            [
                'name' => 'MEX',
                'prefix' => '+52'
            ],
            [
                'name' => 'FSM',
                'prefix' => '+691'
            ],
            [
                'name' => 'MDA',
                'prefix' => '+373'
            ],
            [
                'name' => 'MCO',
                'prefix' => '+377'
            ],
            [
                'name' => 'MNG',
                'prefix' => '+976'
            ],
            [
                'name' => 'MNT',
                'prefix' => '+382'
            ],
            [
                'name' => 'MOZ',
                'prefix' => '+258'
            ],
            [
                'name' => 'NAM',
                'prefix' => '+264'
            ],
            [
                'name' => 'NRU',
                'prefix' => '+674'
            ],
            [
                'name' => 'NPL',
                'prefix' => '+977'
            ],
            [
                'name' => 'NIC',
                'prefix' => '+505'
            ],
            [
                'name' => 'NER',
                'prefix' => '+227'
            ],
            [
                'name' => 'NGA',
                'prefix' => '+234'
            ],
            [
                'name' => 'NOR',
                'prefix' => '+47'
            ],
            [
                'name' => 'NZL',
                'prefix' => '+64'
            ],
            [
                'name' => 'OMN',
                'prefix' => '+968'
            ],
            [
                'name' => 'NLD',
                'prefix' => '+31'
            ],
            [
                'name' => 'PAK',
                'prefix' => '+92'
            ],
            [
                'name' => 'PLW',
                'prefix' => '+680'
            ],
            [
                'name' => 'OLP',
                'prefix' => '+970'
            ],
            [
                'name' => 'PAN',
                'prefix' => '+507'
            ],
            [
                'name' => 'PNG',
                'prefix' => '+675'
            ],
            [
                'name' => 'PRY',
                'prefix' => '+595'
            ],
            [
                'name' => 'PER',
                'prefix' => '+51'
            ],
            [
                'name' => 'POL',
                'prefix' => '+48'
            ],
            [
                'name' => 'PRT',
                'prefix' => '+351'
            ],
            [
                'name' => 'GBR',
                'prefix' => '+44'
            ],
            [
                'name' => 'CAF',
                'prefix' => '+236'
            ],
            [
                'name' => 'CZE',
                'prefix' => '+420'
            ],
            [
                'name' => 'COG',
                'prefix' => '+242'
            ],
            [
                'name' => 'ZAR',
                'prefix' => '+243'
            ],
            [
                'name' => 'DOM',
                'prefix' => '+1'
            ],
            [
                'name' => 'ZAF',
                'prefix' => '+27'
            ],
            [
                'name' => 'RWA',
                'prefix' => '+250'
            ],
            [
                'name' => 'ROM',
                'prefix' => '+40'
            ],
            [
                'name' => 'RUS',
                'prefix' => '+7'
            ],
            [
                'name' => 'WSM',
                'prefix' => '+685'
            ],
            [
                'name' => 'KNA',
                'prefix' => '+1'
            ],
            [
                'name' => 'SMR',
                'prefix' => '+378'
            ],
            [
                'name' => 'VCT',
                'prefix' => '+1'
            ],
            [
                'name' => 'LCA',
                'prefix' => '+1'
            ],
            [
                'name' => 'STP',
                'prefix' => '+239'
            ],
            [
                'name' => 'SEN',
                'prefix' => '+221'
            ],
            [
                'name' => 'SER',
                'prefix' => '+381'
            ],
            [
                'name' => 'SYC',
                'prefix' => '+248'
            ],
            [
                'name' => 'SLE',
                'prefix' => '+232'
            ],
            [
                'name' => 'SGP',
                'prefix' => '+65'
            ],
            [
                'name' => 'SYR',
                'prefix' => '+963'
            ],
            [
                'name' => 'SOM',
                'prefix' => '+252'
            ],
            [
                'name' => 'LKA',
                'prefix' => '+94'
            ],
            [
                'name' => 'SWZ',
                'prefix' => '+268'
            ],
            [
                'name' => 'SUD',
                'prefix' => '+249'
            ],
            [
                'name' => 'SSD',
                'prefix' => '+211'
            ],
            [
                'name' => 'SWE',
                'prefix' => '+46'
            ],
            [
                'name' => 'CHE',
                'prefix' => '+41'
            ],
            [
                'name' => 'SUR',
                'prefix' => '+597'
            ],
            [
                'name' => 'THA',
                'prefix' => '+66'
            ],
            [
                'name' => 'TZA',
                'prefix' => '+255'
            ],
            [
                'name' => 'TJK',
                'prefix' => '+992'
            ],
            [
                'name' => 'TMP',
                'prefix' => '+670'
            ],
            [
                'name' => 'TGO',
                'prefix' => '+228'
            ],
            [
                'name' => 'TON',
                'prefix' => '+676'
            ],
            [
                'name' => 'TTO',
                'prefix' => '+1'
            ],
            [
                'name' => 'TUN',
                'prefix' => '+216'
            ],
            [
                'name' => 'TKM',
                'prefix' => '+993'
            ],
            [
                'name' => 'TUR',
                'prefix' => '+90'
            ],
            [
                'name' => 'TUV',
                'prefix' => '688+'
            ],
            [
                'name' => 'UKR',
                'prefix' => '+380'
            ],
            [
                'name' => 'UGA',
                'prefix' => '+256'
            ],
            [
                'name' => 'URY',
                'prefix' => '+598'
            ],
            [
                'name' => 'VEN',
                'prefix' => '+58'
            ]
        ];

        foreach ($arrayPrefix as $prefix ) {
            Prefix::create($prefix);
        }
    }
}

