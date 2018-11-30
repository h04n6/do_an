<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Repositories\CustomerRepository;
use Repositories\AffiliateRepository;
use Repositories\BasisRepository;
use Repositories\ScheduleRepository;
use Repositories\BlockRepository;
use Repositories\ConfigRepository;

class FrontendController extends Controller {

    public function __construct(ConfigRepository $configRepo, BlockRepository $blockRepo, CustomerRepository $customerRepo, AffiliateRepository $affRepo, BasisRepository $basisRepo, ScheduleRepository $scheduleRepo) {
        $this->customerRepo = $customerRepo;
        $this->affRepo = $affRepo;
        $this->basisRepo = $basisRepo;
        $this->scheduleRepo = $scheduleRepo;
        $this->blockRepo = $blockRepo;
        $this->configRepo = $configRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ref = null) {
        $basis = $this->basisRepo->allOrder();
        $schedule = $this->scheduleRepo->allOrder();
        $content = $this->blockRepo->getBlocksByParentId();
        $contentChildren = $this->blockRepo->getAllChildrenBLock();
        $config = $this->configRepo->first();
        return view('frontend/index', compact('config','ref', 'basis', 'schedule', 'block', 'content', 'contentChildren'));
    }

    public function register(Request $request) {
        $input = $request->all();
        $ref = $request->get('ref');
        $validator = \Validator::make($input, $this->customerRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $affiliate_id = $this->affRepo->findBy('code', $ref);
        if (!is_null($affiliate_id)) {
            $input['affiliate_id'] = $affiliate_id->id;
        }

        $customer = $this->customerRepo->create($input);
        $this->basisRepo->countData($customer->basis_id);
        if ($ref != null) {
            $this->affRepo->countData($ref);
        }
        return redirect()->back();
    }

    public function traffic(Request $request) {
        $ref = $request->get('ref');
        if (!is_null($ref)) {
            $this->affRepo->countTraffic($ref);
        }
        return response()->json(['error' => false]);
    }

}
