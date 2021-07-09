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
            icInterestRatePerYearValue: '',

            icFinalAmountIsUnknown: false,
            icFinalAmountIsBlinked: false,
            icFinalAmountIsFocused: false,
            icFinalAmountValue: '',

            icIsErrorResult: false,
            icErrors: [],

            scIsActive: false,
            scCalculationIsDisabled: true,

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
            scInterestRatePerYearValue: '',

            scFinalAmountIsUnknown: false,
            scFinalAmountIsBlinked: false,
            scFinalAmountIsFocused: false,
            scFinalAmountValue: '',

            scNumberOfYearsUntilFistPaymentIsBlinked: false,
            scNumberOfYearsUntilFistPaymentIsFocused: false,
            scNumberOfYearsUntilFistPaymentValue: '',

            scInflationIsBlinked: false,
            scInflationIsFocused: false,
            scInflationValue: '',

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
        setIcRegularPaymentValue(value) {
            this.icRegularPaymentValue = value;
        },
        setIcNumberOfRegularPaymentsPerYearValue(value) {
            this.icNumberOfRegularPaymentsPerYearValue = value;
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
                app.updateIcInitialAmountValue(response.data.initial_amount);
                app.updateIcRegularPaymentValue(response.data.regular_payment);
                app.updateIcNumberOfRegularPaymentsPerYearValue(response.data.number_of_regular_payments_per_year);
                app.updateIcNumberOfYearsValue(response.data.number_of_years);
                app.updateIcInterestRatePerYearValue(response.data.interest_rate_per_year);
                app.updateIcFinalAmountValue(response.data.final_amount);

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
                app.updateScInitialAmountValue(response.data.initial_amount);
                app.updateScPaymentAmountValue(response.data.payment_amount);
                app.updateScNumberOfPaymentsPerYearValue(response.data.number_of_payments_per_year);
                app.updateScNumberOfYearsValue(response.data.number_of_years);
                app.updateScInterestRatePerYearValue(response.data.interest_rate_per_year);
                app.updateScFinalAmountValue(response.data.final_amount);
                app.updateScNumberOfYearsUntilFistPaymentValue(response.data.number_of_years_until_fist_payment);
                app.updateScInflationValue(response.data.inflation);

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
