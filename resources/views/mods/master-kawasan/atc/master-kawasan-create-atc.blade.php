@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" /> --}}
@endsection

@section('js')
    {{-- <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script> --}}
@endsection

@push('js-push')

    {{-- <script>
        (function() {
            // Modern Wizard
            // --------------------------------------------------------------------
            const wizardModern = document.querySelector('.wizard-modern-example'),
                wizardModernBtnNextList = [].slice.call(wizardModern.querySelectorAll('.btn-next')),
                wizardModernBtnPrevList = [].slice.call(wizardModern.querySelectorAll('.btn-prev')),
                wizardModernBtnSubmit = wizardModern.querySelector('.btn-submit');
            if (typeof wizardModern !== undefined && wizardModern !== null) {
                const modernStepper = new Stepper(wizardModern, {
                    linear: false
                });
                if (wizardModernBtnNextList) {
                    wizardModernBtnNextList.forEach(wizardModernBtnNext => {
                        wizardModernBtnNext.addEventListener('click', event => {
                            modernStepper.next();
                        });
                    });
                }
                if (wizardModernBtnPrevList) {
                    wizardModernBtnPrevList.forEach(wizardModernBtnPrev => {
                        wizardModernBtnPrev.addEventListener('click', event => {
                            modernStepper.previous();
                        });
                    });
                }
                if (wizardModernBtnSubmit) {
                    wizardModernBtnSubmit.addEventListener('click', event => {
                        alert('Submitted..!!');
                    });
                }
            }

        })();
    </script> --}}
@endpush
