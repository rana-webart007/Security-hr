<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->text('guard_id')->nullable();
            $table->text('security_id')->nullable();
            $table->text('incident_id')->nullable();
            $table->text('location')->nullable();
            $table->text('incident_date')->nullable();
            $table->text('incident_time')->nullable();
            $table->text('incident_category')->nullable();
            $table->text('incident_type')->nullable();
            $table->text('incident_img')->nullable();
            $table->text('reported_by')->nullable();
            $table->text('reported_by_title')->nullable();
            $table->text('reported_by_phone')->nullable();
            $table->text('reported_by_email')->nullable();
            $table->text('weapons')->nullable();
            $table->text('weapon_type')->nullable();
            $table->text('weapon_type_other')->nullable();
            $table->text('vehicle_type')->nullable();
            $table->text('vehicle_year')->nullable();
            $table->text('vehicle_model')->nullable();
            $table->text('vehicle_color')->nullable();
            $table->text('vehicle_license_plate')->nullable();
            $table->text('vehicle_notes')->nullable();
            $table->text('police_report_number')->nullable();
            $table->text('police_agency')->nullable();
            $table->text('police_notified')->nullable();
            $table->text('police_officer_name')->nullable();
            $table->text('police_officer_badge_number')->nullable();
            $table->text('police_notified_time')->nullable();
            $table->text('police_arrival_time')->nullable();
            $table->text('police_phone')->nullable();
            $table->text('incident_details')->nullable();
            $table->text('involved_person_type')->nullable();
            $table->text('involved_person_first_name')->nullable();
            $table->text('involved_person_last_name')->nullable();
            $table->text('involved_person_emp_id')->nullable();
            $table->text('involved_person_phone')->nullable();
            $table->text('involved_person_email')->nullable();
            $table->text('involved_person_dob')->nullable();
            $table->text('involved_person_home_address')->nullable();
            $table->text('involved_person_home_city')->nullable();
            $table->text('involved_person_home_state')->nullable();
            $table->text('involved_person_home_zip')->nullable();
            $table->text('involved_person_home_country')->nullable();
            $table->text('involved_person_sex')->nullable();
            $table->text('involved_person_height')->nullable();
            $table->text('involved_person_weight')->nullable();
            $table->text('involved_person_clothing')->nullable();
            $table->text('involved_person_hair_color')->nullable();
            $table->text('involved_person_eye_color')->nullable();
            $table->text('involved_person_tattoos')->nullable();
            $table->text('involved_person_piercings')->nullable();
            $table->text('involved_person_identification_type')->nullable();
            $table->text('involved_person_drivers_license_no')->nullable();
            $table->text('involved_person_drivers_license_state')->nullable();
            $table->text('individual_sku_number')->nullable();
            $table->text('individual_description')->nullable();
            $table->text('individual_unit_price')->nullable();
            $table->text('individual_quantity')->nullable();
            $table->text('individual_item_category')->nullable();
            $table->text('individual_recovered')->nullable();
            $table->text('individual_damaged')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_reports');
    }
};
