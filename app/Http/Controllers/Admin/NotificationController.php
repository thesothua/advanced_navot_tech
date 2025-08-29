<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    // Handle form submit
    public function submitForm(Request $request)
    {
        
        // Validate input
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|min:1000',
        ]);

        // Store in DB
        $contact = Notification::create($request->all());

        // Send email (optional)
        Mail::raw("New message from {$contact->name}\n\n{$contact->message}", function ($mail) use ($contact) {
            $mail->to(env('MAIL_FROM_ADDRESS')) // Change to your admin email
                ->subject("Contact Form: {$contact->subject}");
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
