/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'RezgoCalendar',
  props: {
    uid: {
      type: String,
      required: true
    },
    buttonText: {
      type: String,
      "default": 'Select Date & Price'
    },
    modalTitle: {
      type: String,
      "default": 'Select your date & view pricing'
    }
  },
  data: function data() {
    return {
      showModal: false,
      currentDate: new Date(),
      selectedDate: null,
      selectedPrice: null,
      tempSelectedDate: null,
      tempSelectedPrice: null,
      calendarDates: {},
      weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      loading: false
    };
  },
  computed: {
    monthYearLabel: function monthYearLabel() {
      return new Intl.DateTimeFormat('en-US', {
        month: 'long',
        year: 'numeric'
      }).format(this.currentDate);
    },
    selectedDateLabel: function selectedDateLabel() {
      if (!this.selectedDate) return '';
      return new Intl.DateTimeFormat('en-US', {
        weekday: 'long',
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      }).format(new Date(this.selectedDate));
    },
    daysInMonth: function daysInMonth() {
      return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();
    },
    firstDayOfMonth: function firstDayOfMonth() {
      return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1).getDay();
    }
  },
  mounted: function mounted() {
    var _this = this;
    // Listen for the global event to open the modal
    if (window.rezgoEvents) {
      window.rezgoEvents.addEventListener('openCalendarModal', function () {
        _this.showModal = true;
      });
    }
  },
  methods: {
    loadCalendarDates: function loadCalendarDates() {
      var _this2 = this;
      return _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var params, response;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              if (!_this2.loading) {
                _context.next = 2;
                break;
              }
              return _context.abrupt("return");
            case 2:
              console.log('🔵 loadCalendarDates called, uid:', _this2.uid);
              _this2.loading = true;
              _context.prev = 4;
              params = {
                uid: _this2.uid,
                year: _this2.currentDate.getFullYear(),
                month: _this2.currentDate.getMonth() + 1
              };
              console.log('📡 Fetching from /api/rezgo/pricing/month with params:', params);
              _context.next = 9;
              return axios.get("/api/rezgo/pricing/month", {
                params: params
              });
            case 9:
              response = _context.sent;
              console.log('✅ API Response received:', response.data);
              if (response.data.success) {
                _this2.calendarDates = {};
                response.data.dates.forEach(function (dateObj) {
                  _this2.calendarDates[dateObj.date] = {
                    price_adult: dateObj.price_adult,
                    available: dateObj.available
                  };
                });
                console.log('📊 Calendar dates loaded:', Object.keys(_this2.calendarDates).length, 'dates');
              }
              _context.next = 18;
              break;
            case 14:
              _context.prev = 14;
              _context.t0 = _context["catch"](4);
              console.error('❌ Failed to load calendar dates:', _context.t0);
              if (_context.t0.response) {
                console.error('Response status:', _context.t0.response.status);
                console.error('Response data:', _context.t0.response.data);
                console.error('Response headers:', _context.t0.response.headers);
              }
            case 18:
              _context.prev = 18;
              _this2.loading = false;
              return _context.finish(18);
            case 21:
            case "end":
              return _context.stop();
          }
        }, _callee, null, [[4, 14, 18, 21]]);
      }))();
    },
    getPriceForDate: function getPriceForDate(day) {
      var dateStr = this.getDateString(day);
      var dateData = this.calendarDates[dateStr];
      return dateData ? dateData.price_adult : null;
    },
    isDateAvailable: function isDateAvailable(day) {
      var dateStr = this.getDateString(day);
      var dateData = this.calendarDates[dateStr];
      return dateData ? dateData.available : false;
    },
    getDateString: function getDateString(day) {
      var year = this.currentDate.getFullYear();
      var month = String(this.currentDate.getMonth() + 1).padStart(2, '0');
      var dayStr = String(day).padStart(2, '0');
      return "".concat(year, "-").concat(month, "-").concat(dayStr);
    },
    getCellClasses: function getCellClasses(day) {
      var available = this.isDateAvailable(day);
      var dateStr = this.getDateString(day);
      // Check for selected (either selectedDate or tempSelectedDate during selection)
      var isSelected = this.selectedDate === dateStr || this.tempSelectedDate === dateStr;
      return {
        available: available,
        unavailable: !available,
        selected: isSelected,
        'cursor-pointer': available
      };
    },
    selectDate: function selectDate(day) {
      if (!this.isDateAvailable(day)) return;
      var dateStr = this.getDateString(day);
      var price = this.getPriceForDate(day);

      // Directly select the date (no confirmation needed)
      this.selectedDate = dateStr;
      this.selectedPrice = price;
      this.tempSelectedDate = null;
      this.tempSelectedPrice = null;

      // Update hidden form fields immediately
      this.updateHiddenFields();

      // Emit event for parent component
      this.$emit('date-selected', {
        date: this.selectedDate,
        price: this.selectedPrice,
        uid: this.uid
      });

      // Dispatch event to global event target so app.js can listen and update button
      if (window.rezgoEvents) {
        window.rezgoEvents.dispatchEvent(new CustomEvent('rezgoDateSelected', {
          detail: {
            date: this.selectedDate,
            price: this.selectedPrice,
            uid: this.uid
          }
        }));
      }

      // Close the modal immediately after selection
      this.showModal = false;
      console.log('✅ Date selected directly:', {
        date: this.selectedDate,
        price: this.selectedPrice
      });
    },
    clearSelection: function clearSelection() {
      this.selectedDate = null;
      this.selectedPrice = null;
      this.tempSelectedDate = null;
      this.tempSelectedPrice = null;
      this.$emit('date-cleared');
      this.updateHiddenFields();
    },
    previousMonth: function previousMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
      this.loadCalendarDates();
    },
    nextMonth: function nextMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      this.loadCalendarDates();
    },
    updateHiddenFields: function updateHiddenFields() {
      // Update hidden form fields for cart submission
      var dateField = document.getElementById('rezgo-selected-date');
      var priceField = document.getElementById('rezgo-selected-price');
      var uidField = document.getElementById('rezgo-product-uid');
      if (dateField) dateField.value = this.selectedDate || '';
      if (priceField) priceField.value = this.selectedPrice || '';
      if (uidField) uidField.value = this.uid;
    }
  },
  watch: {
    showModal: function showModal(newVal) {
      if (newVal) {
        this.loadCalendarDates();
      } else {
        // When modal closes without confirmation, clear temp selection
        this.tempSelectedDate = null;
        this.tempSelectedPrice = null;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);

var _hoisted_1 = {
  "class": "rezgo-calendar-container"
};
var _hoisted_2 = {
  "class": "modal-content"
};
var _hoisted_3 = {
  "class": "modal-header"
};
var _hoisted_4 = {
  "class": "modal-title"
};
var _hoisted_5 = {
  "class": "modal-body"
};
var _hoisted_6 = {
  "class": "calendar-header mb-4"
};
var _hoisted_7 = {
  "class": "d-flex justify-content-between align-items-center mb-3"
};
var _hoisted_8 = {
  "class": "mb-0"
};
var _hoisted_9 = {
  "class": "calendar-weekdays mb-2"
};
var _hoisted_10 = {
  "class": "calendar-grid"
};
var _hoisted_11 = ["onClick"];
var _hoisted_12 = {
  "class": "date-number"
};
var _hoisted_13 = {
  key: 0,
  "class": "price-tag"
};
var _hoisted_14 = {
  key: 1,
  "class": "price-tag unavailable"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Calendar Modal "), $data.showModal ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
    key: 0,
    "class": "modal d-block",
    style: {
      "background-color": "rgba(0,0,0,0.5)"
    },
    onClick: _cache[4] || (_cache[4] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $data.showModal = false;
    }, ["self"]))
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "modal-dialog modal-lg",
    onClick: _cache[3] || (_cache[3] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {}, ["stop"]))
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($props.modalTitle), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[0] || (_cache[0] = function ($event) {
      return $data.showModal = false;
    }),
    type: "button",
    "class": "btn-close"
  })]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Month/Year Navigation "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.previousMonth && $options.previousMonth.apply($options, arguments);
    }, ["stop", "prevent"])),
    "class": "btn btn-sm btn-outline-secondary"
  }, "← " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Previous')), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", _hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.monthYearLabel), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    onClick: _cache[2] || (_cache[2] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.nextMonth && $options.nextMonth.apply($options, arguments);
    }, ["stop", "prevent"])),
    "class": "btn btn-sm btn-outline-secondary"
  }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.__('Next')) + " →", 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Days of Week Header "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.weekDays, function (day) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      key: day,
      "class": "calendar-day-header"
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(day), 1 /* TEXT */);
  }), 128 /* KEYED_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Calendar Grid "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Empty cells for days before month starts "), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.firstDayOfMonth, function (i) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      key: 'empty-' + i,
      "class": "calendar-cell empty"
    });
  }), 128 /* KEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Date cells "), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.daysInMonth, function (day) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
      key: day,
      onClick: function onClick($event) {
        return $options.selectDate(day);
      },
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["calendar-cell", $options.getCellClasses(day)])
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(day), 1 /* TEXT */), $options.getPriceForDate(day) ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_13, "$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getPriceForDate(day)), 1 /* TEXT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_14, "—"))], 10 /* CLASS, PROPS */, _hoisted_11);
  }), 128 /* KEYED_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Legend "), _cache[5] || (_cache[5] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "calendar-legend mt-4 pt-3 border-top"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("small", {
    "class": "text-muted"
  }, " Click any date to view price and select. Green dates have available inventory. ")], -1 /* HOISTED */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Modal Footer - Hidden, auto-select on click "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" Confirmation not needed - dates are selected directly ")])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]);
}

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js */ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_laravel_mix_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.rezgo-calendar-container[data-v-7857e572] {\n  padding: 15px 0;\n}\n.modal[data-v-7857e572] {\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  position: fixed;\n  z-index: 1050;\n  left: 0;\n  top: 0;\n  width: 100%;\n  height: 100%;\n}\n.calendar-header[data-v-7857e572] {\n  padding: 10px 0;\n}\n.calendar-weekdays[data-v-7857e572] {\n  display: grid;\n  grid-template-columns: repeat(7, 1fr);\n  gap: 8px;\n  margin-bottom: 10px;\n}\n.calendar-day-header[data-v-7857e572] {\n  text-align: center;\n  font-weight: 600;\n  color: #666;\n  padding: 8px;\n  font-size: 0.85rem;\n}\n.calendar-grid[data-v-7857e572] {\n  display: grid;\n  grid-template-columns: repeat(7, 1fr);\n  gap: 8px;\n  margin: 20px 0;\n}\n.calendar-cell[data-v-7857e572] {\n  aspect-ratio: 1;\n  display: flex;\n  flex-direction: column;\n  align-items: center;\n  justify-content: center;\n  border: 2px solid #e0e0e0;\n  border-radius: 6px;\n  background: #f9f9f9;\n  cursor: default;\n  transition: all 0.2s ease;\n  padding: 6px;\n  min-height: 70px;\n}\n.calendar-cell.empty[data-v-7857e572] {\n  background: transparent;\n  border: none;\n}\n.calendar-cell.available[data-v-7857e572] {\n  background: #e8f5e9;\n  border-color: #4caf50;\n  cursor: pointer;\n}\n.calendar-cell.available[data-v-7857e572]:hover {\n  background: #c8e6c9;\n  border-color: #388e3c;\n  transform: translateY(-2px);\n  box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);\n}\n.calendar-cell.available.selected[data-v-7857e572] {\n  background: #4caf50;\n  color: white;\n  border-color: #2e7d32;\n}\n.calendar-cell.unavailable[data-v-7857e572] {\n  background: #fafafa;\n  border-color: #d0d0d0;\n  color: #999;\n}\n.date-number[data-v-7857e572] {\n  font-weight: 600;\n  font-size: 1.1rem;\n  line-height: 1;\n  margin-bottom: 4px;\n}\n.price-tag[data-v-7857e572] {\n  font-size: 0.85rem;\n  font-weight: 600;\n  color: #4caf50;\n  margin-top: 4px;\n}\n.price-tag.unavailable[data-v-7857e572] {\n  color: #ccc;\n}\n.calendar-legend[data-v-7857e572] {\n  text-align: center;\n}\n.calendar-cell.selected .price-tag[data-v-7857e572] {\n  color: white;\n}\n@media (max-width: 768px) {\n.calendar-grid[data-v-7857e572] {\n    gap: 6px;\n}\n.calendar-cell[data-v-7857e572] {\n    min-height: 60px;\n    padding: 4px;\n}\n.date-number[data-v-7857e572] {\n    font-size: 1rem;\n}\n.price-tag[data-v-7857e572] {\n    font-size: 0.75rem;\n}\n}\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js":
/*!******************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/css-loader/dist/runtime/api.js ***!
  \******************************************************************************/
/***/ ((module) => {



/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_62_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_62_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_style_index_0_id_7857e572_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css */ "./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_62_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_62_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_style_index_0_id_7857e572_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_62_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_62_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_style_index_0_id_7857e572_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {



var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ }),

/***/ "./node_modules/vue-loader/dist/exportHelper.js":
/*!******************************************************!*\
  !*** ./node_modules/vue-loader/dist/exportHelper.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, exports) => {


Object.defineProperty(exports, "__esModule", ({ value: true }));
// runtime helper for setting properties on components
// in a tree-shakable way
exports["default"] = (sfc, props) => {
    const target = sfc.__vccOpts || sfc;
    for (const [key, val] of props) {
        target[key] = val;
    }
    return target;
};


/***/ }),

