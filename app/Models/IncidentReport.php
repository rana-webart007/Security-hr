<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    use HasFactory;

    protected $table = "incident_reports";
    protected $fillable = [
        'guard_id',
        'security_id',
        'incident_id',
        
        'location',
        'incident_date',
        'incident_time',
        'incident_category',
        'incident_type',
        'incident_img',
        
        'reported_by',
        'reported_by_title',
        'reported_by_phone',
        'reported_by_email',
        
        'weapons',
        'weapon_type',
        'weapon_type_other',
        
        'vehicle_type',
        'vehicle_year',
        'vehicle_model',
        'vehicle_color',
        'vehicle_license_plate',
        'vehicle_notes',

        'police_report_number',
        'police_agency',
        'police_notified',
        'police_officer_name',
        'police_officer_badge_number',
        'police_notified_time',
        'police_arrival_time',
        'police_phone',

        'incident_details',
        'involved_person_type',
        'involved_person_first_name',
        'involved_person_last_name',
        'involved_person_emp_id',
        'involved_person_phone',
        'involved_person_email',
        'involved_person_dob',
        'involved_person_home_address',
        'involved_person_home_city',
        'involved_person_home_state',
        'involved_person_home_zip',
        'involved_person_home_country',
        'involved_person_sex',
        'involved_person_height',
        'involved_person_weight',
        'involved_person_clothing',
        'involved_person_hair_color',
        'involved_person_eye_color',
        'involved_person_tattoos',
        'involved_person_piercings',
        'involved_person_identification_type',
        'involved_person_drivers_license_no',
        'involved_person_drivers_license_state',

        'individual_sku_number',
        'individual_description',
        'individual_unit_price',
        'individual_quantity',
        'individual_item_category',
        'individual_recovered',
        'individual_damaged'
    ];
}