<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $notifications = Notification::get();

            return DataTables::of($notifications)
                ->addIndexColumn()
                ->editColumn('created_at', function ($notification) {
                    return $notification->created_at->format('d M Y H:i');
                })
            // ->addColumn('message', function ($notification) {
            //     return $notification->data['message'] ?? '-';
            // })
                ->addColumn('status', function ($notification) {
                    return $notification->read_at
                    ? '<span class="badge bg-success">Read</span>'
                    : '<span class="badge bg-danger">Unread</span>';
                })

                ->addColumn('action', function ($notification) {
                    $show = '<a href="' . route('admin.notification.show', $notification->id) . '" class="btn btn-sm btn-outline-info me-1">Read</a>';

                    return $show;
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.notifications.index');
    }

    // Handle form submit
    public function submitForm(Request $request)
    {

        // // Validate input
        // $request->validate([
        //     'name'    => 'required|string|max:100',
        //     'email'   => 'required|email',
        //     'subject' => 'required|string|max:150',
        //     'message' => 'required|string|min:1000',
        // ]);

        // dd($request->all());

        // Store in DB
        $contact = Notification::create($request->all());

        // Send email (optional)
        Mail::raw("New message from {$contact->name}\n\n{$contact->message}", function ($mail) use ($contact) {
            $mail->to(env('MAIL_FROM_ADDRESS')) // Change to your admin email
                ->subject("Contact Form: {$contact->subject}");
        });

        return redirect()->route('contact')
            ->with('success', 'Message submission successful.');

    }

    public function show($notification)
    {

        $notification = Notification::findOrFail($notification);

        if (is_null($notification->read_at)) {
            $notification->update(['read_at' => now()]);
        }

        return view('admin.notifications.show', compact('notification'));
    }
}
