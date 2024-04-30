<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'customer_since' => 'nullable|date',
            'last_purchase_date' => 'nullable|date',
            'total_spent' => 'nullable|numeric',
            'loyalty_tier' => 'nullable|integer',
            'notes' => 'nullable|string|max:1000',
            'farm_type' => 'nullable|string|max:255'
            
            // Include other fields with validation rules as needed
        ]);
        $customer = Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        return view('customers.show', compact('customer'));
    }

    public function edit($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $customer_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer_id . ',customer_id', // Notice how the rule is structured
            'phone' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'customer_since' => 'nullable|date',
            'last_purchase_date' => 'nullable|date',
            'total_spent' => 'nullable|numeric',
            'loyalty_tier' => 'nullable|integer',
            'notes' => 'nullable|string|max:1000',
            'farm_type' => 'nullable|string|max:255'
            // Include other fields with validation rules as needed
        ]);
        $customer = Customer::findOrFail($customer_id);
        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
