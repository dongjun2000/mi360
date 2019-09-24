<?php

namespace App\Listeners;

use App\Events\QuestionAnswer;
use App\Question;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateQuestion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(QuestionAnswer $event)
    {
        $question = Question::query()->find($event->question_id);
        $question->answer += 1;
        $question->laster_answer_user = [
            'id' => \Auth::user()->id,
            'name' => \Auth::user()->name,
            'type' => 1,
            'created_at' => now()
        ];
        $question->save();
    }
}
