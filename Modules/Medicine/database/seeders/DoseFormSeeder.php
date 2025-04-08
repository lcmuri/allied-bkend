<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Medicine\Models\DoseForm;

class DoseFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doseForms = [
            'Tablet',
            'Capsule',
            'Syrup',
            'Injection (IV/IM)',
            'Ointment',
            'Cream',
            'Gel',
            'Suppository',
            'Inhaler',
            'Eye Drops',
            'Ear Drops',
            'Nasal Spray',
            'Oral Solution',
            'Suspension',
            'Powder',
            'Effervescent Tablet',
            'Lozenges',
            'Transdermal Patch',
            'Implant',
            'Solution for Infusion',
            'Emulsion',
            'Aerosol',
            'Liniment',
            'Pessary',
            'Granules',
            'Chewable Tablet',
            'Sublingual Tablet',
            'Buccal Tablet',
            'Oral Film',
            'Foam',
            'Shampoo',
            'Enema',
            'Solution for Nebulization',
            'Gargle',
            'Mouthwash',
            'Gum',
            'Vaginal Ring',
            'Intrauterine Device (IUD)',
            'Intraarticular Injection',
            'Intradermal Injection',
            'Subcutaneous Injection',
            'Topical Solution',
        ];

        foreach ($doseForms as $form) {
            DoseForm::create(['name' => $form]);
        }
    }
}
