<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create New Survey</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        var inputCount = 1;
        var choiceCount = 1;

        function selectSurveyType() {
            var surveySelect = document.getElementById("surveyTypeSelector");
            var builtInSurvey = document.getElementById("builtInSurveyFormDiv");
            var gFormsSurvey = document.getElementById("googleFormsSurveyForm");

            if (surveySelect.selectedIndex == "0") {
                builtInSurvey.style = "display: none;";
                gFormsSurvey.style = "display: none;";
            } else if (surveySelect.selectedIndex == "1") {
                builtInSurvey.style = "display: block;";
                gFormsSurvey.style = "display: none;";
            } else if (surveySelect.selectedIndex == "2") {
                builtInSurvey.style = "display: none;";
                gFormsSurvey.style = "display: block;";
            }
        }

        function duplicateInput() {
            var builtInSurveyCreatorForm = document.getElementById("builtInSurveyForm");
            var clone = document.getElementById('toClone').cloneNode(true);
            clone.style = 'display: block;';
            builtInSurveyCreatorForm.appendChild(clone);
            //inputCount++;
            clone.removeAttr("id");
            /*var allInputs = clone.getElementsByTagName("input");
            for (var i = 0; i < allInputs.length; i++) {
                allInputs.required = true;
            }*/
        }

        function removeInput(elem) {
            $(elem).parent('div').remove();
        }

        function addChoice(ques) {
            //var builtInSurveyCreatorForm = document.getElementById("builtInSurveyForm");
            var choiceClone = document.getElementById('choiceToClone').cloneNode(true);
            var questionClosest = $(ques).parent("div");
            choiceClone.style = 'display: block;';
            //var question = $(ques).parent;
            questionClosest.appendChild(choiceClone);
            //choiceCount++
            choiceClone.removeAttr("id");
            choiceClone.required = true;
        }
    </script>

    <!--script>
        document.addEventListener("DOMContentLoaded", function() {
            const addQuestionButton = document.getElementById("add-question");
            const questionsContainer = document.getElementById("questions-container");

            addQuestionButton.addEventListener("click", function() {
                const questionTemplate = document.querySelector(".question").cloneNode(true);
                const questionCount = questionsContainer.querySelectorAll(".question").length;

                questionTemplate.querySelector("input[name='questions[0][text]']").setAttribute("name",
                    `questions[${questionCount}][text]`);
                questionTemplate.querySelector("input[id='questions[0][text]']").setAttribute("id",
                    `questions[${questionCount}][text]`);
                questionTemplate.querySelector(".choices").innerHTML = "";

                const addChoiceButton = questionTemplate.querySelector(".add-choice");
                addChoiceButton.addEventListener("click", function() {
                    const horizontal_line = document.createElement("hr");
                    const choiceInput = document.createElement("input");
                    choiceInput.type = "text";
                    choiceInput.name = `questions[${questionCount}][choices][]`;
                    choiceInput.id = `questions[${questionCount}][choices][]`;
                    choiceInput.required = true;

                    const removeChoiceButton = document.createElement("input");
                    removeChoiceButton.type = "button";
                    removeChoiceButton.value = "Remove Choice";
                    removeChoiceButton.addEventListener("click", function() {
                        choiceInput.remove();
                        removeChoiceButton.remove();
                    });

                    const choiceContainer = document.createElement("div");
                    choiceContainer.appendChild(choiceInput);
                    choiceContainer.appendChild(removeChoiceButton);

                    questionTemplate.querySelector(".choices").appendChild(choiceInput);
                });

                questionsContainer.appendChild(questionTemplate);
            });
        });
    </script-->


    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    <div class = "survey_question" id="toClone" style="display: none;">
        <hr>
        <input type="text" name="surveyQuestionInput[]" required>
        <select name="surveyQuestionType[]" required>
            <option value="">--Select Question Type--</option>
            <option value="text">Text</option>
            <option value="select">Dropdown</option>
            <option value="checkbox">Checkbox</option>
            <option value="radio">Radio</option>
            <option value="file">File</option>
        </select>
        <input type="button" onclick="removeInput(this)" value="Remove" id="removeInputButton">
        <br>
        <input type="button" onclick="addChoice(this)" value="Add Choice">
        <hr>
    </div>
    <div class = "survey_choice" id="choiceToClone" style="display: none;">
        <input type="text" name="choiceDescription[]" required>
        <input type="button" onclick="removeInput(this)" value="X" id="removeInputButton">
    </div>
    <h1>Create New Survey</h1>
    <a href="{{ url('posted_surveys') }}">Go back</a>
    <hr>
    <label>Survey Type</label>
    <select id="surveyTypeSelector" onchange="selectSurveyType()">

        <option value="">Choose type</option>
        <option value="Built_in">Built-in</option>
        <option value="Google_form">Google Forms</option>

    </select>
    {{-- BUILT IN SURVEY FORM --}}
    <!--form method="post" id="builtInSurveyFormOrig" action="{{-- route('add_builtin_survey') }}" wire:submit.prevent="updateProfile" style = "display: none;">
        {{-- @csrf --}}
        {{ csrf_field() }}
        <hr>
        <input type="text" name="surveyTitleInput" placeholder="Survey Title" maxlength="50" accept-charset="UTF-8"
            required>
        <input type="text" name="surveyDescInput" placeholder="Survey Description" maxlength="50"
            accept-charset="UTF-8" required>
        <button type="submit">Post Survey</button>
        <hr>
        <div id="questions-container">
            <div class="question">
                <hr>
                <label for="questions[0][text]">Question:</label>
                <input type="text" name="questions[0][text]" id="questions[0][text]" required>
                <select name="surveyQuestionType[]" required>
                    <option value="">--Select Question Type--</option>
                    <option value="text">Text</option>
                    <option value="select">Dropdown</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio</option>
                    <option value="file">File</option>
                </select>

                <div class="choices">
                    <input type="text" name="questions[0][choices][]" required>
                </div>

                <button type="button" class="add-choice">Add Choice</button>
                <hr>
            </div>
        </div>
        <hr>
        <button type="button" id="add-question">Add Question</button>
    </form>
    -->
    <div id="builtInSurveyFormDiv" style="display: none;">
        @livewire('built-in-questionnaire')    
    </div>
    {{-- BUILT IN SURVEY FORM --}}

    {{-- GOOGLE FORMS FORM --}}
    <form method="post" id="googleFormsSurveyForm" action="{{ route('add_hybrid_survey') }}"
        wire:submit.prevent="updateProfile" style="display: none;">
        {{-- @csrf --}}
        {{ csrf_field() }}
        <input type = "hidden" name = "type" value = "google_forms">
        <hr>
        <input type="text" name="surveyTitleInput" placeholder="Survey Title" maxlength="50"
            accept-charset="UTF-8" required>
        <input type="text" name="surveyDescInput" placeholder="Survey Desc" maxlength="50"
            accept-charset="UTF-8" required>
        <input type="text" name="surveyLinkInput" placeholder="Survey Link" maxlength="50"
            accept-charset="UTF-8" required>
            <input type="text" name="surveyEditorLinkInput" placeholder="Survey Editor Link" maxlength="50"
            accept-charset="UTF-8" required>
        <button type="submit">Post Survey</button>
        <hr>
        </div>
        {{-- tas mag chchange ung input type base sa sinelect na type --}}
        {{-- tas kada input type magkaka name ng question1, question2, dynamic ung number --}}
    </form>
    {{-- GOOGLE FORMS FORM --}}

    @livewireScripts
</body>

</html>
