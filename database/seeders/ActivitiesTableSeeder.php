<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'title' => 'Cours de yoga vygnasa doux',
                'description' => 'Détente du corps et de l\'esprit',
                'location' => 'Au centre sportif de la haie-Vigné.',
                'schedule' => 'Le lundi de 12h30 à 13h30',
                'coach' => 'Nathalie Bon',
                'image_id' => 1,
                'additional_line1' => 'Mouvements coordonnés à la respiration, postures, enchaînements de postures, relaxation....',
                'additional_line2' => 'Assouplit et tonifie le corps.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Cours de fitness',
                'description' => 'Cours de GYM\' fitness : remise en forme et entretien.',
                'location' => 'Au centre sportif de la haie-Vigné.',
                'schedule' => 'Le lundi de 20h00 à 21h, Le mardi de 11h30 à 12h30, Le mardi de 20h à 21h',
                'coach' => 'Léa Huchet, Evelyne Bertrand',
                'image_id' => 2,
                'additional_line1' => 'Renforcement musculaire (abdos, fessiers...) enchaînements dansés pour certains cours,
        coordination, étirements.',
                'additional_line2' => 'Renforcement musculaire (abdos, fessiers...) enchaînements dansés pour certains cours,
        coordination, étirements.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cours de pilates',
                'description' => 'Amélioration de la souplesse et de la coordination, harmonie du corps et de l\'esprit, détente et relaxation.',
                'location' => 'Au centre sportif de la haie-Vigné.',
                'schedule' => 'Le mardi de 12h30 à 13h30, Le mercredi de 20h à 21h, Le jeudi de 15h à 16h, Le jeudi de 20h à 21h',
                'coach' => 'Delphine Vattier, Nathalie Bon, Maud Lemoine, Julie Noblet',
                'image_id' => 3,
                'additional_line1' => 'Méthode de remise en forme globale basée sur des excercices doux aynat pour objectif de
        renforcer les muscles profons essentiels à une bonne posture.',
                'additional_line2' => 'Cours visant à muscler harmonieusement toutes les parties du corps, avec une mention
        spéciale pour les abdominaux qui sont travaillés en profondeur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cours de stretching',
                'description' => 'Diminuer le stress et favoriser la relaxation',
                'location' => 'Au centre sportif de la haie-Vigné.',
                'schedule' => 'Le lundi de 20h à 21h',
                'coach' => 'Maud Lemoine',
                'image_id' => 4,
                'additional_line1' => 'Le stretching permet d\'étirer les différents muscles ou groupes musculaires du corps et
        d\'assouplir les articulations.',
                'additional_line2' => ' De ce fait, il préserve contre les traumatismes musculaires et articulaires.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