/***/ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue":
/*!***************************************************************************!*\
  !*** ./platform/themes/farmart/resources/js/components/RezgoCalendar.vue ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _RezgoCalendar_vue_vue_type_template_id_7857e572_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true */ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true");
/* harmony import */ var _RezgoCalendar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RezgoCalendar.vue?vue&type=script&lang=js */ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js");
/* harmony import */ var _RezgoCalendar_vue_vue_type_style_index_0_id_7857e572_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css */ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_RezgoCalendar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_RezgoCalendar_vue_vue_type_template_id_7857e572_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-7857e572"],['__file',"platform/themes/farmart/resources/js/components/RezgoCalendar.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js":
/*!***************************************************************************************************!*\
  !*** ./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RezgoCalendar.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css":
/*!***********************************************************************************************************************************!*\
  !*** ./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css ***!
  \***********************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_laravel_mix_node_modules_css_loader_dist_cjs_js_clonedRuleSet_62_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_62_use_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_style_index_0_id_7857e572_scoped_true_lang_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!../../../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css */ "./node_modules/style-loader/dist/cjs.js!./node_modules/laravel-mix/node_modules/css-loader/dist/cjs.js??clonedRuleSet-62.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-62.use[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=style&index=0&id=7857e572&scoped=true&lang=css");


/***/ }),

