<div class = "container">
    <a href="{{ url('posted_surveys') }}"><button type = "button" class = "go-back-link">Go back</button></a>
    <header class="header">
        <div>
            <hr>
            <h1 id="title" class="text-center">{{-- Survey Title:  --}}{{ $survey_selected->surveyTitle }}</h1>
            <br>
            <p id="description" class="description text-center">{{-- Survey Description: --}}
                {{ $survey_selected->surveyDesc }}</p>
        </div>
    </header>
    <div>
        @if ($surveyType === 'built_in')
            <form id="survey-form" wire:submit.prevent="answerBuiltIn">
                @csrf
                @foreach ($questions as $questionIndex => $question)
                    {{-- @dump($question) --}}
                    <div class="form-group" wire:key="question-{{ $questionIndex }}">
                        <hr>
                        <label id="name-label">{{ $question['questionNum'] }}: {{ $question['questionDesc'] }}</label>
                        <div class="choices" id="choices_{{ $questionIndex }}">
                            @foreach ($question['choices'] as $choiceIndex => $choice)
                                <div class="form-group"
                                    wire:key="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}">
                                    @if ($question['questionType'] == 'radio')
                                        <label>
                                            <input type="{{ $question['questionType'] }}"
                                                id="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                                value="{{ $choice['id'] }}" class="input-radio"
                                                name = "questions.{{ $questionIndex }}.answers.radio.choiceID"
                                                wire:model = "questions.{{ $questionIndex }}.answers.radio.choiceID">
                                            {{ $choice['choiceDesc'] }}
                                        </label>
                                    @elseif ($question['questionType'] == 'checkbox')
                                        <label>
                                            <input type="{{ $question['questionType'] }}"
                                                id="question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                                value="{{ $choice['id'] }}" class="input-checkbox"
                                                name = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.choiceID[]"
                                                wire:model = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.choiceID">
                                            {{ $choice['choiceDesc'] }}
                                        </label>
                                    @elseif($question['questionType'] == 'text')
                                        <input type = "{{ $question['questionType'] }}"
                                            id = "question-{{ $questionIndex }}-choice-{{ $choiceIndex }}"
                                            placeholder = "{{ $choice['choiceDesc'] }}" class="form-control"
                                            name = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.answerDesc[]"
                                            wire:model = "questions.{{ $questionIndex }}.answers.{{ $choiceIndex }}.answerDesc">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                @endforeach

                <button type="submit" class="submit-button">Submit</button>
            </form>
    </div>
@elseif ($surveyType === 'google_forms')
    <div class="GoogleForms">
        <form wire:submit.prevent="answerGoogleForms">
            @csrf
            <div class="form-group">
                <hr>
                <label>Survey Type: {{ $surveyType }}</label>
                <label for="surveyTitle">Survey Title:</label>
                <input type="text" class="form-control" id="surveyTitle" wire:model="surveyTitle" required>

                <label for="surveyDesc">Survey Description:</label>
                <input type="text" class="form-control" id="surveyDesc" wire:model="surveyDesc">

                <label for="surveyLink">Survey Link:</label>
                <input type="text" class="form-control" id="surveyLink" wire:model="surveyLink">

                <label for="surveyEditorLink">Survey Editor Link:</label>
                <input type="text" class="form-control" id="surveyEditorLink" wire:model="surveyEditorLink">

                <label for="active">Active:</label>
                <input type="checkbox" id="active" wire:model="active">
            </div>
            <hr>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
    @endif
</div>
