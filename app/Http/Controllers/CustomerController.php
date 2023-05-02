<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query->get('search');
        $customers = Customer::latest();

        if($search) {
            $customers->where('name', 'like', "%$search%");
        }

        return view('customer.index', [
            'customers' => $customers->paginate(10)
        ]);
    }

    public function add(): View
    {
        return view('customer.add');
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $customer = new Customer($request->all());
        $customer->save();

        return redirect('/customer')->with([
            'success' => 'Customer berhasil ditambahkan'
        ]);
    }

    public function edit(string $id): View
    {
        return view('customer.edit', [
            'customer' => Customer::find($id)
        ]);
    }

    public function update(CustomerUpdateRequest $request): RedirectResponse
    {
        $body = $request->all();
        $customer = Customer::find($body['id']);

        $customer->update($body);

        return redirect('/customer')->with('success', 'Customer '. $customer->name .' berhasil diupdate');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $customer = Customer::find($request->get('id'));

        if($customer) {
            $customer->delete();

            return redirect('/customer')->with([
                'success' => 'Customer '. $customer->name .' berhasil dihapus'
            ]);
        } else {
            return redirect('/customer')->with([
                'error' => 'Customer not found'
            ]);
        }
    }
}
