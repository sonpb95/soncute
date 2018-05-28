<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialInformation extends Model
{
    protected $fillable = [

       'campaign_id', 'account_number', 'account_name', 'bank_name'

    ];
	
	

	
}
