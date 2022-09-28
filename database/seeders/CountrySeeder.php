<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'sort' => 'AF',
                'name' => 'Afghanistan',
                'phoneCode' => 93
            ],
            [
                'sort' => 'AL',
                'name' => 'Albania',
                'phoneCode' => 355
            ],
            [
                'sort' => 'DZ',
                'name' => 'Algeria',
                'phoneCode' => 213
            ],
            [
                'sort' => 'AS',
                'name' => 'American Samoa',
                'phoneCode' => 1684
            ],
            [
                'sort' => 'AD',
                'name' => 'Andorra',
                'phoneCode' => 376
            ],
            [
                'sort' => 'AO',
                'name' => 'Angola',
                'phoneCode' => 244
            ],
            [
                'sort' => 'AI',
                'name' => 'Anguilla',
                'phoneCode' => 1264
            ],
            [
                'sort' => 'AQ',
                'name' => 'Antarctica',
                'phoneCode' => 0
            ],
            [
                'sort' => 'AG',
                'name' => 'Antigua And Barbuda',
                'phoneCode' => 1268
            ],
            [
                'sort' => 'AR',
                'name' => 'Argentina',
                'phoneCode' => 54
            ],
            [
                'sort' => 'AM',
                'name' => 'Armenia',
                'phoneCode' => 374
            ],
            [
                'sort' => 'AW',
                'name' => 'Aruba',
                'phoneCode' => 297
            ],
            [
                'sort' => 'AU',
                'name' => 'Australia',
                'phoneCode' => 61
            ],
            [
                'sort' => 'AT',
                'name' => 'Austria',
                'phoneCode' => 43
            ],
            [
                'sort' => 'AZ',
                'name' => 'Azerbaijan',
                'phoneCode' => 994
            ],
            [
                'sort' => 'BS',
                'name' => 'Bahamas The',
                'phoneCode' => 1242
            ],
            [
                'sort' => 'BH',
                'name' => 'Bahrain',
                'phoneCode' => 973
            ],
            [
                'sort' => 'BD',
                'name' => 'Bangladesh',
                'phoneCode' => 880
            ],
            [
                'sort' => 'BB',
                'name' => 'Barbados',
                'phoneCode' => 1246
            ],
            [
                'sort' => 'BY',
                'name' => 'Belarus',
                'phoneCode' => 375
            ],
            [
                'sort' => 'BE',
                'name' => 'Belgium',
                'phoneCode' => 32
            ],
            [
                'sort' => 'BZ',
                'name' => 'Belize',
                'phoneCode' => 501
            ],
            [
                'sort' => 'BJ',
                'name' => 'Benin',
                'phoneCode' => 229
            ],
            [
                'sort' => 'BM',
                'name' => 'Bermuda',
                'phoneCode' => 1441
            ],
            [
                'sort' => 'BT',
                'name' => 'Bhutan',
                'phoneCode' => 975
            ],
            [
                'sort' => 'BO',
                'name' => 'Bolivia',
                'phoneCode' => 591
            ],
            [
                'sort' => 'BA',
                'name' => 'Bosnia and Herzegovina',
                'phoneCode' => 387
            ],
            [
                'sort' => 'BW',
                'name' => 'Botswana',
                'phoneCode' => 267
            ],
            [
                'sort' => 'BV',
                'name' => 'Bouvet Island',
                'phoneCode' => 0
            ],
            [
                'sort' => 'BR',
                'name' => 'Brazil',
                'phoneCode' => 55
            ],
            [
                'sort' => 'IO',
                'name' => 'British Indian Ocean Territory',
                'phoneCode' => 246
            ],
            [
                'sort' => 'BN',
                'name' => 'Brunei',
                'phoneCode' => 673
            ],
            [
                'sort' => 'BG',
                'name' => 'Bulgaria',
                'phoneCode' => 359
            ],
            [
                'sort' => 'BF',
                'name' => 'Burkina Faso',
                'phoneCode' => 226
            ],
            [
                'sort' => 'BI',
                'name' => 'Burundi',
                'phoneCode' => 257
            ],
            [
                'sort' => 'KH',
                'name' => 'Cambodia',
                'phoneCode' => 855
            ],
            [
                'sort' => 'CM',
                'name' => 'Cameroon',
                'phoneCode' => 237
            ],
            [
                'sort' => 'CA',
                'name' => 'Canada',
                'phoneCode' => 1
            ],
            [
                'sort' => 'CV',
                'name' => 'Cape Verde',
                'phoneCode' => 238
            ],
            [
                'sort' => 'KY',
                'name' => 'Cayman Islands',
                'phoneCode' => 1345
            ],
            [
                'sort' => 'CF',
                'name' => 'Central African Republic',
                'phoneCode' => 236
            ],
            [
                'sort' => 'TD',
                'name' => 'Chad',
                'phoneCode' => 235
            ],
            [
                'sort' => 'CL',
                'name' => 'Chile',
                'phoneCode' => 56
            ],
            [
                'sort' => 'CN',
                'name' => 'China',
                'phoneCode' => 86
            ],
            [
                'sort' => 'CX',
                'name' => 'Christmas Island',
                'phoneCode' => 61
            ],
            [
                'sort' => 'CC',
                'name' => 'Cocos (Keeling) Islands',
                'phoneCode' => 672
            ],
            [
                'sort' => 'CO',
                'name' => 'Colombia',
                'phoneCode' => 57
            ],
            [
                'sort' => 'KM',
                'name' => 'Comoros',
                'phoneCode' => 269
            ],
            [
                'sort' => 'CG',
                'name' => 'Republic Of The Congo',
                'phoneCode' => 242
            ],
            [
                'sort' => 'CD',
                'name' => 'Democratic Republic Of The Congo',
                'phoneCode' => 242
            ],
            [
                'sort' => 'CK',
                'name' => 'Cook Islands',
                'phoneCode' => 682
            ],
            [
                'sort' => 'CR',
                'name' => 'Costa Rica',
                'phoneCode' => 506
            ],
            [
                'sort' => 'CI',
                'name' => 'Cote D Ivoire (Ivory Coast)',
                'phoneCode' => 225
            ],
            [
                'sort' => 'HR',
                'name' => 'Croatia (Hrvatska)',
                'phoneCode' => 385
            ],
            [
                'sort' => 'CU',
                'name' => 'Cuba',
                'phoneCode' => 53
            ],
            [
                'sort' => 'CY',
                'name' => 'Cyprus',
                'phoneCode' => 357
            ],
            [
                'sort' => 'CZ',
                'name' => 'Czech Republic',
                'phoneCode' => 420
            ],
            [
                'sort' => 'DK',
                'name' => 'Denmark',
                'phoneCode' => 45
            ],
            [
                'sort' => 'DJ',
                'name' => 'Djibouti',
                'phoneCode' => 253
            ],
            [
                'sort' => 'DM',
                'name' => 'Dominica',
                'phoneCode' => 1767
            ],
            [
                'sort' => 'DO',
                'name' => 'Dominican Republic',
                'phoneCode' => 1809
            ],
            [
                'sort' => 'TP',
                'name' => 'East Timor',
                'phoneCode' => 670
            ],
            [
                'sort' => 'EC',
                'name' => 'Ecuador',
                'phoneCode' => 593
            ],
            [
                'sort' => 'EG',
                'name' => 'Egypt',
                'phoneCode' => 20
            ],
            [
                'sort' => 'SV',
                'name' => 'El Salvador',
                'phoneCode' => 503
            ],
            [
                'sort' => 'GQ',
                'name' => 'Equatorial Guinea',
                'phoneCode' => 240
            ],
            [
                'sort' => 'ER',
                'name' => 'Eritrea',
                'phoneCode' => 291
            ],
            [
                'sort' => 'EE',
                'name' => 'Estonia',
                'phoneCode' => 372
            ],
            [
                'sort' => 'ET',
                'name' => 'Ethiopia',
                'phoneCode' => 251
            ],
            [
                'sort' => 'XA',
                'name' => 'External Territories of Australia',
                'phoneCode' => 61
            ],
            [
                'sort' => 'FK',
                'name' => 'Falkland Islands',
                'phoneCode' => 500
            ],
            [
                'sort' => 'FO',
                'name' => 'Faroe Islands',
                'phoneCode' => 298
            ],
            [
                'sort' => 'FJ',
                'name' => 'Fiji Islands',
                'phoneCode' => 679
            ],
            [
                'sort' => 'FI',
                'name' => 'Finland',
                'phoneCode' => 358
            ],
            [
                'sort' => 'FR',
                'name' => 'France',
                'phoneCode' => 33
            ],
            [
                'sort' => 'GF',
                'name' => 'French Guiana',
                'phoneCode' => 594
            ],
            [
                'sort' => 'PF',
                'name' => 'French Polynesia',
                'phoneCode' => 689
            ],
            [
                'sort' => 'TF',
                'name' => 'French Southern Territories',
                'phoneCode' => 0
            ],
            [
                'sort' => 'GA',
                'name' => 'Gabon',
                'phoneCode' => 241
            ],
            [
                'sort' => 'GM',
                'name' => 'Gambia The',
                'phoneCode' => 220
            ],
            [
                'sort' => 'GE',
                'name' => 'Georgia',
                'phoneCode' => 995
            ],
            [
                'sort' => 'DE',
                'name' => 'Germany',
                'phoneCode' => 49
            ],
            [
                'sort' => 'GH',
                'name' => 'Ghana',
                'phoneCode' => 233
            ],
            [
                'sort' => 'GI',
                'name' => 'Gibraltar',
                'phoneCode' => 350
            ],
            [
                'sort' => 'GR',
                'name' => 'Greece',
                'phoneCode' => 30
            ],
            [
                'sort' => 'GL',
                'name' => 'Greenland',
                'phoneCode' => 299
            ],
            [
                'sort' => 'GD',
                'name' => 'Grenada',
                'phoneCode' => 1473
            ],
            [
                'sort' => 'GP',
                'name' => 'Guadeloupe',
                'phoneCode' => 590
            ],
            [
                'sort' => 'GU',
                'name' => 'Guam',
                'phoneCode' => 1671
            ],
            [
                'sort' => 'GT',
                'name' => 'Guatemala',
                'phoneCode' => 502
            ],
            [
                'sort' => 'XU',
                'name' => 'Guernsey and Alderney',
                'phoneCode' => 44
            ],
            [
                'sort' => 'GN',
                'name' => 'Guinea',
                'phoneCode' => 224
            ],
            [
                'sort' => 'GW',
                'name' => 'Guinea-Bissau',
                'phoneCode' => 245
            ],
            [
                'sort' => 'GY',
                'name' => 'Guyana',
                'phoneCode' => 592
            ],
            [
                'sort' => 'HT',
                'name' => 'Haiti',
                'phoneCode' => 509
            ],
            [
                'sort' => 'HM',
                'name' => 'Heard and McDonald Islands',
                'phoneCode' => 0
            ],
            [
                'sort' => 'HN',
                'name' => 'Honduras',
                'phoneCode' => 504
            ],
            [
                'sort' => 'HK',
                'name' => 'Hong Kong S.A.R.',
                'phoneCode' => 852
            ],
            [
                'sort' => 'HU',
                'name' => 'Hungary',
                'phoneCode' => 36
            ],
            [
                'sort' => 'IS',
                'name' => 'Iceland',
                'phoneCode' => 354
            ],
            [
                'sort' => 'IN',
                'name' => 'India',
                'phoneCode' => 91
            ],
            [
                'sort' => 'country_id',
                'name' => 'Indonesia',
                'phoneCode' => 62
            ],
            [
                'sort' => 'IR',
                'name' => 'Iran',
                'phoneCode' => 98
            ],
            [
                'sort' => 'IQ',
                'name' => 'Iraq',
                'phoneCode' => 964
            ],
            [
                'sort' => 'IE',
                'name' => 'Ireland',
                'phoneCode' => 353
            ],
            [
                'sort' => 'IL',
                'name' => 'Israel',
                'phoneCode' => 972
            ],
            [
                'sort' => 'IT',
                'name' => 'Italy',
                'phoneCode' => 39
            ],
            [
                'sort' => 'JM',
                'name' => 'Jamaica',
                'phoneCode' => 1876
            ],
            [
                'sort' => 'JP',
                'name' => 'Japan',
                'phoneCode' => 81
            ],
            [
                'sort' => 'XJ',
                'name' => 'Jersey',
                'phoneCode' => 44
            ],
            [
                'sort' => 'JO',
                'name' => 'Jordan',
                'phoneCode' => 962
            ],
            [
                'sort' => 'KZ',
                'name' => 'Kazakhstan',
                'phoneCode' => 7
            ],
            [
                'sort' => 'KE',
                'name' => 'Kenya',
                'phoneCode' => 254
            ],
            [
                'sort' => 'KI',
                'name' => 'Kiribati',
                'phoneCode' => 686
            ],
            [
                'sort' => 'KP',
                'name' => 'Korea North',
                'phoneCode' => 850
            ],
            [
                'sort' => 'KR',
                'name' => 'Korea South',
                'phoneCode' => 82
            ],
            [
                'sort' => 'KW',
                'name' => 'Kuwait',
                'phoneCode' => 965
            ],
            [
                'sort' => 'KG',
                'name' => 'Kyrgyzstan',
                'phoneCode' => 996
            ],
            [
                'sort' => 'LA',
                'name' => 'Laos',
                'phoneCode' => 856
            ],
            [
                'sort' => 'LV',
                'name' => 'Latvia',
                'phoneCode' => 371
            ],
            [
                'sort' => 'LB',
                'name' => 'Lebanon',
                'phoneCode' => 961
            ],
            [
                'sort' => 'LS',
                'name' => 'Lesotho',
                'phoneCode' => 266
            ],
            [
                'sort' => 'LR',
                'name' => 'Liberia',
                'phoneCode' => 231
            ],
            [
                'sort' => 'LY',
                'name' => 'Libya',
                'phoneCode' => 218
            ],
            [
                'sort' => 'LI',
                'name' => 'Liechtenstein',
                'phoneCode' => 423
            ],
            [
                'sort' => 'LT',
                'name' => 'Lithuania',
                'phoneCode' => 370
            ],
            [
                'sort' => 'LU',
                'name' => 'Luxembourg',
                'phoneCode' => 352
            ],
            [
                'sort' => 'MO',
                'name' => 'Macau S.A.R.',
                'phoneCode' => 853
            ],
            [
                'sort' => 'MK',
                'name' => 'Macedonia',
                'phoneCode' => 389
            ],
            [
                'sort' => 'MG',
                'name' => 'Madagascar',
                'phoneCode' => 261
            ],
            [
                'sort' => 'MW',
                'name' => 'Malawi',
                'phoneCode' => 265
            ],
            [
                'sort' => 'MY',
                'name' => 'Malaysia',
                'phoneCode' => 60
            ],
            [
                'sort' => 'MV',
                'name' => 'Maldives',
                'phoneCode' => 960
            ],
            [
                'sort' => 'ML',
                'name' => 'Mali',
                'phoneCode' => 223
            ],
            [
                'sort' => 'MT',
                'name' => 'Malta',
                'phoneCode' => 356
            ],
            [
                'sort' => 'XM',
                'name' => 'Man (Isle of)',
                'phoneCode' => 44
            ],
            [
                'sort' => 'MH',
                'name' => 'Marshall Islands',
                'phoneCode' => 692
            ],
            [
                'sort' => 'MQ',
                'name' => 'Martinique',
                'phoneCode' => 596
            ],
            [
                'sort' => 'MR',
                'name' => 'Mauritania',
                'phoneCode' => 222
            ],
            [
                'sort' => 'MU',
                'name' => 'Mauritius',
                'phoneCode' => 230
            ],
            [
                'sort' => 'YT',
                'name' => 'Mayotte',
                'phoneCode' => 269
            ],
            [
                'sort' => 'MX',
                'name' => 'Mexico',
                'phoneCode' => 52
            ],
            [
                'sort' => 'FM',
                'name' => 'Micronesia',
                'phoneCode' => 691
            ],
            [
                'sort' => 'MD',
                'name' => 'Moldova',
                'phoneCode' => 373
            ],
            [
                'sort' => 'MC',
                'name' => 'Monaco',
                'phoneCode' => 377
            ],
            [
                'sort' => 'MN',
                'name' => 'Mongolia',
                'phoneCode' => 976
            ],
            [
                'sort' => 'MS',
                'name' => 'Montserrat',
                'phoneCode' => 1664
            ],
            [
                'sort' => 'MA',
                'name' => 'Morocco',
                'phoneCode' => 212
            ],
            [
                'sort' => 'MZ',
                'name' => 'Mozambique',
                'phoneCode' => 258
            ],
            [
                'sort' => 'MM',
                'name' => 'Myanmar',
                'phoneCode' => 95
            ],
            [
                'sort' => 'NA',
                'name' => 'Namibia',
                'phoneCode' => 264
            ],
            [
                'sort' => 'NR',
                'name' => 'Nauru',
                'phoneCode' => 674
            ],
            [
                'sort' => 'NP',
                'name' => 'Nepal',
                'phoneCode' => 977
            ],
            [
                'sort' => 'AN',
                'name' => 'Netherlands Antilles',
                'phoneCode' => 599
            ],
            [
                'sort' => 'NL',
                'name' => 'Netherlands The',
                'phoneCode' => 31
            ],
            [
                'sort' => 'NC',
                'name' => 'New Caledonia',
                'phoneCode' => 687
            ],
            [
                'sort' => 'NZ',
                'name' => 'New Zealand',
                'phoneCode' => 64
            ],
            [
                'sort' => 'NI',
                'name' => 'Nicaragua',
                'phoneCode' => 505
            ],
            [
                'sort' => 'NE',
                'name' => 'Niger',
                'phoneCode' => 227
            ],
            [
                'sort' => 'NG',
                'name' => 'Nigeria',
                'phoneCode' => 234
            ],
            [
                'sort' => 'NU',
                'name' => 'Niue',
                'phoneCode' => 683
            ],
            [
                'sort' => 'NF',
                'name' => 'Norfolk Island',
                'phoneCode' => 672
            ],
            [
                'sort' => 'MP',
                'name' => 'Northern Mariana Islands',
                'phoneCode' => 1670
            ],
            [
                'sort' => 'NO',
                'name' => 'Norway',
                'phoneCode' => 47
            ],
            [
                'sort' => 'OM',
                'name' => 'Oman',
                'phoneCode' => 968
            ],
            [
                'sort' => 'PK',
                'name' => 'Pakistan',
                'phoneCode' => 92
            ],
            [
                'sort' => 'PW',
                'name' => 'Palau',
                'phoneCode' => 680
            ],
            [
                'sort' => 'PS',
                'name' => 'Palestinian Territory Occupied',
                'phoneCode' => 970
            ],
            [
                'sort' => 'PA',
                'name' => 'Panama',
                'phoneCode' => 507
            ],
            [
                'sort' => 'PG',
                'name' => 'Papua new Guinea',
                'phoneCode' => 675
            ],
            [
                'sort' => 'PY',
                'name' => 'Paraguay',
                'phoneCode' => 595
            ],
            [
                'sort' => 'PE',
                'name' => 'Peru',
                'phoneCode' => 51
            ],
            [
                'sort' => 'PH',
                'name' => 'Philippines',
                'phoneCode' => 63
            ],
            [
                'sort' => 'PN',
                'name' => 'Pitcairn Island',
                'phoneCode' => 0
            ],
            [
                'sort' => 'PL',
                'name' => 'Poland',
                'phoneCode' => 48
            ],
            [
                'sort' => 'PT',
                'name' => 'Portugal',
                'phoneCode' => 351
            ],
            [
                'sort' => 'PR',
                'name' => 'Puerto Rico',
                'phoneCode' => 1787
            ],
            [
                'sort' => 'QA',
                'name' => 'Qatar',
                'phoneCode' => 974
            ],
            [
                'sort' => 'RE',
                'name' => 'Reunion',
                'phoneCode' => 262
            ],
            [
                'sort' => 'RO',
                'name' => 'Romania',
                'phoneCode' => 40
            ],
            [
                'sort' => 'RU',
                'name' => 'Russia',
                'phoneCode' => 70
            ],
            [
                'sort' => 'RW',
                'name' => 'Rwanda',
                'phoneCode' => 250
            ],
            [
                'sort' => 'SH',
                'name' => 'Saint Helena',
                'phoneCode' => 290
            ],
            [
                'sort' => 'KN',
                'name' => 'Saint Kitts And Nevis',
                'phoneCode' => 1869
            ],
            [
                'sort' => 'LC',
                'name' => 'Saint Lucia',
                'phoneCode' => 1758
            ],
            [
                'sort' => 'PM',
                'name' => 'Saint Pierre and Miquelon',
                'phoneCode' => 508
            ],
            [
                'sort' => 'VC',
                'name' => 'Saint Vincent And The Grenadines',
                'phoneCode' => 1784
            ],
            [
                'sort' => 'WS',
                'name' => 'Samoa',
                'phoneCode' => 684
            ],
            [
                'sort' => 'SM',
                'name' => 'San Marino',
                'phoneCode' => 378
            ],
            [
                'sort' => 'ST',
                'name' => 'Sao Tome and Principe',
                'phoneCode' => 239
            ],
            [
                'sort' => 'SA',
                'name' => 'Saudi Arabia',
                'phoneCode' => 966
            ],
            [
                'sort' => 'SN',
                'name' => 'Senegal',
                'phoneCode' => 221
            ],
            [
                'sort' => 'RS',
                'name' => 'Serbia',
                'phoneCode' => 381
            ],
            [
                'sort' => 'SC',
                'name' => 'Seychelles',
                'phoneCode' => 248
            ],
            [
                'sort' => 'SL',
                'name' => 'Sierra Leone',
                'phoneCode' => 232
            ],
            [
                'sort' => 'SG',
                'name' => 'Singapore',
                'phoneCode' => 65
            ],
            [
                'sort' => 'SK',
                'name' => 'Slovakia',
                'phoneCode' => 421
            ],
            [
                'sort' => 'SI',
                'name' => 'Slovenia',
                'phoneCode' => 386
            ],
            [
                'sort' => 'XG',
                'name' => 'Smaller Territories of the UK',
                'phoneCode' => 44
            ],
            [
                'sort' => 'SB',
                'name' => 'Solomon Islands',
                'phoneCode' => 677
            ],
            [
                'sort' => 'SO',
                'name' => 'Somalia',
                'phoneCode' => 252
            ],
            [
                'sort' => 'ZA',
                'name' => 'South Africa',
                'phoneCode' => 27
            ],
            [
                'sort' => 'GS',
                'name' => 'South Georgia',
                'phoneCode' => 0
            ],
            [
                'sort' => 'SS',
                'name' => 'South Sudan',
                'phoneCode' => 211
            ],
            [
                'sort' => 'ES',
                'name' => 'Spain',
                'phoneCode' => 34
            ],
            [
                'sort' => 'LK',
                'name' => 'Sri Lanka',
                'phoneCode' => 94
            ],
            [
                'sort' => 'SD',
                'name' => 'Sudan',
                'phoneCode' => 249
            ],
            [
                'sort' => 'SR',
                'name' => 'Suri',
                'phoneCode' => 597
            ],
            [
                'sort' => 'SJ',
                'name' => 'Svalbard And Jan Mayen Islands',
                'phoneCode' => 47
            ],
            [
                'sort' => 'SZ',
                'name' => 'Swaziland',
                'phoneCode' => 268
            ],
            [
                'sort' => 'SE',
                'name' => 'Sweden',
                'phoneCode' => 46
            ],
            [
                'sort' => 'CH',
                'name' => 'Switzerland',
                'phoneCode' => 41
            ],
            [
                'sort' => 'SY',
                'name' => 'Syria',
                'phoneCode' => 963
            ],
            [
                'sort' => 'TW',
                'name' => 'Taiwan',
                'phoneCode' => 886
            ],
            [
                'sort' => 'TJ',
                'name' => 'Tajikistan',
                'phoneCode' => 992
            ],
            [
                'sort' => 'TZ',
                'name' => 'Tanzania',
                'phoneCode' => 255
            ],
            [
                'sort' => 'TH',
                'name' => 'Thailand',
                'phoneCode' => 66
            ],
            [
                'sort' => 'TG',
                'name' => 'Togo',
                'phoneCode' => 228
            ],
            [
                'sort' => 'TK',
                'name' => 'Tokelau',
                'phoneCode' => 690
            ],
            [
                'sort' => 'TO',
                'name' => 'Tonga',
                'phoneCode' => 676
            ],
            [
                'sort' => 'TT',
                'name' => 'Trinad And Tobago',
                'phoneCode' => 1868
            ],
            [
                'sort' => 'TN',
                'name' => 'Tunisia',
                'phoneCode' => 216
            ],
            [
                'sort' => 'TR',
                'name' => 'Turkey',
                'phoneCode' => 90
            ],
            [
                'sort' => 'TM',
                'name' => 'Turkmenistan',
                'phoneCode' => 7370
            ],
            [
                'sort' => 'TC',
                'name' => 'Turks And Caicos Islands',
                'phoneCode' => 1649
            ],
            [
                'sort' => 'TV',
                'name' => 'Tuvalu',
                'phoneCode' => 688
            ],
            [
                'sort' => 'UG',
                'name' => 'Uganda',
                'phoneCode' => 256
            ],
            [
                'sort' => 'UA',
                'name' => 'Ukraine',
                'phoneCode' => 380
            ],
            [
                'sort' => 'AE',
                'name' => 'United Arab Emirates',
                'phoneCode' => 971
            ],
            [
                'sort' => 'GB',
                'name' => 'United Kingdom',
                'phoneCode' => 44
            ],
            [
                'sort' => 'US',
                'name' => 'United States',
                'phoneCode' => 1
            ],
            [
                'sort' => 'UM',
                'name' => 'United States Minor Outlying Islands',
                'phoneCode' => 1
            ],
            [
                'sort' => 'UY',
                'name' => 'Uruguay',
                'phoneCode' => 598
            ],
            [
                'sort' => 'UZ',
                'name' => 'Uzbekistan',
                'phoneCode' => 998
            ],
            [
                'sort' => 'VU',
                'name' => 'Vanuatu',
                'phoneCode' => 678
            ],
            [
                'sort' => 'VA',
                'name' => 'Vatican City State (Holy See)',
                'phoneCode' => 39
            ],
            [
                'sort' => 'VE',
                'name' => 'Venezuela',
                'phoneCode' => 58
            ],
            [
                'sort' => 'VN',
                'name' => 'Vietnam',
                'phoneCode' => 84
            ],
            [
                'sort' => 'VG',
                'name' => 'Virgin Islands (British)',
                'phoneCode' => 1284
            ],
            [
                'sort' => 'VI',
                'name' => 'Virgin Islands (US)',
                'phoneCode' => 1340
            ],
            [
                'sort' => 'WF',
                'name' => 'Wallis And Futuna Islands',
                'phoneCode' => 681
            ],
            [
                'sort' => 'EH',
                'name' => 'Western Sahara',
                'phoneCode' => 212
            ],
            [
                'sort' => 'YE',
                'name' => 'Yemen',
                'phoneCode' => 967
            ],
            [
                'sort' => 'YU',
                'name' => 'Yugoslavia',
                'phoneCode' => 38
            ],
            [
                'sort' => 'ZM',
                'name' => 'Zambia',
                'phoneCode' => 260
            ],
            [
                'sort' => 'ZW',
                'name' => 'Zimbabwe',
                'phoneCode' => 26
            ],
        ];

        foreach ($countries as $country) {
            if (is_null(Country::where('name', $country['name'])->first()))
                Country::create([
                    'name'          => $country['name'],
                    'sort'          => $country['sort'],
                    'phoneCode'     => $country['phoneCode'],
                    'status'        => 1,
                ]);
        }
    }
}