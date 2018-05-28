<?php

	namespace App\Http\Controllers\Campaign;

use App\Services\FollowService;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Auth;

class FollowController extends Controller
{
    /**
     * @var FollowService
     */
	private $followService;

    /**
     * FollowController constructor.
     * @param FollowService $followService
     */
	public function __construct(FollowService $followService) {
		$this->followService = $followService;
	}

    /**
     * @param $id
     * @return mixed
     */
	public function follow($id) {
		return $this->followService->follow($id);
	}
}