<!-- resources/views/livewire/survey-list.blade.php -->

<script>
    function confirmDeleteSurvey(surveyData) {
        if (confirm('Are you sure you want to delete "' + surveyData.surveyTitle + '"?')) {
            // If the user confirms, redirect to the delete route
            window.location.href = "/delete_survey/" + surveyData.id;
        }
    }
</script>



<div class="card">
    <div class="header">
        <div class="content">
            <span class="title">Posted Surveys</span>

            @if (!$survey_list->isEmpty())
                <table>
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Survey Type</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($survey_list as $survey_posted)
                            <tr>
                                <td>{{ $survey_posted->id }}</td>
                                <td><img src="{{ URL::asset('/images/xls_icon.png') }}" alt="xls file icon" height="25"
                                        width="25"></td>
                                <td>
                                    <a href="{{ route('answer_survey', ['survey_selected' => $survey_posted->id]) }}">
                                        {{ $survey_posted->surveyTitle }}
                                    </a>
                                </td>
                                <td>{{ $survey_posted->surveyDesc }}</td>
                                @if ($survey_posted->surveyType === 'built_in')
                                    <td>Built-in</td>
                                @endif
                                @if ($survey_posted->surveyType === 'google_forms')
                                    <td>Google Forms</td>
                                @endif
                                <td>{{ $survey_posted->created_at }}</td>
                                <td>
                                    <div>
                                        <a
                                            href="{{ route('edit_survey', ['survey_selected' => $survey_posted->id]) }}"><button>Edit</button></a>
                                        <button
                                            onclick="confirmDeleteSurvey({{ json_encode($survey_posted) }})">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <p>No surveys available.</p>
            @endif
            <a class = "message" href="{{ url('new_survey') }}">Create New Survey</a>
        </div>
    </div>
