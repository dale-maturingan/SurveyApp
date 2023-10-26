<form method="post" id="builtInSurveyForm" action="{{ route('add_hybrid_survey') }}"
            wire:submit.prevent="updateProfile">
            {{-- @csrf --}}
            {{ csrf_field() }}
        <input type = "hidden" name = "type" value = "built_in">
            <hr>
            <input type="text" name="surveyTitleInput" placeholder="Survey Title" maxlength="50"
                accept-charset="UTF-8" required>
            <input type="text" name="surveyDescInput" placeholder="Survey Description" maxlength="50"
                accept-charset="UTF-8" required>
            <button type="submit">Post Survey</button>
            <hr>
            <br>
            {{-- tas may lalabas na input at select dropdown para makapili kung anong input type --}}
            <hr>
            <div class = "survey_question">
                <input type="text" name="surveyQuestionInput[]" required placeholder="Question (required)">
                <select name="surveyQuestionType[]" required>
                    <option value="">--Select Question Type--</option>
                    <option value="text">Text</option>
                    <option value="select">Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio</option>
                    <option value="file">File</option>
                </select>
                <br>
                <div class = "survey_choice">
                    <input type="text" name="choiceDescription[]" required placeholder="Choice (required)">
                </div>
                <input type="button" onclick="addChoice(this)" value="Add Choice">
                <hr>
            </div>
            {{-- tas mag chchange ung input type base sa sinelect na type --}}
            {{-- tas kada input type magkaka name ng question1, question2, dynamic ung number --}}
        </form>
        <input type="button" onclick="duplicateInput()" value="Add Question">