/***/ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true":
/*!*********************************************************************************************************************!*\
  !*** ./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true ***!
  \*********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_template_id_7857e572_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RezgoCalendar_vue_vue_type_template_id_7857e572_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./platform/themes/farmart/resources/js/components/RezgoCalendar.vue?vue&type=template&id=7857e572&scoped=true");


/***/ }),

/***/ "vue":
/*!**********************!*\
  !*** external "Vue" ***!
  \**********************/
/***/ ((module) => {

module.exports = Vue;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			id: moduleId,
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/nonce */
/******/ 	(() => {
/******/ 		__webpack_require__.nc = undefined;
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*****************************************************!*\
  !*** ./platform/themes/farmart/resources/js/app.js ***!
  \*****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_RezgoCalendar_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/RezgoCalendar.vue */ "./platform/themes/farmart/resources/js/components/RezgoCalendar.vue");
/**
 * Farmart Theme - App Initialization
 * Registers Vue components and initializes theme functionality
 */




// Create a global event target for inter-component communication
window.rezgoEvents = new EventTarget();

// Initialize function
function initializeRezgoCalendar() {
  var calendarRoot = document.getElementById('rezgo-calendar-root');
  if (calendarRoot) {
    var rezgoUid = calendarRoot.getAttribute('data-rezgo-uid');
    var app = (0,vue__WEBPACK_IMPORTED_MODULE_0__.createApp)({
      components: {
        'rezgo-calendar': _components_RezgoCalendar_vue__WEBPACK_IMPORTED_MODULE_1__["default"]
      },
      data: function data() {
        return {
          rezgoUid: rezgoUid
        };
      },
      template: '<rezgo-calendar :uid="rezgoUid"></rezgo-calendar>'
    });

    // Make the i18n function available to all components
    app.config.globalProperties.__ = window.__ || function (key) {
      return key;
    };
    app.mount(calendarRoot);
    console.log('Rezgo Calendar initialized for UID:', rezgoUid);

    // Set up button click handler to open calendar modal
    var button = document.getElementById('rezgo-select-date-btn');
    if (button) {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        // Dispatch a custom event that the component can listen to
        window.rezgoEvents.dispatchEvent(new CustomEvent('openCalendarModal'));
      });
    }
  }
}

// Listen for date selection event from the Vue component
if (window.rezgoEvents) {
  window.rezgoEvents.addEventListener('rezgoDateSelected', function (event) {
    var _event$detail = event.detail,
      date = _event$detail.date,
      price = _event$detail.price;
    var button = document.getElementById('rezgo-select-date-btn');
    if (button) {
      // Format date for display (e.g., "May 18, 2026")
      var dateObj = new Date(date + 'T00:00:00');
      var formattedDate = new Intl.DateTimeFormat('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      }).format(dateObj);

      // Update button text to show selection
      button.textContent = "\u2713 Selected: ".concat(formattedDate, " @ $").concat(parseFloat(price).toFixed(2));
      button.classList.add('selected');
      button.classList.remove('btn-outline-primary');
      button.classList.add('btn-success');
      console.log('Button updated with selection:', {
        date: date,
        price: price
      });
    }
  });
}

// Initialize immediately if DOM is ready, or wait for DOMContentLoaded
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeRezgoCalendar);
} else {
  // DOM is already loaded, initialize immediately
  setTimeout(initializeRezgoCalendar, 0);
}
})();

/******/ })()
;