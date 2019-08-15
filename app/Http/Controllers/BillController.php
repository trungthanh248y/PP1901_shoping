<?php

namespace App\Http\Controllers;

use App\Bill;
use app\Contracts\BillRepositoryInterface;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public $billRepository;

    public function __construct(BillRepositoryInterface $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    public function index()
    {
        $bills = $this->billRepository->getAll();

        return view('bills.home', compact('bills'));
    }

    public function create()
    {

        return view('bills.add', compact('bills'));
    }

    public function store(Request $request)
    {
        $arr = [];
        $arr['payment'] = $request->get('payment');
        $arr['status'] = $request->get('status');
        $arr['total'] = $request->get('total');
        $mess = "";
        if ($this->billRepository->create($arr)) {
            $mess = "Success add new";
        }

        return view('bills.add', compact('bill'))->with('mess', $mess);
    }

    public function edit($id)
    {
        $bill = $this->billRepository->find($id);

        return view('bills.edit', compact('bill'));
    }

    public function update(Request $request, $id)
    {
        $arr = [];
        $arr['payment'] = $request->get('payment');
        $arr['status'] = $request->get('status');
        $arr['total'] = $request->get('total');
        $mess = "";
        if ($this->billRepository->update($id, $arr)) {
            $mess = "Success edit";
        }

        return view('bills.edit', compact('bill'))->with('mess', $mess);
    }

    public function delete(Request $request)
    {
        $this->billRepository->delete($request->id);
        return redirect()->route('indexBill')->with('mes_del', 'Delete success');
    }
}
