<?php

namespace App\Livewire;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ShowContactPage extends Component
{

    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();
        $mailData = [
            'subject' => 'Yout have received a contact Email',
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message
        ];
        Mail::to('admin@example.com')->send(new ContactEmail($mailData));
        session()->flash('success', 'Your message has been sent successfully, we will get to you soon.');
        $this->redirect('contact');
    }
    public function render()
    {
        return view('livewire.show-contact-page');
    }
}
