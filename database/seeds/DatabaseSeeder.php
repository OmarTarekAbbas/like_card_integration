<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(RolesTableSeeder::class);
      $this->call(UserHasRolesTableSeeder::class);
      $this->call(PermissionsTableSeeder::class);
      $this->call(UserHasPermissionsTableSeeder::class);
      $this->call(RoleHasPermissionsTableSeeder::class);
      $this->call(ScaffoldinterfacesTableSeeder::class);
      $this->call(RelationsTableSeeder::class);
      $this->call(PasswordResetsTableSeeder::class);
      $this->call(RoutesTableSeeder::class);
      $this->call(RoleRouteTableSeeder::class);
      $this->call(TypesTableSeeder::class);
      $this->call(SettingsTableSeeder::class);
    //   $this->call(DeleteAllFlagsTableSeeder::class);
    //   $this->call(LanguagesTableSeeder::class);
    //   $this->call(StaticBodiesTableSeeder::class);
    //   $this->call(StaticTranslationsTableSeeder::class);
    //   $this->call(TansBodiesTableSeeder::class);
    //   $this->call(TranslatablesTableSeeder::class);
    //   $this->call(CountriesTableSeeder::class);
    //   $this->call(OperatorsTableSeeder::class);
    //   $this->call(CategoriesTableSeeder::class);
    $this->call(ContentTypesTableSeeder::class);
    //   $this->call(ContentsTableSeeder::class);
    //   $this->call(PostsTableSeeder::class);
    //   $this->call(RbtCodesTableSeeder::class);
    }
}
