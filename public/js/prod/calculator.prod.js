"use strict";function _toConsumableArray(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",window.isMobile=screen.width<992,window.onresize=function(){window.isMobile=screen.width<992};var Calculator={compilerOptions:{delimiters:["${","}"]},data:function(){return{chartIsActive:!1,icIsActive:!0,icCalculationIsDisabled:!0,icCopyIsEnabled:!1,icInitialAmountIsUnknown:!1,icInitialAmountIsBlinked:!1,icInitialAmountIsFocused:!1,icInitialAmountValue:"",icRegularPaymentIsUnknown:!1,icRegularPaymentIsBlinked:!1,icRegularPaymentIsFocused:!1,icRegularPaymentValue:"",icNumberOfRegularPaymentsPerYearIsBlinked:!1,icNumberOfRegularPaymentsPerYearIsFocused:!1,icNumberOfRegularPaymentsPerYearValue:"",icNumberOfYearsIsUnknown:!1,icNumberOfYearsIsBlinked:!1,icNumberOfYearsIsFocused:!1,icNumberOfYearsValue:"",icInterestRatePerYearIsUnknown:!1,icInterestRatePerYearIsBlinked:!1,icInterestRatePerYearIsFocused:!1,icInterestRatePerYearValue:"10",icFinalAmountIsUnknown:!1,icFinalAmountIsBlinked:!1,icFinalAmountIsFocused:!1,icFinalAmountValue:"",icLastRequestCash:{isEmpty:!0,initialAmount:"",regularPayment:"",numberOfRegularPaymentsPerYear:"",numberOfYears:"",interestRatePerYear:"",finalAmount:"",yearly_balances:[]},icIsErrorResult:!1,icErrors:[],scIsActive:!1,scCalculationIsDisabled:!0,scCopyIsEnabled:!1,scInitialAmountIsUnknown:!1,scInitialAmountIsBlinked:!1,scInitialAmountIsFocused:!1,scInitialAmountValue:"",scPaymentAmountIsUnknown:!1,scPaymentAmountIsBlinked:!1,scPaymentAmountIsFocused:!1,scPaymentAmountValue:"",scNumberOfPaymentsPerYearIsBlinked:!1,scNumberOfPaymentsPerYearIsFocused:!1,scNumberOfPaymentsPerYearValue:"",scNumberOfYearsIsUnknown:!1,scNumberOfYearsIsBlinked:!1,scNumberOfYearsIsFocused:!1,scNumberOfYearsValue:"",scInterestRatePerYearIsUnknown:!1,scInterestRatePerYearIsBlinked:!1,scInterestRatePerYearIsFocused:!1,scInterestRatePerYearValue:"5",scFinalAmountIsUnknown:!1,scFinalAmountIsBlinked:!1,scFinalAmountIsFocused:!1,scFinalAmountValue:"",scNumberOfYearsUntilFistPaymentIsBlinked:!1,scNumberOfYearsUntilFistPaymentIsFocused:!1,scNumberOfYearsUntilFistPaymentValue:"",scInflationIsBlinked:!1,scInflationIsFocused:!1,scInflationValue:"2",scLastRequestCash:{isEmpty:!0,initialAmount:"",paymentAmount:"",numberOfPaymentsPerYear:"",numberOfYears:"",interestRatePerYear:"",finalAmount:"",numberOfYearsUntilFistPayment:"",inflation:"",balances_by_period:[]},scIsErrorResult:!1,scErrors:[]}},computed:{icInitialAmountIsRequired:function(){return!this.icInitialAmountIsUnknown&&"required"},icRegularPaymentIsRequired:function(){return!this.icRegularPaymentIsUnknown&&"required"},icNumberOfYearsIsRequired:function(){return!this.icNumberOfYearsIsUnknown&&"required"},icInterestRatePerYearIsRequired:function(){return!this.icInterestRatePerYearIsUnknown&&"required"},icFinalAmountIsRequired:function(){return!this.icFinalAmountIsUnknown&&"required"},scInitialAmountIsRequired:function(){return!this.scInitialAmountIsUnknown&&"required"},scPaymentAmountIsRequired:function(){return!this.scPaymentAmountIsUnknown&&"required"},scNumberOfYearsIsRequired:function(){return!this.scNumberOfYearsIsUnknown&&"required"},scInterestRatePerYearIsRequired:function(){return!this.scInterestRatePerYearIsUnknown&&"required"},scFinalAmountIsRequired:function(){return!this.scFinalAmountIsUnknown&&"required"}},methods:{scrollToHeader:function(){if(window.isMobile){var e=document.getElementsByTagName("h1")[0].offsetTop;window.scroll({top:e,left:0,behavior:"smooth"})}},activeIncomeCalculator:function(){this.chartIsActive=!1,this.scIsActive=!1,this.icIsActive=!0,this.scrollToHeader()},activeSpendCalculator:function(){this.chartIsActive=!1,this.icIsActive=!1,this.scIsActive=!0,this.scrollToHeader()},activeChart:function(){this.icIsActive=!1,this.scIsActive=!1,this.chartIsActive=!0,this.scrollToHeader()},changeIcInitialAmountUnknowing:function(){this.icInitialAmountIsUnknown?(this.icInitialAmountIsUnknown=!1,this.icCalculationIsDisabled=!0):(this.setIcInitialAmountValue(""),this.icInitialAmountIsUnknown=!0,this.icRegularPaymentIsUnknown=!1,this.icNumberOfYearsIsUnknown=!1,this.icInterestRatePerYearIsUnknown=!1,this.icFinalAmountIsUnknown=!1,this.icCalculationIsDisabled=!1)},changeIcRegularPaymentUnknowing:function(){this.icRegularPaymentIsUnknown?(this.icRegularPaymentIsUnknown=!1,this.icCalculationIsDisabled=!0):(this.setIcRegularPaymentValue(""),this.icRegularPaymentIsUnknown=!0,this.icInitialAmountIsUnknown=!1,this.icNumberOfYearsIsUnknown=!1,this.icInterestRatePerYearIsUnknown=!1,this.icFinalAmountIsUnknown=!1,this.icCalculationIsDisabled=!1)},changeIcNumberOfYearsUnknowing:function(){this.icNumberOfYearsIsUnknown?(this.icNumberOfYearsIsUnknown=!1,this.icCalculationIsDisabled=!0):(this.setIcNumberOfYearsValue(""),this.icNumberOfYearsIsUnknown=!0,this.icInitialAmountIsUnknown=!1,this.icRegularPaymentIsUnknown=!1,this.icInterestRatePerYearIsUnknown=!1,this.icFinalAmountIsUnknown=!1,this.icCalculationIsDisabled=!1)},changeIcInterestRatePerYearUnknowing:function(){this.icInterestRatePerYearIsUnknown?(this.icInterestRatePerYearIsUnknown=!1,this.icCalculationIsDisabled=!0):(this.setIcInterestRatePerYearValue(""),this.icInterestRatePerYearIsUnknown=!0,this.icInitialAmountIsUnknown=!1,this.icRegularPaymentIsUnknown=!1,this.icNumberOfYearsIsUnknown=!1,this.icFinalAmountIsUnknown=!1,this.icCalculationIsDisabled=!1)},changeIcFinalAmountUnknowing:function(){this.icFinalAmountIsUnknown?(this.icFinalAmountIsUnknown=!1,this.icCalculationIsDisabled=!0):(this.setIcFinalAmountValue(""),this.icFinalAmountIsUnknown=!0,this.icInitialAmountIsUnknown=!1,this.icRegularPaymentIsUnknown=!1,this.icNumberOfYearsIsUnknown=!1,this.icInterestRatePerYearIsUnknown=!1,this.icCalculationIsDisabled=!1)},changeScInitialAmountUnknowing:function(){this.scInitialAmountIsUnknown?(this.scInitialAmountIsUnknown=!1,this.scCalculationIsDisabled=!0):(this.setScInitialAmountValue(""),this.scInitialAmountIsUnknown=!0,this.scPaymentAmountIsUnknown=!1,this.scNumberOfYearsIsUnknown=!1,this.scInterestRatePerYearIsUnknown=!1,this.scFinalAmountIsUnknown=!1,this.scCalculationIsDisabled=!1)},changeScPaymentAmountUnknowing:function(){this.scPaymentAmountIsUnknown?(this.scPaymentAmountIsUnknown=!1,this.scCalculationIsDisabled=!0):(this.setScPaymentAmountValue(""),this.scPaymentAmountIsUnknown=!0,this.scInitialAmountIsUnknown=!1,this.scNumberOfYearsIsUnknown=!1,this.scInterestRatePerYearIsUnknown=!1,this.scFinalAmountIsUnknown=!1,this.scCalculationIsDisabled=!1)},changeScNumberOfYearsUnknowing:function(){this.scNumberOfYearsIsUnknown?(this.scNumberOfYearsIsUnknown=!1,this.scCalculationIsDisabled=!0):(this.setScNumberOfYearsValue(""),this.scNumberOfYearsIsUnknown=!0,this.scInitialAmountIsUnknown=!1,this.scPaymentAmountIsUnknown=!1,this.scInterestRatePerYearIsUnknown=!1,this.scFinalAmountIsUnknown=!1,this.scCalculationIsDisabled=!1)},changeScInterestRatePerYearUnknowing:function(){this.scInterestRatePerYearIsUnknown?(this.scInterestRatePerYearIsUnknown=!1,this.scCalculationIsDisabled=!0):(this.setScInterestRatePerYearValue(""),this.scInterestRatePerYearIsUnknown=!0,this.scInitialAmountIsUnknown=!1,this.scPaymentAmountIsUnknown=!1,this.scNumberOfYearsIsUnknown=!1,this.scFinalAmountIsUnknown=!1,this.scCalculationIsDisabled=!1)},changeScFinalAmountUnknowing:function(){this.scFinalAmountIsUnknown?(this.scFinalAmountIsUnknown=!1,this.scCalculationIsDisabled=!0):(this.setScFinalAmountValue(""),this.scFinalAmountIsUnknown=!0,this.scInitialAmountIsUnknown=!1,this.scPaymentAmountIsUnknown=!1,this.scNumberOfYearsIsUnknown=!1,this.scInterestRatePerYearIsUnknown=!1,this.scCalculationIsDisabled=!1)},setIcInitialAmountValue:function(e){this.icInitialAmountValue=e},setIcRegularPaymentValue:function(e){this.icRegularPaymentValue=e;var t=this.icNumberOfRegularPaymentsPerYearValue;""!==t&&(t=parseFloat(t)),(""===e||parseFloat(e)>0)&&(""!==t&&0!==t||this.updateIcNumberOfRegularPaymentsPerYearValue(1)),0===parseFloat(e)&&(""!==t&&0===t||this.updateIcNumberOfRegularPaymentsPerYearValue(0))},setIcNumberOfRegularPaymentsPerYearValue:function(e){this.icNumberOfRegularPaymentsPerYearValue=e;var t=this.icRegularPaymentValue;""!==t&&(t=parseFloat(t)),""!==e&&(this.icRegularPaymentIsUnknown||(parseFloat(e)>0&&0===t&&this.updateIcRegularPaymentValue(""),0===parseFloat(e)&&(""!==t&&0===t||this.updateIcRegularPaymentValue(0))))},setIcNumberOfYearsValue:function(e){this.icNumberOfYearsValue=e},setIcInterestRatePerYearValue:function(e){this.icInterestRatePerYearValue=e},setIcFinalAmountValue:function(e){this.icFinalAmountValue=e},setScInitialAmountValue:function(e){this.scInitialAmountValue=e},setScPaymentAmountValue:function(e){this.scPaymentAmountValue=e},setScNumberOfPaymentsPerYearValue:function(e){this.scNumberOfPaymentsPerYearValue=e},setScNumberOfYearsValue:function(e){this.scNumberOfYearsValue=e},setScInterestRatePerYearValue:function(e){this.scInterestRatePerYearValue=e},setScFinalAmountValue:function(e){this.scFinalAmountValue=e},setScNumberOfYearsUntilFistPaymentValue:function(e){this.scNumberOfYearsUntilFistPaymentValue=e},setScInflationValue:function(e){this.scInflationValue=e},updateIcInitialAmountValue:function(e){var t=this;e=e.toString(),t.icInitialAmountValue!==e&&(t.icInitialAmountValue=e,t.icInitialAmountIsBlinked=!0,window.setTimeout(function(){t.icInitialAmountIsBlinked=!1},1100))},updateIcRegularPaymentValue:function(e){var t=this;e=e.toString(),t.icRegularPaymentValue!==e&&(t.icRegularPaymentValue=e,t.icRegularPaymentIsBlinked=!0,window.setTimeout(function(){t.icRegularPaymentIsBlinked=!1},1100))},updateIcNumberOfRegularPaymentsPerYearValue:function(e){var t=this;e=e.toString(),t.icNumberOfRegularPaymentsPerYearValue!==e&&(t.icNumberOfRegularPaymentsPerYearValue=e,t.icNumberOfRegularPaymentsPerYearIsBlinked=!0,window.setTimeout(function(){t.icNumberOfRegularPaymentsPerYearIsBlinked=!1},1100))},updateIcNumberOfYearsValue:function(e){var t=this;e=e.toString(),t.icNumberOfYearsValue!==e&&(t.icNumberOfYearsValue=e,t.icNumberOfYearsIsBlinked=!0,window.setTimeout(function(){t.icNumberOfYearsIsBlinked=!1},1100))},updateIcInterestRatePerYearValue:function(e){var t=this;e=e.toString(),t.icInterestRatePerYearValue!==e&&(t.icInterestRatePerYearValue=e,t.icInterestRatePerYearIsBlinked=!0,window.setTimeout(function(){t.icInterestRatePerYearIsBlinked=!1},1100))},updateIcFinalAmountValue:function(e){var t=this;e=e.toString(),t.icFinalAmountValue!==e&&(t.icFinalAmountValue=e,t.icFinalAmountIsBlinked=!0,window.setTimeout(function(){t.icFinalAmountIsBlinked=!1},1100))},updateScInitialAmountValue:function(e){var t=this;e=e.toString(),t.scInitialAmountValue!==e&&(t.scInitialAmountValue=e,t.scInitialAmountIsBlinked=!0,window.setTimeout(function(){t.scInitialAmountIsBlinked=!1},1100))},updateScPaymentAmountValue:function(e){var t=this;e=e.toString(),t.scPaymentAmountValue!==e&&(t.scPaymentAmountValue=e,t.scPaymentAmountIsBlinked=!0,window.setTimeout(function(){t.scPaymentAmountIsBlinked=!1},1100))},updateScNumberOfPaymentsPerYearValue:function(e){var t=this;e=e.toString(),t.scNumberOfPaymentsPerYearValue!==e&&(t.scNumberOfPaymentsPerYearValue=e,t.scNumberOfPaymentsPerYearIsBlinked=!0,window.setTimeout(function(){t.scNumberOfPaymentsPerYearIsBlinked=!1},1100))},updateScNumberOfYearsValue:function(e){var t=this;e=e.toString(),t.scNumberOfYearsValue!==e&&(t.scNumberOfYearsValue=e,t.scNumberOfYearsIsBlinked=!0,window.setTimeout(function(){t.scNumberOfYearsIsBlinked=!1},1100))},updateScInterestRatePerYearValue:function(e){var t=this;e=e.toString(),t.scInterestRatePerYearValue!==e&&(t.scInterestRatePerYearValue=e,t.scInterestRatePerYearIsBlinked=!0,window.setTimeout(function(){t.scInterestRatePerYearIsBlinked=!1},1100))},updateScFinalAmountValue:function(e){var t=this;e=e.toString(),t.scFinalAmountValue!==e&&(t.scFinalAmountValue=e,t.scFinalAmountIsBlinked=!0,window.setTimeout(function(){t.scFinalAmountIsBlinked=!1},1100))},updateScNumberOfYearsUntilFistPaymentValue:function(e){var t=this;e=e.toString(),t.scNumberOfYearsUntilFistPaymentValue!==e&&(t.scNumberOfYearsUntilFistPaymentValue=e,t.scNumberOfYearsUntilFistPaymentIsBlinked=!0,window.setTimeout(function(){t.scNumberOfYearsUntilFistPaymentIsBlinked=!1},1100))},updateScInflationValue:function(e){var t=this;e=e.toString(),t.scInflationValue!==e&&(t.scInflationValue=e,t.scInflationIsBlinked=!0,window.setTimeout(function(){t.scInflationIsBlinked=!1},1100))},doIncomeSubmit:function(e){this.icCalculationIsDisabled&&e.preventDefault()},doIncomeCalc:function(){var e=this;this.icReqWasHandledByCache()||axios.get("/api/income-calculator",{params:{initial_amount:e.icInitialAmountValue,regular_payment:e.icRegularPaymentValue,number_of_regular_payments_per_year:e.icNumberOfRegularPaymentsPerYearValue,number_of_years:e.icNumberOfYearsValue,interest_rate_per_year:e.icInterestRatePerYearValue,final_amount:e.icFinalAmountValue,initial_amount_is_unknown:e.icInitialAmountIsUnknown?1:0,regular_payment_is_unknown:e.icRegularPaymentIsUnknown?1:0,number_of_years_is_unknown:e.icNumberOfYearsIsUnknown?1:0,interest_rate_per_year_is_unknown:e.icInterestRatePerYearIsUnknown?1:0,final_amount_is_unknown:e.icFinalAmountIsUnknown?1:0}}).then(function(t){if(e.updateIcInitialAmountValue(t.data.initial_amount),e.updateIcRegularPaymentValue(t.data.regular_payment),e.updateIcNumberOfRegularPaymentsPerYearValue(t.data.number_of_regular_payments_per_year),e.updateIcNumberOfYearsValue(t.data.number_of_years),e.updateIcInterestRatePerYearValue(t.data.interest_rate_per_year),e.updateIcFinalAmountValue(t.data.final_amount),e.icLastRequestCash.isEmpty=!1,e.icLastRequestCash.initialAmount=t.data.initial_amount.toString(),e.icLastRequestCash.regularPayment=t.data.regular_payment.toString(),e.icLastRequestCash.numberOfRegularPaymentsPerYear=t.data.number_of_regular_payments_per_year.toString(),e.icLastRequestCash.numberOfYears=t.data.number_of_years.toString(),e.icLastRequestCash.interestRatePerYear=t.data.interest_rate_per_year.toString(),e.icLastRequestCash.finalAmount=t.data.final_amount.toString(),e.icLastRequestCash.yearly_balances=t.data.yearly_balances,e.icIsErrorResult=!1,e.icErrors.splice(0),e.icCopyIsEnabled=!0,window.isMobile){var n=0;e.icInitialAmountIsUnknown?n=document.getElementById("ic-initial-amount").offsetTop:e.icRegularPaymentIsUnknown?n=document.getElementById("ic-regular-payment").offsetTop:e.icNumberOfYearsIsUnknown?n=document.getElementById("ic-number-of-years").offsetTop:e.icInterestRatePerYearIsUnknown?n=document.getElementById("ic-interest-rate-per-year").offsetTop:e.icFinalAmountIsUnknown&&(n=document.getElementById("ic-final-amount").offsetTop),window.scroll({top:n-50,left:0,behavior:"smooth"})}}).catch(function(t){var n;e.icLastRequestCash.isEmpty=!0,e.icLastRequestCash.initialAmount="",e.icLastRequestCash.regularPayment="",e.icLastRequestCash.numberOfRegularPaymentsPerYear="",e.icLastRequestCash.numberOfYears="",e.icLastRequestCash.interestRatePerYear="",e.icLastRequestCash.finalAmount="",e.icLastRequestCash.yearly_balances=[],e.icCopyIsEnabled=!1,e.icErrors.splice(0),(n=e.icErrors).push.apply(n,_toConsumableArray(t.response.data.errors)),e.icIsErrorResult=!0}).finally(function(){e.updateChart()})},copyScToIc:function(){this.icLastRequestCash.isEmpty=!0,this.icLastRequestCash.initialAmount="",this.icLastRequestCash.regularPayment="",this.icLastRequestCash.numberOfRegularPaymentsPerYear="",this.icLastRequestCash.numberOfYears="",this.icLastRequestCash.interestRatePerYear="",this.icLastRequestCash.finalAmount="",this.icLastRequestCash.yearly_balances=[],this.icCopyIsEnabled=!1,this.icIsErrorResult=!1,this.icInitialAmountIsUnknown=!1,this.icRegularPaymentIsUnknown=!1,this.icNumberOfYearsIsUnknown=!1,this.icInterestRatePerYearIsUnknown=!1,this.icFinalAmountIsUnknown=!1,this.icInitialAmountValue="",this.icRegularPaymentValue="",this.icNumberOfRegularPaymentsPerYearValue="",this.updateIcNumberOfYearsValue(this.scNumberOfYearsUntilFistPaymentValue),this.updateIcInterestRatePerYearValue("10"),this.updateIcFinalAmountValue(this.scInitialAmountValue),this.activeIncomeCalculator(),this.updateChart()},icReqWasHandledByCache:function(){var e=this.icLastRequestCash;return!(!this.icInitialAmountIsUnknown&&this.icInitialAmountValue!==e.initialAmount)&&(!(!this.icRegularPaymentIsUnknown&&this.icRegularPaymentValue!==e.regularPayment)&&(this.icNumberOfRegularPaymentsPerYearValue===e.numberOfRegularPaymentsPerYear&&(!(!this.icNumberOfYearsIsUnknown&&this.icNumberOfYearsValue!==e.numberOfYears)&&(!(!this.icInterestRatePerYearIsUnknown&&this.icInterestRatePerYearValue!==e.interestRatePerYear)&&(!(!this.icFinalAmountIsUnknown&&this.icFinalAmountValue!==e.finalAmount)&&(this.updateIcInitialAmountValue(e.initialAmount),this.updateIcRegularPaymentValue(e.regularPayment),this.updateIcNumberOfRegularPaymentsPerYearValue(e.numberOfRegularPaymentsPerYear),this.updateIcNumberOfYearsValue(e.numberOfYears),this.updateIcInterestRatePerYearValue(e.interestRatePerYear),this.updateIcFinalAmountValue(e.finalAmount),!0))))))},doSpendSubmit:function(e){this.scCalculationIsDisabled&&e.preventDefault()},doSpendCalc:function(){var e=this;this.scReqWasHandledByCache()||axios.get("/api/spend-calculator",{params:{initial_amount:e.scInitialAmountValue,payment_amount:e.scPaymentAmountValue,number_of_payments_per_year:e.scNumberOfPaymentsPerYearValue,number_of_years:e.scNumberOfYearsValue,interest_rate_per_year:e.scInterestRatePerYearValue,final_amount:e.scFinalAmountValue,number_of_years_until_fist_payment:e.scNumberOfYearsUntilFistPaymentValue,inflation:e.scInflationValue,initial_amount_is_unknown:e.scInitialAmountIsUnknown?1:0,payment_amount_is_unknown:e.scPaymentAmountIsUnknown?1:0,number_of_years_is_unknown:e.scNumberOfYearsIsUnknown?1:0,interest_rate_per_year_is_unknown:e.scInterestRatePerYearIsUnknown?1:0,final_amount_is_unknown:e.scFinalAmountIsUnknown?1:0}}).then(function(t){if(e.updateScInitialAmountValue(t.data.initial_amount),e.updateScPaymentAmountValue(t.data.payment_amount),e.updateScNumberOfPaymentsPerYearValue(t.data.number_of_payments_per_year),e.updateScNumberOfYearsValue(t.data.number_of_years),e.updateScInterestRatePerYearValue(t.data.interest_rate_per_year),e.updateScFinalAmountValue(t.data.final_amount),e.updateScNumberOfYearsUntilFistPaymentValue(t.data.number_of_years_until_fist_payment),e.updateScInflationValue(t.data.inflation),e.scLastRequestCash.isEmpty=!1,e.scLastRequestCash.initialAmount=t.data.initial_amount.toString(),e.scLastRequestCash.paymentAmount=t.data.payment_amount.toString(),e.scLastRequestCash.numberOfPaymentsPerYear=t.data.number_of_payments_per_year.toString(),e.scLastRequestCash.numberOfYears=t.data.number_of_years.toString(),e.scLastRequestCash.interestRatePerYear=t.data.interest_rate_per_year.toString(),e.scLastRequestCash.finalAmount=t.data.final_amount.toString(),e.scLastRequestCash.numberOfYearsUntilFistPayment=t.data.number_of_years_until_fist_payment.toString(),e.scLastRequestCash.inflation=t.data.inflation.toString(),e.scLastRequestCash.balances_by_period=t.data.balances_by_period,e.scIsErrorResult=!1,e.scErrors.splice(0),e.scCopyIsEnabled=!0,window.isMobile){var n=0;e.scInitialAmountIsUnknown?n=document.getElementById("sc-initial-amount").offsetTop:e.scPaymentAmountIsUnknown?n=document.getElementById("sc-payment-amount").offsetTop:e.scNumberOfYearsIsUnknown?n=document.getElementById("sc-number-of-years").offsetTop:e.scInterestRatePerYearIsUnknown?n=document.getElementById("sc-interest-rate-per-year").offsetTop:e.icFinalAmountIsUnknown&&(n=document.getElementById("sc-final-amount").offsetTop),window.scroll({top:n-50,left:0,behavior:"smooth"})}}).catch(function(t){var n;e.scLastRequestCash.isEmpty=!0,e.scLastRequestCash.initialAmount="",e.scLastRequestCash.paymentAmount="",e.scLastRequestCash.numberOfPaymentsPerYear="",e.scLastRequestCash.numberOfYears="",e.scLastRequestCash.interestRatePerYear="",e.scLastRequestCash.finalAmount="",e.scLastRequestCash.numberOfYearsUntilFistPayment="",e.scLastRequestCash.inflation="",e.scLastRequestCash.balances_by_period=[],e.scCopyIsEnabled=!1,e.scErrors.splice(0),(n=e.scErrors).push.apply(n,_toConsumableArray(t.response.data.errors)),e.scIsErrorResult=!0}).finally(function(){e.updateChart()})},copyIcToSc:function(){this.scLastRequestCash.isEmpty=!0,this.scLastRequestCash.initialAmount="",this.scLastRequestCash.paymentAmount="",this.scLastRequestCash.numberOfPaymentsPerYear="",this.scLastRequestCash.numberOfYears="",this.scLastRequestCash.interestRatePerYear="",this.scLastRequestCash.finalAmount="",this.scLastRequestCash.numberOfYearsUntilFistPayment="",this.scLastRequestCash.inflation="",this.scLastRequestCash.balances_by_period=[],this.scCopyIsEnabled=!1,this.scIsErrorResult=!1,this.scInitialAmountIsUnknown=!1,this.scPaymentAmountIsUnknown=!1,this.scNumberOfYearsIsUnknown=!1,this.scInterestRatePerYearIsUnknown=!1,this.scFinalAmountIsUnknown=!1,this.scPaymentAmountValue="",this.scNumberOfPaymentsPerYearValue="",this.scNumberOfYearsValue="",this.scFinalAmountValue="",this.updateScInitialAmountValue(this.icFinalAmountValue),this.updateScInterestRatePerYearValue("5"),this.updateScInflationValue("2"),this.updateScNumberOfYearsUntilFistPaymentValue(this.icNumberOfYearsValue),this.activeSpendCalculator(),this.updateChart()},scReqWasHandledByCache:function(){var e=this.scLastRequestCash;return!(!this.scInitialAmountIsUnknown&&this.scInitialAmountValue!==e.initialAmount)&&(!(!this.scPaymentAmountIsUnknown&&this.scPaymentAmountValue!==e.paymentAmount)&&(this.scNumberOfPaymentsPerYearValue===e.numberOfPaymentsPerYear&&(!(!this.scNumberOfYearsIsUnknown&&this.scNumberOfYearsValue!==e.numberOfYears)&&(!(!this.scInterestRatePerYearIsUnknown&&this.scInterestRatePerYearValue!==e.interestRatePerYear)&&(!(!this.scFinalAmountIsUnknown&&this.scFinalAmountValue!==e.finalAmount)&&(this.scNumberOfYearsUntilFistPaymentValue===e.numberOfYearsUntilFistPayment&&(this.scInflationValue===e.inflation&&(this.updateScInitialAmountValue(e.initialAmount),this.updateScPaymentAmountValue(e.paymentAmount),this.updateScNumberOfPaymentsPerYearValue(e.numberOfPaymentsPerYear),this.updateScNumberOfYearsValue(e.numberOfYears),this.updateScInterestRatePerYearValue(e.interestRatePerYear),this.updateScFinalAmountValue(e.finalAmount),this.updateScNumberOfYearsUntilFistPaymentValue(e.numberOfYearsUntilFistPayment),this.updateScInflationValue(e.inflation),!0))))))))},updateChart:function(){var e=this,t=[];this.icLastRequestCash.isEmpty||0!==this.icLastRequestCash.yearly_balances.length&&this.icLastRequestCash.yearly_balances.forEach(function(e){t.push([e.index_of_year,e.amount])});var n=[];this.scLastRequestCash.isEmpty||function(){var t=0;0!==parseInt(e.scLastRequestCash.numberOfYearsUntilFistPayment)&&(t=parseInt(e.scLastRequestCash.numberOfYearsUntilFistPayment));var a,s=parseInt(e.scLastRequestCash.numberOfPaymentsPerYear);0!==e.scLastRequestCash.balances_by_period.length&&(a=1,e.scLastRequestCash.balances_by_period.forEach(function(e){a!==s?(1===a&&(n.push([t,e.amount]),t++),a++):a=1})),n.pop()}(),ApexCharts.exec("mychart","updateOptions",{yaxis:{labels:{show:!0}},xaxis:{labels:{show:!0}},series:[{name:"Использование",data:n},{name:"Накопление",data:t}]},!1,!1,!1)}}};Vue.createApp(Calculator).mount("main");var chart=new ApexCharts(document.querySelector("#chart-item"),{chart:{id:"mychart",type:"line",toolbar:{show:!1},animations:{enabled:!1},zoom:{enabled:!1}},yaxis:{title:{text:"Размер капитала"},labels:{show:!1}},xaxis:{title:{text:"Годы"},type:"numeric",labels:{show:!1}},series:[{name:"Использование",data:[]},{name:"Накопление",data:[]}],colors:["#de0b0b","#10a114"],dataLabels:{enabled:!0,textAnchor:"end"},stroke:{curve:"straight"},markers:{size:3,hover:{sizeOffset:0}},legend:{show:!0,position:"top",horizontalAlign:"right"}});chart.render(),window.onbeforeprint=function(){ApexCharts.exec("mychart","updateOptions",{chart:{width:"600px"}},!1,!1,!1)},window.onafterprint=function(){ApexCharts.exec("mychart","updateOptions",{chart:{width:"100%"}},!1,!1,!1)};