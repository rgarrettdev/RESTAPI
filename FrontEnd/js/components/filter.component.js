app.component("filter", {
  templateUrl: "views/template/filter.tpl.html",
  controller: function filterController($scope) {
    $scope.dropDownFilter = {
      option: "paper",
      options: [
        "miscellaneous",
        "keynote",
        "break",
        "paper",
        "course",
        "altchi",
        "SIG",
        "casestudy",
        "Competition",
        "Awards",
        "panel",
        "interactivity",
        "DC",
        "SDC",
        "lbw",
        "videoshowcase",
      ],
    };
  },
});
