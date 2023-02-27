<?php

use App\Models\Lead;

if(!function_exists('dashboard_lead_icon')){
    function dashboard_lead_icon($status){
        switch ($status){
            case Lead::UNPROCESSED:
                $icon = '<i class="fa-solid fa-exclamation-triangle info-page-unprocessed2"></i>';
            break;
            case Lead::APPOINTMENT:
                $icon = '<i class="fa-solid fa-handshake info-page-appointment2"></i>';
            break;
            case Lead::DEADLINE:
                $icon = '<i class="fa-solid fa-calendar-day info-page-deadline2"></i>';
            break;
            case Lead::CLOSED:
                $icon = '<i class="fa-solid fa-times-circle info-page-closed2"></i>';
            break;
            case Lead::NOT_CLOSED:
                $icon = '<i class="fa-solid fa-exclamation-circle info-page-not-closed"></i>';
            break;
            case Lead::NO_INTEREST:
                $icon = '<i class="fa-solid fa-sad-tear info-page-no-interests2"></i>';
            break;
            default:
                $icon = '<i class="fa-solid fa-phone-slash info-page-not-reached2"></i>';
            break;
        }
        return $icon;
    }
}

if(!function_exists('lead_table_icon')){
    function lead_table_icon($status){
        switch ($status){
            case Lead::UNPROCESSED:
                $icon = '<span class="badge badge-sm light personal-badge-unprocessed"><i class="fa-solid fa-exclamation-triangle personal-page-unprocessed me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            case Lead::APPOINTMENT:
                $icon = '<span class="badge badge-sm light personal-badge-appointment"><i class="fa-solid fa-handshake personal-page-appointment me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            case Lead::DEADLINE:
                $icon = '<span class="badge badge-sm light personal-badge-deadline"><i class="fa-solid fa-calendar-day personal-page-deadline me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            case Lead::CLOSED:
                $icon = '<span class="badge badge-sm light personal-badge-closed"><i class="fa-solid fa-times-circle personal-page-closed me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            case Lead::NOT_CLOSED:
                $icon = '<span class="badge badge-sm light personal-badge-not-closed"><i class="fa-solid fa-exclamation-circle personal-page-not-closed me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            case Lead::NO_INTEREST:
                $icon = '<span class="badge badge-sm light personal-badge-no-interests"><i class="fa-solid fa-sad-tear personal-page-no-interests me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
            default:
                $icon = '<span class="badge badge-sm light personal-badge-not-reached"><i class="fa-solid fa-phone-slash personal-page-not-reached me-1"></i>'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                break;
        }
        return $icon;
    }
}

if (!function_exists('getLeadNumber')){
    function getLeadNumber($leadId){
        return '#'.str_pad($leadId, 7, '0', STR_PAD_LEFT);
    }
}