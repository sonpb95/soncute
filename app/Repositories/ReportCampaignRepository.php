<?php
namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

class ReportCampaignRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\ReportCampaign';
    }

    public function getReportedCampaign(){
        return $this->model->with('campaigns')->distinct()->get(['campaign_id']);
    }
}
