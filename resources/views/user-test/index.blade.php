@extends('layouts.app')

@section('title', 'My Test')

@section('breadcrumb')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="active">My Test</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="main-widget-container">
            <div class="row">
                <div class="col-xs-12 widget-container-col ui-sortable" id="data-container"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    $(document).ready(function() {
        const $dataContainer = $("#data-container"),
            answerUrl = "{{ route('user-tests.answer', ['userTest' => ':id']) }}",
            testStartUrl = "{{ route('user-tests.start') }}",
            timerInterval = parseInt("{{ config('app.question_timer_seconds', 120) }}");

        let timer = null;

        // Add a request interceptor
        axios.interceptors.request.use(function(config) {
            // Do something before request is sent
            $dataContainer.empty();
            return config;
        }, function(error) {
            // Do something with request error
            return Promise.reject(error);
        });

        // Fetch initial data
        loadDate();

        $dataContainer.on('click', '.save-and-next', function(e, autoTrigger) {

            e.preventDefault();

            const $this = $(this),
                userTestId = $this.attr('data-userTestId'),
                questionId = $this.attr('data-questionId'),
                answer_option = $this.closest('form').find("input[type='radio']:checked").val();

            if (typeof userTestId === 'undefined' || typeof questionId === 'undefined') {
                swal({
                    icon: "info",
                    title: "There is some issue. Please refresh page!",
                });
                return false;
            }

            if (typeof autoTrigger === 'undefined' && typeof answer_option === 'undefined') {
                swal({
                    icon: "warning",
                    title: "Please choose an option!",
                });
                return false;
            }

            if (typeof userTestId !== 'undefined' && userTestId === true) {
                answer_option = '';
            }

            if (userTestId && questionId) {
                axios.post(answerUrl.replace(':id', userTestId), {
                        question_id: questionId,
                        answer_option: answer_option,
                    })
                    .then(({
                        data: {
                            status,
                            html
                        }
                    }) => {
                        if (status) {
                            $dataContainer.append(html);
                            startTimer();
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }).on('click', '.start-test', function(e) {

            e.preventDefault();

            axios.post(testStartUrl)
                .then(({
                    data: {
                        status,
                    }
                }) => {
                    if (status) {
                        loadDate();
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        });

        function handleError(error) {
            clearTimer();
            console.log(error);
        }

        function loadDate() {
            axios.get("{{ route('user-tests.load') }}")
                .then(({
                    data: {
                        status,
                        html
                    }
                }) => {
                    if (status) {
                        $dataContainer.append(html);
                        startTimer();
                    }
                })
                .catch(function(error) {
                    handleError(error);
                });
        }

        function startTimer() {

            clearTimer();

            const $actable = $dataContainer.find(".save-and-next");

            if ($actable.length == 1) {
                timer = getTimer(function() {
                    $actable.trigger('click', true);
                });
            }
        }

        function clearTimer() {
            if (timer) {
                clearInterval(timer);
            }
        }

        function getTimer(cb) {

            const $questionTime = $dataContainer.find('.question-time');
            let seconds = 0;

            return setInterval(function() {
                seconds++;

                if ($questionTime.length == 1) {
                    $questionTime.html(formatTime(seconds));

                    if (seconds > timerInterval - 10) {
                        $questionTime.parent().addClass('text-danger');
                    }
                }

                if (seconds == timerInterval) {
                    seconds = 0;
                    cb();
                }

            }, 1000); //miliseconds
        }

        function formatTime(seconds) {
            if (typeof seconds === 'undefined' || seconds <= 0) {
                return "00:00";
            }

            const effectiveSeconds = seconds % 60,
                effectiveMinutes = (seconds - effectiveSeconds) / 60;
            return `${`0${effectiveMinutes}`.slice(-2)}:${`0${effectiveSeconds}`.slice(-2)}`;
        }
    });
</script>
@endpush