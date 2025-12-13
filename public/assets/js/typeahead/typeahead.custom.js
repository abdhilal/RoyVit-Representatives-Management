document.addEventListener("DOMContentLoaded", function () {
  function initChoices(selector, options){
    var el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return null;
    var isSelect = el.tagName === 'SELECT';
    var isText = el.tagName === 'INPUT' && (el.type === 'text' || el.type === 'search');
    if (!isSelect && !isText) return null;
    try { return new Choices(el, options || { allowHTML: true }); } catch (e) { return null; }
  }

  var singleNoSearch = initChoices("#choices-single-no-search", {
    allowHTML: true,
    searchEnabled: false,
    removeItemButton: true,
    choices: [
      { value: "One", label: "Alabama" },
      { value: "Two", label: "California", disabled: true },
      { value: "Three", label: "Colorado" },
    ],
  });
  if (singleNoSearch) {
    singleNoSearch.setChoices(
      [
        { value: "Four", label: "Indiana", disabled: true },
        { value: "Five", label: "Iowa" },
        { value: "Six", label: "Massachusetts", selected: true },
      ],
      "value",
      "label",
      false
    );
  }

  var multipleCancelButton = initChoices("#choices-multiple-remove-button", {
    allowHTML: true,
    removeItemButton: true,
  });

  initChoices("#choices-scrolling-dropdown", {
    allowHTML: true,
    shouldSort: false,
  });

  initChoices(document.getElementById("choices-multiple-groups"), { allowHTML: true });

  initChoices(document.getElementById("cities"), { allowHTML: true });

  initChoices(document.getElementById("rtl"), { allowHTML: true });
});
