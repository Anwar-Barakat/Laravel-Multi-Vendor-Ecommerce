<?php

namespace App\Http\Livewire\Front\Contact;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactPage extends Component
{
    public $name, $email, $phone, $subject, $message;

    protected $rules = [
        'name'      => ['required', 'min:3', 'max:30'],
        'email'     => ['required', 'email'],
        'phone'     => ['required', 'min:10', 'max:10'],
        'subject'   => ['required', 'min:3', 'max:50'],
        'message'   => ['required', 'min:3', 'max:200'],
    ];

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function addMessage()
    {
        $validations            = $this->validate();
        try {
            if (Auth::check()) {
                Contact::create($validations);
                toastr()->success('Message Has Been Sended Successfully');
                $this->reset();
            } else
                toastr()->info('Login First So That Add a New Message');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.front.contact.contact-page');
    }
}