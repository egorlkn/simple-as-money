axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const Calculator = {
    compilerOptions: {
        delimiters: ['${', '}']
    },
    data() {
        return {
            icIsActive: true,
            icCalculationIsDisabled: true,

            icInitialAmountIsUnknown: false,
            icInitialAmountIsBlinked: false,
            icInitialAmountValue: '',

            icRegularPaymentIsUnknown: false,
            icRegularPaymentIsBlinked: false,
            icRegularPaymentValue: '',

            icNumberOfRegularPaymentsPerYearIsBlinked: false,
            icNumberOfRegularPaymentsPerYearValue: '',

            icNumberOfYearsIsUnknown: false,
            icNumberOfYearsIsBlinked: false,
            icNumberOfYearsValue: '',

            icInterestRatePerYearIsUnknown: false,
            icInterestRatePerYearIsBlinked: false,
            icInterestRatePerYearValue: '',

            icFinalAmountIsUnknown: false,
            icFinalAmountIsBlinked: false,
            icFinalAmountValue: '',

            icIsErrorResult: false,
            icErrors: [],

            scIsActive: false,
            scCalculationIsDisabled: true,

            scInitialAmountIsUnknown: false,
            scInitialAmountIsBlinked: false,
            scInitialAmountValue: '',

            scPaymentAmountIsUnknown: false,
            scPaymentAmountIsBlinked: false,
            scPaymentAmountValue: '',

            scNumberOfPaymentsPerYearIsBlinked: false,
            scNumberOfPaymentsPerYearValue: '',

            scNumberOfYearsIsUnknown: false,
            scNumberOfYearsIsBlinked: false,
            scNumberOfYearsValue: '',

            scInterestRatePerYearIsUnknown: false,
            scInterestRatePerYearIsBlinked: false,
            scInterestRatePerYearValue: '',

            scFinalAmountIsUnknown: false,
            scFinalAmountIsBlinked: false,
            scFinalAmountValue: '',

            scNumberOfYearsUntilFistPaymentIsBlinked: false,
            scNumberOfYearsUntilFistPaymentValue: '',

            scInflationIsBlinked: false,
            scInflationValue: '',

            scIsErrorResult: false,
            scErrors: []
        }
    },
    computed: {
        icInitialAmountIsRequired() {
            if (this.icInitialAmountIsUnknown) {
                this.icInitialAmountValue = '';

                return false;
            }

            return 'required';
        },
        icRegularPaymentIsRequired() {
            if (this.icRegularPaymentIsUnknown) {
                this.icRegularPaymentValue = '';

                return false;
            }

            return 'required';
        },
        icNumberOfYearsIsRequired() {
            if (this.icNumberOfYearsIsUnknown) {
                this.icNumberOfYearsValue = '';

                return false;
            }

            return 'required';
        },
        icInterestRatePerYearIsRequired() {
            if (this.icInterestRatePerYearIsUnknown) {
                this.icInterestRatePerYearValue = '';

                return false;
            }

            return 'required';
        },
        icFinalAmountIsRequired() {
            if (this.icFinalAmountIsUnknown) {
                this.icFinalAmountValue = '';

                return false;
            }

            return 'required';
        },
        scInitialAmountIsRequired() {
            if (this.scInitialAmountIsUnknown) {
                this.scInitialAmountValue = '';

                return false;
            }

            return 'required';
        },
        scPaymentAmountIsRequired() {
            if (this.scPaymentAmountIsUnknown) {
                this.scPaymentAmountValue = '';

                return false;
            }

            return 'required';
        },
        scNumberOfYearsIsRequired() {
            if (this.scNumberOfYearsIsUnknown) {
                this.scNumberOfYearsValue = '';

                return false;
            }

            return 'required';
        },
        scInterestRatePerYearIsRequired() {
            if (this.scInterestRatePerYearIsUnknown) {
                this.scInterestRatePerYearValue = '';

                return false;
            }

            return 'required';
        },
        scFinalAmountIsRequired() {
            if (this.scFinalAmountIsUnknown) {
                this.scFinalAmountValue = '';

                return false;
            }

            return 'required';
        }
    },
    methods: {
        activeIncomeCalculator() {
            this.scIsActive = false;
            this.icIsActive = true;
        },
        activeSpendCalculator() {
            this.icIsActive = false;
            this.scIsActive = true;
        },
        changeIcInitialAmountUnknowing() {
            if (this.icInitialAmountIsUnknown) {
                this.icInitialAmountIsUnknown = false;

                this.icCalculationIsDisabled = true;
            } else {
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
                this.scFinalAmountIsUnknown = true;

                this.scInitialAmountIsUnknown = false;
                this.scPaymentAmountIsUnknown = false;
                this.scNumberOfYearsIsUnknown = false;
                this.scInterestRatePerYearIsUnknown = false;

                this.scCalculationIsDisabled = false;
            }
        },
        setIcInitialAmountValue(value) {
            const app = this;

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
        setIcRegularPaymentValue(value) {
            const app = this;

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
        setIcNumberOfRegularPaymentsPerYearValue(value) {
            const app = this;

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
        setIcNumberOfYearsValue(value) {
            const app = this;

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
        setIcInterestRatePerYearValue(value) {
            const app = this;

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
        setIcFinalAmountValue(value) {
            const app = this;

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
        setScInitialAmountValue(value) {
            const app = this;

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
        setScPaymentAmountValue(value) {
            const app = this;

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
        setScNumberOfPaymentsPerYearValue(value) {
            const app = this;

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
        setScNumberOfYearsValue(value) {
            const app = this;

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
        setScInterestRatePerYearValue(value) {
            const app = this;

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
        setScFinalAmountValue(value) {
            const app = this;

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
        setScNumberOfYearsUntilFistPaymentValue(value) {
            const app = this;

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
        setScInflationValue(value) {
            const app = this;

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
            .then(function (response) {
                app.setIcInitialAmountValue(response.data.initial_amount);
                app.setIcRegularPaymentValue(response.data.regular_payment);
                app.setIcNumberOfRegularPaymentsPerYearValue(response.data.number_of_regular_payments_per_year);
                app.setIcNumberOfYearsValue(response.data.number_of_years);
                app.setIcInterestRatePerYearValue(response.data.interest_rate_per_year);
                app.setIcFinalAmountValue(response.data.final_amount);

                // app.icYearlyBalances.splice(0);
                // app.icYearlyBalances.push(...response.data.yearly_balances);

                app.icIsErrorResult = false;

                app.icErrors.splice(0);
            })
            .catch(function (error) {
                app.icErrors.splice(0);
                app.icErrors.push(...error.response.data.errors);

                app.icIsErrorResult = true;
            });
        },
        doSpendSubmit($event) {
            if (this.scCalculationIsDisabled) {
                $event.preventDefault();
            }
        },
        doSpendCalc() {
            const app = this;

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
            .then(function (response) {
                app.setScInitialAmountValue(response.data.initial_amount);
                app.setScPaymentAmountValue(response.data.payment_amount);
                app.setScNumberOfPaymentsPerYearValue(response.data.number_of_payments_per_year);
                app.setScNumberOfYearsValue(response.data.number_of_years);
                app.setScInterestRatePerYearValue(response.data.interest_rate_per_year);
                app.setScFinalAmountValue(response.data.final_amount);
                app.setScNumberOfYearsUntilFistPaymentValue(response.data.number_of_years_until_fist_payment);
                app.setScInflationValue(response.data.inflation);

                // app.scBalancesByPeriod.splice(0);
                // app.scBalancesByPeriod.push(...response.data.balances_by_period);

                app.scIsErrorResult = false;

                app.scErrors.splice(0);
            })
            .catch(function (error) {
                app.scErrors.splice(0);
                app.scErrors.push(...error.response.data.errors);

                app.scIsErrorResult = true;
            });
        }
    }
};

Vue.createApp(Calculator).mount('main');
