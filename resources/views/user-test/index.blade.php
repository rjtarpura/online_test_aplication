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
            testStartUrl = "{{ route('user-tests.start') }}";

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

        $dataContainer.on('click', '.save-and-next', function(e) {

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

            if (typeof answer_option === 'undefined') {
                swal({
                    icon: "warning",
                    title: "Please choose an option!",
                });
                return false;
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
                    }
                })
                .catch(function(error) {
                    handleError(error);
                });
        }
    });
</script>
@endpush