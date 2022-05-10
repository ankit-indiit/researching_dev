<?php

    if (! function_exists('pr')) {
    function pr($arr) {
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
    }

    function getTopicNameById($topicId)
    {
        return App\Models\Topics::where('id', $topicId)->pluck('topic_name')->first();
    }

    function userProgress()
    {
        $courseTopicIds = App\Models\Topics::where('course_id', Request::segment(2))->pluck('id')->toArray();
        $pdfTopic = App\Models\TopicsPdf::whereIn('topic_id', $courseTopicIds)->count();
        $videoTopic = App\Models\TopicVideos::whereIn('topic_id', $courseTopicIds)->count();
        $quizTopic = App\Models\TopicQuiz::whereIn('topic_id', $courseTopicIds)->count();
        $totalCompleted = $pdfTopic + $videoTopic + $quizTopic;
    	$totalCourseTopics = App\Models\UserCourseProgress::where('user_id', Auth::user()->id)->where('course_id', Request::segment(2))->count();
        @$percentage = $totalCourseTopics/$totalCompleted;
        if ($percentage > 0) {
            return round($percentage * 100, 0);
        } else {
            return 0;
        }
    }

    function showCorrectAns($qusId)
    {
        return App\Models\TopicQuizQuestions::where("id", $qusId)->pluck('answer')->first();
    }
}

        
    
    
    
    

?>