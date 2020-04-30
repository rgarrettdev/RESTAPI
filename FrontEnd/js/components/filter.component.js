app.component("filter", {
  templateUrl: "views/template/filter.tpl.html",
  controller: function filterController($scope) {
    $scope.dropDownFilter = {
      option: "Choose a Filter",
      options: [
        "Choose a Filter",
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
