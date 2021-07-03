axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const Calculator = {
    compilerOptions: {
        delimiters: ['${', '}']
    },
    data() {
        return {
            icInitialAmountIsUnknown: false,
            icInitialAmountValue: 0,
            icInitialAmountResult: '',

            icRegularPaymentIsUnknown: false,
            icRegularPaymentValue: 200,
            icRegularPaymentResult: '',

            icNumberOfRegularPaymentsPerYearValue: 12,
            icNumberOfRegularPaymentsPerYearResult: '',

            icNumberOfYearsIsUnknown: false,
            icNumberOfYearsValue: 20,
            icNumberOfYearsResult: '',

            icInterestRatePerYearIsUnknown: false,
            icInterestRatePerYearValue: 12,
            icInterestRatePerYearResult: '',

            icFinalAmountIsUnknown: true,
            icFinalAmountValue: '',
            icFinalAmountResult: '',

            icYearlyBalances: [],

            icIsErrorResult: false,
            icIsSuccessResult: false,
            icErrors: [],

            scInitialAmountIsUnknown: true,
            scInitialAmountValue: '',
            scInitialAmountResult: '',

            scPaymentAmountIsUnknown: false,
            scPaymentAmountValue: 5000,
            scPaymentAmountResult: '',

            scNumberOfPaymentsPerYearValue: 12,
            scNumberOfPaymentsPerYearResult: '',

            scNumberOfYearsIsUnknown: false,
            scNumberOfYearsValue: 30,
            scNumberOfYearsResult: '',

            scInterestRatePerYearIsUnknown: false,
            scInterestRatePerYearValue: 4,
            scInterestRatePerYearResult: '',

            scFinalAmountIsUnknown: false,
            scFinalAmountValue: 0,
            scFinalAmountResult: '',

            scNumberOfYearsUntilFistPaymentValue: 0,
            scNumberOfYearsUntilFistPaymentResult: '',

            scInflationValue: 2,
            scInflationResult: '',

            scBalancesByPeriod: [],

            scIsErrorResult: false,
            scIsSuccessResult: false,
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
                app.icInitialAmountResult = response.data.initial_amount;
                app.icRegularPaymentResult = response.data.regular_payment;
                app.icNumberOfRegularPaymentsPerYearResult = response.data.number_of_regular_payments_per_year;
                app.icNumberOfYearsResult = response.data.number_of_years;
                app.icInterestRatePerYearResult = response.data.interest_rate_per_year;
                app.icFinalAmountResult = response.data.final_amount;

                app.icYearlyBalances.splice(0);
                app.icYearlyBalances.push(...response.data.yearly_balances);

                app.icIsErrorResult = false;
                app.icIsSuccessResult = true;

                app.icErrors.splice(0);
            })
            .catch(function (error) {
                if (typeof error.response !== 'object') {
                    console.error(error.request);

                    return void 0;
                }

                app.icErrors.splice(0);
                app.icErrors.push(...error.response.data.errors);

                app.icIsSuccessResult = false;
                app.icIsErrorResult = true;
            });
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
                app.scInitialAmountResult = response.data.initial_amount;
                app.scPaymentAmountResult = response.data.payment_amount;
                app.scNumberOfPaymentsPerYearResult = response.data.number_of_payments_per_year;
                app.scNumberOfYearsResult = response.data.number_of_years;
                app.scInterestRatePerYearResult = response.data.interest_rate_per_year;
                app.scFinalAmountResult = response.data.final_amount;
                app.scNumberOfYearsUntilFistPaymentResult = response.data.number_of_years_until_fist_payment;
                app.scInflationResult = response.data.inflation;

                app.scBalancesByPeriod.splice(0);
                app.scBalancesByPeriod.push(...response.data.balances_by_period);

                app.scIsErrorResult = false;
                app.scIsSuccessResult = true;

                app.scErrors.splice(0);
            })
            .catch(function (error) {
                if (typeof error.response !== 'object') {
                    console.error(error.request);

                    return void 0;
                }

                app.scErrors.splice(0);
                app.scErrors.push(...error.response.data.errors);

                app.scIsSuccessResult = false;
                app.scIsErrorResult = true;
            });
        }
    }
};

Vue.createApp(Calculator).mount('main');
