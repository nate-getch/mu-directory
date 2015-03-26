<!doctype html>
<html lang="en" ng-app="muDirectory">
<head>
	<meta charset="utf-8" />
	<title>Mekelle University - Campus Directory</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div class="container-mid">
	
		<header class="header">
			<h1>Search For People</h1>
		</header>
		
		<nav>
			<ul class="nav nav-pills">
				  <li class="active"><a href="index.php">People</a></li>
				  <li><a href="location.php">Location</a></li>
				  <li><a href="department.php">Department</a></li>
				  <li><a href="service.php">Service</a></li>
			</ul>
		</nav>
		
		<hr/>
		
		<section class="row">
			<aside class="col-md-3">
				<h4>Search Tips</h4>
				<p>Be specific in the search</p>
				<p>Spell correctly as possible</p>
			</aside>
			
			<div class="col-md-9" ng-controller="search" >
				  
				<div ng-repeat="r in result">{{r.name}}</div>
				  
				<form ng-submit="searchLib()" class="form-horizontal" id="searchForm" role="form" >
				  <div class="form-group">
					<label for="personName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="name" aria-required="true" ng-model="name" aria-label="enter person name" id="personName" value="">
					</div>
				  </div>			  
				  <div class="form-group">
					<label for="personStatus" class="col-sm-2 control-label">Status</label>
					<div class="col-sm-10">
					  <select class="form-control" name="status" ng-model="status" aria-label="select person status" id="personStatus" >
						<option selected value="1">Faculty</option>
						<option value="2">Staff</option>
						<option value="3">Student</option>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="department" class="col-sm-2 control-label">Department</label>
					<div class="col-sm-10">
					  <select class="form-control" name="department" ng-model="department" aria-label="select department" id="department" >
						<option selected value="0">Natural sciences</option>
						<option value="1">Computer Science</option>
						<option value="2">Health & Medical science</option>
						<option value="3">Technology & Engineering</option>
						<option value="4">Social Sciences & Languages</option>
						<option value="5">Business & Economics</option>
					  </select>
					</div>
				  </div>				  
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button aria-label="submit" type="submit" class="btn btn-default">Search</button>
					</div>
				  </div>
				  <div tabindex="30" id="error"></div>
				</form>
				
				<div id="result_counter" tabindex="4"></div>
				
				<div class="hidden search_result">
					<table class="table table-striped">
					  <thead>
						<th>Name</th>
						<th>Address</th>
					  </thead>
					  <tbody>
						  <tr ng-repeat="x in people">
							<td>{{ x.Name }}</td>
							<td>{{ x.Address }}</td>
						  </tr>
					  </tbody>
					</table>
				</div>

			</div>
		</section>
		
		<footer>
			<p> &copy; 2014 Ethiopian Institute of Technology - Mekelle.</p>
		</footer>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/jquery.hotkeys.js"></script>
	<script>
		var libraryApp = angular.module("muDirectory",[]);
		libraryApp.controller("search",function($scope, $http){
			$scope.searchLib = function(){
				var name = $scope.name;
				var status = $scope.status;
				var dep = $scope.department;
				if (!name){
					$('#error').html("<p class=\"bg-danger\">Error: Please Enter person name</p>").focus();
					return false;
				}
				else
				{
					$('#error').html("");
				}
				$http.get("search.php?q=people&name="+name+"&status="+status+"&dep="+dep)
				.success(function(response) {
				//$scope.result = response;
				if(!response){
					$('#error').html("<p class=\"bg-danger\">No result Found</p>").focus();
				}
				else{
					$scope.people = response;
					$('#searchForm').hide();
					$('.search_result').removeClass('hidden').show();
					$('#result_counter').html("<p class=\"bg-success\">"+$scope.people.length+" Results Found</p>").focus();
					//$('#result_counter').focus();
				}
				
				});
			}
		});
		
		function shortcutKey(){
			  /* keys
			  p = people
			  l = location
			  d = department
			  s = service
			  f = search form
			  */
			var elements = [
				"alt+p","alt+l","alt+d","alt+s","alt+f"
			];
			var pagename = location.pathname.split("/").slice(-1);

			// the fetching...
			$.each(elements, function(i, e) { // i is element index. e is element as text.
			   
			   // Binding keys
			   $(document).bind('keydown', elements[i], function assets() {
				   if(elements[i]=="alt+f"){
					$('#searchForm input').focus();
				   }
				   else if(elements[i]=="alt+p" && pagename != "index.php"){
					window.location.assign("index.php");
				   }
				   else if(elements[i]=="alt+l" && pagename != "location.php"){
					window.location.assign("location.php");
				   }
				   else if(elements[i]=="alt+d" && pagename != "department.php"){
					window.location.assign("department.php");
				   }	
				   else if(elements[i]=="alt+s" && pagename != "service.php"){
					window.location.assign("service.php");
				   }				   
				   else{
					alert(location.pathname.split("/").slice(-1));
				   }
				   
				   return false;
			   });
			});
			
		}
		
		jQuery(document).ready(shortcutKey);
	</script>
		
</body>
</html>