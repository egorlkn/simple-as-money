axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.isMobile = screen.width < 992;

window.onresize = function () {
    window.isMobile = screen.width < 992;
};

const Calculator = {
    compilerOptions: {
        delimiters: ['${', '}']
    },
    data() {
        return {
            currency: 1,

            chartIsActive: false,

            icIsActive: true,
            icCalculationIsDisabled: true,
            icCopyIsEnabled: false,

            icInitialAmountIsUnknown: false,
            icInitialAmountIsBlinked: false,
            icInitialAmountIsFocused: false,
            icInitialAmountValue: '',

            icRegularPaymentIsUnknown: false,
            icRegularPaymentIsBlinked: false,
            icRegularPaymentIsFocused: false,
            icRegularPaymentValue: '',

            icNumberOfRegularPaymentsPerYearIsBlinked: false,
            icNumberOfRegularPaymentsPerYearIsFocused: false,
            icNumberOfRegularPaymentsPerYearValue: '',

            icNumberOfYearsIsUnknown: false,
            icNumberOfYearsIsBlinked: false,
            icNumberOfYearsIsFocused: false,
            icNumberOfYearsValue: '',

            icInterestRatePerYearIsUnknown: false,
            icInterestRatePerYearIsBlinked: false,
            icInterestRatePerYearIsFocused: false,
            icInterestRatePerYearValue: '12',

            icFinalAmountIsUnknown: false,
            icFinalAmountIsBlinked: false,
            icFinalAmountIsFocused: false,
            icFinalAmountValue: '',

            icLastRequestCash: {
                isEmpty: true,
                initialAmount: '',
                regularPayment: '',
                numberOfRegularPaymentsPerYear: '',
                numberOfYears: '',
                interestRatePerYear: '',
                finalAmount: '',
                yearly_balances: [],
            },

            icIsErrorResult: false,
            icErrors: [],

            scIsActive: false,
            scCalculationIsDisabled: true,
            scCopyIsEnabled: false,

            scInitialAmountIsUnknown: false,
            scInitialAmountIsBlinked: false,
            scInitialAmountIsFocused: false,
            scInitialAmountValue: '',

            scPaymentAmountIsUnknown: false,
            scPaymentAmountIsBlinked: false,
            scPaymentAmountIsFocused: false,
            scPaymentAmountValue: '',

            scNumberOfPaymentsPerYearIsBlinked: false,
            scNumberOfPaymentsPerYearIsFocused: false,
            scNumberOfPaymentsPerYearValue: '',

            scNumberOfYearsIsUnknown: false,
            scNumberOfYearsIsBlinked: false,
            scNumberOfYearsIsFocused: false,
            scNumberOfYearsValue: '',

            scInterestRatePerYearIsUnknown: false,
            scInterestRatePerYearIsBlinked: false,
            scInterestRatePerYearIsFocused: false,
            scInterestRatePerYearValue: '7',

            scFinalAmountIsUnknown: false,
            scFinalAmountIsBlinked: false,
            scFinalAmountIsFocused: false,
            scFinalAmountValue: '',

            scNumberOfYearsUntilFistPaymentIsBlinked: false,
            scNumberOfYearsUntilFistPaymentIsFocused: false,
            scNumberOfYearsUntilFistPaymentValue: '',

            scInflationIsBlinked: false,
            scInflationIsFocused: false,
            scInflationValue: '2',

            scLastRequestCash: {
                isEmpty: true,
                initialAmount: '',
                paymentAmount: '',
                numberOfPaymentsPerYear: '',
                numberOfYears: '',
                interestRatePerYear: '',
                finalAmount: '',
                numberOfYearsUntilFistPayment: '',
                inflation: '',
                balances_by_period: []
            },

            scIsErrorResult: false,
            scErrors: []
        }
    },
    computed: {
        icInitialAmountIsRequired() {
            if (this.icInitialAmountIsUnknown) {
                return false;
            }

            return 'required';
        },
        icRegularPaymentIsRequired() {
            if (this.icRegularPaymentIsUnknown) {
                return false;
            }

            return 'required';
        },
        icNumberOfYearsIsRequired() {
            if (this.icNumberOfYearsIsUnknown) {
                return false;
            }

            return 'required';
        },
        icInterestRatePerYearIsRequired() {
            if (this.icInterestRatePerYearIsUnknown) {
                return false;
            }

            return 'required';
        },
        icFinalAmountIsRequired() {
            if (this.icFinalAmountIsUnknown) {
                return false;
            }

            return 'required';
        },
        scInitialAmountIsRequired() {
            if (this.scInitialAmountIsUnknown) {
                return false;
            }

            return 'required';
        },
        scPaymentAmountIsRequired() {
            if (this.scPaymentAmountIsUnknown) {
                return false;
            }

            return 'required';
        },
        scNumberOfYearsIsRequired() {
            if (this.scNumberOfYearsIsUnknown) {
                return false;
            }

            return 'required';
        },
        scInterestRatePerYearIsRequired() {
            if (this.scInterestRatePerYearIsUnknown) {
                return false;
            }

            return 'required';
        },
        scFinalAmountIsRequired() {
            if (this.scFinalAmountIsUnknown) {
                return false;
            }

            return 'required';
        }
    },
    methods: {
        scrollToHeader() {
            if (window.isMobile) {
                let top = document.getElementsByTagName('h1')[0].offsetTop;

                window.scroll(
                    {
                        top: top,
                        left: 0,
                        behavior: 'smooth'
                    }
                );
            }
        },
        activeIncomeCalculator() {
            this.chartIsActive = false;
            this.scIsActive = false;
            this.icIsActive = true;

            this.scrollToHeader();
        },
        activeSpendCalculator() {
            this.chartIsActive = false;
            this.icIsActive = false;
            this.scIsActive = true;

            this.scrollToHeader();
        },
        activeChart() {
            this.icIsActive = false;
            this.scIsActive = false;
            this.chartIsActive = true;

            this.scrollToHeader();
        },
        changeIcInitialAmountUnknowing() {
            if (this.icInitialAmountIsUnknown) {
                this.icInitialAmountIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
                this.setIcInitialAmountValue('');

                this.icInitialAmountIsUnknown = true;

                this.icRegularPaymentIsUnknown = false;
                this.icNumberOfYearsIsUnknown = false;
                this.icInterestRatePerYearIsUnknown = false;
                this.icFinalAmountIsUnknown = false;

                this.icCalculationIsDisabled = false;
            }
        },
        changeIcRegularPaymentUnknowing() {
            if (this.icRegularPaymentIsUnknown) {
                this.icRegularPaymentIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
                this.setIcRegularPaymentValue('');

                this.icRegularPaymentIsUnknown = true;

                this.icInitialAmountIsUnknown = false;
                this.icNumberOfYearsIsUnknown = false;
                this.icInterestRatePerYearIsUnknown = false;
                this.icFinalAmountIsUnknown = false;

                this.icCalculationIsDisabled = false;
            }
        },
        changeIcNumberOfYearsUnknowing() {
            if (this.icNumberOfYearsIsUnknown) {
                this.icNumberOfYearsIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
                this.setIcNumberOfYearsValue('');

                this.icNumberOfYearsIsUnknown = true;

                this.icInitialAmountIsUnknown = false;
                this.icRegularPaymentIsUnknown = false;
                this.icInterestRatePerYearIsUnknown = false;
                this.icFinalAmountIsUnknown = false;

                this.icCalculationIsDisabled = false;
            }
        },
        changeIcInterestRatePerYearUnknowing() {
            if (this.icInterestRatePerYearIsUnknown) {
                this.icInterestRatePerYearIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
                this.setIcInterestRatePerYearValue('');

                this.icInterestRatePerYearIsUnknown = true;

                this.icInitialAmountIsUnknown = false;
                this.icRegularPaymentIsUnknown = false;
                this.icNumberOfYearsIsUnknown = false;
                this.icFinalAmountIsUnknown = false;

                this.icCalculationIsDisabled = false;
            }
        },
        changeIcFinalAmountUnknowing() {
            if (this.icFinalAmountIsUnknown) {
                this.icFinalAmountIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
                this.setIcFinalAmountValue('');

                this.icFinalAmountIsUnknown = true;

                this.icInitialAmountIsUnknown = false;
                this.icRegularPaymentIsUnknown = false;
                this.icNumberOfYearsIsUnknown = false;
                this.icInterestRatePerYearIsUnknown = false;

                this.icCalculationIsDisabled = false;
            }
        },
        changeScInitialAmountUnknowing() {
            if (this.scInitialAmountIsUnknown) {
                this.scInitialAmountIsUnknown = false;

                this.scCalculationIsDisabled = true;
            } else {
                this.setScInitialAmountValue('');

                this.scInitialAmountIsUnknown = true;

                this.scPaymentAmountIsUnknown = false;
                this.scNumberOfYearsIsUnknown = false;
                this.scInterestRatePerYearIsUnknown = false;
                this.scFinalAmountIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        changeScPaymentAmountUnknowing() {
            if (this.scPaymentAmountIsUnknown) {
                this.scPaymentAmountIsUnknown = false;

                this.scCalculationIsDisabled = true;
            } else {
                this.setScPaymentAmountValue('');

                this.scPaymentAmountIsUnknown = true;

                this.scInitialAmountIsUnknown = false;
                this.scNumberOfYearsIsUnknown = false;
                this.scInterestRatePerYearIsUnknown = false;
                this.scFinalAmountIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        changeScNumberOfYearsUnknowing() {
            if (this.scNumberOfYearsIsUnknown) {
                this.scNumberOfYearsIsUnknown = false;

                this.scCalculationIsDisabled = true;
            } else {
                this.setScNumberOfYearsValue('');

                this.scNumberOfYearsIsUnknown = true;

                this.scInitialAmountIsUnknown = false;
                this.scPaymentAmountIsUnknown = false;
                this.scInterestRatePerYearIsUnknown = false;
                this.scFinalAmountIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        changeScInterestRatePerYearUnknowing() {
            if (this.scInterestRatePerYearIsUnknown) {
                this.scInterestRatePerYearIsUnknown = false;

                this.scCalculationIsDisabled = true;
            } else {
                this.setScInterestRatePerYearValue('');

                this.scInterestRatePerYearIsUnknown = true;

                this.scInitialAmountIsUnknown = false;
                this.scPaymentAmountIsUnknown = false;
                this.scNumberOfYearsIsUnknown = false;
                this.scFinalAmountIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        changeScFinalAmountUnknowing() {
            if (this.scFinalAmountIsUnknown) {
                this.scFinalAmountIsUnknown = false;

                this.scCalculationIsDisabled = true;
            } else {
                this.setScFinalAmountValue('');

                this.scFinalAmountIsUnknown = true;

                this.scInitialAmountIsUnknown = false;
                this.scPaymentAmountIsUnknown = false;
                this.scNumberOfYearsIsUnknown = false;
                this.scInterestRatePerYearIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        setIcInitialAmountValue(value) {
            this.icInitialAmountValue = value;
        },
        setIcRegularPaymentValue(regularPayment) {
            this.icRegularPaymentValue = regularPayment;

            let numberPerYear = this.icNumberOfRegularPaymentsPerYearValue;

            if (numberPerYear !== '') {
                numberPerYear = parseFloat(numberPerYear);
            }

            if (regularPayment === '' || parseFloat(regularPayment) > 0.0) {
                if (numberPerYear === '' || numberPerYear === 0.0) {
                    this.updateIcNumberOfRegularPaymentsPerYearValue(12);
                }
            }

            if (parseFloat(regularPayment) === 0.0) {
                if (numberPerYear === '' || numberPerYear !== 0.0) {
                    this.updateIcNumberOfRegularPaymentsPerYearValue(0);
                }
            }
        },
        setIcNumberOfRegularPaymentsPerYearValue(numberPerYear) {
            this.icNumberOfRegularPaymentsPerYearValue = numberPerYear;

            let regularPayment = this.icRegularPaymentValue;

            if (regularPayment !== '') {
                regularPayment = parseFloat(regularPayment);
            }

            if (numberPerYear === '') {
                return void 0;
            }

            if (this.icRegularPaymentIsUnknown) {
                return void 0;
            }

            if (parseFloat(numberPerYear) > 0.0) {
                if (regularPayment === 0.0) {
                    this.updateIcRegularPaymentValue('');
                }
            }

            if (parseFloat(numberPerYear) === 0.0) {
                if (regularPayment === '' || regularPayment !== 0.0) {
                    this.updateIcRegularPaymentValue(0);
                }
            }
        },
        setIcNumberOfYearsValue(value) {
            this.icNumberOfYearsValue = value;
        },
        setIcInterestRatePerYearValue(value) {
            this.icInterestRatePerYearValue = value;
        },
        setIcFinalAmountValue(value) {
            this.icFinalAmountValue = value;
        },
        setScInitialAmountValue(value) {
            this.scInitialAmountValue = value;
        },
        setScPaymentAmountValue(value) {
            this.scPaymentAmountValue = value;
        },
        setScNumberOfPaymentsPerYearValue(value) {
            this.scNumberOfPaymentsPerYearValue = value;
        },
        setScNumberOfYearsValue(value) {
            this.scNumberOfYearsValue = value;
        },
        setScInterestRatePerYearValue(value) {
            this.scInterestRatePerYearValue = value;
        },
        setScFinalAmountValue(value) {
            this.scFinalAmountValue = value;
        },
        setScNumberOfYearsUntilFistPaymentValue(value) {
            this.scNumberOfYearsUntilFistPaymentValue = value;
        },
        setScInflationValue(value) {
            this.scInflationValue = value;
        },
        updateIcInitialAmountValue(value) {
            const app = this;

            value = value.toString();

            if (app.icInitialAmountValue === value) {
                return void 0;
            }

            app.icInitialAmountValue = value;
            app.icInitialAmountIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icInitialAmountIsBlinked = false;
                },
                1100
            );
        },
        updateIcRegularPaymentValue(value) {
            const app = this;

            value = value.toString();

            if (app.icRegularPaymentValue === value) {
                return void 0;
            }

            app.icRegularPaymentValue = value;
            app.icRegularPaymentIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icRegularPaymentIsBlinked = false;
                },
                1100
            );
        },
        updateIcNumberOfRegularPaymentsPerYearValue(value) {
            const app = this;

            value = value.toString();

            if (app.icNumberOfRegularPaymentsPerYearValue === value) {
                return void 0;
            }

            app.icNumberOfRegularPaymentsPerYearValue = value;
            app.icNumberOfRegularPaymentsPerYearIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icNumberOfRegularPaymentsPerYearIsBlinked = false;
                },
                1100
            );
        },
        updateIcNumberOfYearsValue(value) {
            const app = this;

            value = value.toString();

            if (app.icNumberOfYearsValue === value) {
                return void 0;
            }

            app.icNumberOfYearsValue = value;
            app.icNumberOfYearsIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icNumberOfYearsIsBlinked = false;
                },
                1100
            );
        },
        updateIcInterestRatePerYearValue(value) {
            const app = this;

            value = value.toString();

            if (app.icInterestRatePerYearValue === value) {
                return void 0;
            }

            app.icInterestRatePerYearValue = value;
            app.icInterestRatePerYearIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icInterestRatePerYearIsBlinked = false;
                },
                1100
            );
        },
        updateIcFinalAmountValue(value) {
            const app = this;

            value = value.toString();

            if (app.icFinalAmountValue === value) {
                return void 0;
            }

            app.icFinalAmountValue = value;
            app.icFinalAmountIsBlinked = true;

            window.setTimeout(
                function () {
                    app.icFinalAmountIsBlinked = false;
                },
                1100
            );
        },
        updateScInitialAmountValue(value) {
            const app = this;

            value = value.toString();

            if (app.scInitialAmountValue === value) {
                return void 0;
            }

            app.scInitialAmountValue = value;
            app.scInitialAmountIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scInitialAmountIsBlinked = false;
                },
                1100
            );
        },
        updateScPaymentAmountValue(value) {
            const app = this;

            value = value.toString();

            if (app.scPaymentAmountValue === value) {
                return void 0;
            }

            app.scPaymentAmountValue = value;
            app.scPaymentAmountIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scPaymentAmountIsBlinked = false;
                },
                1100
            );
        },
        updateScNumberOfPaymentsPerYearValue(value) {
            const app = this;

            value = value.toString();

            if (app.scNumberOfPaymentsPerYearValue === value) {
                return void 0;
            }

            app.scNumberOfPaymentsPerYearValue = value;
            app.scNumberOfPaymentsPerYearIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scNumberOfPaymentsPerYearIsBlinked = false;
                },
                1100
            );
        },
        updateScNumberOfYearsValue(value) {
            const app = this;

            value = value.toString();

            if (app.scNumberOfYearsValue === value) {
                return void 0;
            }

            app.scNumberOfYearsValue = value;
            app.scNumberOfYearsIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scNumberOfYearsIsBlinked = false;
                },
                1100
            );
        },
        updateScInterestRatePerYearValue(value) {
            const app = this;

            value = value.toString();

            if (app.scInterestRatePerYearValue === value) {
                return void 0;
            }

            app.scInterestRatePerYearValue = value;
            app.scInterestRatePerYearIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scInterestRatePerYearIsBlinked = false;
                },
                1100
            );
        },
        updateScFinalAmountValue(value) {
            const app = this;

            value = value.toString();

            if (app.scFinalAmountValue === value) {
                return void 0;
            }

            app.scFinalAmountValue = value;
            app.scFinalAmountIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scFinalAmountIsBlinked = false;
                },
                1100
            );
        },
        updateScNumberOfYearsUntilFistPaymentValue(value) {
            const app = this;

            value = value.toString();

            if (app.scNumberOfYearsUntilFistPaymentValue === value) {
                return void 0;
            }

            app.scNumberOfYearsUntilFistPaymentValue = value;
            app.scNumberOfYearsUntilFistPaymentIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scNumberOfYearsUntilFistPaymentIsBlinked = false;
                },
                1100
            );
        },
        updateScInflationValue(value) {
            const app = this;

            value = value.toString();

            if (app.scInflationValue === value) {
                return void 0;
            }

            app.scInflationValue = value;
            app.scInflationIsBlinked = true;

            window.setTimeout(
                function () {
                    app.scInflationIsBlinked = false;
                },
                1100
            );
        },
        doIncomeSubmit($event) {
            if (this.icCalculationIsDisabled) {
                $event.preventDefault();
            }
        },
        doIncomeCalc() {
            const app = this;

            if (this.icReqWasHandledByCache()) {
                return void 0;
            }

            axios.get('/api/income-calculator', {
                params: {
                    initial_amount: app.icInitialAmountValue,
                    regular_payment: app.icRegularPaymentValue,
                    number_of_regular_payments_per_year: app.icNumberOfRegularPaymentsPerYearValue,
                    number_of_years: app.icNumberOfYearsValue,
                    interest_rate_per_year: app.icInterestRatePerYearValue,
                    final_amount: app.icFinalAmountValue,
                    initial_amount_is_unknown: app.icInitialAmountIsUnknown ? 1 : 0,
                    regular_payment_is_unknown: app.icRegularPaymentIsUnknown ? 1 : 0,
                    number_of_years_is_unknown: app.icNumberOfYearsIsUnknown ? 1 : 0,
                    interest_rate_per_year_is_unknown: app.icInterestRatePerYearIsUnknown ? 1 : 0,
                    final_amount_is_unknown: app.icFinalAmountIsUnknown ? 1 : 0,
                }
            })
            .then(function (res) {
                app.updateIcInitialAmountValue(res.data.initial_amount);
                app.updateIcRegularPaymentValue(res.data.regular_payment);
                app.updateIcNumberOfRegularPaymentsPerYearValue(res.data.number_of_regular_payments_per_year);
                app.updateIcNumberOfYearsValue(res.data.number_of_years);
                app.updateIcInterestRatePerYearValue(res.data.interest_rate_per_year);
                app.updateIcFinalAmountValue(res.data.final_amount);

                app.icLastRequestCash.isEmpty = false;
                app.icLastRequestCash.initialAmount = res.data.initial_amount.toString();
                app.icLastRequestCash.regularPayment = res.data.regular_payment.toString();
                app.icLastRequestCash.numberOfRegularPaymentsPerYear =
                    res.data.number_of_regular_payments_per_year.toString();
                app.icLastRequestCash.numberOfYears = res.data.number_of_years.toString();
                app.icLastRequestCash.interestRatePerYear = res.data.interest_rate_per_year.toString();
                app.icLastRequestCash.finalAmount = res.data.final_amount.toString();
                app.icLastRequestCash.yearly_balances = res.data.yearly_balances;

                // app.icYearlyBalances.splice(0);
                // app.icYearlyBalances.push(...res.data.yearly_balances);

                app.icIsErrorResult = false;

                app.icErrors.splice(0);

                app.icCopyIsEnabled = true;

                if (!window.isMobile) {
                    return void 0;
                }

                let top = 0;

                if (app.icInitialAmountIsUnknown) {
                    top = document.getElementById('ic-initial-amount').offsetTop;
                } else if (app.icRegularPaymentIsUnknown) {
                    top = document.getElementById('ic-regular-payment').offsetTop;
                } else if (app.icNumberOfYearsIsUnknown) {
                    top = document.getElementById('ic-number-of-years').offsetTop;
                } else if (app.icInterestRatePerYearIsUnknown) {
                    top = document.getElementById('ic-interest-rate-per-year').offsetTop;
                } else if (app.icFinalAmountIsUnknown) {
                    top = document.getElementById('ic-final-amount').offsetTop;
                }

                window.scroll(
                    {
                        top: top - 50,
                        left: 0,
                        behavior: 'smooth'
                    }
                );
            })
            .catch(function (error) {
                app.icLastRequestCash.isEmpty = true;
                app.icLastRequestCash.initialAmount = '';
                app.icLastRequestCash.regularPayment = '';
                app.icLastRequestCash.numberOfRegularPaymentsPerYear = '';
                app.icLastRequestCash.numberOfYears = '';
                app.icLastRequestCash.interestRatePerYear = '';
                app.icLastRequestCash.finalAmount = '';
                app.icLastRequestCash.yearly_balances = [];

                app.icCopyIsEnabled = false;

                app.icErrors.splice(0);
                app.icErrors.push(...error.response.data.errors);

                app.icIsErrorResult = true;
            })
            .finally(function () {
                app.updateChart();
            });
        },
        copyScToIc() {
            this.icLastRequestCash.isEmpty = true;
            this.icLastRequestCash.initialAmount = '';
            this.icLastRequestCash.regularPayment = '';
            this.icLastRequestCash.numberOfRegularPaymentsPerYear = '';
            this.icLastRequestCash.numberOfYears = '';
            this.icLastRequestCash.interestRatePerYear = '';
            this.icLastRequestCash.finalAmount = '';
            this.icLastRequestCash.yearly_balances = [];

            this.icCopyIsEnabled = false;

            this.icIsErrorResult = false;

            this.icInitialAmountIsUnknown = false;
            this.icRegularPaymentIsUnknown = false;
            this.icNumberOfYearsIsUnknown = false;
            this.icInterestRatePerYearIsUnknown = false;
            this.icFinalAmountIsUnknown = false;

            this.icInitialAmountValue = '';
            this.icRegularPaymentValue = '';

            this.updateIcNumberOfYearsValue(this.scNumberOfYearsUntilFistPaymentValue);
            this.updateIcNumberOfRegularPaymentsPerYearValue(this.scNumberOfPaymentsPerYearValue);
            this.updateIcInterestRatePerYearValue('10');
            this.updateIcFinalAmountValue(this.scInitialAmountValue);

            this.activeIncomeCalculator();

            this.updateChart();
        },
        icReqWasHandledByCache() {
            let cache = this.icLastRequestCash;

            if (
                !this.icInitialAmountIsUnknown &&
                this.icInitialAmountValue !== cache.initialAmount
            ) {
                return false;
            }

            if (
                !this.icRegularPaymentIsUnknown &&
                this.icRegularPaymentValue !== cache.regularPayment
            ) {
                return false;
            }

            if (this.icNumberOfRegularPaymentsPerYearValue !== cache.numberOfRegularPaymentsPerYear) {
                return false;
            }

            if (
                !this.icNumberOfYearsIsUnknown &&
                this.icNumberOfYearsValue !== cache.numberOfYears
            ) {
                return false;
            }

            if (
                !this.icInterestRatePerYearIsUnknown &&
                this.icInterestRatePerYearValue !== cache.interestRatePerYear
            ) {
                return false;
            }

            if (
                !this.icFinalAmountIsUnknown &&
                this.icFinalAmountValue !== cache.finalAmount
            ) {
                return false;
            }

            this.updateIcInitialAmountValue(cache.initialAmount);
            this.updateIcRegularPaymentValue(cache.regularPayment);
            this.updateIcNumberOfRegularPaymentsPerYearValue(cache.numberOfRegularPaymentsPerYear);
            this.updateIcNumberOfYearsValue(cache.numberOfYears);
            this.updateIcInterestRatePerYearValue(cache.interestRatePerYear);
            this.updateIcFinalAmountValue(cache.finalAmount);

            return true;
        },
        doSpendSubmit($event) {
            if (this.scCalculationIsDisabled) {
                $event.preventDefault();
            }
        },
        doSpendCalc() {
            const app = this;

            if (this.scReqWasHandledByCache()) {
                return void 0;
            }

            axios.get('/api/spend-calculator', {
                params: {
                    initial_amount: app.scInitialAmountValue,
                    payment_amount: app.scPaymentAmountValue,
                    number_of_payments_per_year: app.scNumberOfPaymentsPerYearValue,
                    number_of_years: app.scNumberOfYearsValue,
                    interest_rate_per_year: app.scInterestRatePerYearValue,
                    final_amount: app.scFinalAmountValue,
                    number_of_years_until_fist_payment: app.scNumberOfYearsUntilFistPaymentValue,
                    inflation: app.scInflationValue,
                    initial_amount_is_unknown: app.scInitialAmountIsUnknown ? 1 : 0,
                    payment_amount_is_unknown: app.scPaymentAmountIsUnknown ? 1 : 0,
                    number_of_years_is_unknown: app.scNumberOfYearsIsUnknown ? 1 : 0,
                    interest_rate_per_year_is_unknown: app.scInterestRatePerYearIsUnknown ? 1 : 0,
                    final_amount_is_unknown: app.scFinalAmountIsUnknown ? 1 : 0,
                }
            })
            .then(function (res) {
                app.updateScInitialAmountValue(res.data.initial_amount);
                app.updateScPaymentAmountValue(res.data.payment_amount);
                app.updateScNumberOfPaymentsPerYearValue(res.data.number_of_payments_per_year);
                app.updateScNumberOfYearsValue(res.data.number_of_years);
                app.updateScInterestRatePerYearValue(res.data.interest_rate_per_year);
                app.updateScFinalAmountValue(res.data.final_amount);
                app.updateScNumberOfYearsUntilFistPaymentValue(res.data.number_of_years_until_fist_payment);
                app.updateScInflationValue(res.data.inflation);

                app.scLastRequestCash.isEmpty = false;
                app.scLastRequestCash.initialAmount = res.data.initial_amount.toString();
                app.scLastRequestCash.paymentAmount = res.data.payment_amount.toString();
                app.scLastRequestCash.numberOfPaymentsPerYear = res.data.number_of_payments_per_year.toString();
                app.scLastRequestCash.numberOfYears = res.data.number_of_years.toString();
                app.scLastRequestCash.interestRatePerYear = res.data.interest_rate_per_year.toString();
                app.scLastRequestCash.finalAmount = res.data.final_amount.toString();
                app.scLastRequestCash.numberOfYearsUntilFistPayment =
                    res.data.number_of_years_until_fist_payment.toString();
                app.scLastRequestCash.inflation = res.data.inflation.toString();
                app.scLastRequestCash.balances_by_period = res.data.balances_by_period;

                // app.scBalancesByPeriod.splice(0);
                // app.scBalancesByPeriod.push(...res.data.balances_by_period);

                app.scIsErrorResult = false;

                app.scErrors.splice(0);

                app.scCopyIsEnabled = true;

                if (!window.isMobile) {
                    return void 0;
                }

                let top = 0;

                if (app.scInitialAmountIsUnknown) {
                    top = document.getElementById('sc-initial-amount').offsetTop;
                } else if (app.scPaymentAmountIsUnknown) {
                    top = document.getElementById('sc-payment-amount').offsetTop;
                } else if (app.scNumberOfYearsIsUnknown) {
                    top = document.getElementById('sc-number-of-years').offsetTop;
                } else if (app.scInterestRatePerYearIsUnknown) {
                    top = document.getElementById('sc-interest-rate-per-year').offsetTop;
                } else if (app.icFinalAmountIsUnknown) {
                    top = document.getElementById('sc-final-amount').offsetTop;
                }

                window.scroll(
                    {
                        top: top - 50,
                        left: 0,
                        behavior: 'smooth'
                    }
                );
            })
            .catch(function (error) {
                app.scLastRequestCash.isEmpty = true;
                app.scLastRequestCash.initialAmount = '';
                app.scLastRequestCash.paymentAmount = '';
                app.scLastRequestCash.numberOfPaymentsPerYear = '';
                app.scLastRequestCash.numberOfYears = '';
                app.scLastRequestCash.interestRatePerYear = '';
                app.scLastRequestCash.finalAmount = '';
                app.scLastRequestCash.numberOfYearsUntilFistPayment = '';
                app.scLastRequestCash.inflation = '';
                app.scLastRequestCash.balances_by_period = [];

                app.scCopyIsEnabled = false;

                app.scErrors.splice(0);
                app.scErrors.push(...error.response.data.errors);

                app.scIsErrorResult = true;
            })
            .finally(function () {
                app.updateChart();
            });
        },
        copyIcToSc() {
            this.scLastRequestCash.isEmpty = true;
            this.scLastRequestCash.initialAmount = '';
            this.scLastRequestCash.paymentAmount = '';
            this.scLastRequestCash.numberOfPaymentsPerYear = '';
            this.scLastRequestCash.numberOfYears = '';
            this.scLastRequestCash.interestRatePerYear = '';
            this.scLastRequestCash.finalAmount = '';
            this.scLastRequestCash.numberOfYearsUntilFistPayment = '';
            this.scLastRequestCash.inflation = '';
            this.scLastRequestCash.balances_by_period = [];

            this.scCopyIsEnabled = false;

            this.scIsErrorResult = false;

            this.scInitialAmountIsUnknown = false;
            this.scPaymentAmountIsUnknown = false;
            this.scNumberOfYearsIsUnknown = false;
            this.scInterestRatePerYearIsUnknown = false;
            this.scFinalAmountIsUnknown = false;

            this.scPaymentAmountValue = '';
            this.scNumberOfYearsValue = '';
            this.scFinalAmountValue = '';

            this.updateScInitialAmountValue(this.icFinalAmountValue);
            this.updateScNumberOfPaymentsPerYearValue(this.icNumberOfRegularPaymentsPerYearValue);
            this.updateScInterestRatePerYearValue('5');
            this.updateScInflationValue('2');
            this.updateScNumberOfYearsUntilFistPaymentValue(this.icNumberOfYearsValue);

            this.activeSpendCalculator();

            this.updateChart();
        },
        scReqWasHandledByCache() {
            let cache = this.scLastRequestCash;

            if (
                !this.scInitialAmountIsUnknown &&
                this.scInitialAmountValue !== cache.initialAmount
            ) {
                return false;
            }

            if (
                !this.scPaymentAmountIsUnknown &&
                this.scPaymentAmountValue !== cache.paymentAmount
            ) {
                return false;
            }

            if (this.scNumberOfPaymentsPerYearValue !== cache.numberOfPaymentsPerYear) {
                return false;
            }

            if (
                !this.scNumberOfYearsIsUnknown &&
                this.scNumberOfYearsValue !== cache.numberOfYears
            ) {
                return false;
            }

            if (
                !this.scInterestRatePerYearIsUnknown &&
                this.scInterestRatePerYearValue !== cache.interestRatePerYear
            ) {
                return false;
            }

            if (
                !this.scFinalAmountIsUnknown &&
                this.scFinalAmountValue !== cache.finalAmount
            ) {
                return false;
            }

            if (this.scNumberOfYearsUntilFistPaymentValue !== cache.numberOfYearsUntilFistPayment) {
                return false;
            }

            if (this.scInflationValue !== cache.inflation) {
                return false;
            }

            this.updateScInitialAmountValue(cache.initialAmount);
            this.updateScPaymentAmountValue(cache.paymentAmount);
            this.updateScNumberOfPaymentsPerYearValue(cache.numberOfPaymentsPerYear);
            this.updateScNumberOfYearsValue(cache.numberOfYears);
            this.updateScInterestRatePerYearValue(cache.interestRatePerYear);
            this.updateScFinalAmountValue(cache.finalAmount);
            this.updateScNumberOfYearsUntilFistPaymentValue(cache.numberOfYearsUntilFistPayment);
            this.updateScInflationValue(cache.inflation);

            return true;
        },
        updateChart() {
            let icData = [];

            if (!this.icLastRequestCash.isEmpty) {
                if (this.icLastRequestCash.yearly_balances.length !== 0) {
                    this.icLastRequestCash.yearly_balances.forEach(
                        function (balance) {
                            icData.push([balance.index_of_year, balance.amount]);
                        }
                    );
                }
            }


            let scData = [];

            if (!this.scLastRequestCash.isEmpty) {
                let firstYear = 0;

                if (parseInt(this.scLastRequestCash.numberOfYearsUntilFistPayment) !== 0) {
                    firstYear = parseInt(this.scLastRequestCash.numberOfYearsUntilFistPayment);
                }

                let numberOfPaymentsPerYear = parseInt(this.scLastRequestCash.numberOfPaymentsPerYear);

                if (this.scLastRequestCash.balances_by_period.length !== 0) {
                    let numberOfPayment = 1;

                    this.scLastRequestCash.balances_by_period.forEach(
                        function (balance) {
                            if (numberOfPaymentsPerYear === 1) {
                                scData.push([firstYear, balance.amount]);

                                firstYear++;
                            } else {
                                if (numberOfPayment === numberOfPaymentsPerYear) {
                                    numberOfPayment = 1;

                                    return void 0;
                                }

                                if (numberOfPayment === 1) {
                                    scData.push([firstYear, balance.amount]);

                                    firstYear++;
                                }

                                numberOfPayment++;
                            }
                        }
                    );
                }
            }


            ApexCharts.exec(
                'mychart',
                'updateOptions',
                {
                    yaxis: {
                        labels: {
                            show: true
                        }
                    },
                    xaxis: {
                        labels: {
                            show: true
                        }
                    },
                    series: [
                        {
                            name: 'Использование',
                            data: scData
                        },
                        {
                            name: 'Накопление',
                            data: icData
                        }
                    ]
                },
                false,
                false,
                false
            );
        },
        changeCurrency($event) {
            this.currency = parseInt($event.target.value);

            this.fullClear();
        },
        fullClear() {
            this.icLastRequestCash.isEmpty = true;
            this.icLastRequestCash.initialAmount = '';
            this.icLastRequestCash.regularPayment = '';
            this.icLastRequestCash.numberOfRegularPaymentsPerYear = '';
            this.icLastRequestCash.numberOfYears = '';
            this.icLastRequestCash.interestRatePerYear = '';
            this.icLastRequestCash.finalAmount = '';
            this.icLastRequestCash.yearly_balances = [];

            this.icCopyIsEnabled = false;

            this.icIsErrorResult = false;

            this.icInitialAmountIsUnknown = false;
            this.icRegularPaymentIsUnknown = false;
            this.icNumberOfYearsIsUnknown = false;
            this.icInterestRatePerYearIsUnknown = false;
            this.icFinalAmountIsUnknown = false;

            this.icInitialAmountValue = '';
            this.icRegularPaymentValue = '';
            this.icNumberOfRegularPaymentsPerYearValue = '';
            this.icNumberOfYearsValue = '';
            this.icFinalAmountValue = '';

            this.scLastRequestCash.isEmpty = true;
            this.scLastRequestCash.initialAmount = '';
            this.scLastRequestCash.paymentAmount = '';
            this.scLastRequestCash.numberOfPaymentsPerYear = '';
            this.scLastRequestCash.numberOfYears = '';
            this.scLastRequestCash.interestRatePerYear = '';
            this.scLastRequestCash.finalAmount = '';
            this.scLastRequestCash.numberOfYearsUntilFistPayment = '';
            this.scLastRequestCash.inflation = '';
            this.scLastRequestCash.balances_by_period = [];

            this.scCopyIsEnabled = false;

            this.scIsErrorResult = false;

            this.scInitialAmountIsUnknown = false;
            this.scPaymentAmountIsUnknown = false;
            this.scNumberOfYearsIsUnknown = false;
            this.scInterestRatePerYearIsUnknown = false;
            this.scFinalAmountIsUnknown = false;

            this.scInitialAmountValue = '';
            this.scPaymentAmountValue = '';
            this.scNumberOfPaymentsPerYearValue = '';
            this.scNumberOfYearsValue = '';
            this.scNumberOfYearsUntilFistPaymentValue = '';
            this.scFinalAmountValue = '';

            switch (this.currency) {
                case 1:
                    this.updateIcInterestRatePerYearValue('12');
                    this.updateScInterestRatePerYearValue('7');
                    this.updateScInflationValue('2');
                    break;

                case 2:
                    this.updateIcInterestRatePerYearValue('8');
                    this.updateScInterestRatePerYearValue('4');
                    this.updateScInflationValue('1.5');
                    break;

                case 3:
                    this.updateIcInterestRatePerYearValue('20');
                    this.updateScInterestRatePerYearValue('12');
                    this.updateScInflationValue('5');
                    break;
            }

            this.updateChart();
        }
    }
};

