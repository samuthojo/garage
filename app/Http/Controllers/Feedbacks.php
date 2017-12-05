<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;

class Feedbacks extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index() {
      $feedbacks = Feedback::orderBy('id', 'desc')->get();
      return view('feedback.feedbacks', compact('feedbacks'));
    }

    public function read(Feedback $feedback) {
      return view('feedback.read_feedback', compact('feedback'));
    }

    public function delete(Request $request) {
      $id = $request->input('id');
      Feedback::where('id', $id)->delete();
      return redirect()->route('feedbacks.index');
    }
}
