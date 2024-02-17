<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(PejabatPenetapTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(CustomizedAdminMenuTableSeeder::class);
        $this->call(CustomizedAdminOperationLogTableSeeder::class);
        $this->call(CustomizedAdminPermissionsTableSeeder::class);
        $this->call(CustomizedAdminRoleMenuTableSeeder::class);
        $this->call(CustomizedAdminRolePermissionsTableSeeder::class);
        $this->call(CustomizedAdminRoleUsersTableSeeder::class);
        $this->call(CustomizedAdminRolesTableSeeder::class);
        $this->call(CustomizedAdminUserPermissionsTableSeeder::class);
        $this->call(CustomizedAdminUsersTableSeeder::class);
        $this->call(CustomizedAgamaTableSeeder::class);
        $this->call(CustomizedAlasanHukumanTableSeeder::class);
        $this->call(CustomizedBankTableSeeder::class);
        $this->call(CustomizedCountryTableSeeder::class);
        $this->call(CustomizedDiklatTableSeeder::class);
        $this->call(CustomizedDiklatSiasnTableSeeder::class);
        $this->call(CustomizedDiklatSiasnStrukturalTableSeeder::class);
        $this->call(CustomizedDokumenPegawaiTableSeeder::class);
        $this->call(CustomizedEmployeeTableSeeder::class);
        $this->call(CustomizedEselonTableSeeder::class);
        $this->call(CustomizedFailedJobsTableSeeder::class);
        $this->call(CustomizedGajiPokokTableSeeder::class);
        $this->call(CustomizedGolonganDarahTableSeeder::class);
        $this->call(CustomizedHukumanTableSeeder::class);
        $this->call(CustomizedJabatanTableSeeder::class);
        $this->call(CustomizedJenisBahasaTableSeeder::class);
        $this->call(CustomizedJenisKelaminTableSeeder::class);
        $this->call(CustomizedJenisKenaikanGajiTableSeeder::class);
        $this->call(CustomizedJenisKpTableSeeder::class);
        $this->call(CustomizedJenisPekerjaanTableSeeder::class);
        $this->call(CustomizedJenisPensiunTableSeeder::class);
        $this->call(CustomizedJenjangFungsionalTableSeeder::class);
        $this->call(CustomizedKategoriLayananTableSeeder::class);
        $this->call(CustomizedKemampuanBicaraTableSeeder::class);
        $this->call(CustomizedKlasifikasiDokumenTableSeeder::class);
        $this->call(CustomizedMigrationsTableSeeder::class);
        $this->call(CustomizedPangkatTableSeeder::class);
        $this->call(CustomizedPasswordResetsTableSeeder::class);
        $this->call(CustomizedPejabatPenetapTableSeeder::class);
        $this->call(CustomizedPendidikanTableSeeder::class);
        $this->call(CustomizedPenempatanPegawaiTableSeeder::class);
        $this->call(CustomizedPenghargaanTableSeeder::class);
        $this->call(CustomizedRequestLogTableSeeder::class);
        $this->call(CustomizedRiwayatAnakTableSeeder::class);
        $this->call(CustomizedRiwayatAngkakreditTableSeeder::class);
        $this->call(CustomizedRiwayatDiklatStrukturalTableSeeder::class);
        $this->call(CustomizedRiwayatDiklatTeknisTableSeeder::class);
        $this->call(CustomizedRiwayatDp3TableSeeder::class);
        $this->call(CustomizedRiwayatGajiTableSeeder::class);
        $this->call(CustomizedRiwayatHukumanTableSeeder::class);
        $this->call(CustomizedRiwayatJabatanTableSeeder::class);
        $this->call(CustomizedRiwayatKinerjaTableSeeder::class);
        $this->call(CustomizedRiwayatKursusTableSeeder::class);
        $this->call(CustomizedRiwayatMutasiTableSeeder::class);
        $this->call(CustomizedRiwayatNikahTableSeeder::class);
        $this->call(CustomizedRiwayatOrangtuaTableSeeder::class);
        $this->call(CustomizedRiwayatOrganisasiTableSeeder::class);
        $this->call(CustomizedRiwayatPangkatTableSeeder::class);
        $this->call(CustomizedRiwayatPendidikanTableSeeder::class);
        $this->call(CustomizedRiwayatPengalamanKerjaTableSeeder::class);
        $this->call(CustomizedRiwayatPenghargaanTableSeeder::class);
        $this->call(CustomizedRiwayatPenguasaanBahasaTableSeeder::class);
        $this->call(CustomizedRiwayatPensiunTableSeeder::class);
        $this->call(CustomizedRiwayatPotensiDiriTableSeeder::class);
        $this->call(CustomizedRiwayatRekammedisTableSeeder::class);
        $this->call(CustomizedRiwayatSaudaraTableSeeder::class);
        $this->call(CustomizedRiwayatSeminarTableSeeder::class);
        $this->call(CustomizedRiwayatSkcpnsTableSeeder::class);
        $this->call(CustomizedRiwayatSkpnsTableSeeder::class);
        $this->call(CustomizedRiwayatSumpahTableSeeder::class);
        $this->call(CustomizedRiwayatUjiKompetensiTableSeeder::class);
        $this->call(CustomizedRiwayatUsulanTableSeeder::class);
        $this->call(CustomizedStatusAnakTableSeeder::class);
        $this->call(CustomizedStatusJabatanTableSeeder::class);
        $this->call(CustomizedStatusMenikahTableSeeder::class);
        $this->call(CustomizedStatusPegawaiTableSeeder::class);
        $this->call(CustomizedStatusPernikahanTableSeeder::class);
        $this->call(CustomizedStatusUsulanTableSeeder::class);
        $this->call(CustomizedTingkatHukumanTableSeeder::class);
        $this->call(CustomizedTipeJabatanTableSeeder::class);
        $this->call(CustomizedUnitKerjaTableSeeder::class);
        $this->call(CustomizedUsersTableSeeder::class);
        $this->call(CustomizedOauthAuthCodesTableSeeder::class);
        $this->call(CustomizedOauthAccessTokensTableSeeder::class);
        $this->call(CustomizedOauthRefreshTokensTableSeeder::class);
        $this->call(CustomizedOauthClientsTableSeeder::class);
        $this->call(CustomizedOauthPersonalAccessClientsTableSeeder::class);
    }
}