Vue.createApp(Calculator).mount('main');

const chart = new ApexCharts(
    document.querySelector('#chart-item'),
    {
        chart: {
            id: 'mychart',
            type: 'line',
            toolbar: {
                show: false
            },
            animations: {
                enabled: false
            },
            zoom: {
                enabled: false
            }
        },
        yaxis: {
            title: {
                text: 'Размер капитала'
            },
            labels: {
                show: false
            }
        },
        xaxis: {
            title: {
                text: 'Годы'
            },
            type: 'numeric',
            labels: {
                show: false
            }
        },
        series: [
            {
                name: 'Использование',
                data: []
            },
            {
                name: 'Накопление',
                data: []
            }
        ],
        colors: ['#de0b0b', '#10a114'],
        dataLabels: {
            enabled: true,
            textAnchor: 'end'
        },
        stroke: {
            curve: 'straight'
        },
        markers: {
            size: 3,
            hover: {
                sizeOffset: 0
            }
        },
        legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'right'
        }
    }
);

chart.render();

window.onbeforeprint = function() {
    ApexCharts.exec(
        'mychart',
        'updateOptions',
        {
            chart: {
                width: '600px'
            }
        },
        false,
        false,
        false
    );
};

window.onafterprint = function() {
    ApexCharts.exec(
        'mychart',
        'updateOptions',
        {
            chart: {
                width: '100%'
            }
        },
        false,
        false,
        false
    );
};

tippy(
    '[data-tippy-content]',
    {
        trigger: 'click',
        placement: 'top'
    }
);
