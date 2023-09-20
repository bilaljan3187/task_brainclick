<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = User::where('user_type_id',2)->with('courses')->get();

        foreach ($students as $student) {

            // Build the email content here
            $studentName = $student->name;
            $courseNames = $student->courses->pluck('name')->implode(', ');

            // Send the email
            Mail::raw("Hello $studentName, your courses are: $courseNames", function ($message) use ($student) {
                $message->to($student->email)->subject('Daily Reminder to Check Your Course Progress');
            });
        }

        $this->info('Reminder emails sent successfully.');
    }
}
