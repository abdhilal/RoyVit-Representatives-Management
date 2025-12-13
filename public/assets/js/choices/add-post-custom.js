
document.addEventListener('DOMContentLoaded', function() {
    var el = document.querySelector('#choices-remove-button');
    if (el && (el.tagName === 'SELECT' || (el.tagName === 'INPUT' && (el.type === 'text' || el.type === 'search')))) {
      try {
        new Choices(el, {
          allowHTML: true,
          removeItemButton: true,
        });
      } catch (e) {}
    }
      var editor1 = new Quill("#editor1", {
        modules: { toolbar: "#toolbar1" },
        theme: "snow",
        placeholder: "Enter your messages...",
      });
});
