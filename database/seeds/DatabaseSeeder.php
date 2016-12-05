<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);

        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');



//        $this->call(UserProfilesTableSeeder::class);
//        $this->call(UserGroupsTableSeeder::class);
//        $this->call(AdministrativeAreasTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(UserDetailsTableSeeder::class);
//        $this->call(SchoolingsTableSeeder::class);
//        $this->call(SchoolingTranslationsTableSeeder::class);

        //$this->call(TopicsTableSeeder::class);
//        $this->call(TypesTableSeeder::class);
//        $this->call(TypesTranslationSeeder::class);
//        $this->call(ObjectiveVerbsTableSeeder::class);
//        $this->call(ObjectivePrepositionsTableSeeder::class);
//        $this->call(ObjectiveContentsTableSeeder::class);
//        $this->call(CountriesTableSeeder::class);
//        $this->call(StatesTableSeeder::class);
//        $this->call(CitiesTableSeeder::class);
//        $this->call(LanguagesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(LevelsTranslationTableSeeder::class);
//        $this->call(LicensesTableSeeder::class);
//        $this->call(FileTypesTableSeeder::class);
//        $this->call(FiletypeTranslationsTranslationSeeder::class);
//        $this->call(TopicsTableSeeder::class);
//        $this->call(TopicsTranslationSeeder::class);
//
//        $this->call(ThreadsTableSeeder::class);
//        $this->call(ThreadsTranslationTableSeeder::class);
//
//        $this->call(ProjectSituationsSeeder::class);
//        $this->call(ProjectSituationsTranslationSeeder::class);
//        $this->call(ProjectTypeSeeder::class);
//        $this->call(ProjectTypeTranslationSeeder::class);
//
//        $this->call(ProjectActivitiesSeeder::class);
//        $this->call(ProjectActivitiesTranslationsSeeder::class);
//
//        $this->call(ProjectSeeder::class);
//        $this->call(ProjectTranslationsSeeder::class);
//        $this->call(ProjectYearSeeder::class);
//        $this->call(PartnerSeeder::class);
//        $this->call(PartnerTranslationsSeeder::class);
//        $this->call(PartnerGroupsSeeder::class);
//        $this->call(PartnerGroupTranslationsSeeder::class);
//        $this->call(PartnerImagesSeeder::class);

        //$this->call(ProjectPartnersSeeder::class);

//        $this->call(ObjectSeeder::class); //-- Esse seed tmb gera os registros do translate via faker.

        //$this->call(NewsSeeder::class);
//        $this->call(NewsEditorialSeeder::class);
        //$this->call(NewsEditorialTranslationSeeder::class);

        //$this->call(CmsHighlightsSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Model::reguard();
    }
}
