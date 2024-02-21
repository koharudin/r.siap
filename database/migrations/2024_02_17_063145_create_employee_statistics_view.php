<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW \"employee_statistics\" AS  SELECT count(employee.id) AS total_employees,
    count(DISTINCT employee.unit_id) AS total_units,
    avg(
        CASE
            WHEN ((employee.sex)::text = 'L'::text) THEN 1
            ELSE 0
        END) AS male_percentage,
    avg(
        CASE
            WHEN ((employee.sex)::text = 'P'::text) THEN 1
            ELSE 0
        END) AS female_percentage,
    avg(
        CASE
            WHEN ((employee.status_kawin)::text = 'K'::text) THEN 1
            ELSE 0
        END) AS married_percentage,
    avg(
        CASE
            WHEN ((employee.status_kawin)::text = 'B'::text) THEN 1
            ELSE 0
        END) AS single_percentage,
    avg(
        CASE
            WHEN ((employee.golongan_darah)::text = 'A'::text) THEN 1
            ELSE 0
        END) AS blood_type_a_percentage,
    avg(
        CASE
            WHEN ((employee.golongan_darah)::text = 'B'::text) THEN 1
            ELSE 0
        END) AS blood_type_b_percentage,
    avg(
        CASE
            WHEN ((employee.golongan_darah)::text = 'O'::text) THEN 1
            ELSE 0
        END) AS blood_type_o_percentage,
    avg(
        CASE
            WHEN ((employee.golongan_darah)::text = 'AB'::text) THEN 1
            ELSE 0
        END) AS blood_type_ab_percentage
   FROM employee;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS \"employee_statistics\"");
    }
};
