(() => {
  var __create = Object.create;
  var __defProp = Object.defineProperty;
  var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
  var __getOwnPropNames = Object.getOwnPropertyNames;
  var __getProtoOf = Object.getPrototypeOf;
  var __hasOwnProp = Object.prototype.hasOwnProperty;
  var __markAsModule = (target) => __defProp(target, "__esModule", { value: true });
  var __commonJS = (cb, mod) => function __require() {
    return mod || (0, cb[Object.keys(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
  };
  var __reExport = (target, module, desc) => {
    if (module && typeof module === "object" || typeof module === "function") {
      for (let key of __getOwnPropNames(module))
        if (!__hasOwnProp.call(target, key) && key !== "default")
          __defProp(target, key, { get: () => module[key], enumerable: !(desc = __getOwnPropDesc(module, key)) || desc.enumerable });
    }
    return target;
  };
  var __toModule = (module) => {
    return __reExport(__markAsModule(__defProp(module != null ? __create(__getProtoOf(module)) : {}, "default", module && module.__esModule && "default" in module ? { get: () => module.default, enumerable: true } : { value: module, enumerable: true })), module);
  };

  // node_modules/sprintf-js/src/sprintf.js
  var require_sprintf = __commonJS({
    "node_modules/sprintf-js/src/sprintf.js"(exports) {
      !function() {
        "use strict";
        var re = {
          not_string: /[^s]/,
          not_bool: /[^t]/,
          not_type: /[^T]/,
          not_primitive: /[^v]/,
          number: /[diefg]/,
          numeric_arg: /[bcdiefguxX]/,
          json: /[j]/,
          not_json: /[^j]/,
          text: /^[^\x25]+/,
          modulo: /^\x25{2}/,
          placeholder: /^\x25(?:([1-9]\d*)\$|\(([^)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-gijostTuvxX])/,
          key: /^([a-z_][a-z_\d]*)/i,
          key_access: /^\.([a-z_][a-z_\d]*)/i,
          index_access: /^\[(\d+)\]/,
          sign: /^[+-]/
        };
        function sprintf2(key) {
          return sprintf_format(sprintf_parse(key), arguments);
        }
        function vsprintf(fmt, argv) {
          return sprintf2.apply(null, [fmt].concat(argv || []));
        }
        function sprintf_format(parse_tree, argv) {
          var cursor = 1, tree_length = parse_tree.length, arg, output = "", i, k, ph, pad, pad_character, pad_length, is_positive, sign;
          for (i = 0; i < tree_length; i++) {
            if (typeof parse_tree[i] === "string") {
              output += parse_tree[i];
            } else if (typeof parse_tree[i] === "object") {
              ph = parse_tree[i];
              if (ph.keys) {
                arg = argv[cursor];
                for (k = 0; k < ph.keys.length; k++) {
                  if (arg == void 0) {
                    throw new Error(sprintf2('[sprintf] Cannot access property "%s" of undefined value "%s"', ph.keys[k], ph.keys[k - 1]));
                  }
                  arg = arg[ph.keys[k]];
                }
              } else if (ph.param_no) {
                arg = argv[ph.param_no];
              } else {
                arg = argv[cursor++];
              }
              if (re.not_type.test(ph.type) && re.not_primitive.test(ph.type) && arg instanceof Function) {
                arg = arg();
              }
              if (re.numeric_arg.test(ph.type) && (typeof arg !== "number" && isNaN(arg))) {
                throw new TypeError(sprintf2("[sprintf] expecting number but found %T", arg));
              }
              if (re.number.test(ph.type)) {
                is_positive = arg >= 0;
              }
              switch (ph.type) {
                case "b":
                  arg = parseInt(arg, 10).toString(2);
                  break;
                case "c":
                  arg = String.fromCharCode(parseInt(arg, 10));
                  break;
                case "d":
                case "i":
                  arg = parseInt(arg, 10);
                  break;
                case "j":
                  arg = JSON.stringify(arg, null, ph.width ? parseInt(ph.width) : 0);
                  break;
                case "e":
                  arg = ph.precision ? parseFloat(arg).toExponential(ph.precision) : parseFloat(arg).toExponential();
                  break;
                case "f":
                  arg = ph.precision ? parseFloat(arg).toFixed(ph.precision) : parseFloat(arg);
                  break;
                case "g":
                  arg = ph.precision ? String(Number(arg.toPrecision(ph.precision))) : parseFloat(arg);
                  break;
                case "o":
                  arg = (parseInt(arg, 10) >>> 0).toString(8);
                  break;
                case "s":
                  arg = String(arg);
                  arg = ph.precision ? arg.substring(0, ph.precision) : arg;
                  break;
                case "t":
                  arg = String(!!arg);
                  arg = ph.precision ? arg.substring(0, ph.precision) : arg;
                  break;
                case "T":
                  arg = Object.prototype.toString.call(arg).slice(8, -1).toLowerCase();
                  arg = ph.precision ? arg.substring(0, ph.precision) : arg;
                  break;
                case "u":
                  arg = parseInt(arg, 10) >>> 0;
                  break;
                case "v":
                  arg = arg.valueOf();
                  arg = ph.precision ? arg.substring(0, ph.precision) : arg;
                  break;
                case "x":
                  arg = (parseInt(arg, 10) >>> 0).toString(16);
                  break;
                case "X":
                  arg = (parseInt(arg, 10) >>> 0).toString(16).toUpperCase();
                  break;
              }
              if (re.json.test(ph.type)) {
                output += arg;
              } else {
                if (re.number.test(ph.type) && (!is_positive || ph.sign)) {
                  sign = is_positive ? "+" : "-";
                  arg = arg.toString().replace(re.sign, "");
                } else {
                  sign = "";
                }
                pad_character = ph.pad_char ? ph.pad_char === "0" ? "0" : ph.pad_char.charAt(1) : " ";
                pad_length = ph.width - (sign + arg).length;
                pad = ph.width ? pad_length > 0 ? pad_character.repeat(pad_length) : "" : "";
                output += ph.align ? sign + arg + pad : pad_character === "0" ? sign + pad + arg : pad + sign + arg;
              }
            }
          }
          return output;
        }
        var sprintf_cache = Object.create(null);
        function sprintf_parse(fmt) {
          if (sprintf_cache[fmt]) {
            return sprintf_cache[fmt];
          }
          var _fmt = fmt, match, parse_tree = [], arg_names = 0;
          while (_fmt) {
            if ((match = re.text.exec(_fmt)) !== null) {
              parse_tree.push(match[0]);
            } else if ((match = re.modulo.exec(_fmt)) !== null) {
              parse_tree.push("%");
            } else if ((match = re.placeholder.exec(_fmt)) !== null) {
              if (match[2]) {
                arg_names |= 1;
                var field_list = [], replacement_field = match[2], field_match = [];
                if ((field_match = re.key.exec(replacement_field)) !== null) {
                  field_list.push(field_match[1]);
                  while ((replacement_field = replacement_field.substring(field_match[0].length)) !== "") {
                    if ((field_match = re.key_access.exec(replacement_field)) !== null) {
                      field_list.push(field_match[1]);
                    } else if ((field_match = re.index_access.exec(replacement_field)) !== null) {
                      field_list.push(field_match[1]);
                    } else {
                      throw new SyntaxError("[sprintf] failed to parse named argument key");
                    }
                  }
                } else {
                  throw new SyntaxError("[sprintf] failed to parse named argument key");
                }
                match[2] = field_list;
              } else {
                arg_names |= 2;
              }
              if (arg_names === 3) {
                throw new Error("[sprintf] mixing positional and named placeholders is not (yet) supported");
              }
              parse_tree.push({
                placeholder: match[0],
                param_no: match[1],
                keys: match[2],
                sign: match[3],
                pad_char: match[4],
                align: match[5],
                width: match[6],
                precision: match[7],
                type: match[8]
              });
            } else {
              throw new SyntaxError("[sprintf] unexpected placeholder");
            }
            _fmt = _fmt.substring(match[0].length);
          }
          return sprintf_cache[fmt] = parse_tree;
        }
        if (typeof exports !== "undefined") {
          exports["sprintf"] = sprintf2;
          exports["vsprintf"] = vsprintf;
        }
        if (typeof window !== "undefined") {
          window["sprintf"] = sprintf2;
          window["vsprintf"] = vsprintf;
          if (typeof define === "function" && define["amd"]) {
            define(function() {
              return {
                "sprintf": sprintf2,
                "vsprintf": vsprintf
              };
            });
          }
        }
      }();
    }
  });

  // node_modules/memize/dist/index.js
  function memize(fn, options) {
    var size = 0;
    var head;
    var tail;
    options = options || {};
    function memoized() {
      var node = head, len = arguments.length, args, i;
      searchCache:
        while (node) {
          if (node.args.length !== arguments.length) {
            node = node.next;
            continue;
          }
          for (i = 0; i < len; i++) {
            if (node.args[i] !== arguments[i]) {
              node = node.next;
              continue searchCache;
            }
          }
          if (node !== head) {
            if (node === tail) {
              tail = node.prev;
            }
            node.prev.next = node.next;
            if (node.next) {
              node.next.prev = node.prev;
            }
            node.next = head;
            node.prev = null;
            head.prev = node;
            head = node;
          }
          return node.val;
        }
      args = new Array(len);
      for (i = 0; i < len; i++) {
        args[i] = arguments[i];
      }
      node = {
        args,
        val: fn.apply(null, args)
      };
      if (head) {
        head.prev = node;
        node.next = head;
      } else {
        tail = node;
      }
      if (size === options.maxSize) {
        tail = tail.prev;
        tail.next = null;
      } else {
        size++;
      }
      head = node;
      return node.val;
    }
    memoized.clear = function() {
      head = null;
      tail = null;
      size = 0;
    };
    return memoized;
  }

  // node_modules/@wordpress/i18n/build-module/sprintf.js
  var import_sprintf_js = __toModule(require_sprintf());
  var logErrorOnce = memize(console.error);

  // node_modules/@tannin/postfix/index.js
  var PRECEDENCE;
  var OPENERS;
  var TERMINATORS;
  var PATTERN;
  PRECEDENCE = {
    "(": 9,
    "!": 8,
    "*": 7,
    "/": 7,
    "%": 7,
    "+": 6,
    "-": 6,
    "<": 5,
    "<=": 5,
    ">": 5,
    ">=": 5,
    "==": 4,
    "!=": 4,
    "&&": 3,
    "||": 2,
    "?": 1,
    "?:": 1
  };
  OPENERS = ["(", "?"];
  TERMINATORS = {
    ")": ["("],
    ":": ["?", "?:"]
  };
  PATTERN = /<=|>=|==|!=|&&|\|\||\?:|\(|!|\*|\/|%|\+|-|<|>|\?|\)|:/;
  function postfix(expression) {
    var terms = [], stack = [], match, operator, term, element;
    while (match = expression.match(PATTERN)) {
      operator = match[0];
      term = expression.substr(0, match.index).trim();
      if (term) {
        terms.push(term);
      }
      while (element = stack.pop()) {
        if (TERMINATORS[operator]) {
          if (TERMINATORS[operator][0] === element) {
            operator = TERMINATORS[operator][1] || operator;
            break;
          }
        } else if (OPENERS.indexOf(element) >= 0 || PRECEDENCE[element] < PRECEDENCE[operator]) {
          stack.push(element);
          break;
        }
        terms.push(element);
      }
      if (!TERMINATORS[operator]) {
        stack.push(operator);
      }
      expression = expression.substr(match.index + operator.length);
    }
    expression = expression.trim();
    if (expression) {
      terms.push(expression);
    }
    return terms.concat(stack.reverse());
  }

  // node_modules/@tannin/evaluate/index.js
  var OPERATORS = {
    "!": function(a) {
      return !a;
    },
    "*": function(a, b) {
      return a * b;
    },
    "/": function(a, b) {
      return a / b;
    },
    "%": function(a, b) {
      return a % b;
    },
    "+": function(a, b) {
      return a + b;
    },
    "-": function(a, b) {
      return a - b;
    },
    "<": function(a, b) {
      return a < b;
    },
    "<=": function(a, b) {
      return a <= b;
    },
    ">": function(a, b) {
      return a > b;
    },
    ">=": function(a, b) {
      return a >= b;
    },
    "==": function(a, b) {
      return a === b;
    },
    "!=": function(a, b) {
      return a !== b;
    },
    "&&": function(a, b) {
      return a && b;
    },
    "||": function(a, b) {
      return a || b;
    },
    "?:": function(a, b, c) {
      if (a) {
        throw b;
      }
      return c;
    }
  };
  function evaluate(postfix2, variables) {
    var stack = [], i, j, args, getOperatorResult, term, value;
    for (i = 0; i < postfix2.length; i++) {
      term = postfix2[i];
      getOperatorResult = OPERATORS[term];
      if (getOperatorResult) {
        j = getOperatorResult.length;
        args = Array(j);
        while (j--) {
          args[j] = stack.pop();
        }
        try {
          value = getOperatorResult.apply(null, args);
        } catch (earlyReturn) {
          return earlyReturn;
        }
      } else if (variables.hasOwnProperty(term)) {
        value = variables[term];
      } else {
        value = +term;
      }
      stack.push(value);
    }
    return stack[0];
  }

  // node_modules/@tannin/compile/index.js
  function compile(expression) {
    var terms = postfix(expression);
    return function(variables) {
      return evaluate(terms, variables);
    };
  }

  // node_modules/@tannin/plural-forms/index.js
  function pluralForms(expression) {
    var evaluate2 = compile(expression);
    return function(n) {
      return +evaluate2({ n });
    };
  }

  // node_modules/tannin/index.js
  var DEFAULT_OPTIONS = {
    contextDelimiter: "",
    onMissingKey: null
  };
  function getPluralExpression(pf) {
    var parts, i, part;
    parts = pf.split(";");
    for (i = 0; i < parts.length; i++) {
      part = parts[i].trim();
      if (part.indexOf("plural=") === 0) {
        return part.substr(7);
      }
    }
  }
  function Tannin(data, options) {
    var key;
    this.data = data;
    this.pluralForms = {};
    this.options = {};
    for (key in DEFAULT_OPTIONS) {
      this.options[key] = options !== void 0 && key in options ? options[key] : DEFAULT_OPTIONS[key];
    }
  }
  Tannin.prototype.getPluralForm = function(domain, n) {
    var getPluralForm = this.pluralForms[domain], config, plural, pf;
    if (!getPluralForm) {
      config = this.data[domain][""];
      pf = config["Plural-Forms"] || config["plural-forms"] || config.plural_forms;
      if (typeof pf !== "function") {
        plural = getPluralExpression(config["Plural-Forms"] || config["plural-forms"] || config.plural_forms);
        pf = pluralForms(plural);
      }
      getPluralForm = this.pluralForms[domain] = pf;
    }
    return getPluralForm(n);
  };
  Tannin.prototype.dcnpgettext = function(domain, context, singular, plural, n) {
    var index, key, entry;
    if (n === void 0) {
      index = 0;
    } else {
      index = this.getPluralForm(domain, n);
    }
    key = singular;
    if (context) {
      key = context + this.options.contextDelimiter + singular;
    }
    entry = this.data[domain][key];
    if (entry && entry[index]) {
      return entry[index];
    }
    if (this.options.onMissingKey) {
      this.options.onMissingKey(singular, domain);
    }
    return index === 0 ? singular : plural;
  };

  // node_modules/@wordpress/i18n/build-module/create-i18n.js
  var DEFAULT_LOCALE_DATA = {
    "": {
      plural_forms(n) {
        return n === 1 ? 0 : 1;
      }
    }
  };
  var I18N_HOOK_REGEXP = /^i18n\.(n?gettext|has_translation)(_|$)/;
  var createI18n = (initialData, initialDomain, hooks) => {
    const tannin = new Tannin({});
    const listeners = new Set();
    const notifyListeners = () => {
      listeners.forEach((listener) => listener());
    };
    const subscribe2 = (callback) => {
      listeners.add(callback);
      return () => listeners.delete(callback);
    };
    const getLocaleData2 = (domain = "default") => tannin.data[domain];
    const doSetLocaleData = (data, domain = "default") => {
      tannin.data[domain] = {
        ...tannin.data[domain],
        ...data
      };
      tannin.data[domain][""] = {
        ...DEFAULT_LOCALE_DATA[""],
        ...tannin.data[domain]?.[""]
      };
      delete tannin.pluralForms[domain];
    };
    const setLocaleData2 = (data, domain) => {
      doSetLocaleData(data, domain);
      notifyListeners();
    };
    const addLocaleData = (data, domain = "default") => {
      tannin.data[domain] = {
        ...tannin.data[domain],
        ...data,
        "": {
          ...DEFAULT_LOCALE_DATA[""],
          ...tannin.data[domain]?.[""],
          ...data?.[""]
        }
      };
      delete tannin.pluralForms[domain];
      notifyListeners();
    };
    const resetLocaleData2 = (data, domain) => {
      tannin.data = {};
      tannin.pluralForms = {};
      setLocaleData2(data, domain);
    };
    const dcnpgettext = (domain = "default", context, single, plural, number) => {
      if (!tannin.data[domain]) {
        doSetLocaleData(void 0, domain);
      }
      return tannin.dcnpgettext(domain, context, single, plural, number);
    };
    const getFilterDomain = (domain = "default") => domain;
    const __2 = (text, domain) => {
      let translation = dcnpgettext(domain, void 0, text);
      if (!hooks) {
        return translation;
      }
      translation = hooks.applyFilters("i18n.gettext", translation, text, domain);
      return hooks.applyFilters("i18n.gettext_" + getFilterDomain(domain), translation, text, domain);
    };
    const _x2 = (text, context, domain) => {
      let translation = dcnpgettext(domain, context, text);
      if (!hooks) {
        return translation;
      }
      translation = hooks.applyFilters("i18n.gettext_with_context", translation, text, context, domain);
      return hooks.applyFilters("i18n.gettext_with_context_" + getFilterDomain(domain), translation, text, context, domain);
    };
    const _n2 = (single, plural, number, domain) => {
      let translation = dcnpgettext(domain, void 0, single, plural, number);
      if (!hooks) {
        return translation;
      }
      translation = hooks.applyFilters("i18n.ngettext", translation, single, plural, number, domain);
      return hooks.applyFilters("i18n.ngettext_" + getFilterDomain(domain), translation, single, plural, number, domain);
    };
    const _nx2 = (single, plural, number, context, domain) => {
      let translation = dcnpgettext(domain, context, single, plural, number);
      if (!hooks) {
        return translation;
      }
      translation = hooks.applyFilters("i18n.ngettext_with_context", translation, single, plural, number, context, domain);
      return hooks.applyFilters("i18n.ngettext_with_context_" + getFilterDomain(domain), translation, single, plural, number, context, domain);
    };
    const isRTL2 = () => {
      return _x2("ltr", "text direction") === "rtl";
    };
    const hasTranslation2 = (single, context, domain) => {
      const key = context ? context + "" + single : single;
      let result = !!tannin.data?.[domain !== null && domain !== void 0 ? domain : "default"]?.[key];
      if (hooks) {
        result = hooks.applyFilters("i18n.has_translation", result, single, context, domain);
        result = hooks.applyFilters("i18n.has_translation_" + getFilterDomain(domain), result, single, context, domain);
      }
      return result;
    };
    if (initialData) {
      setLocaleData2(initialData, initialDomain);
    }
    if (hooks) {
      const onHookAddedOrRemoved = (hookName) => {
        if (I18N_HOOK_REGEXP.test(hookName)) {
          notifyListeners();
        }
      };
      hooks.addAction("hookAdded", "core/i18n", onHookAddedOrRemoved);
      hooks.addAction("hookRemoved", "core/i18n", onHookAddedOrRemoved);
    }
    return {
      getLocaleData: getLocaleData2,
      setLocaleData: setLocaleData2,
      addLocaleData,
      resetLocaleData: resetLocaleData2,
      subscribe: subscribe2,
      __: __2,
      _x: _x2,
      _n: _n2,
      _nx: _nx2,
      isRTL: isRTL2,
      hasTranslation: hasTranslation2
    };
  };

  // node_modules/@wordpress/hooks/build-module/validateNamespace.js
  function validateNamespace(namespace) {
    if (typeof namespace !== "string" || namespace === "") {
      console.error("The namespace must be a non-empty string.");
      return false;
    }
    if (!/^[a-zA-Z][a-zA-Z0-9_.\-\/]*$/.test(namespace)) {
      console.error("The namespace can only contain numbers, letters, dashes, periods, underscores and slashes.");
      return false;
    }
    return true;
  }
  var validateNamespace_default = validateNamespace;

  // node_modules/@wordpress/hooks/build-module/validateHookName.js
  function validateHookName(hookName) {
    if (typeof hookName !== "string" || hookName === "") {
      console.error("The hook name must be a non-empty string.");
      return false;
    }
    if (/^__/.test(hookName)) {
      console.error("The hook name cannot begin with `__`.");
      return false;
    }
    if (!/^[a-zA-Z][a-zA-Z0-9_.-]*$/.test(hookName)) {
      console.error("The hook name can only contain numbers, letters, dashes, periods and underscores.");
      return false;
    }
    return true;
  }
  var validateHookName_default = validateHookName;

  // node_modules/@wordpress/hooks/build-module/createAddHook.js
  function createAddHook(hooks, storeKey) {
    return function addHook(hookName, namespace, callback, priority = 10) {
      const hooksStore = hooks[storeKey];
      if (!validateHookName_default(hookName)) {
        return;
      }
      if (!validateNamespace_default(namespace)) {
        return;
      }
      if (typeof callback !== "function") {
        console.error("The hook callback must be a function.");
        return;
      }
      if (typeof priority !== "number") {
        console.error("If specified, the hook priority must be a number.");
        return;
      }
      const handler = {
        callback,
        priority,
        namespace
      };
      if (hooksStore[hookName]) {
        const handlers = hooksStore[hookName].handlers;
        let i;
        for (i = handlers.length; i > 0; i--) {
          if (priority >= handlers[i - 1].priority) {
            break;
          }
        }
        if (i === handlers.length) {
          handlers[i] = handler;
        } else {
          handlers.splice(i, 0, handler);
        }
        hooksStore.__current.forEach((hookInfo) => {
          if (hookInfo.name === hookName && hookInfo.currentIndex >= i) {
            hookInfo.currentIndex++;
          }
        });
      } else {
        hooksStore[hookName] = {
          handlers: [handler],
          runs: 0
        };
      }
      if (hookName !== "hookAdded") {
        hooks.doAction("hookAdded", hookName, namespace, callback, priority);
      }
    };
  }
  var createAddHook_default = createAddHook;

  // node_modules/@wordpress/hooks/build-module/createRemoveHook.js
  function createRemoveHook(hooks, storeKey, removeAll = false) {
    return function removeHook(hookName, namespace) {
      const hooksStore = hooks[storeKey];
      if (!validateHookName_default(hookName)) {
        return;
      }
      if (!removeAll && !validateNamespace_default(namespace)) {
        return;
      }
      if (!hooksStore[hookName]) {
        return 0;
      }
      let handlersRemoved = 0;
      if (removeAll) {
        handlersRemoved = hooksStore[hookName].handlers.length;
        hooksStore[hookName] = {
          runs: hooksStore[hookName].runs,
          handlers: []
        };
      } else {
        const handlers = hooksStore[hookName].handlers;
        for (let i = handlers.length - 1; i >= 0; i--) {
          if (handlers[i].namespace === namespace) {
            handlers.splice(i, 1);
            handlersRemoved++;
            hooksStore.__current.forEach((hookInfo) => {
              if (hookInfo.name === hookName && hookInfo.currentIndex >= i) {
                hookInfo.currentIndex--;
              }
            });
          }
        }
      }
      if (hookName !== "hookRemoved") {
        hooks.doAction("hookRemoved", hookName, namespace);
      }
      return handlersRemoved;
    };
  }
  var createRemoveHook_default = createRemoveHook;

  // node_modules/@wordpress/hooks/build-module/createHasHook.js
  function createHasHook(hooks, storeKey) {
    return function hasHook(hookName, namespace) {
      const hooksStore = hooks[storeKey];
      if (typeof namespace !== "undefined") {
        return hookName in hooksStore && hooksStore[hookName].handlers.some((hook) => hook.namespace === namespace);
      }
      return hookName in hooksStore;
    };
  }
  var createHasHook_default = createHasHook;

  // node_modules/@wordpress/hooks/build-module/createRunHook.js
  function createRunHook(hooks, storeKey, returnFirstArg = false) {
    return function runHooks(hookName, ...args) {
      const hooksStore = hooks[storeKey];
      if (!hooksStore[hookName]) {
        hooksStore[hookName] = {
          handlers: [],
          runs: 0
        };
      }
      hooksStore[hookName].runs++;
      const handlers = hooksStore[hookName].handlers;
      if (true) {
        if (hookName !== "hookAdded" && hooksStore.all) {
          handlers.push(...hooksStore.all.handlers);
        }
      }
      if (!handlers || !handlers.length) {
        return returnFirstArg ? args[0] : void 0;
      }
      const hookInfo = {
        name: hookName,
        currentIndex: 0
      };
      hooksStore.__current.push(hookInfo);
      while (hookInfo.currentIndex < handlers.length) {
        const handler = handlers[hookInfo.currentIndex];
        const result = handler.callback.apply(null, args);
        if (returnFirstArg) {
          args[0] = result;
        }
        hookInfo.currentIndex++;
      }
      hooksStore.__current.pop();
      if (returnFirstArg) {
        return args[0];
      }
      return void 0;
    };
  }
  var createRunHook_default = createRunHook;

  // node_modules/@wordpress/hooks/build-module/createCurrentHook.js
  function createCurrentHook(hooks, storeKey) {
    return function currentHook() {
      var _hooksStore$__current;
      const hooksStore = hooks[storeKey];
      return (_hooksStore$__current = hooksStore.__current[hooksStore.__current.length - 1]?.name) !== null && _hooksStore$__current !== void 0 ? _hooksStore$__current : null;
    };
  }
  var createCurrentHook_default = createCurrentHook;

  // node_modules/@wordpress/hooks/build-module/createDoingHook.js
  function createDoingHook(hooks, storeKey) {
    return function doingHook(hookName) {
      const hooksStore = hooks[storeKey];
      if (typeof hookName === "undefined") {
        return typeof hooksStore.__current[0] !== "undefined";
      }
      return hooksStore.__current[0] ? hookName === hooksStore.__current[0].name : false;
    };
  }
  var createDoingHook_default = createDoingHook;

  // node_modules/@wordpress/hooks/build-module/createDidHook.js
  function createDidHook(hooks, storeKey) {
    return function didHook(hookName) {
      const hooksStore = hooks[storeKey];
      if (!validateHookName_default(hookName)) {
        return;
      }
      return hooksStore[hookName] && hooksStore[hookName].runs ? hooksStore[hookName].runs : 0;
    };
  }
  var createDidHook_default = createDidHook;

  // node_modules/@wordpress/hooks/build-module/createHooks.js
  var _Hooks = class {
    constructor() {
      this.actions = Object.create(null);
      this.actions.__current = [];
      this.filters = Object.create(null);
      this.filters.__current = [];
      this.addAction = createAddHook_default(this, "actions");
      this.addFilter = createAddHook_default(this, "filters");
      this.removeAction = createRemoveHook_default(this, "actions");
      this.removeFilter = createRemoveHook_default(this, "filters");
      this.hasAction = createHasHook_default(this, "actions");
      this.hasFilter = createHasHook_default(this, "filters");
      this.removeAllActions = createRemoveHook_default(this, "actions", true);
      this.removeAllFilters = createRemoveHook_default(this, "filters", true);
      this.doAction = createRunHook_default(this, "actions");
      this.applyFilters = createRunHook_default(this, "filters", true);
      this.currentAction = createCurrentHook_default(this, "actions");
      this.currentFilter = createCurrentHook_default(this, "filters");
      this.doingAction = createDoingHook_default(this, "actions");
      this.doingFilter = createDoingHook_default(this, "filters");
      this.didAction = createDidHook_default(this, "actions");
      this.didFilter = createDidHook_default(this, "filters");
    }
  };
  function createHooks() {
    return new _Hooks();
  }
  var createHooks_default = createHooks;

  // node_modules/@wordpress/hooks/build-module/index.js
  var defaultHooks = createHooks_default();

  // node_modules/@wordpress/i18n/build-module/default-i18n.js
  var i18n = createI18n(void 0, void 0, defaultHooks);
  var getLocaleData = i18n.getLocaleData.bind(i18n);
  var setLocaleData = i18n.setLocaleData.bind(i18n);
  var resetLocaleData = i18n.resetLocaleData.bind(i18n);
  var subscribe = i18n.subscribe.bind(i18n);
  var __ = i18n.__.bind(i18n);
  var _x = i18n._x.bind(i18n);
  var _n = i18n._n.bind(i18n);
  var _nx = i18n._nx.bind(i18n);
  var isRTL = i18n.isRTL.bind(i18n);
  var hasTranslation = i18n.hasTranslation.bind(i18n);

  // node_modules/@wordpress/api-fetch/build-module/middlewares/nonce.js
  function createNonceMiddleware(nonce) {
    const middleware = (options, next) => {
      const {
        headers = {}
      } = options;
      for (const headerName in headers) {
        if (headerName.toLowerCase() === "x-wp-nonce" && headers[headerName] === middleware.nonce) {
          return next(options);
        }
      }
      return next({
        ...options,
        headers: {
          ...headers,
          "X-WP-Nonce": middleware.nonce
        }
      });
    };
    middleware.nonce = nonce;
    return middleware;
  }
  var nonce_default = createNonceMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/namespace-endpoint.js
  var namespaceAndEndpointMiddleware = (options, next) => {
    let path = options.path;
    let namespaceTrimmed, endpointTrimmed;
    if (typeof options.namespace === "string" && typeof options.endpoint === "string") {
      namespaceTrimmed = options.namespace.replace(/^\/|\/$/g, "");
      endpointTrimmed = options.endpoint.replace(/^\//, "");
      if (endpointTrimmed) {
        path = namespaceTrimmed + "/" + endpointTrimmed;
      } else {
        path = namespaceTrimmed;
      }
    }
    delete options.namespace;
    delete options.endpoint;
    return next({
      ...options,
      path
    });
  };
  var namespace_endpoint_default = namespaceAndEndpointMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/root-url.js
  var createRootURLMiddleware = (rootURL) => (options, next) => {
    return namespace_endpoint_default(options, (optionsWithPath) => {
      let url = optionsWithPath.url;
      let path = optionsWithPath.path;
      let apiRoot;
      if (typeof path === "string") {
        apiRoot = rootURL;
        if (rootURL.indexOf("?") !== -1) {
          path = path.replace("?", "&");
        }
        path = path.replace(/^\//, "");
        if (typeof apiRoot === "string" && apiRoot.indexOf("?") !== -1) {
          path = path.replace("?", "&");
        }
        url = apiRoot + path;
      }
      return next({
        ...optionsWithPath,
        url
      });
    });
  };
  var root_url_default = createRootURLMiddleware;

  // node_modules/@wordpress/url/build-module/get-query-string.js
  function getQueryString(url) {
    let query;
    try {
      query = new URL(url, "http://example.com").search.substring(1);
    } catch (error) {
    }
    if (query) {
      return query;
    }
  }

  // node_modules/@wordpress/url/build-module/build-query-string.js
  function buildQueryString(data) {
    let string = "";
    const stack = Object.entries(data);
    let pair;
    while (pair = stack.shift()) {
      let [key, value] = pair;
      const hasNestedData = Array.isArray(value) || value && value.constructor === Object;
      if (hasNestedData) {
        const valuePairs = Object.entries(value).reverse();
        for (const [member, memberValue] of valuePairs) {
          stack.unshift([`${key}[${member}]`, memberValue]);
        }
      } else if (value !== void 0) {
        if (value === null) {
          value = "";
        }
        string += "&" + [key, value].map(encodeURIComponent).join("=");
      }
    }
    return string.substr(1);
  }

  // node_modules/@wordpress/url/build-module/safe-decode-uri-component.js
  function safeDecodeURIComponent(uriComponent) {
    try {
      return decodeURIComponent(uriComponent);
    } catch (uriComponentError) {
      return uriComponent;
    }
  }

  // node_modules/@wordpress/url/build-module/get-query-args.js
  function setPath(object, path, value) {
    const length = path.length;
    const lastIndex = length - 1;
    for (let i = 0; i < length; i++) {
      let key = path[i];
      if (!key && Array.isArray(object)) {
        key = object.length.toString();
      }
      key = ["__proto__", "constructor", "prototype"].includes(key) ? key.toUpperCase() : key;
      const isNextKeyArrayIndex = !isNaN(Number(path[i + 1]));
      object[key] = i === lastIndex ? value : object[key] || (isNextKeyArrayIndex ? [] : {});
      if (Array.isArray(object[key]) && !isNextKeyArrayIndex) {
        object[key] = {
          ...object[key]
        };
      }
      object = object[key];
    }
  }
  function getQueryArgs(url) {
    return (getQueryString(url) || "").replace(/\+/g, "%20").split("&").reduce((accumulator, keyValue) => {
      const [key, value = ""] = keyValue.split("=").filter(Boolean).map(safeDecodeURIComponent);
      if (key) {
        const segments = key.replace(/\]/g, "").split("[");
        setPath(accumulator, segments, value);
      }
      return accumulator;
    }, Object.create(null));
  }

  // node_modules/@wordpress/url/build-module/add-query-args.js
  function addQueryArgs(url = "", args) {
    if (!args || !Object.keys(args).length) {
      return url;
    }
    let baseUrl = url;
    const queryStringIndex = url.indexOf("?");
    if (queryStringIndex !== -1) {
      args = Object.assign(getQueryArgs(url), args);
      baseUrl = baseUrl.substr(0, queryStringIndex);
    }
    return baseUrl + "?" + buildQueryString(args);
  }

  // node_modules/@wordpress/url/build-module/get-query-arg.js
  function getQueryArg(url, arg) {
    return getQueryArgs(url)[arg];
  }

  // node_modules/@wordpress/url/build-module/has-query-arg.js
  function hasQueryArg(url, arg) {
    return getQueryArg(url, arg) !== void 0;
  }

  // node_modules/@wordpress/url/build-module/normalize-path.js
  function normalizePath(path) {
    const splitted = path.split("?");
    const query = splitted[1];
    const base = splitted[0];
    if (!query) {
      return base;
    }
    return base + "?" + query.split("&").map((entry) => entry.split("=")).map((pair) => pair.map(decodeURIComponent)).sort((a, b) => a[0].localeCompare(b[0])).map((pair) => pair.map(encodeURIComponent)).map((pair) => pair.join("=")).join("&");
  }

  // node_modules/@wordpress/api-fetch/build-module/middlewares/preloading.js
  function createPreloadingMiddleware(preloadedData) {
    const cache = Object.fromEntries(Object.entries(preloadedData).map(([path, data]) => [normalizePath(path), data]));
    return (options, next) => {
      const {
        parse = true
      } = options;
      let rawPath = options.path;
      if (!rawPath && options.url) {
        const {
          rest_route: pathFromQuery,
          ...queryArgs
        } = getQueryArgs(options.url);
        if (typeof pathFromQuery === "string") {
          rawPath = addQueryArgs(pathFromQuery, queryArgs);
        }
      }
      if (typeof rawPath !== "string") {
        return next(options);
      }
      const method = options.method || "GET";
      const path = normalizePath(rawPath);
      if (method === "GET" && cache[path]) {
        const cacheData = cache[path];
        delete cache[path];
        return prepareResponse(cacheData, !!parse);
      } else if (method === "OPTIONS" && cache[method] && cache[method][path]) {
        const cacheData = cache[method][path];
        delete cache[method][path];
        return prepareResponse(cacheData, !!parse);
      }
      return next(options);
    };
  }
  function prepareResponse(responseData, parse) {
    return Promise.resolve(parse ? responseData.body : new window.Response(JSON.stringify(responseData.body), {
      status: 200,
      statusText: "OK",
      headers: responseData.headers
    }));
  }
  var preloading_default = createPreloadingMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/fetch-all-middleware.js
  var modifyQuery = ({
    path,
    url,
    ...options
  }, queryArgs) => ({
    ...options,
    url: url && addQueryArgs(url, queryArgs),
    path: path && addQueryArgs(path, queryArgs)
  });
  var parseResponse = (response) => response.json ? response.json() : Promise.reject(response);
  var parseLinkHeader = (linkHeader) => {
    if (!linkHeader) {
      return {};
    }
    const match = linkHeader.match(/<([^>]+)>; rel="next"/);
    return match ? {
      next: match[1]
    } : {};
  };
  var getNextPageUrl = (response) => {
    const {
      next
    } = parseLinkHeader(response.headers.get("link"));
    return next;
  };
  var requestContainsUnboundedQuery = (options) => {
    const pathIsUnbounded = !!options.path && options.path.indexOf("per_page=-1") !== -1;
    const urlIsUnbounded = !!options.url && options.url.indexOf("per_page=-1") !== -1;
    return pathIsUnbounded || urlIsUnbounded;
  };
  var fetchAllMiddleware = async (options, next) => {
    if (options.parse === false) {
      return next(options);
    }
    if (!requestContainsUnboundedQuery(options)) {
      return next(options);
    }
    const response = await build_module_default({
      ...modifyQuery(options, {
        per_page: 100
      }),
      parse: false
    });
    const results = await parseResponse(response);
    if (!Array.isArray(results)) {
      return results;
    }
    let nextPage = getNextPageUrl(response);
    if (!nextPage) {
      return results;
    }
    let mergedResults = [].concat(results);
    while (nextPage) {
      const nextResponse = await build_module_default({
        ...options,
        path: void 0,
        url: nextPage,
        parse: false
      });
      const nextResults = await parseResponse(nextResponse);
      mergedResults = mergedResults.concat(nextResults);
      nextPage = getNextPageUrl(nextResponse);
    }
    return mergedResults;
  };
  var fetch_all_middleware_default = fetchAllMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/http-v1.js
  var OVERRIDE_METHODS = new Set(["PATCH", "PUT", "DELETE"]);
  var DEFAULT_METHOD = "GET";
  var httpV1Middleware = (options, next) => {
    const {
      method = DEFAULT_METHOD
    } = options;
    if (OVERRIDE_METHODS.has(method.toUpperCase())) {
      options = {
        ...options,
        headers: {
          ...options.headers,
          "X-HTTP-Method-Override": method,
          "Content-Type": "application/json"
        },
        method: "POST"
      };
    }
    return next(options);
  };
  var http_v1_default = httpV1Middleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/user-locale.js
  var userLocaleMiddleware = (options, next) => {
    if (typeof options.url === "string" && !hasQueryArg(options.url, "_locale")) {
      options.url = addQueryArgs(options.url, {
        _locale: "user"
      });
    }
    if (typeof options.path === "string" && !hasQueryArg(options.path, "_locale")) {
      options.path = addQueryArgs(options.path, {
        _locale: "user"
      });
    }
    return next(options);
  };
  var user_locale_default = userLocaleMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/utils/response.js
  var parseResponse2 = (response, shouldParseResponse = true) => {
    if (shouldParseResponse) {
      if (response.status === 204) {
        return null;
      }
      return response.json ? response.json() : Promise.reject(response);
    }
    return response;
  };
  var parseJsonAndNormalizeError = (response) => {
    const invalidJsonError = {
      code: "invalid_json",
      message: __("The response is not a valid JSON response.")
    };
    if (!response || !response.json) {
      throw invalidJsonError;
    }
    return response.json().catch(() => {
      throw invalidJsonError;
    });
  };
  var parseResponseAndNormalizeError = (response, shouldParseResponse = true) => {
    return Promise.resolve(parseResponse2(response, shouldParseResponse)).catch((res) => parseAndThrowError(res, shouldParseResponse));
  };
  function parseAndThrowError(response, shouldParseResponse = true) {
    if (!shouldParseResponse) {
      throw response;
    }
    return parseJsonAndNormalizeError(response).then((error) => {
      const unknownError = {
        code: "unknown_error",
        message: __("An unknown error occurred.")
      };
      throw error || unknownError;
    });
  }

  // node_modules/@wordpress/api-fetch/build-module/middlewares/media-upload.js
  function isMediaUploadRequest(options) {
    const isCreateMethod = !!options.method && options.method === "POST";
    const isMediaEndpoint = !!options.path && options.path.indexOf("/wp/v2/media") !== -1 || !!options.url && options.url.indexOf("/wp/v2/media") !== -1;
    return isMediaEndpoint && isCreateMethod;
  }
  var mediaUploadMiddleware = (options, next) => {
    if (!isMediaUploadRequest(options)) {
      return next(options);
    }
    let retries = 0;
    const maxRetries = 5;
    const postProcess = (attachmentId) => {
      retries++;
      return next({
        path: `/wp/v2/media/${attachmentId}/post-process`,
        method: "POST",
        data: {
          action: "create-image-subsizes"
        },
        parse: false
      }).catch(() => {
        if (retries < maxRetries) {
          return postProcess(attachmentId);
        }
        next({
          path: `/wp/v2/media/${attachmentId}?force=true`,
          method: "DELETE"
        });
        return Promise.reject();
      });
    };
    return next({
      ...options,
      parse: false
    }).catch((response) => {
      const attachmentId = response.headers.get("x-wp-upload-attachment-id");
      if (response.status >= 500 && response.status < 600 && attachmentId) {
        return postProcess(attachmentId).catch(() => {
          if (options.parse !== false) {
            return Promise.reject({
              code: "post_process",
              message: __("Media upload failed. If this is a photo or a large image, please scale it down and try again.")
            });
          }
          return Promise.reject(response);
        });
      }
      return parseAndThrowError(response, options.parse);
    }).then((response) => parseResponseAndNormalizeError(response, options.parse));
  };
  var media_upload_default = mediaUploadMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/middlewares/theme-preview.js
  var createThemePreviewMiddleware = (themePath) => (options, next) => {
    if (typeof options.url === "string" && !hasQueryArg(options.url, "wp_theme_preview")) {
      options.url = addQueryArgs(options.url, {
        wp_theme_preview: themePath
      });
    }
    if (typeof options.path === "string" && !hasQueryArg(options.path, "wp_theme_preview")) {
      options.path = addQueryArgs(options.path, {
        wp_theme_preview: themePath
      });
    }
    return next(options);
  };
  var theme_preview_default = createThemePreviewMiddleware;

  // node_modules/@wordpress/api-fetch/build-module/index.js
  var DEFAULT_HEADERS = {
    Accept: "application/json, */*;q=0.1"
  };
  var DEFAULT_OPTIONS2 = {
    credentials: "include"
  };
  var middlewares = [user_locale_default, namespace_endpoint_default, http_v1_default, fetch_all_middleware_default];
  function registerMiddleware(middleware) {
    middlewares.unshift(middleware);
  }
  var checkStatus = (response) => {
    if (response.status >= 200 && response.status < 300) {
      return response;
    }
    throw response;
  };
  var defaultFetchHandler = (nextOptions) => {
    const {
      url,
      path,
      data,
      parse = true,
      ...remainingOptions
    } = nextOptions;
    let {
      body,
      headers
    } = nextOptions;
    headers = {
      ...DEFAULT_HEADERS,
      ...headers
    };
    if (data) {
      body = JSON.stringify(data);
      headers["Content-Type"] = "application/json";
    }
    const responsePromise = window.fetch(url || path || window.location.href, {
      ...DEFAULT_OPTIONS2,
      ...remainingOptions,
      body,
      headers
    });
    return responsePromise.then((value) => Promise.resolve(value).then(checkStatus).catch((response) => parseAndThrowError(response, parse)).then((response) => parseResponseAndNormalizeError(response, parse)), (err) => {
      if (err && err.name === "AbortError") {
        throw err;
      }
      throw {
        code: "fetch_error",
        message: __("You are probably offline.")
      };
    });
  };
  var fetchHandler = defaultFetchHandler;
  function setFetchHandler(newFetchHandler) {
    fetchHandler = newFetchHandler;
  }
  function apiFetch(options) {
    const enhancedHandler = middlewares.reduceRight((next, middleware) => {
      return (workingOptions) => middleware(workingOptions, next);
    }, fetchHandler);
    return enhancedHandler(options).catch((error) => {
      if (error.code !== "rest_cookie_invalid_nonce") {
        return Promise.reject(error);
      }
      return window.fetch(apiFetch.nonceEndpoint).then(checkStatus).then((data) => data.text()).then((text) => {
        apiFetch.nonceMiddleware.nonce = text;
        return apiFetch(options);
      });
    });
  }
  apiFetch.use = registerMiddleware;
  apiFetch.setFetchHandler = setFetchHandler;
  apiFetch.createNonceMiddleware = nonce_default;
  apiFetch.createPreloadingMiddleware = preloading_default;
  apiFetch.createRootURLMiddleware = root_url_default;
  apiFetch.fetchAllMiddleware = fetch_all_middleware_default;
  apiFetch.mediaUploadMiddleware = media_upload_default;
  apiFetch.createThemePreviewMiddleware = theme_preview_default;
  var build_module_default = apiFetch;

  // resources/js/app.js
  function prepareNavController() {
    const main_navigation = document.querySelector(".csek-nav-menu");
    const nav_open_buttons = document.querySelectorAll("a[data-nav-open]");
    const nav_close_buttons = document.querySelectorAll("a[data-nav-close]");
    nav_close_buttons.forEach((button) => {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        main_navigation.classList.add("hidden-nav");
      });
    });
    nav_open_buttons.forEach((button) => {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        main_navigation.classList.toggle("hidden-nav");
      });
    });
  }
  async function addToggleHeaderButton() {
    const searchParams = new URLSearchParams(window.location.search);
    const preview = searchParams.get("preview");
    if (!preview || preview === false)
      return;
    const button = document.createElement("input");
    button.setAttribute("type", "checkbox");
    button.setAttribute("id", "toggle-header");
    button.setAttribute("class", "toggle-header");
    button.setAttribute("title", "Toggle Wordpress Header");
    button.addEventListener("change", (e) => {
      const checked = e.target.checked;
      const header = document.querySelector("#wpadminbar");
      if (checked) {
        header.classList.add("hide-header");
      } else {
        header.classList.remove("hide-header");
      }
    });
    document.body.appendChild(button);
  }
  window.addEventListener("load", () => {
    prepareNavController();
    addToggleHeaderButton();
  });
})();
