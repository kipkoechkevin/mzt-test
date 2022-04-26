<?php

namespace App\Http\Controllers;

use App\Mail\ContactCandidate;
use App\Mail\HireCandidate;
use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $coins = Company::find(1)->wallet->coins;
        return view('candidates.index', compact('candidates', 'coins'));
    }

    public function contact($id)
    {
        // @todo
        //get the candidate data
        $candidate = Candidate::find($id);

        //Get the email data needed to be passed on the email
        $mailData = [
            'name' => $candidate->name,
            'email' => $candidate->email,
            'subject' => 'Letter from MZT',
            'url' => 'https://www.myzenteam.com/',
            'title' => 'An exciting Career Opportunity',
            'message' => 'We are contacting you for the available vacant position in our organisation',
        ];

        //Send the mail
        Mail::to($mailData['email'])->send(new ContactCandidate($mailData));

        //Deduct 5 coins from the company
        $company = Company::find(1);

        $company->wallet()->decrement('coins', 5);

        $candidate->status = 'contacted';
        $candidate->save();

        return response()->json();
    }

    public function hire($id)
    {
       $company = Company::find(1);
       $candidate = Candidate::find($id);

        $mailData = [
            'name' => $candidate->name,
            'email' => $candidate->email,
            'subject' => 'Welcome Aboard - MZT',
            'url' => 'https://www.myzenteam.com/',
            'title' => 'Welcome Aboard',
            'message' => 'We are happy to inform you ....',
        ];

        if ($candidate->status !== 'contacted'){
           return abort(403,'Please contact candidate before hire');
        }

        Mail::to($mailData['email'])->send(new HireCandidate($mailData));

        $company->wallet()->increment('coins',5);

        $candidate->status = 'hired';
        $candidate->save();

        return response()->json();
    }
}
