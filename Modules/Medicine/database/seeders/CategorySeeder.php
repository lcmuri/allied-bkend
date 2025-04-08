<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Medicine\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anaesthetics = Category::create([
            'parent_id' => null,
            'name' => 'ANAESTHETICS, PRE- & INTRA-OPERATIVE MEDICINES and MEDICAL GASE',
        ]);
        $general_anaesthetics = Category::create([
            'parent_id' => $anaesthetics->id,
            'name' => 'General Anaesthetics',
        ]);
        $inhalational_medicines = Category::create([
            'parent_id' => $general_anaesthetics->id,
            'name' => 'Inhalational Medicines',
        ]);
        $injectable_medicines = Category::create([
            'parent_id' => $general_anaesthetics->id,
            'name' => 'Injectable Medicines',
        ]);
        $local_anaesthetics = Category::create([
            'parent_id' => $anaesthetics->id,
            'name' => 'Local Anaesthetics',
            'description' => 'For spinal, epidural, caudal or IV regional anaesthesia, use preservative-free injections. Local anaesthetics are used to numb a small area for minor procedures, such as dental work or stitches.',
        ]);
        $pre_operative_medicines = Category::create([
            'parent_id' => $anaesthetics->id,
            'name' => 'Pre-and Intra-Operative Medication and Sedation for Short-Term Procedures and Adjuncts for Spinal and
Epidural Anaesthesia ',
        ]);
        $medical_gases = Category::create([
            'parent_id' => $anaesthetics->id,
            'name' => 'Medical Gases',
        ]);
        $muscle_relaxant = Category::create([
            'parent_id' => null,
            'name' => ' MUSCLE RELAXANTS (PERIPHERALLY ACTING), CHOLINESTERASE INHIBITORS and
ANTICHOLINERGICS',
        ]);
        $muscle_relaxants = Category::create([
            'parent_id' => $muscle_relaxant->id,
            'name' => 'Muscle Relaxants (Peripherally Acting)',
        ]);
        $cholinesterase_inhibitors = Category::create([
            'parent_id' => $muscle_relaxant->id,
            'name' => 'Cholinesterase Inhibitors',
        ]);
        $anticholinergics = Category::create([
            'parent_id' => $muscle_relaxant->id,
            'name' => 'Anticholinergics',
        ]);
        $medicine_pain = Category::create([
            'parent_id' => null,
            'name' => 'MEDICINES FOR PAIN and PALLIATIVE CARE',
        ]);
        $nsaims = Category::create([
            'parent_id' => $medicine_pain->id,
            'name' => 'Non-Opioids and Non-Steroidal Anti-Inflammatory Medicines (NSAIMs)',
            'description' => 'Use NSAIMs with caution in patients with renal disease and cardiac conditions.'
        ]);
        $opioids = Category::create([
            'parent_id' => $medicine_pain->id,
            'name' => 'Opioids',
            'description' => 'Opioids are used for moderate to severe pain. They are used for short-term pain relief, such as after surgery. They are also used for long-term pain relief, such as for cancer patients.'
        ]);
        $adjuvants = Category::create([
            'parent_id' => $medicine_pain->id,
            'name' => 'Adjuncts for pain Management and Medicines for other Symptoms in Palliative Care',
            'description' => 'Adjuvants are used to help the primary pain medication work better. They are used to treat pain that is not relieved by other pain medications.'
        ]);
        $antiallergies = Category::create([
            'parent_id' => null,
            'name' => 'ANTIALLERGICS and MEDICINES used in ANAPHYLAXIS',
        ]);
        $antidotes = Category::create([
            'parent_id' => null,
            'name' => 'ANTIDOTES and OTHER SUBSTANCES used in POISONINGS',
        ]);
        $non_specific_antidotes = Category::create([
            'parent_id' => $antidotes->id,
            'name' => 'Non-Specific Antidotes',
        ]);
        $specific_antidotes = Category::create([
            'parent_id' => $antidotes->id,
            'name' => 'Specific Antidotes',
        ]);
        $anticonvulsants = Category::create([
            'parent_id' => null,
            'name' => 'ANTICONVULSANTS/ANTIEPILEPTICS',
        ]);
        $antiinfectives = Category::create([
            'parent_id' => null,
            'name' => 'ANTI-INFECTIVES MEDICINES',
        ]);
        $antihelminthics = Category::create([
            'parent_id' => $antiinfectives->id,
            'name' => 'Antihelminthics',
        ]);
        $intestinal_antihelminthics = Category::create([
            'parent_id' => $antihelminthics->id,
            'name' => 'Intestinal Antihelminthics',
        ]);
        $antifilarials = Category::create([
            'parent_id' => $antihelminthics->id,
            'name' => 'Antifilarials',
            'description' => 'Management of lymphatic filariasis to be done with triple therapy regimen comprising Albendazole + Diethylcarbamazine dihydrogen citrate + Ivermectin'
        ]);
        $antibacterials = Category::create([
            'parent_id' => $antiinfectives->id,
            'name' => 'Antibacterials',
        ]);
        $access_group_antibiotics = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Access Group Antibiotics',
        ]);
        $watch_group_antibiotics = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Watch Group Antibiotics',
        ]);
        $reserve_group_antibiotics = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Reserve Group Antibiotics',
        ]);
        $antileprosy = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Antileprosy Medicines',
            'description' => 'These Anti-leprosy medicines to be used only in combination, never individually, to prevent emergence of drug resistance.'
        ]);
        $antituberculosis = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Antituberculosis Medicines',
            'description' => 'These Anti-Tuberculosis medicines to be used only in combination with FDCs+/-, never individually, to prevent emergence of drug resistance.'
        ]);
        $single_medicines = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Single Medicines',
        ]);
        $fdcs = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Fixed Dose Combinations (FDCs)',
        ]);
        $mdr_tb = Category::create([
            'parent_id' => $antibacterials->id,
            'name' => 'Medicines for treatment of multi-drug resistant Tuberculosis (MDR-TB)',
            'description' => 'Medicines for the treatment of multidrug-resistant tuberculosis (MDR-TB) should be used in specialized centres adhering to WHO standards for TB control.'
        ]);
        $antifungals = Category::create([
            'parent_id' => $antiinfectives->id,
            'name' => 'Antifungals',
        ]);
        $antiviral = Category::create([
            'parent_id' => $antiinfectives->id,
            'name' => 'Antiviral Medicines',
        ]);
        $antiherpes = Category::create([
            'parent_id' => $antiviral->id,
            'name' => 'Anti-Herpes Medicines',
        ]);
        $antiretrovirals = Category::create([
            'parent_id' => $antiviral->id,
            'name' => 'Antiretrovirals',
            'description' => 'Essential medicines for treatment and prevention of HIV (prevention of mother-to-child transmission and post-exposure prophylaxis). Use of fixed dose combination (FDC) medicines for Antiretroviral therapy (ART) is recommended.'
        ]);
        $nrti = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Nucleoside Reverse Transcriptase Inhibitors (NRTIs)',
        ]);
        $nnrti = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Non-Nucleoside Reverse Transcriptase Inhibitors (NNRTIs)',
        ]);
        $pi = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Protease Inhibitors (PIs)',
        ]);

        $fdc_antiretrovirals = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Fixed Dose Combination (FDC) Antiretrovirals',
        ]);
        $oppurtunistic_infections = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Medicines for prevention of HIV-related opportunistic infections',
        ]);
        $other_antiretrovirals = Category::create([
            'parent_id' => $antiretrovirals->id,
            'name' => 'Other Antiretrovirals',
        ]);
        $antihepatitis = Category::create([
            'parent_id' => $antiviral->id,
            'name' => 'Anti-Hepatitis Medicines',
        ]);
        $antihepatitis_b = Category::create([
            'parent_id' => $antihepatitis->id,
            'name' => 'Medicines for Hepatitis B',
        ]);
        $nucleoside_reverse_transcriptase_inhibitors = Category::create([
            'parent_id' => $antihepatitis_b->id,
            'name' => 'Nucleoside/Nucleotide Reverse Transcriptase Inhibitors',
        ]);
        $antihepatitis_c = Category::create([
            'parent_id' => $antihepatitis->id,
            'name' => 'Medicines for Hepatitis C',
        ]);
        $non_pangenotypic = Category::create([
            'parent_id' => $antihepatitis_c->id,
            'name' => 'non-pangenotypic direct-acting antiviral combinations',
        ]);
        $pangenotypic = Category::create([
            'parent_id' => $antihepatitis_c->id,
            'name' => 'Pangenotypic direct-acting antiviral combinations',
        ]);
        $antiprotazoals = Category::create([
            'parent_id' => $antiinfectives->id,
            'name' => 'Antiprotozoals medicines',
        ]);
        $antiamoebic = Category::create([
            'parent_id' => $antiprotazoals->id,
            'name' => 'Antiamoebic and antigiardiasis Medicines',
        ]);
        $antileishmaniasis = Category::create([
            'parent_id' => $antiprotazoals->id,
            'name' => 'Antileishmaniasis Medicines',
        ]);
        $antimalarials = Category::create([
            'parent_id' => $antiprotazoals->id,
            'name' => 'Antimalarials',
        ]);
        $curative_treatment = Category::create([
            'parent_id' => $antimalarials->id,
            'name' => 'For Curative Treatment',
        ]);
        $prophylaxis = Category::create([
            'parent_id' => $antimalarials->id,
            'name' => 'For Prophylaxis',
        ]);
        $antipneumocystis = Category::create([
            'parent_id' => $antiprotazoals->id,
            'name' => 'Antipneumocystis and Antitoxoplasmosis Medicines',
        ]);
        $antitrypanosomiasis = Category::create([
            'parent_id' => $antiprotazoals->id,
            'name' => 'Antitrypanosomiasis Medicines',
        ]);
    }
}
