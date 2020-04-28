app.factory("slotService", [
  "$cookies",
  function ($cookies) {
    var savedData = [];
    function set(data) {
      savedData = data;
      $cookies.put("slotID", savedData);
    }
    function get() {
      return $cookies.get("slotID");
    }

    return {
      set: set,
      get: get,
    };
  },
]);
