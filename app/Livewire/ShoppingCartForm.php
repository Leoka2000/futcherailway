<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;


class ShoppingCartForm extends Component
{
    public $brazilStates = [];
    public $email, $first_name, $last_name, $address, $address2, $city, $selectedState, $zipcode, $phone;

    protected $rules = [
        'email' => 'required|email|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'address2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'selectedState' => 'required|string|max:255',
        'zipcode' => 'required|string|max:10',
        'phone' => 'required|string|max:15',
       
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function mount($brazilStates)
    {
        $this->brazilStates = $brazilStates;
    }
    
    public function submit()
    {
        $this->validate();

        // Create a new Customer
        Customer::create([
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'province' => $this->selectedState,
            'zipcode' => $this->zipcode,
            'phone' => $this->phone,
            'status' => 'active',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        session()->flash('success', 'Customer created successfully!');

        return redirect()->route('components/list-cart');
    }

    public function render()
    {
        return view('livewire.shopping-cart-form');
    }
}