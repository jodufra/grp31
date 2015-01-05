<select name="country" class="form-control col-md-4" ng-controller="CountriesController">
       <option ng-repeat="country in countries()" value="[[country]]" title="[[country]]" ng-bind="country"></option>
</select>